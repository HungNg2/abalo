export default {
    mounted() {
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
                { name: "Home", link: "#" },
                { name: "Kategorien", link: "#" },
                { name: "Verkaufen", link: "#" },
                {
                    name: "Unternehmen",
                    subMenu: [
                        { name: "Philosophie", link: "#" },
                        { name: "Karriere", link: "#" }
                    ]
                }
            ],
            search: "",
            items: []
        }
    },
    methods: {
        createMenu: function (menuStructure) {
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
        },
        /*loadArticles() {
            console.log("search: " + this.search);
            if (this.search.length > 2) {
                fetch(`http://localhost:8000/api/articles?search=${this.search}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        this.items = data;
                    })
                    .catch(error => console.log(error.message));
            }
        },*/
        getImageUrl(id, extension) {
            return `./articelimages/${id}.${extension}`;
        },
        fileExists(id, extension) {
            return new Promise((resolve, reject) => {
                const img = new Image();
                img.onload = () => {
                    resolve(true); // File exists
                };
                img.onerror = () => {
                    resolve(false); // File does not exist
                };
                img.src = this.getImageUrl(id, extension);
            });
        },

    },
    template: `
        <div id="header">
        <div class="logo">
            <img src="../../logo.jpg" width="80px">
        </div>
        <div id="Navigationsmenues"></div>
        <!-- <div class="search_item">
             <h2>Search for an Item:&nbsp;</h2>
             <input type="text" v-model="search" @keyup="loadArticles" value="search"><br> <br>
         </div>-->
        </div>
        <!--<table v-if="this.search.length > 2 && items.length > 0">
        <thead>
        <tr>
            <th>id</th>
            <th>ab_name</th>
            <th>ab_price</th>
            <th>ab_description</th>
            <th>ab_creator_id</th>
            <th>ab_created_date</th>
            <th>ab_image</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in items" :key="item.ab_name">
            <td class="id">{{ item.id }}</td>
            <td class="shop-item-title">{{ item.ab_name }}</td>
            <td class="shop-item-price">{{ item.ab_price }}</td>
            <td>{{ item.ab_description }}</td>
            <td>{{ item.ab_creator_id }}</td>
            <td>{{ item.ab_createdate }}</td>
            <td>
                <img v-if="fileExists(item.id, 'jpg')" :src="getImageUrl(item.id, 'jpg')" alt="Image" width="120">
                <img v-else-if="fileExists(item.id, 'png')" :src="getImageUrl(item.id, 'png')" alt="Image" width="120">
            </td>
        </tr>
        </tbody>
        </table>-->
    `
}
