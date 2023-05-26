<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Artikeleingabe</title>
</head>
<body>
<h1>Artikeleingabe</h1>
<div id="newArticle">
</div>
<script>
    "use strict"
// Test die Änderung2
    let form = document.createElement('form');
    //form.action = "/articles";
    form.action = "/api/articles";
    form.method = "POST";

    let nameInput = document.createElement('input');
    nameInput.setAttribute('type','text');
    nameInput.setAttribute('name', 'ab_name');
    nameInput.setAttribute('placeholder', 'Name');
    nameInput.required = true;
    form.append(nameInput);

    let descriptionInput = document.createElement('input');
    descriptionInput.setAttribute('type','text');
    descriptionInput.setAttribute('name', 'ab_description');
    descriptionInput.setAttribute('placeholder', 'Beschreibung');
    descriptionInput.required = true;
    form.append(descriptionInput);

    let priceInput = document.createElement('input');
    priceInput.setAttribute('type','number');
    priceInput.setAttribute('name', 'ab_price');
    priceInput.setAttribute('min', '1');
    priceInput.setAttribute('placeholder', 'Price');
    priceInput.required = true;
    form.append(priceInput);

    let createArticleButton = document.createElement('button');
    createArticleButton.innerHTML = 'Speichern';

    let xhrResponse = document.createElement('p');

    createArticleButton.addEventListener('click', function (event){
        event.preventDefault();

        let ausgabe = "";

        if(form.reportValidity()) {
            let xhr = new XMLHttpRequest();
            //xhr.open("POST","/articles");
            xhr.open("POST","/api/articles");
            xhr.setRequestHeader('Accept', 'application/json');
            xhr.onreadystatechange = function (){
                if(xhr.readyState === 4){
                    if(xhr.status === 200){
                        xhrResponse.innerText = xhr.responseText;
                        xhrResponse.style.color = "green";
                    }else{
                        const antwort = JSON.parse(xhr.responseText);

                        for (let key in antwort['errors']){
                            console.log("antwort['errors'][key] = " + antwort['errors'][key]);
                            ausgabe += antwort['errors'][key] + "<br>" ;
                        }
                        xhrResponse.innerHTML = antwort['message']+ "<br>" + ausgabe ;
                        xhrResponse.style.color = "red";
                    }
                }
            };
            xhr.send(new FormData(form));
        }
    });

    form.append(createArticleButton);
    let newArticleForm = document.getElementById('newArticle');
    newArticleForm.append(form);
    newArticleForm.append(xhrResponse);

</script>
</body>
</html>
