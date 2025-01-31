<x-app-layout>
    <div class="container">
        <h1 class="mt-4">Lista de Peliculas</h1>
        <ul>
            <li><a href={{route('oldFilms')}}>Pelis antiguas</a></li>
            <li><a href={{route('newFilms')}}>Pelis nuevas</a></li>
            <li><a href={{route('listFilms')}}>Pelis</a></li>
            <li><a href={{route('filmForm')}}>Crear película</a></li>
            <li><a href={{Route('sortFilms')}}>Pelis ordenadas descendentemente por año</a></li>
            <li><a href={{Route('countFilms')}}>Contador de Pelis</a></li>
        </ul>
    </div>
</x-app-layout>