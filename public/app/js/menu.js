function _renderMenu (idPersonagem = null) {
    let menuEntries = [
        {
            "class": "btn",
            "link": "./personagens.html",
            "title": "Personagens",
        }
    ];
    if(idPersonagem !== null) {
        menuEntries.push(
            {
                "class": "btn",
                "link": `./dashboard.html?idPersonagem=${idPersonagem}`,
                "title": "Dashboard",
            },
            {
                "class": "btn",
                "link": `./ideias.html?idPersonagem=${idPersonagem}`,
                "title": "Ideias",
            },
            {
                "class": "btn",
                "link": `./cobrancas.html?idPersonagem=${idPersonagem}`,
                "title": "Cobrancas",
            },
            {
                "class": "btn",
                "link": `./missoes.html?idPersonagem=${idPersonagem}`,
                "title": "Missoes",
            },
        )
    }
    navMenu = '';
    menuEntries.forEach(item => {
        navMenu += `
        <a class="${item.class}" href="${item.link}">${item.title}</a>
        `;
    });
    document.getElementById('navMenu').innerHTML = navMenu;
}