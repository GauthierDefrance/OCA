document.addEventListener('DOMContentLoaded', function () {
    const MessageBlock = document.getElementById('message-block');
    const refreshBtn = document.getElementById('refresh');
    const form = document.querySelector('.message-sender');
    let currentChannelId = null;

    // Fonction pour extraire l'ID du channel depuis l'attribut "action" du formulaire
    function extractChannelIdFromFormAction() {
        const urlParts = form.action.split('/');
        return urlParts[urlParts.indexOf('channels') + 1] || null;
    }

    async function loadMessages(channelId = null) {
        // Si on ne reçoit pas d'ID, on essaie de le prendre depuis le form
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
        } catch (error) {
            console.error(error);
            MessageBlock.innerHTML = '<p>Impossible de charger les messages.</p>';
        }
    }

    function renderMessages(messages) {
        MessageBlock.innerHTML = '';
        if (messages.length === 0) {
            MessageBlock.innerHTML = '<p>Aucun message pour ce groupe.</p>';
            return;
        }

        messages.forEach(msg => {
            const div = document.createElement('div');
            div.classList.add('message-item');
            div.innerHTML = `<strong>${msg.sender?.name || 'Utilisateur'} :</strong> ${msg.body}`;
            MessageBlock.appendChild(div);
        });

        MessageBlock.scrollTop = MessageBlock.scrollHeight;
    }

    refreshBtn.addEventListener('click', () => {
        loadMessages();
    });

    // Rendre accessible depuis d'autres scripts
    window.loadMessages = loadMessages;
});
