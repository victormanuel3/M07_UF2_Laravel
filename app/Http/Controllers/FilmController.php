<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    /**
     * List films older than input year 
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listOldFilms($year = null)
    {        
        if (is_null($year)) $year = 2000;
    
        $title = "Listado de Pelis Antiguas (Antes de $year)";    
        $films = Film::where('year','<', $year)->get();

        return view('films.list', ["films" => $films, "title" => $title]);
    }
    /**
     * List films younger than input year
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listNewFilms($year = null)
    {
        $films = [];
        if (is_null($year)) $year = 2000;

        $title = "Listado de Pelis Nuevas (Después de $year)";
        $films = Film::where('year','>=', $year)->get();

        return view('films.list', ["films" => $films, "title" => $title]);
    }
    /**
     * Lista TODAS las películas.
     */
    public function listFilms()
    {
        $title = "Listado de todas las pelis";
        $films = Film::all();

        return view("films.list", ["films" => $films, "title" => $title]);
    }
    /**
    * Lista TODAS las películas o filtra x genero.
    */
    public function listFilmsByGenre($genre = null){
        $title = "Listado de películas por género";
        
        if (is_null($genre)) {
            $films = Film::all();
            return view('films.list', ["films" => $films, "title" => $title]);
        }else {
            $films = Film::where('genre', $genre)->get();
            
            return view("films.list",[
                "films" => $films, 
                "title" => $title
            ]);
        }
    }
    /**
    * Lista TODAS las películas o filtra x year.
    */
    public function listFilmsByYear($year = null){
        $title = "Listado de películas por año";
        
        if (is_null($year)) {
            $films = Film::all();
            return view('films.list', ["films" => $films, "title" => $title]);
        }else {
            $films = Film::where('year', $year);
            return view("films.list",[
                "films" => $films, 
                "title" => $title
            ]);
        }
    }

    public function sortFilms(){
        $title = "Listado de todas las pelis";
        $films = Film::all()->sortByDesc('year');

        return view("films.list", ["films" => $films, "title" => $title]);
    }

    public function countFilms(){
        $title = "Cantidad de películas";
        $films = Film::all()->count();

        return view("films.counter", ["count" => $films, "title" => $title]);
    }

    public function createFilm() {
        Film::create([
            
        ]);
    }
}
