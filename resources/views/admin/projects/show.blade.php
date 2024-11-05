@extends('layouts.app')

@section('page-title', $project->title)

@section('main-content')
<div class="row">
    <div class="col">
        <h1>Progetto: {{$project->title}}</h1>
        @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                {{$error}}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <div class="card">
            <h5 class="card-header">{{$project->title}}</h5>
            <div class="card-body">
                <h5 class="card-title mb-4">Linguaggi usati:
                    @foreach ($project->technologies as $technology)
                        <span class="badge rounded-pill text-bg-primary">{{$technology->name}}</span>
                    @endforeach
                </h5>
                <p class="card-text"><strong>Descrizione progetto:</strong> <br>
                    {{$project->description}}
                </p>
                @if ($project->cover != null)
                    <div class="card-text">
                        <img src="{{asset('storage/'.$project->cover)}}" alt="{{$project->title}}">
                    </div>
                @endif
                <p class="card-text">
                    Stato:
                    @if ($project->completed)
                        <span class="text-success">Completato</span>
                    @else
                        <span class="text-warning">In lavorazione</span>
                    @endif
                </p>
                <p class="card-text">
                    Iniziato il: {{$project->starting_date}}
                </p>
                <p class="card-text">
                    Tipo di progetto: {{ucfirst($project->type->name)}}
                </p>
                <p class="card-text">
                    Livello programmatore:
                    @if ($project->level == 'junior')
                    <span class="text-success">Principiante</span>
                    @elseif ($project->level == 'experienced')
                    <span class="text-warning">Con esperienza</span>
                    @else
                    <span class="text-primary">Senior</span>
                    @endif
                </p>
                <a class="btn btn-primary me-2" href="{{route('admin.projects.index')}}">Torna alla lista progetti</a>
                <a href="{{route('admin.projects.edit', ['project'=> $project->id])}}" class="btn btn-warning">
                    Modifica
                </a>
                <form
                    onsubmit="return confirm('Attenzione: sei sicuro di voler cancellare questo progetto?')"
                    class="d-flex justify-content-end"
                    method="POST"
                    action="{{route('admin.projects.destroy', ['project'=>$project->id])}}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Cancella</button>
                </form>
            </div>
          </div>
    </div>
</div>

@endsection
