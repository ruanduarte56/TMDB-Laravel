<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <title>Document</title>
</head>
<body>
    
    <div style="width:85%; margin:100px auto; column-gap:0.5%; row-gap:30px; height:500px; display: grid; grid-template-columns:200px auto; grid-template-rows:repeat(2,250px);">
        <div>
        <a href="{{route('filme',$filme['title'])}}"><img style="object-fit: cover; width:100%; height:190px;" src="https://image.tmdb.org/t/p/w500/{{$filme['backdrop_path']}}" alt=""> </a>
        <p style="">{{$filme['title']}}</p>
        </div>
        <div>
            <p>{{$filme['overview']}}</p>
        </div>
    </div>
</body>
</html>