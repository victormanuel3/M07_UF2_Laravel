<h1>{{$title}}</h1>

@if(empty($films))
    <p COLOR="red">No se ha encontrado ninguna película</p>
@else
    <div align="center">
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Country</th>
            <th>Year</th>
            <th>Genre</th>
            <th>Duration</th>
            <th>Image</th>
        </tr>

        @foreach($films as $film)
            <tr>
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