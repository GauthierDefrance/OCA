// =====================================================
// Initialisation après le chargement complet du DOM
// =====================================================
document.addEventListener('DOMContentLoaded', function () {

    // =====================================================
    // Gestion de l'acceptation initiale des invitations
    // =====================================================
    document.querySelectorAll('.invite-btn').forEach(button => {
        button.addEventListener('click', async () => {
            // Récupération des identifiants du groupe, de l'expéditeur et du destinataire
            const groupId = button.getAttribute('data-group-id');
            const senderId = button.getAttribute('data-sender-id');
            const recipientId = button.getAttribute('data-recipient-id');

            try {
                // Envoi d'une requête POST pour accepter l'invitation
                const response = await fetch(`/api/channels/${groupId}/accept-invite`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        // Ajout du token CSRF pour la sécurisation de la requête
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    // Données envoyées en format JSON
                    body: JSON.stringify({
                        group_id: groupId,
                        sender_id: senderId,
                        recipient_id: recipientId
                    })
                });

                // Si la réponse est positive, désactive le bouton et indique que l'invitation a été acceptée
                if (response.ok) {
                    button.disabled = true;
                    button.textContent = 'Invitation acceptée';
                } else {
                    // Récupération de l'erreur (non affichée ici)
                    const error = await response.json();
                }
            } catch (err) {
                // Affichage de l'erreur dans la console en cas de problème
                console.error(err);
            }
        });
    });

    // =====================================================
    // Gestion du rejet initial des invitations
    // =====================================================
    document.querySelectorAll('.reject-btn').forEach(button => {
        button.addEventListener('click', async () => {
            // Récupération des identifiants du groupe, de l'expéditeur et du destinataire
            const groupId = button.getAttribute('data-group-id');
            const senderId = button.getAttribute('data-sender-id');
            const recipientId = button.getAttribute('data-recipient-id');

            try {
                // Envoi d'une requête POST pour rejeter l'invitation
                const response = await fetch(`/api/channels/${groupId}/reject-invite`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        // Utilisation du token CSRF
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    // Envoi des données de l'invitation en format JSON
                    body: JSON.stringify({
                        group_id: groupId,
                        sender_id: senderId,
                        recipient_id: recipientId
                    })
                });

                // Si la réponse est positive, désactive le bouton et indique que l'invitation a été refusée
                if (response.ok) {
                    button.disabled = true;
                    button.textContent = 'Invitation refusé';
                } else {
                    // Récupération de l'erreur en format JSON (non utilisée ici)
                    const error = await response.json();
                }
            } catch (err) {
                // Affichage de l'erreur dans la console
                console.error(err);
            }
        });
    });

    // =====================================================
    // Récupération de la section des invitations dans le DOM
    // =====================================================
    const inviteSection = document.getElementById('invite');

    // =====================================================
    // Fonction de création d'un élément d'invitation dynamique
    // =====================================================
    function createInviteElement(invite) {
        // Création du conteneur de l'invitation et affectation d'une classe CSS
        const container = document.createElement('div');
        container.classList.add('invite-item');

        // Création d'un élément pour afficher le nom du groupe
        const groupName = document.createElement('span');
        groupName.classList.add('group-name');
        groupName.textContent = invite.conversation.title || 'Untitled Group';

        // Création d'un paragraphe indiquant l'expéditeur de l'invitation
        const fromPara = document.createElement('p');
        fromPara.innerHTML = `from <span class="group-name">${invite.sender.name}</span>`;

        // Création du bouton d'acceptation de l'invitation
        const acceptBtn = document.createElement('button');
        acceptBtn.classList.add('invite-btn');
        acceptBtn.textContent = 'accept';
        acceptBtn.dataset.groupId = invite.conversation_id;
        acceptBtn.dataset.senderId = invite.sender_id;
        acceptBtn.dataset.recipientId = invite.recipient_id;

        // Création du bouton de rejet de l'invitation
        const rejectBtn = document.createElement('button');
        rejectBtn.classList.add('reject-btn');
        rejectBtn.textContent = 'reject';
        rejectBtn.dataset.groupId = invite.conversation_id;
        rejectBtn.dataset.senderId = invite.sender_id;
        rejectBtn.dataset.recipientId = invite.recipient_id;

        // Ajout des éléments (nom de groupe, infos d'expéditeur, boutons) dans le conteneur
        container.appendChild(groupName);
        container.appendChild(fromPara);
        container.appendChild(acceptBtn);
        container.appendChild(rejectBtn);

        // =====================================================
        // Ajout des événements pour l'acceptation de l'invitation
        // =====================================================
        acceptBtn.addEventListener('click', async () => {
            try {
                // Envoi d'une requête POST pour accepter l'invitation
                const response = await fetch(`/api/channels/${acceptBtn.dataset.groupId}/accept-invite`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        group_id: acceptBtn.dataset.groupId,
                        sender_id: acceptBtn.dataset.senderId,
                        recipient_id: acceptBtn.dataset.recipientId
                    })
                });
                // Si la requête est réussie, désactive le bouton d'acceptation et le bouton de rejet
                if (response.ok) {
                    acceptBtn.disabled = true;
                    acceptBtn.textContent = 'Invitation acceptée';
                    rejectBtn.disabled = true;
                }
            } catch (err) {
                // Affiche l'erreur dans la console
                console.error(err);
            }
        });

        // =====================================================
        // Ajout des événements pour le rejet de l'invitation
        // =====================================================
        rejectBtn.addEventListener('click', async () => {
            try {
                // Envoi d'une requête POST pour rejeter l'invitation
                const response = await fetch(`/api/channels/${rejectBtn.dataset.groupId}/reject-invite`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        group_id: rejectBtn.dataset.groupId,
                        sender_id: rejectBtn.dataset.senderId,
                        recipient_id: rejectBtn.dataset.recipientId
                    })
                });
                // Si la requête est réussie, désactive le bouton de rejet et le bouton d'acceptation
                if (response.ok) {
                    rejectBtn.disabled = true;
                    rejectBtn.textContent = 'Invitation refusée';
                    acceptBtn.disabled = true;
                }
            } catch (err) {
                // Log de l'erreur en cas de problème
                console.error(err);
            }
        });

        // Retourne l'élément d'invitation créé
        return container;
    }

    // =====================================================
    // Gestion des mises à jour en temps réel pour les invitations via Echo (Reverb/Pusher)
    // =====================================================
    // Récupération de l'ID utilisateur stocké dans l'attribut data-user-id pour la gestion des notifications en temps réel
    const userId = inviteSection.dataset.userId;
    // Souscription au canal privé Echo pour l'utilisateur
    const channel = window.Echo.private(`invite.${userId}`);

    // Attente d'un délai pour s'assurer que la connexion en temps réel est bien établie
    setTimeout(() => {
        if (
            window.Echo &&
            window.Echo.connector &&
            window.Echo.connector.pusher &&
            window.Echo.connector.pusher.connection
        ) {
            // Récupération de la connexion via Pusher
            const connection = window.Echo.connector.pusher.connection;
            console.log("Connexion Reverb établie via pusher.connection pour InvitationScripts");

            // =====================================================
            // Interception des messages WebSocket en provenance du backend
            // =====================================================
            connection.bind('message', (data) => {
                console.log("Message WS reçu :", data);

                // Vérification que le message correspond à l'événement d'invitation
                if (data && data.event === "App\\Events\\InvitationEvent") {
                    const inviteData = data.data;
                    console.log("Invitation Event reçu avec les données :", inviteData);

                    // Sélection du conteneur existant pour les invitations dans la section
                    const invitationContainer = document.querySelector('#invite nav.chat-actions');
                    if (invitationContainer) {
                        // Si un message indiquant "No invitations at the moment." est présent, il est supprimé
                        const noInvitesElem = invitationContainer.querySelector('p');
                        if (noInvitesElem && noInvitesElem.innerText.includes('No invitations')) {
                            noInvitesElem.remove();
                        }

                        // =====================================================
                        // Création et insertion d'un nouveau bloc d'invitation reçu en temps réel
                        // =====================================================
                        const inviteElement = document.createElement('div');
                        inviteElement.classList.add('groupe-invite');
                        inviteElement.innerHTML = `
                            <span class="group-name">${inviteData.group_title || 'Untitled Group'}</span>
                            <p>from <span class="group-name">${inviteData.inviter.name || 'Unknown'}</span></p>
                            <button class="invite-btn"
                                data-group-id="${inviteData.channel_id}"
                                data-sender-id="${inviteData.inviter.id}"
                                data-recipient-id="${inviteData.invitee.id}">
                                accept
                            </button>
                            <button class="reject-btn"
                                data-group-id="${inviteData.channel_id}"
                                data-sender-id="${inviteData.inviter.id}"
                                data-recipient-id="${inviteData.invitee.id}">
                                reject
                            </button>
                        `;
                        // Ajout du nouvel élément dans le conteneur des invitations
                        invitationContainer.appendChild(inviteElement);

                        // Sélection des boutons dans le nouveau bloc d'invitation
                        const acceptBtn = inviteElement.querySelector('.invite-btn');
                        const rejectBtn = inviteElement.querySelector('.reject-btn');

                        // =====================================================
                        // Ajout de l'événement pour l'acceptation de l'invitation reçue via Echo
                        // =====================================================
                        acceptBtn.addEventListener('click', async () => {
                            try {
                                const response = await fetch(`/api/channels/${acceptBtn.dataset.groupId}/accept-invite`, {
                                    method: 'POST',
                                    headers: {
                                        'Accept': 'application/json',
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                                    },
                                    body: JSON.stringify({
                                        group_id: acceptBtn.dataset.groupId,
                                        sender_id: acceptBtn.dataset.senderId,
                                        recipient_id: acceptBtn.dataset.recipientId
                                    })
                                });
                                if (response.ok) {
                                    acceptBtn.disabled = true;
                                    acceptBtn.textContent = 'Invitation acceptée';
                                    rejectBtn.disabled = true;
                                }
                            } catch (err) {
                                console.error(err);
                            }
                        });

                        // =====================================================
                        // Ajout de l'événement pour le rejet de l'invitation reçue via Echo
                        // =====================================================
                        rejectBtn.addEventListener('click', async () => {
                            try {
                                const response = await fetch(`/api/channels/${rejectBtn.dataset.groupId}/reject-invite`, {
                                    method: 'POST',
                                    headers: {
                                        'Accept': 'application/json',
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                                    },
                                    body: JSON.stringify({
                                        group_id: rejectBtn.dataset.groupId,
                                        sender_id: rejectBtn.dataset.senderId,
                                        recipient_id: rejectBtn.dataset.recipientId
                                    })
                                });
                                if (response.ok) {
                                    rejectBtn.disabled = true;
                                    rejectBtn.textContent = 'Invitation refusée';
                                    acceptBtn.disabled = true;
                                }
                            } catch (err) {
                                console.error(err);
                            }
                        });
                    } else {
                        // Log une erreur si le conteneur des invitations n'est pas trouvé
                        console.error("Le conteneur des invitations n'a pas été trouvé !");
                    }
                }
            });
        } else {
            // Log si la connexion Reverb n'est pas disponible
            console.log("La connexion Reverb n'est pas disponible");
        }
    }, 2000); // Délai en millisecondes pour l'initialisation de la connexion

});
