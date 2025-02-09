<x-app-layout>
    @slot('header')
        <a href="{{ route('welcome') }}" class="back-home">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>
    @endslot
    <div class="container-form">
        <h1 class="mt-4">{{isset($film) ? 'Modificar película' : 'Añadir película'}}</h1>
        <form action={{isset($film) ? route('updateFilm', ['id' => $film->id]) : route('createFilm')}} method="post">
            @csrf
            @if (isset($film))
                @method('PUT')
            @endif
            <input type="text" name="name" placeholder="Nombre" value={{isset($film) ? $film->name : ''}}>
            @error('name') <span class="error">{{$message}}</span> @enderror
            
            <input type="number" name="year" placeholder="Year" min="1800" value={{isset($film) ? $film->year : ''}}>
            @error('year') <span class="error">{{$message}}</span> @enderror
            
            <input type="text" name="genre" placeholder="Genero" value={{isset($film) ? $film->genre : ''}}>
            @error('genre') <span class="error">{{$message}}</span> @enderror
    
            <input type="text" name="country" placeholder="Pais" value={{isset($film) ? $film->country : ''}}>
            @error('country') <span class="error">{{$message}}</span> @enderror
    
            <input type="number" name="duration" placeholder="Duracion" min="30" value={{isset($film) ? $film->duration : ''}}>
            @error('duration') <span class="error">{{$message}}</span> @enderror
            
            <input type="text" name="img_url" placeholder="Image_URL" value={{isset($film) ? $film->img_url : ''}}>
            @error('img_url') <span class="error">{{$message}}</span> @enderror
            
            <button style="background-color: #003366; border: none; font-size: 15px;" type="submit" class="btn btn-primary btn-lg">{{isset($film) ? 'Modificar película' : 'Crear película'}}</button>
        </form>
    </div>
</x-app-layout>

