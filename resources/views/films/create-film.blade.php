<x-app-layout>
    <h1 class="mt-4">{{isset($film) ? 'Modificar película' : 'Añadir película'}}</h1>
    <form action={{isset($film) ? route('updateFilm', ['id' => $film->id]) : route('createFilm')}} method="post">
        @csrf
        @if (isset($film))
            @method('PUT')
        @endif
        <input type="text" name="name" placeholder="Nombre" value={{isset($film) ? $film->name : ''}}>
        @error('name') <p>{{$message}}</p> @enderror
        
        <input type="number" name="year" placeholder="Year" min="1800" value={{isset($film) ? $film->year : ''}}>
        @error('year') <p>{{$message}}</p> @enderror
        
        <input type="text" name="genre" placeholder="Genero" value={{isset($film) ? $film->genre : ''}}>
        @error('genre') <p>{{$message}}</p> @enderror

        <input type="text" name="country" placeholder="Pais" value={{isset($film) ? $film->country : ''}}>
        @error('country') <p>{{$message}}</p> @enderror

        <input type="number" name="duration" placeholder="Duracion" min="30" value={{isset($film) ? $film->duration : ''}}>
        @error('duration') <p>{{$message}}</p> @enderror
        
        <input type="text" name="img_url" placeholder="Image_URL" value={{isset($film) ? $film->img_url : ''}}>
        @error('img_url') <p>{{$message}}</p> @enderror
        
        <button type="submit">{{isset($film) ? 'Modificar película' : 'Crear película'}}</button>
    </form>
</x-app-layout>

