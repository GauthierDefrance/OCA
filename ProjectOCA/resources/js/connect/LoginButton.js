document.addEventListener('DOMContentLoaded', function () {
    // Obtenir les sections de connexion et d'inscription
    const sectionLogin = document.getElementById('section-login');
    const sectionRegister = document.getElementById('section-register');

    // Obtenir les boutons de connexion et d'inscription
    const buttonLogin = document.getElementById('button-login');
    const buttonRegister = document.getElementById('button-register');

    // Fonction pour afficher la section de connexion et masquer celle d'inscription
    function showLogin() {
        buttonLogin.disabled = true;
        buttonRegister.disabled = false;
        sectionLogin.style.display = 'block';  // Afficher la section Login
        sectionRegister.style.display = 'none';  // Masquer la section Register
    }

    // Fonction pour afficher la section d'inscription et masquer celle de connexion
    function showRegister() {
        buttonLogin.disabled = false;
        buttonRegister.disabled = true;
        sectionRegister.style.display = 'block';  // Afficher la section Register
        sectionLogin.style.display = 'none';  // Masquer la section Login
    }

    // Ajouter un événement au bouton de connexion pour afficher la section de connexion
    buttonLogin.addEventListener('click', function () {
        showLogin();
    });

    // Ajouter un événement au bouton d'inscription pour afficher la section d'inscription
    buttonRegister.addEventListener('click', function () {
        showRegister();
    });

    // Optionnel: Initialiser la première section (par défaut, la section Login peut être affichée)
    showLogin();  // Afficher la section Login au chargement de la page
});
