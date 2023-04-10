<!DOCTYPE html>
<html land="de">
<head>
    <title>Abalo</title>
    <meta charset="utf-8">
</head>

<body>
    <div>
        <label id="article search">Search</label>
        <form>
            <div>
                <input type="search" id="article search" name="search"
                       @if(!empty($keyword))
                           value="{{ $keyword }}"
                       @else
                           placeholder="Search a article"
                       @endif
                >
                <button>Search</button>
            </div>
        </form>
    </div>

    <br>
    <br>

    <div>
        @if(!empty($keyword))
            @if(count($results) != 0)
                <table>
                    <caption>Result for "{{ $keyword }}"</caption>
                    <tr>
                        <th>ArticleID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>User</th>
                        <th>Created at</th>
                    </tr>
                    @foreach($results as $result)
                        <tr>
                            <td> {{ $result->id }} </td>
                            <th>
                                @if( array_key_exists( $result->id , $images) )
                                    <img src="{{url($images[$result->id])}}" width="100" height="100">
                                @else
                                    No image found
                                @endif
                            </th>
                            <td> {{ $result->ab_name }} </td>
                            <td> {{ $result->ab_price }}€</td>
                            <td> {{ $result->ab_description }} </td>
                            <td> {{ $result->ab_creator_id }} </td>
                            <td> {{ $result->created_at }} </td>
                        </tr>
                    @endforeach
                </table>
            @else
                No "{{ $keyword }}" was found
            @endif
        @endif
    </div>

</body>
</html>
