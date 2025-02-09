<x-app-layout>
    @slot('header')
        <a href="{{ route('welcome') }}" class="back-home">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>
    @endslot

    <h1>{{$title}}</h1>

    <div class="container-alerta">
        @if(session()->has('success') || session()->has('error'))
            <div class="alert {{ session()->has('success') ? 'alert-success' : 'alert-danger' }} alert-dismissible fade show" role="alert">
                <strong>{{ session('success') ?? session('error') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    @if(count($films) == 0)
        <span class="not-found">No se ha encontrado ninguna película</span>
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
                        <div class="buttons">
                            <form action={{route('showUpdateForm', ['id' => $film->id])}} method="get">
                                <button>
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            </form>
                            <form action={{route("deleteFilm", ['id' => $film->id])}} method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    <i class="fa-sharp fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
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