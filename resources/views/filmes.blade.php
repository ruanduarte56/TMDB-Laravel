<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/filme.css')}}">
    <title>Document</title>
</head>
<body>
    <form id="form-search" class="form-pesquisa" action="{{route('index')}}" method="GET">
        <input name="search" class="input-pesquisa" type="search" placeholder="Pesquisar filme">
        <button id="search" type="submit"><i class="material-icons">search</i></button>
    </form>
    
    <div style="width:85%; margin:30px auto; column-gap:0.5%; row-gap:30px; height:540px; display: grid; grid-template-columns: repeat(8,12%); grid-template-rows:repeat(2,250px);">
        @foreach ($filmes as $filme)
        <div>
        <a href="{{route('filme',$filme['title'])}}"><img style="object-fit: cover; width:100%; height:190px;" src="https://image.tmdb.org/t/p/w500/{{$filme['backdrop_path']}}" alt=""> </a>
        <p style="">{{$filme['title']}}</p>
        </div>
        @endforeach
    </div>
    <div class="center">
    {{ $filmes->links('custom.paginate') }}
    </div>
</body>
</html>