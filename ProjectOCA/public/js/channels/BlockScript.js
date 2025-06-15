
document.addEventListener('DOMContentLoaded', () => {
    const blockForm = document.querySelector('.block-form');
    const errorBlock = document.getElementById('error-block');
    const bannedList = document.getElementById('banned-list');

    // Fonction qui gère la requête de déblocage
    async function handleUnblock(userId, buttonElement) {
        try {
            const response = await fetch('/api/unblock', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]')?.value || ''
                },
                body: JSON.stringify({ user_id: userId }),
                credentials: 'same-origin',
            });

            const data = await response.json();

            if (response.ok) {
                // Supprimer l'élément bloqué de l'interface
                const userDiv = buttonElement.closest('.blocked-user');
                userDiv.remove();
            } else {
                errorBlock.textContent = data.message || 'Erreur lors du déblocage.';
                errorBlock.style.color = 'red';
            }
        } catch (error) {
            console.error(error);
            errorBlock.textContent = 'Erreur réseau.';
            errorBlock.style.color = 'red';
        }
    }

    // Ajoute l'écouteur sur les boutons actuels
    function attachUnblockListeners() {
        const buttons = document.querySelectorAll('.unblock-btn');
        buttons.forEach(btn => {
            btn.removeEventListener('click', btn._unblockHandler); // éviter les doublons
            btn._unblockHandler = async function () {
                const userId = btn.dataset.blockedUserId;
                if (userId) {
                    await handleUnblock(userId, btn);
                }
            };
            btn.addEventListener('click', btn._unblockHandler);
        });
    }

    // Envoi de la requête de blocage
    blockForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const emailInput = document.querySelector('#email-to-block');
        const email = emailInput.value.trim();
        errorBlock.textContent = '';

        if (!email) {
            errorBlock.textContent = 'Veuillez entrer un email valide.';
            errorBlock.style.color = 'red';
            return;
        }

        try {
            const response = await fetch('/api/block', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]')?.value || ''
                },
                body: JSON.stringify({ email_to_block: email }),
                credentials: 'same-origin',
            });

            const data = await response.json();

            if (response.ok) {
                // Réinitialisation
                emailInput.value = '';
                errorBlock.textContent = 'Utilisateur bloqué avec succès !';
                errorBlock.style.color = 'green';

                // Ajouter le nouvel utilisateur bloqué
                if (data.user) {
                    const newBlocked = document.createElement('div');
                    newBlocked.classList.add('blocked-user');
                    newBlocked.innerHTML = `
                        <p>${data.user.name}</p>
                        <p>${data.user.email}</p>
                        <button class="unblock-btn" data-blocked-user-id="${data.user.id}">Unblock</button>
                    `;
                    bannedList.appendChild(newBlocked);
                    attachUnblockListeners();
                }

            } else {
                errorBlock.textContent = data.message || 'Impossible de bloquer cet utilisateur.';
                errorBlock.style.color = 'red';
            }
        } catch (error) {
            console.error(error);
            errorBlock.textContent = 'Erreur réseau ou serveur.';
            errorBlock.style.color = 'red';
        }
    });

    // Initialisation des listeners existants
    attachUnblockListeners();
});
