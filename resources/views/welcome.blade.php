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
        <h1 class="mt-4">Añadir película</h1>
        <form action={{route('createPelicula')}} action="post">
            <input type="text" placeholder="Nombre">
            <input type="number" placeholder="Year" min="1800">
            <input type="text" placeholder="Genero">
            <input type="text" placeholder="Pais">
            <input type="number" placeholder="Duracion" min="30">
            <input type="url" placeholder="Image_URL">
            <button type="submit">Crear</button>
        </form>
    </div>
</x-app-layout>