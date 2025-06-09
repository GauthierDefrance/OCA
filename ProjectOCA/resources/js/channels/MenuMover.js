document.addEventListener('DOMContentLoaded', () => {
    // Tous les menus
    const menus = {
        home: document.getElementById('home'),
        creategroup: document.getElementById('creategroup'),
        invite: document.getElementById('invite'),
        block: document.getElementById('block'),
        chat: document.getElementById('chat'),
    };

    const buttons = {
        home: document.getElementById('home-btn'),
        creategroup: document.getElementById('creategroup-btn'),
        invite: document.getElementById('invite-btn'),
        block: document.getElementById('block-btn'),
    }

    const allMenus = Object.values(menus);

    const groupButtons = document.querySelectorAll('.group-selector-button');

    // Fonction pour afficher un menu et cacher les autres
    function showMenu(menuToShow) {
        allMenus.forEach(menu => {
            if (menu) menu.style.display = 'none';
        });
        if (menuToShow) menuToShow.style.display = 'block';
    }

    //On ajoute des listeners à tous les boutons pour que leurs menus apparaissent uniquement.
    buttons.home?.addEventListener('click', () => {
        showMenu(menus.home);
    });
    buttons.creategroup?.addEventListener('click', () => {
        showMenu(menus.creategroup);
    });
    buttons.invite?.addEventListener('click', () => {
        showMenu(menus.invite);
    });
    buttons.block?.addEventListener('click', () => {
        showMenu(menus.block);
    });
    groupButtons.forEach(btn => {
        btn?.addEventListener('click', () => {
            showMenu(menus.chat);
        });
    });

});
