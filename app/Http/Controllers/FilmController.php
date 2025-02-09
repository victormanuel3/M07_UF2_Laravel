<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class FilmController extends Controller
{
    /**
     * List films older than input year 
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listOldFilms($year = null)
    {
        try{
            if (is_null($year)) $year = 2000;
    
            $title = "Listado de Pelis Antiguas (Antes de $year)";    
            $films = Film::where('year','<', $year)->get();
    
            if ($films->count() > 0) {
                Log::info("Se han encontrado {$films->count()} películas anteriores a $year");
            } else {
                Log::info("No se encontraron películas anteriores a $year");
            }

            return view('films.list', ["films" => $films, "title" => $title]);
        }catch(QueryException $e) {
            Log::warning("Error al listar películas antiguas: " . $e->getMessage());
        }     
    }
    /**
     * List films younger than input year
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listNewFilms($year = null)
    {
        try{
            $films = [];
            if (is_null($year)) $year = 2000;
    
            $title = "Listado de Pelis Nuevas (Después de $year)";
            $films = Film::where('year','>=', $year)->get();
    
            if ($films->count() > 0) {
                Log::info("Se han encontrado {$films->count()} películas posteriores a $year");
            } else {
                Log::info("No se encontraron películas posteriores a $year");
            }
            return view('films.list', ["films" => $films, "title" => $title]);
        }catch(QueryException $e) {
            Log::warning("Error al listar películas nuevas: " . $e->getMessage());
        }  
    }
    /**
     * Lista TODAS las películas.
     */
    public function listFilms()
    {
        try{
            $title = "Listado de todas las pelis";
            $films = Film::all();
    
            if ($films->count() > 0) {
                Log::info("Se han listado todas las películas. Total: {$films->count()}");
            } else {
                Log::info("No hay películas en la base de datos");
            }
            return view("films.list", ["films" => $films, "title" => $title]);
        }catch(QueryException $e) {
            Log::warning("Error al listar todas las películas: " . $e->getMessage());
        }  
    }
    /**
    * Lista TODAS las películas o filtra x genero.
    */
    public function listFilmsByGenre($genre = null){
        try{
            $title = "Listado de películas por género";
            
            if (is_null($genre)) {
                $films = Film::all();
                Log::info("No se ha indicado el género, por lo tanto se han listado todas las películas.");
                return view('films.list', ["films" => $films, "title" => $title]);
            }else {
                $films = Film::where('genre', $genre)->get();

                Log::info("Las películas del género {$genre} han sido listadas exitosamente.");
                return view("films.list",[
                    "films" => $films, 
                    "title" => $title
                ]);
            }
        }catch(QueryException $e) {
            Log::warning("Error al filtrar las películas por género: {$e->getMessage()}");
        }  
    }
    /**
    * Lista TODAS las películas o filtra x year.
    */
    public function listFilmsByYear($year = null){
        try{
            $title = "Listado de películas por año";
            
            if (is_null($year)) {
                $films = Film::all();
                Log::info("No se ha indicado el año, por lo tanto se han listado todas las películas.");
                return view('films.list', ["films" => $films, "title" => $title]);
            }else {
                $films = Film::where('year', $year);
                Log::info("Las películas del año ".$year." han sido listadas exitosamente.");
                return view("films.list",[
                    "films" => $films, 
                    "title" => $title
                ]);
            }
        }catch(QueryException $e) {
            Log::warning("Error al filtrar las películas por año: {$e->getMessage()}");
        }  
    }

    public function sortFilms(){
        try{
            $title = "Listado de todas las pelis";
            $films = Film::all()->sortByDesc('year');

            Log::info("Se han listado de manera ordenada por año todas las películas.");
            return view("films.list", ["films" => $films, "title" => $title]);
        }catch(QueryException $e) {
            Log::warning("Ha ocurrido un error al ordenar las películas por año: {$e->getMessage()}");
        }  
    }

    public function countFilms(){
        try{
            $title = "Cantidad de películas";
            $films = Film::all()->count();
            Log::info("Hay un total de ".$films." películas.");
            return view("films.counter", ["count" => $films, "title" => $title]);
        }catch(QueryException $e) {
            Log::warning("Error al contar los registros en la tabla películas: {$e->getMessage()}");
        }  
    }


    public function showUpdateForm($id = null) {
        try{
            $film = Film::findOrFail($id);
            return view('films.create-film', ['film' => $film]);
        }catch(QueryException $e) {
            Log::warning("Error al intentar buscar una película: {$e->getMessage()}");
        }  
    }
    public function showFilmForm() {
        return view('films.create-film');
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

            Film::create([
                'name' => $request->name,
                'year' => $request->year,
                'genre' => $request->genre,
                'country' => $request->country,
                'duration' => $request->duration,
                'img_url' => $request->img_url,
            ]);

            Log::info("La película {$film->name} ha sido creada.");
            session()->flash('success', 'Película creada exitosamente.');
            return $this->listFilms();
        }catch (QueryException $e) {
            Log::error("Ha ocurrido un error en el create {$e->getMessage()}");
            return back()->with('error', 'Error al crear la película');
        }
    }

    public function deleteFilm($id = null) {
        try {
            $film = Film::find($id);
            $film->delete();
            Log::info("El delete de la película {$film->name} ha sido exitoso.");
            return redirect()->route('listFilms')->with('success', 'Película eliminada correctamente');
        }catch(QueryException $e) {
            Log::error("Error a la hora de realizar un delete {$e->getMessage()}");
            return redirect()->route('listFilms')->with('error', 'Error al eliminar la película');
        }
    }

    public function updateFilm($id = null, Request $request) {
        try {
            $film = Film::findOrFail($id);
            $validated = $request->validate([
                'name' => 'required|string',
                'year' => 'required|integer|min:1700|max:2025',
                'genre' => 'required|string',
                'country' => 'required|string',
                'duration' => 'required|numeric|min:40|max:300',
                'img_url' => 'required|string',
            ]);

            $film->update($validated);

            Log::info("La película {$film->name} ha sido modificada.");
            return redirect()->route('listFilms')->with('success', 'La película ha sido actualizada correctamente.');
        }catch (QueryException $e) {
            Log::error("El update de la película ha fallado {$e->getMessage()}");
            return redirect()->route('listFilms')->with('error', 'Error al actualizar la película')->withInput();
        }
    }
}
