export default {
    /** array contains all cart-element id
     * @type {any[]}
     */
    CartList: [],
    showCart: false,

    popUpFunction() {
        /** div element contains cart table
         * @type {HTMLElement}
         * be hidden when no article in cart
         */

        let divShoppingCart = document.getElementById("Shopping_Cart");
        if (!this.showCart) {
            this.showCart = true;
            if (this.CartList.length === 0)
                divShoppingCart.style.visibility = "hidden";
            else
                divShoppingCart.style.visibility = "visible";
        } else {
            this.showCart = false;
            divShoppingCart.style.visibility = "hidden";
        }
    },

    /** function to create a table when '+' button was clicked
     * @param id : id of the selected article
     */
    shoppingCart(id) {
        /** table <tbody> element
         * */
        let cartTable = document.getElementById("cart");
        this.CartList.push(id);
        //divShoppingCart.style.visibility = "visible";

        let new_cartElement = document.createElement("tr");
        new_cartElement.setAttribute("id", "cartElement" + id);

        let tdName = document.createElement("td");
        let tdPrice = document.createElement("td");
        let tdImage = document.createElement("td");
        let tdRemove = document.createElement("td");

        /** find selected items
         * @type {HTMLElement}
         */
        let addButtonColumn = document.getElementById("input" + id);
        let articleRow = document.getElementById('' + id);

        /**
         ** add content from the selected article to cart (name, price, image)
         ** this 'if' trigger when button '+' has been clicked.
         */
        let tdNameContent = articleRow.getElementsByTagName("td").item(1).innerHTML;
        let tdPriceContent = articleRow.getElementsByTagName("td").item(2).innerHTML;
        let tdImageContent = articleRow.getElementsByTagName("td").item(6).innerHTML;
        tdName.innerHTML = tdNameContent;
        tdPrice.innerHTML = tdPriceContent;
        tdImage.innerHTML = tdImageContent;

        // hide the already clicked button
        addButtonColumn.style.visibility = "hidden";

        /** create remove button
         * @type {HTMLInputElement}
         */
        let removeButton = document.createElement("input");
        removeButton.setAttribute("id", "remove" + id);
        removeButton.setAttribute("type", "button");
        removeButton.setAttribute("value", "-");
        tdRemove.append(removeButton);
        removeButton.onclick = function () {
            this.remove_from_shopping_cart(id);
        }

        /** add "td" elements to "tr"
         */
        new_cartElement.append(tdName);
        new_cartElement.append(tdPrice);
        new_cartElement.append(tdImage);
        new_cartElement.append(tdRemove);

        /** add "tr" elements to <table body>
         */
        cartTable.append(new_cartElement);

        event.preventDefault();
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '/api/shoppingcart');
        //xhr.setRequestHeader('Accept', 'application/json');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    alert(xhr.responseText);
                } else {
                    const antwort = JSON.parse(xhr.responseText);

                    for (let key in antwort['errors']) {
                        console.log("antwort['errors'][key] = " + antwort['errors'][key]);
                    }
                }
            }
        }
        let xhrForm = document.getElementById('form' + id);
        xhr.send(new FormData(xhrForm));

    },

    /**  function to remove an article from shopping cart
     * @param id of the selected article when click '-' button
     */
    remove_from_shopping_cart(id) {
        /** div element contains cart table
         * @type {HTMLElement}
         * be hidden when no article in cart
         */

        let divShoppingCart = document.getElementById("Shopping_Cart");
        /** table <tbody> element
         * */
        let cartTable = document.getElementById("cart");

        let xhr = new XMLHttpRequest();
        xhr.open('DELETE', '/api/shoppingcart/2/articles/' + id);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    alert(xhr.responseText);
                } else {
                    const antwort = JSON.parse(xhr.responseText);

                    for (let key in antwort['errors']) {
                        console.log("antwort['errors'][key] = " + antwort['errors'][key]);
                    }
                }
            }
        }
        xhr.send();
        /** remove a row by removing a <tr> tag
         * */
        let trRemoveItem = document.getElementById("cartElement" + id);
        cartTable.removeChild(trRemoveItem);

        /** delete article-id in cart-element array
         * hide the <div> area when ta no article in cart
         */
        this.CartList.splice(this.CartList.indexOf(id), 1);
        if (this.CartList.length === 0)
            divShoppingCart.style.visibility = "hidden";

        /** make '+' button visible again
         * give user an option to add to cart again
         * @type {HTMLElement}
         */
        let addButtonColumn = document.getElementById("input" + id);
        addButtonColumn.style.visibility = "visible";
    },
}

