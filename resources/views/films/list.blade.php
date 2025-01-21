<x-app-layout>
    <h1>{{$title}}</h1>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('success')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(empty($films))
    <p COLOR="red">No se ha encontrado ninguna película</p>
    @else
    <div align="center">
        <table border="1" >
            <tr>
                <th></th>
                <th>Name</th>
                <th>Country</th>
                <th>Year</th>
                <th>Genre</th>
                <th>Duration</th>
                <th>Image</th>
            </tr>

            @foreach($films as $film)
                <tr>
                    <td>
                        <form action={{route("deleteFilm", ['id' => $film->id])}} method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <i class="fa-sharp fa-solid fa-
                                trash"></i>
                            </button>
                        </form>
                        {{-- <a href={{route("")}}><i class="fa-sharp fa-solid fa-pen"></i></a> --}}
                        <form action={{route('updateFilm', ['id' => $film->id])}} method="post">
                            @csrf
                            @method()
                            <button>
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        </form>
                    </td>
                    <td>{{$film->name}}</td>
                    <td>{{$film->country}}</td>
                    <td>{{$film->year}}</td>
                    <td>{{$film->genre}}</td>
                    <td>{{$film->duration}}min</td>
                    <td><img src={{$film->img_url}} style="width: 100px; heigth: 120px;"/></td>
                </tr>
            @endforeach
        </table>
    </div>
    @endif
</x-app-layout>


{{-- 
@foreach($films as $film)
    <tr>
        <td>
            <form action={{route("deleteFilm", ['id' => $film->id])}} method="post">
                @csrf
                @method('DELETE')
                <button type="submit">
                    <i class="fa-sharp fa-solid fa-trash"></i>
                </button>
            </form>
        </td>
        <td>{{$film->name}}</td>
        <td>{{$film->country}}</td>
        <td>{{$film->year}}</td>
        <td>{{$film->genre}}</td>
        <td>{{$film->duration}}min</td>
        <td><img src={{$film->img_url}} style="width: 100px; heigth: 120px;"/></td>
    </tr>
@endforeach

Route::delete('deleteFilm/{id}', [FilmController::class, 'deleteFilm'])->name('deleteFilm');

function deleteFilm($id = null) {
$film = Film::find($id);
$film->delete();
return $this->listFilms();
}

¿una pregunta, para hacer un delete si o si debo meterlo en una etiqueta 
form y poner @csrf @method('DELETE')? o se puede hacer un solo boton sin meterlo en la etiqueta? 
cual es la forma de hacerlo más profeisonal y adecuada la que estoy haciendo ahora o así como te 
decía y explícame por qué es necesario poner el METHOD('DELETE') y qué pasa si no lo pongo 
--}}