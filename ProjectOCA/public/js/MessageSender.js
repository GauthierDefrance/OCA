document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.message-sender');

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        //récupération du contenu de la boite message
        const message = form.message.value;
        //Récupération du token pour la communication sécurisé POST

        //Envoi du formulaire post
        const response = await fetch(form.action, {
            method: 'POST', //On précise la méthode de communication
            headers: {
                //On indique que, on envoie un JSON et le token
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            //Ici, on envoie le message
            body: JSON.stringify({ message: message })
        });

        //On attend la réponse serveur pour être sûr que la communication se passe bien
        if (response.ok) {
            const data = await response.json();
            console.log('Message envoyé avec succès :', data);
            form.reset(); // vide le champ
        //Sinon erreur lors de l'envoi de la requête
        } else {
            console.error('Erreur lors de l’envoi du message');
        }
    });
});
