export default {
    mounted() {
        this.loadArticles();
    },

    data(){
        return{
            items: []
        };
    },
    methods: {
        loadArticles() {
                fetch(`http://localhost:8000/api/articles`)
                    .then(response => response.json())
                    .then(data => {
                        console.log("DATA: "+data);
                        this.items = data;
                    })
                    .catch(error => console.log(error.message));
        },
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
        }

    },
    template: `<div class="body"  v-model="loadArticles">
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
            <td>
                <img v-if="fileExists(item.id)" :src="getImageUrl(item.id, 'jpg')" alt="Image" width="120">
                <img v-else-if="fileExists(item.id)" :src="getImageUrl(item.id, 'png')" alt="Image" width="120">
            </td>
        </tr>
        </tbody>
    </table>
    </div>`
}
