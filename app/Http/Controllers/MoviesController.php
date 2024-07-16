<?php
namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller; // Adicione esta linha se não houver extensão de um Controller base
use GuzzleHttp\Client;

class MoviesController extends Controller
{
    public function index(Request $request)
    {
        $filmes=[];
        $res = $request->input('search');
        if(!isset($res)){
            $url = 'https://api.themoviedb.org/3/movie/popular?api_key=e5ba6c0e1bbe8ff741e4b8f4a7bb830f&language=pt-BR&page=1';
        $response = Http::withoutVerifying()->withHeaders([
            'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJlNWJhNmMwZTFiYmU4ZmY3NDFlNGI4ZjRhN2JiODMwZiIsIm5iZiI6MTcyMTA1MzYwMy42MzE3OTEsInN1YiI6IjY2OTMyODc2N2M1ZTgxYmMxYzAxMGQyMSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ._Q8pi4EJFjnuq2JHINvknzGXUDZbBikc8X0PaOnAHs8',
            'accept' => 'application/json',
        ])->get($url);
        }else{
            $url = 'https://api.themoviedb.org/3/search/movie?query='. $res .'&api_key=e5ba6c0e1bbe8ff741e4b8f4a7bb830f&language=pt-BR&append_to_response=videos,images';
            $response = Http::withoutVerifying()->withHeaders([
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJlNWJhNmMwZTFiYmU4ZmY3NDFlNGI4ZjRhN2JiODMwZiIsIm5iZiI6MTcyMTA1MzYwMy42MzE3OTEsInN1YiI6IjY2OTMyODc2N2M1ZTgxYmMxYzAxMGQyMSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ._Q8pi4EJFjnuq2JHINvknzGXUDZbBikc8X0PaOnAHs8',
                'accept' => 'application/json',
            ])->get($url);
        }

        if ($response->successful()) {
            $data = $response->json();
            $filmes = $data['results'] ?? [];
        } else {
            $filmes = [];
        }

        $perPage = 16;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = array_slice($filmes, ($currentPage - 1) * $perPage, $perPage);

        $paginatedItems = new LengthAwarePaginator(
            $currentPageItems,
            count($filmes),
            $perPage,
            $currentPage,
            ['path' => Paginator::resolveCurrentPath()]
        );

        return view('filmes', ['filmes' => $paginatedItems]);
    }

    public function show($title_param, Client $client){
        $url = 'https://api.themoviedb.org/3/search/movie?query='. $title_param .'&api_key=e5ba6c0e1bbe8ff741e4b8f4a7bb830f&language=pt-BR&append_to_response=videos,images';
        $response = Http::withoutVerifying()->withHeaders([
            'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJlNWJhNmMwZTFiYmU4ZmY3NDFlNGI4ZjRhN2JiODMwZiIsIm5iZiI6MTcyMTA1MzYwMy42MzE3OTEsInN1YiI6IjY2OTMyODc2N2M1ZTgxYmMxYzAxMGQyMSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ._Q8pi4EJFjnuq2JHINvknzGXUDZbBikc8X0PaOnAHs8',
            'accept' => 'application/json',
        ])->get($url);
        
        $filmes = $response->json();

        $url = 'https://api.themoviedb.org/3/tv/100/recommendations?language=pt-BR&page=10';
        $response = Http::withoutVerifying()->withHeaders([
            'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJlNWJhNmMwZTFiYmU4ZmY3NDFlNGI4ZjRhN2JiODMwZiIsIm5iZiI6MTcyMTA1MzYwMy42MzE3OTEsInN1YiI6IjY2OTMyODc2N2M1ZTgxYmMxYzAxMGQyMSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ._Q8pi4EJFjnuq2JHINvknzGXUDZbBikc8X0PaOnAHs8',
            'accept' => 'application/json',
        ])->get($url);

        $te = $response->json();

        if (isset($filmes['results'])) {
            foreach ($filmes['results'] as $filme) {
                if ($title_param == $filme['title']) {
                    return view('filme', ['filme' => $filme,'te'=>$te]);
                }
            }
        }

    }

}