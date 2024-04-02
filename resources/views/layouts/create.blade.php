@extends('layouts.back-office.dashboard')

@section('content')

    <main class="container text-center">

        <h1>Crea</h1>

        <form class="d-flex flex-column align-items-center" action="{{route('dashboard.project.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="d-flex flex-column">
                <label for="title">Titolo</label>
                <input type="text" name="title" id="title">
            </div>


            <div class="d-flex flex-column">
                <label for="description">Descrizione</label>
                <textarea name="description" id="description" cols="30" rows="10"></textarea>
            </div>

            <div class="d-flex flex-column">
                <label for="thumb">immagine</label>
                <input type="file" name="thumb" id="thumb">
            </div>

            <div class="d-flex flex-column">
                <label for="date">Data</label>
                <input type="date" name="date" id="date">
            </div>

            <button class="submit">Invio</button>

        </form>

    </main>

@endsection
