<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Artikeln</title>
    <link rel="stylesheet" href="{{asset('css/article.css')}}">
</head>
<body>
    <div id="header">
        <div class="logo">
        <img src="logo.jpg" width="80px">
        </div>
        <div id="Navigationsmenues"></div>
        <div class="search_item">
            <h2>Search for an Item:&nbsp;</h2>
            <form method="GET" action="/articlesapi">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="enter the item name here">
                <button type="submit">Search</button>
            </form>
            <br>
        </div>
    </div>
    <div class="popup">
        <img src="shopping-cart-1985.png" width="50px" onclick="popUpFunction()">
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
                    <th>ADD TO SHOPPING CART</th>
                </tr>
                </thead>
                    <tbody>
                    @foreach ($abarticle as $article)
                        <tr id="{{$article->id}}">
                            <td>{{ $article->id }}</td>
                            <td>{{ $article->ab_name }}</td>
                            <td>{{ $article->ab_price }}</td>
                            <td>{{ $article->ab_description }}</td>
                            <td>{{$article->ab_creator_id}}</td>
                            <td>{{$article->ab_createdate}}</td>
                            @if(file_exists(public_path('articelimages/' . $article->id . '.png')))
                            <td><img src="{{url('./articelimages/'.$article->id).'.png'}}" alt="Image" width="120"> </td>
                            @elseif(file_exists(public_path('articelimages/' . $article->id . '.jpg')))
                                <td><img src="{{url('./articelimages/'.$article->id).'.jpg'}}" alt="Image" width="120"> </td>
                                @else
                                <td></td>
                            @endif
                            <td>
                                <form method="POST" action="/api/shoppingcart/" id="form{{ $article->id }}">
                                    <input type="hidden" name="article" value="{{ $article->id }}">
                                </form>
                                <button form="form" type="submit"
                                        id="input{{ $article->id }}"
                                        onclick="shoppingCart({{ $article->id }})">+
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
        </table>
</div>
    <script src="{{asset('js/shopingcart.js')}}"></script>
    @include("patterns/cookieform")
    <script src="{{asset('/js/Navigation.js')}}"></script>
</body>
</html>
