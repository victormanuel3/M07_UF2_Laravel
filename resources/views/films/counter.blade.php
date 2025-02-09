<x-app-layout>
    @slot('header')
        <a href="{{ route('welcome') }}" class="back-home">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>
    @endslot
    <div class="counter-info">
        <h1>{{$title}}<h1>
        <p>{{$count}} películas registradas</p>
    </div>
</x-app-layout>