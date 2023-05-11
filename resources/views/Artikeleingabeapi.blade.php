<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Artikeleingabe</title>
</head>
<body>
<h1>Artikeleingabeapi</h1>
<div id="newArticle">
    <form action="/articlesapi" method="POST">
        @csrf
        <input type="text" name="ab_name" placeholder="Name" required>
        <input type="text" name="ab_description" placeholder="Beschreibung" required>
        <input type="number" name="ab_price" min="1" placeholder="Price" required>
        <button type="submit">Speichern</button>
    </form>
</div>
</body>
</html>
