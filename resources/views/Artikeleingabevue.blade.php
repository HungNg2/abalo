<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Artikeleingabe</title>
    <script src="https://unpkg.com/vue@3"></script>
</head>
<body>
<h1>Artikeleingabe</h1>
<div id="newArticle">
    <form @submit.prevent="createArticle">
        <input type="text" name="ab_name" placeholder="Name" required v-model="name">
        <input type="text" name="ab_description" placeholder="Beschreibung" required v-model="description">
        <input type="number" name="ab_price" min="1" placeholder="Price" required v-model.number="price">
        <button type="submit">Speichern</button>
    </form>
</div>
<script>
    const app = Vue.createApp({
        data() {
            return {
                name: '',
                description: '',
                price: 0
            };
        },
        methods: {
            createArticle() {
                const formData = new FormData();
                formData.append('ab_name', this.name);
                formData.append('ab_description', this.description);
                formData.append('ab_price', this.price);

                fetch('/api/articles', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => {

                        console.log(response);
                    })
                    .catch(error => {
                        // Handle error
                        console.error(error);
                    });
            }
        }
    }).mount('#newArticle');
</script>
</body>
</html>
