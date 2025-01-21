<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Exception;
use Illuminate\Http\Request;

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


    public function createFilm(Request $request) {
        try {
            $request->validate([
                'name' => 'required|string',
                'year' => 'required|integer|min:1700|max:2025',
                'genre' => 'required|string',
                'country' => 'required|string',
                'duration' => 'required|numeric|min:40|max:300',
                'img_url' => 'required|string',
            ]);

            $film = new Film();
            if ($film->isFilm($request->name)){
                return back()->withErrors(['name' => 'La película ya existe.']);
            }

            // Crear el film utilizando directamente el request
            Film::create([
                'name' => $request->name,
                'year' => $request->year,
                'genre' => $request->genre,
                'country' => $request->country,
                'duration' => $request->duration,
                'img_url' => $request->img_url,
            ]);
            
            session()->flash('success', 'Película creada exitosamente.');

            return $this->listFilms();
        }catch (Exception $e) {
            session()->flash('error', 'Hubo un problema al crear la película: ' . $e->getMessage());
        }
    }

    function deleteFilm($id = null) {
        $film = Film::find($id);
        $film->delete();
        return $this->listFilms();
    }

    function updateFilm($id = null, Request $request) {
        $film = Film::find($id);

        $film->save([
            'name' => $request->name
        ]);
    }
}
