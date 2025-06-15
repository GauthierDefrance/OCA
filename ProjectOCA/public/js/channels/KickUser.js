document.addEventListener('DOMContentLoaded', () => {
    const kickButtons = document.querySelectorAll('.kick-btn');
    const conversationId = document.querySelector('#conversation-id').value;
    const csrfToken = document.querySelector('input[name="_token"]').value;
    const errorElement = document.querySelector('#error');

    const showMessage = (message, type = 'error') => {
        errorElement.textContent = message;
        errorElement.style.color = type === 'success' ? 'green' : 'red';
    };

    kickButtons.forEach(button => {
        button.addEventListener('click', async () => {
            const userId = button.dataset.userId;

            if (!confirm("Êtes-vous sûr de vouloir exclure cet utilisateur ?")) return;

            try {
                const response = await fetch('/api/kick-user', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        user_id: userId,
                        conversation_id: conversationId
                    }),
                    credentials: 'same-origin',
                });

                const data = await response.json();

                if (response.ok) {
                    showMessage('Utilisateur exclu avec succès.', 'success');
                    button.closest('li').remove();
                } else {
                    showMessage(data.message || 'Erreur lors de l\'exclusion.');
                }
            } catch (error) {
                console.error(error);
                showMessage('Erreur réseau ou serveur.');
            }
        });
    });
});
