@extends("layouts.back-office.dashboard")


@section('content')

<div class="container text-center d-flex flex-column align-items-center">

    <h1>{{$project->title}}</h1>
    <p>{{$project->description}}</p>
    <img src="{{ asset('storage/images/'.$project->thumb )}}" alt="">
    <span>{{$project->date}}</span>

    <form action="{{route('dashboard.project.destroy', $project->id)}}" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="submit">Elimina</button>
    </form>
</div>

@endsection
