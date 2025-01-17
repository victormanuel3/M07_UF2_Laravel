<x-app-layout>
    <div class="container">
        <h1 class="mt-4">Lista de Peliculas</h1>
        <ul>
            <li><a href=/filmout/oldFilms>Pelis antiguas</a></li>
            <li><a href=/filmout/newFilms>Pelis nuevas</a></li>
            <li><a href=/filmout/films>Pelis</a></li>
            <li><a href=/filmout/sortFilms>Pelis ordenadas descendentemente por año</a></li>
            <li><a href=/filmout/countFilms>Contador de Pelis</a></li>
        </ul>
        <div>

            <h1 class="mt-4">Añadir película</h1>
            <form action={{route('createFilm')}} method="post">
                @if(session('success') || session('error'))
                    <div class="alert {{ session('success') ? 'alert-success' : 'alert-danger' }}">
                        {{ session('success') ?? session('error') }}
                    </div>
                @endif
                @csrf
                <input type="text" name="name" placeholder="Nombre">
                @error('name') <p>{{$message}}</p> @enderror
    
                <input type="number" name="year" placeholder="Year" min="1800">
                @error('year') <p>{{$message}}</p> @enderror
    
                <input type="text" name="genre" placeholder="Genero">
                @error('genre') <p>{{$message}}</p> @enderror
    
                <input type="text" name="country" placeholder="Pais">
                @error('country') <p>{{$message}}</p> @enderror
    
                <input type="number" name="duration" placeholder="Duracion" min="30">
                @error('duration') <p>{{$message}}</p> @enderror
    
                <input type="text" name="img_url" placeholder="Image_URL">
                @error('img_url') <p>{{$message}}</p> @enderror
    
                <button type="submit">Crear</button>
            </form>
        </div>
    </div>
</x-app-layout>