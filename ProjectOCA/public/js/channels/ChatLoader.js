document.addEventListener('DOMContentLoaded', () => {
    // =====================================================
    // Sélection des éléments du DOM & variables d'état
    // =====================================================

    // --- Éléments internes à la page
    const groupButtons = document.querySelectorAll('.group-selector-button'); // Boutons de sélection de groupe
    const form = document.querySelector('.message-sender');                  // Formulaire d'envoi de message
    const groupTitle = document.getElementById('group-name');                  // Titre du groupe sélectionné
    const MessageBlock = document.getElementById('message-block');             // Conteneur d'affichage des messages

    // --- Liens de navigation pour les groupes
    const listLink = document.getElementById('list-group'); // Lien vers la liste des membres du groupe
    const addLink = document.getElementById('add-group');   // Lien pour ajouter un membre dans le groupe
    const leaveLink = document.getElementById('leave-group'); // Lien pour quitter le groupe

    // Variables globales pour le canal de discussion et le stockage des messages
    let currentChannelId = null;
    let echoChannels = {}; // gestion multi abonnements WebSocket
    let messageList = []; // Stockage local des messages

    // -----------------------------------------------------
    // Gestion des menus et boutons de navigation
    // -----------------------------------------------------
    // Définition des différents menus de l'application
    const menus = {
        home: document.getElementById('home'),
        creategroup: document.getElementById('creategroup'),
        invite: document.getElementById('invite'),
        block: document.getElementById('block'),
        chat: document.getElementById('chat'),
    };

    // Tableau de tous les menus pour une gestion collective de l'affichage
    const allMenus = Object.values(menus);

    // Fonction pour masquer tous les menus et afficher uniquement celui souhaité
    function showMenu(menuToShow) {
        allMenus.forEach(menu => {
            if (menu) menu.style.display = 'none';
        });
        if (menuToShow) menuToShow.style.display = 'block';
    }

    // Boutons servant à naviguer entre les menus
    const buttons = {
        home: document.getElementById('home-btn'),
        creategroup: document.getElementById('creategroup-btn'),
        invite: document.getElementById('invite-btn'),
        block: document.getElementById('block-btn'),
    };

    // Fonction de mise à jour du formulaire et des liens en fonction du groupe sélectionné
    function changeForm(btn) {
        groupTitle.textContent = btn.textContent;                        // Met à jour le titre du groupe
        form.message.value = '';                                           // Réinitialise le champ message
        form.action = `/api/channels/${currentChannelId}/send-message`;    // Définit l'action du formulaire d'envoi de message
        leaveLink.href = `/channels/${currentChannelId}/quit-channel`;      // Définit l'URL pour quitter le groupe
        listLink.href = `/channels/${currentChannelId}/group-member`;       // Définit l'URL pour consulter les membres du groupe
        addLink.href = `/channels/${currentChannelId}/add-member`;          // Définit l'URL pour ajouter un membre
    }

    // Lors du clic sur les boutons de menu, réinitialise l'ID du canal actif
    buttons.home?.addEventListener('click', () => currentChannelId = null);
    buttons.creategroup?.addEventListener('click', () => currentChannelId = null);
    buttons.invite?.addEventListener('click', () => currentChannelId = null);
    buttons.block?.addEventListener('click', () => currentChannelId = null);

    // =====================================================
    // Fonctions utilitaires
    // =====================================================

    // Fonction pour formater un timestamp selon la langue de l'utilisateur
    function formatTimestamp(ts) {
        const userLocale = navigator.language || 'en-EN';
        const date = new Date(ts);
        return date.toLocaleDateString(userLocale, {
            day: '2-digit',
            month: 'long',
            year: 'numeric',
        }) + ' : ' + date.toLocaleTimeString(userLocale, {
            hour: '2-digit',
            minute: '2-digit',
            hour12: false,
        });
    }

    // Fonction pour créer l'élément HTML d'un message, en tenant compte du type et de l'expéditeur
    function createMessageElement(msg) {
        const div = document.createElement('div');
        div.classList.add('message-item');

        // Récupère le nom de l'utilisateur connecté depuis l'attribut dataset
        const loggedUserName = document.getElementById('chat').dataset.userName;
        // Compare le nom de l'expéditeur avec celui de l'utilisateur connecté
        const isCurrentUser = msg.sender?.name === loggedUserName;
        // Définit le nom de l'expéditeur ou "Unknown" si non défini
        const name = msg.sender?.name || 'Unknow';
        // Définit le contenu du message ou indique qu'il a été supprimé
        const content = msg.content || '[Deleted]';
        // Formate l'heure du message si elle est présente
        const time = msg.created_at ? formatTimestamp(msg.created_at) : '';

        // Gère les messages système en appliquant un style particulier
        if (msg.type === 'system') {
            div.classList.add('message-middle');
            div.innerHTML = `
                <span class="system-message">${content}</span>
                <div class="timestamp">${time}</div>
            `;
            return div;
        }

        // Applique un style différent si le message provient de l'utilisateur courant ou d'un autre
        div.classList.add(isCurrentUser ? 'message-right' : 'message-left');
        div.innerHTML = `
            <strong>${name}</strong><br>
            <span>${content}</span>
            <div class="timestamp">${time}</div>
        `;
        return div;
    }

    // Fonction pour afficher l'ensemble des messages dans le conteneur dédié
    function renderMessages(messages) {
        MessageBlock.innerHTML = ''; // Réinitialise le bloc de messages
        if (messages.length === 0) {
            MessageBlock.innerHTML = '<p class="message-middle">Start of the conversation.</p>';
            return;
        }
        messages.forEach(msg => {
            const el = createMessageElement(msg);
            MessageBlock.appendChild(el);
        });
        // Faire défiler le bloc de messages vers le bas
        MessageBlock.scrollTop = MessageBlock.scrollHeight;
    }

    // =====================================================
    // Chargement des messages et gestion des abonnements
    // =====================================================

    // Fonction asynchrone pour charger les messages depuis le serveur
    async function loadMessages() {
        if (!currentChannelId) {
            MessageBlock.innerHTML = '<p>Pas de groupe sélectionné.</p>';
            return;
        }
        try {
            const response = await fetch(`/api/channels/${currentChannelId}/get-all-messages`);
            if (!response.ok) throw new Error('Erreur lors du chargement des messages');

            const data = await response.json();
            messageList = data.messages || [];
            renderMessages(messageList);
        } catch (error) {
            console.error(error);
            MessageBlock.innerHTML = '<p>Impossible de charger les messages.</p>';
        }
    }

    // Ajout d'écouteurs sur chaque bouton de groupe présent dans la page
    groupButtons.forEach(btn => {
        btn?.addEventListener('click', () => {
            currentChannelId = btn.dataset.groupId; // Met à jour le canal actif selon le bouton cliqué
            changeForm(btn);                        // Actualise le formulaire et les liens associés au groupe
            subscribeToChannel(currentChannelId);   // Abonne le client au canal correspondant via Echo
            loadMessages();                         // Charge les messages du groupe sélectionné
        });
    });

    // Fonction pour s'abonner à un canal privé via Echo
    function subscribeToChannel(channelId) {
        // Si déjà abonné à ce canal, on ne fait rien
        if (echoChannels[channelId]) return;

        const newChannel = window.Echo.private(`channels.${channelId}`)
            .listen('.MessageSent', (event) => {
                // N'affiche les messages que si on regarde ce canal
                if (currentChannelId == channelId) {
                    messageList.push(event);
                    renderMessages(messageList);
                }
            });

        echoChannels[channelId] = newChannel;
    }

    // Fonction pour créer dynamiquement un bouton de groupe
    function createGroupButton(groupId, title) {
        const btn = document.createElement('button');
        btn.classList.add('group-selector-button');
        btn.setAttribute('data-group-id', groupId);
        btn.setAttribute('value', `/api/channels/${groupId}`);
        btn.textContent = title;
        return btn;
    }

    // =====================================================
    // Gestion des mises à jour en temps réel pour les groupes
    // =====================================================

    // Récupère l'ID de l'utilisateur pour l'abonnement au canal des mises à jour
    const userId = document.getElementById('invite')?.dataset.userId;
    // Élément contenant la liste dynamique des groupes
    const groupMenu = document.getElementById('channels');

    // Abonnement à un canal privé pour recevoir les mises à jour relatives aux groupes
    const channel = window.Echo.private(`channel-updater.${userId}`);

    // Délai pour s'assurer que la connexion Reverb (Pusher) est établie correctement
    setTimeout(() => {
        if (
            window.Echo &&
            window.Echo.connector &&
            window.Echo.connector.pusher &&
            window.Echo.connector.pusher.connection
        ) {
            const connection = window.Echo.connector.pusher.connection;
            console.log("Connexion Reverb établie via pusher.connection");

            // Liaison de l'événement 'message' pour traiter les mises à jour des groupes
            connection.bind('message', (data) => {
                console.log("Message WS reçu :", data);

                // Vérification que le message correspond à une mise à jour d'accès aux groupes
                if (data && data.event === "GroupAccessUpdated") {
                    const groupData = data.data;
                    const action = groupData.action;
                    const groupId = groupData.data.group_id;
                    const title = groupData.data.title || 'Groupe sans titre';

                    // Recherche d'un bouton existant correspondant au groupe
                    const existingBtn = groupMenu.querySelector(`button[data-group-id="${groupId}"]`);

                    if (action === 'added' && !existingBtn) {
                        // Cas d'ajout : le groupe n'existe pas encore, donc on le crée
                        const btn = document.createElement('button');
                        btn.classList.add('group-selector-button');
                        btn.setAttribute('data-group-id', groupId);
                        btn.setAttribute('value', `/api/channels/${groupId}`);
                        btn.textContent = title;

                        // Ajout d'un écouteur sur le nouveau bouton pour gérer sa sélection
                        btn.addEventListener('click', () => {
                            if (!btn.isConnected) return; // évite bugs sur vieux boutons
                            currentChannelId = btn.dataset.groupId;
                            changeForm(btn);
                            subscribeToChannel(currentChannelId);
                            showMenu(menus.chat);
                            loadMessages();
                        });

                        groupMenu.appendChild(btn);
                        console.log(`Groupe "${title}" ajouté.`);
                    } else if (action === 'removed' && existingBtn) {
                        existingBtn.remove();
                        console.log(`Groupe ID ${groupId} supprimé.`);

                        // Désabonne uniquement du canal correspondant
                        if (echoChannels[groupId]) {
                            echoChannels[groupId].unsubscribe();
                            delete echoChannels[groupId];
                        }

                        // Si on était en train de regarder ce groupe, on vide l'affichage
                        if (currentChannelId === groupId) {
                            currentChannelId = null;
                            MessageBlock.innerHTML = '<p>Vous avez été retiré de ce groupe.</p>';
                        }
                    } else {
                        // Si l'action n'est ni ajout ni suppression, log l'erreur dans la console
                        console.log("erreur");
                        console.log(action);
                        console.log(data);
                    }
                }
            });
        } else {
            console.warn("Connexion Reverb non disponible.");
        }
    }, 2000);
});
