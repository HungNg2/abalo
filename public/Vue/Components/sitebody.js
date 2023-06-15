import {ShoppingCart} from './shoppingCart-Component.js';
import Impressum from "./Impressum.js";
import SiteFooter from "./sitefooter.js";



export default {
    props: ['ShowImpressum'],
    components: {
        Impressum,
        SiteFooter
    },
    mounted() {
        this.loadArticles();
    },
    data(){
        return{
            search: "",
            items: [],
            maxarticles:[],
            offset: 0,
            currentpage: 1,
            ShowImpressum: false,
            sc: new ShoppingCart(),
        };
    },
    methods: {

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
        loadArticles() {
            if (this.search.length > 2) {
                fetch(`http://localhost:8000/api/articles2?search=${this.search}&offset=${this.offset}`
                )
                    .then((data) => data.json())
                    .then((data) => {
                        console.log(data);
                        this.items = data;
                        this.maxarticles =data;

                    })
                    .catch((err) => console.log(err.message));
            } else {
                fetch(`http://localhost:8000/api/articles?offset=${this.offset}`)
                    .then((data) => data.json())
                    .then((data) => {
                        console.log(data);
                        this.maxarticles =data;

                        this.items = data.slice(this.offset, this.offset + 5); // Show only the items for the current page
                    })
                    .catch((err) => console.log(err.message));
            }
        },
        offsetplus() {
            const totalPages = this.maxarticles.length / 5;
            if (this.items.length > 2 ) {
                if (this.currentpage < totalPages) {
                    this.offset += 5;
                    this.currentpage++;
                }
            }
        },
        offsetminus() {
            if (this.currentpage > 1) {
                this.offset -= 5;
                this.currentpage--;
            }
        },
        shoppingCart(id) {
            this.sc.shoppingCart(id);
        },
        impressum(showImpressum) {
            this.ShowImpressum = showImpressum;
        },
        makeOffer(id) {
            axios.post(`/api/articles/${id}/makeoffer`).then(response => {
                console.log("makeOffer response: ",response);
            })
                .catch(error => {
                    console.log(error);
                });
        },
        Offer(id) {

            let article = this.items.find(element => element.id === id);
            console.log("article: ",article);
            if (article) {
                article.highlighted = true;
                alert(`Der Artikel ${article.ab_name} wird nun günstiger angeboten! Greifen Sie schnell zu.`);
            }
        },
    },
    created: function () {
        var self = this;
        let conn = new WebSocket('ws://localhost:8085/chat');
        conn.onopen = function (e) {
            //conn.send('Nachricht vom Webbrowser!')
            console.log('Connected!')
        }
        //eine Nachricht vom Server empfangen wurde.
        conn.onmessage = function (e) {
            let eventData = e.data
            let dataString = JSON.parse(eventData)
            console.log("dataString: ",dataString);
            console.log("dataString Type: ",dataString.type);
        if (dataString.type === 'Wartung') {
                alert("In Kürze verbessern wir Abalo für Sie! Nach einer kurzen Pause sind wir wieder für Sie da! Versprochen.");
            } else if (dataString.type === 'offer') {
                console.log("DataString_article_id: ",dataString.article_id);
                self.Offer(dataString.article_id);
            }
        }
    },
    template: `
    <div v-if="!this.ShowImpressum">
    <div class="popup">
        <img v-bind:src="'shopping-cart-1985.png'"  width="50px">
        <table class="popUp_table" id="Shopping_Cart" border="1px">
            <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Image</th>
                <th>REMOVE</th>
            </tr>
            </thead>
            <tbody id="cart">
            </tbody>
        </table>
        <br>
    </div>
    <div class="body">
        <div class="search_item">
            <h2>Search for an Item:&nbsp;</h2>
            <input type="text" v-model="search" v-on:keyup="loadArticles" v-on:change="loadArticles"><br><br>
            <br>
        </div>
        <h1>List of Articles</h1>
        <table id="Article_table">
            <thead>
            <tr>
                <th>id</th>
                <th>ab_name</th>
                <th>ab_price</th>
                <th>ab_description</th>
                <th>ab_creator_id</th>
                <th>ab_created_date</th>
                <th>ab_image</th>
                <th>ADD TO CART</th>
                <th>Angebot</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in this.items" :key="item.ab_name">
                <td class="id"> {{ item.id }}</td>
                <td class="shop-item-title">{{ item.ab_name }}</td>
                <td class="shop-item-price">{{ item.ab_price }}</td>
                <td>{{ item.ab_description }}</td>
                <td>{{ item.ab_creator_id }}</td>
                <td>{{ item.ab_createdate }}</td>
                <!--<td>
                    <img v-if="fileExists(item.id)" :src="getImageUrl(item.id, 'jpg')" alt="Image" width="120">
                    <img v-else-if="fileExists(item.id)" :src="getImageUrl(item.id, 'png')" alt="Image" width="120">
                </td>-->
                <td><img  v-bind:src="'./articelimages/'+ item.id+'.jpg'" alt="Image" width="120"></td>
                <td>
                    <form method="POST" action="/api/shoppingcart/" :id="'form' + item.id">
                        <input type="hidden" name="article" :value="item.id">
                    </form>
                    <button form="form" type="submit"
                            id="input{{ item.id }}"
                            @click="shoppingCart(item.id)">+
                    </button>
                </td>
                <!--<td v-if="item.highlighted!== true && item.ab_creator_id === 5">-->
                <td>
                <button v-on:click="makeOffer(item.id)" >Artikel jetzt als Angebot anbieten</button>
            </td>
            <!--<td v-else-if="item.ab_creator_id === 5" style="font-weight: bold ;background-color: #EF3B2D"  >
                <button v-on:click="makeOffer(item.id)" >Artikel jetzt als Angebot anbieten</button>
            </td>-->
            </tr>
            </tbody>
        </table>
        </div>
        <div >
        <button v-on:click="offsetminus(); loadArticles()">&lt;</button>
        {{ currentpage }}
        <button v-on:click="offsetplus(); loadArticles()">&gt;</button>
        </div>
    </div>
    <div v-if="this.ShowImpressum">
    <Impressum @show-impressum="impressum"></Impressum>
    </div>
    <SiteFooter @show-impressum="impressum"> </SiteFooter>
    `

}
