export default {
    beforeCreate() {
        this.createMenu(this.menuStructure);
        let hasChildren = document.querySelectorAll('.has-children');
        hasChildren.forEach(item => {
            item.addEventListener('click', () => {
                item.querySelector('.childList').classList.toggle('active');
            });
        });
    },
    data: function () {
        return {
            menuStructure: [
                {name:"Home",link:"#"},
                {name:"Kategorien",link:"#"},
                {name: "Verkaufen",link:"#"},
                {name: "Unternehmen",subMenu: [
                    {name:"Philosophie",link:"#"},
                    {name: "Karriere",link:"#"},]},
            ]
        }
    },
    methods: {
        createMenu: function(menuStructure) {
            const menu = document.createElement("ul");

            for(let i=0;i<menuStructure.length;i++){
                //let lastElement = menuStructure.length-1;

                const menuItemElement = document.createElement("li");
                //const menuItemLink = document.createElement("a");
                //menuItemLink.href = menuStructure[i].link;
                menuItemElement.innerText = menuStructure[i].name;
                //menuItemElement.appendChild(menuItemLink);


                if (menuStructure[i].subMenu) {
                    const subMenu = this.createMenu(menuStructure[i].subMenu);
                    subMenu.classList.add("childList");
                    menuItemElement.classList.add("has-children");
                    menuItemElement.appendChild(subMenu);
                }
                menu.appendChild(menuItemElement);
                let Navigationsmenues = document.getElementById("Navigationsmenues");
                Navigationsmenues.appendChild(menu);

            }
            return menu;
        }
    },
    template: '#site-header-template'
}
