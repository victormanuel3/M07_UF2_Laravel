<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{

    /**
     * Read films from storage
     */
    public static function readFilms(): array {
        $films = Storage::json('/public/films.json');
        return $films;
    }
    /**
     * List films older than input year 
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listOldFilms($year = null)
    {        
        $old_films = [];
        if (is_null($year))
        $year = 2000;
    
        $title = "Listado de Pelis Antiguas (Antes de $year)";    
        $films = FilmController::readFilms();

        foreach ($films as $film) {
        //foreach ($this->datasource as $film) {
            if ($film['year'] < $year)
                $old_films[] = $film;
        }
        return view('films.list', ["films" => $old_films, "title" => $title]);
    }
    /**
     * List films younger than input year
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listNewFilms($year = null)
    {
        $new_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Nuevas (Después de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] >= $year)
                $new_films[] = $film;
        }
        return view('films.list', ["films" => $new_films, "title" => $title]);
    }
    /**
     * Lista TODAS las películas o filtra x año o categoría.
     */
    public function listFilms()
    {
        $films_filtered = [];

        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            $films_filtered[] = $film;
        }

        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }
    /**
    * Lista TODAS las películas o filtra x genero.
    */
    public function listFilmsByGenre($genre = null){
        $films_filtered = [];

        $title = "Listado de películas por género";
        $films = FilmController::readFilms();
        if (is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);

        //list based in the year
        foreach ($films as $film) {
            if(!is_null($genre) && $film["genre"] == $genre){
                $films_filtered[] = $film;
            }
        }
        
        return view("films.list",[
            "films" => $films_filtered, 
            "title" => $title
        ]);
    }
    /**
    * Lista TODAS las películas o filtra x year.
    */
    public function listFilmsByYear($year = null){
        $films_filtered = [];

        $title = "Listado de películas por año";
        $films = FilmController::readFilms();
        
        if (is_null($year))
            return view('films.list', ["films" => $films, "title" => $title]);

        //list based in the year
        foreach ($films as $film) {
            if(!is_null($year) && $film["year"] == $year){
                $films_filtered[] = $film;
            }
        }

        return view("films.list",[
            "films" => $films_filtered, 
            "title" => $title
        ]);
    }

    public function sortFilms(){
        $films_filtered = [];

        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        array_multisort(array_column($films, "year"), SORT_DESC, $films);

        foreach ($films as $film) {
            $films_filtered[] = $film;
        }

        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }
}
