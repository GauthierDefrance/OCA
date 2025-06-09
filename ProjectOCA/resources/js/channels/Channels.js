document.addEventListener('DOMContentLoaded', function () {
    // --- Sélecteurs généraux ---
    const form = document.querySelector('.message-sender');
    const MessageBlock = document.getElementById('message-block');
    const GroupTitle = document.getElementById('group-name');
    const groupButtons = document.querySelectorAll('#channels button');

    // --- Menus ---
    const HomeMenu = document.getElementById('home');
    const CreateChatMenu = document.getElementById('creategroup');
    const InvitationMenu = document.getElementById('invite');
    const BlockMenu = document.getElementById('block');
    const ChatMenu = document.getElementById('chat');
    const allMenus = [HomeMenu, CreateChatMenu, InvitationMenu, BlockMenu, ChatMenu];

    // --- Boutons de navigation ---
    const HomeBtn = document.getElementById('home-btn');
    const CreateChatBtn = document.getElementById('creategroup-btn');
    const InvitationBtn = document.getElementById('invite-btn');
    const BlockBtn = document.getElementById('block-btn');

    const listLink = document.getElementById('list-group');
    const addLink = document.getElementById('add-group');
    const leaveLink = document.getElementById('leave-group');

    let currentChannelId = null;
    let lastMessageTimestamp = '1970-01-01T00:00:00Z';
    let loop=false;

    // --- Fonctions utilitaires ---
    function toggleMenus(hideElements, showElement) {
        hideElements.forEach(el => el && (el.style.display = 'none'));
        if (showElement) showElement.style.display = 'block';
    }

    function extractChannelIdFromFormAction() {
        const urlParts = form.action.split('/');
        return urlParts[urlParts.indexOf('channels') + 1] || null;
    }

    async function loadMessages(channelId = null) {
        loop=false;
        currentChannelId = channelId || extractChannelIdFromFormAction();

        if (!currentChannelId) {
            MessageBlock.innerHTML = '<p>Pas de groupe sélectionné.</p>';
            return;
        }

        try {
            const response = await fetch(`/api/channels/${currentChannelId}/get-all-messages`);
            if (!response.ok) throw new Error('Erreur lors du chargement des messages');

            const data = await response.json();
            renderMessages(data.messages || []);

            if (data.messages?.length > 0) {
                lastMessageTimestamp = data.messages[data.messages.length - 1].created_at;
            } else {
                lastMessageTimestamp = '1970-01-01T00:00:00Z';
            }
        } catch (error) {
            console.error(error);
            MessageBlock.innerHTML = '<p>Impossible de charger les messages.</p>';
        }
        loop=true;
    }

    async function loadNewMessages() {
        if (!currentChannelId || !lastMessageTimestamp || !loop) return;

        try {
            const response = await fetch(`/api/channels/${currentChannelId}/get-new-messages?since=${encodeURIComponent(lastMessageTimestamp)}`, {
                credentials: 'same-origin'
            });
            if (!response.ok) throw new Error(`Erreur HTTP ${response.status}`);

            const data = await response.json();

            if (data.success && data.new_messages?.length > 0) {
                appendMessages(data.new_messages);
                lastMessageTimestamp = data.new_messages[data.new_messages.length - 1].created_at;
            }
        } catch (error) {
            console.error('Erreur lors du chargement des nouveaux messages :', error);
        }
    }

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

    function createMessageElement(msg) {
        const div = document.createElement('div');
        div.classList.add('message-item');

        const loggedUserName = document.getElementById('chat').dataset.userName;
        const isCurrentUser = msg.sender?.name === loggedUserName;
        const name = msg.sender?.name || 'Unknow';
        const content = msg.content || '[Deleted]';
        const time = msg.created_at ? formatTimestamp(msg.created_at) : '';

        // Cas spécial pour les messages système
        if (msg.type === 'system') {
            div.classList.add('message-middle');
            div.innerHTML = `
            <span class="system-message">${content}</span>
            <div class="timestamp">${time}</div>
        `;
            return div;
        }

        // Sinon message utilisateur (gauche ou droite)
        if (isCurrentUser) {
            div.classList.add('message-right');
        } else {
            div.classList.add('message-left');
        }

        div.innerHTML = `
        <strong>${name}</strong><br>
        <span>${content}</span>
        <div class="timestamp">${time}</div>
    `;
        return div;
    }

    function appendMessages(messages) {
        messages.forEach(msg => {
            const el = createMessageElement(msg);
            MessageBlock.appendChild(el);
        });
        MessageBlock.scrollTop = MessageBlock.scrollHeight;
    }

    function renderMessages(messages) {
        MessageBlock.innerHTML = '';
        if (messages.length === 0) {
            MessageBlock.innerHTML = '<p class="message-middle">Start of the conversation.</p>';
            return;
        }
        messages.forEach(msg => {
            const el = createMessageElement(msg);
            MessageBlock.appendChild(el);
        });
        MessageBlock.scrollTop = MessageBlock.scrollHeight;
    }

    // --- Navigation principale ---
    HomeBtn.addEventListener('click', () => {
        toggleMenus(allMenus, HomeMenu);
        currentChannelId = null;
    });
    CreateChatBtn.addEventListener('click', () => {
        toggleMenus(allMenus, CreateChatMenu);
        currentChannelId = null;
    });
    InvitationBtn.addEventListener('click', () => {
        toggleMenus(allMenus, InvitationMenu);
        currentChannelId = null;
    });
    BlockBtn.addEventListener('click', () => {
        toggleMenus(allMenus, BlockMenu);
        currentChannelId = null;
    });

    // --- Sélection d’un groupe de discussion ---
    groupButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            GroupTitle.textContent = btn.textContent;
            toggleMenus(allMenus, ChatMenu);
            form.action = btn.value + '/send-message';
            form.message.value = '';
            const channelId = btn.value.split('/').pop();
            leaveLink.href = `/channels/${channelId}/quit-channel`;
            listLink.href = `/channels/${channelId}/group-member`;
            addLink.href = `/channels/${channelId}/add-member`;
            loadMessages(channelId);
        });
    });

    // --- Rafraîchissement auto ---
    function startAutoRefresh() {
        // Cette fonction appelle loadNewMessages toutes les 1000 millisecondes (1 seconde)
        setInterval(function () {
            loadNewMessages();
        }, 1000);
    }

    // Appel de la fonction pour démarrer l’actualisation automatique
    startAutoRefresh();

    // --- Export ---
    window.loadMessages = loadMessages;


    document.querySelectorAll('.invite-btn').forEach(button => {
        button.addEventListener('click', async () => {
            const groupId = button.getAttribute('data-group-id');
            const senderId = button.getAttribute('data-sender-id');
            const recipientId = button.getAttribute('data-recipient-id');

            try {
                const response = await fetch(`/api/channels/${groupId}/accept-invite`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        group_id: groupId,
                        sender_id: senderId,
                        recipient_id: recipientId
                    })
                });

                if (response.ok) {
                    button.disabled = true;
                    button.textContent = 'Invitation acceptée';
                } else {
                    const error = await response.json();
                }
            } catch (err) {
                console.error(err);
            }
        });
    });

});
