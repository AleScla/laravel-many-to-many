@extends('layouts.app')

@section('page-title', 'I tuoi progetti')

@section('main-content')
    <div class="row">
        <div class="col">
            <h1 class="pb-2">I tuoi progetti</h1>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Titolo progetto</th>
                    <th scope="col">Completato</th>
                    <th scope="col">Tecnologie</th>
                    <th scope="col">Tipo</th>

                    <th class="text-center" scope="col">Azioni</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($projects as $project)
                    <tr>
                        <th scope="row">{{$project->id}}</th>
                        <td>{{$project->title}}</td>
                        @if ($project->completed == 1)
                        <td class="text-success">Completato</td>
                        @else
                        <td class="text-danger">In sviluppo</td>
                        @endif
                        <td>
                            @foreach ($project->technologies as $technology)

                            <span class="badge rounded-pill text-bg-primary">{{$technology->name}}</span>
                            @endforeach

                        </td>
                        {{-- ucfirst rende la prima lettera di ogni tipo maiuscola --}}
                        <td>{{ucfirst($project->type->name)}}</td>
                        <td class="d-flex justify-content-around">
                            <a href="{{route('admin.projects.show', ['project'=> $project->id])}}" class="btn btn-primary">
                                Più dettagli
                            </a>
                            <a href="{{route('admin.projects.edit', ['project'=> $project->id])}}" class="btn btn-warning">
                                Modifica
                            </a>
                            <form
                            onsubmit="return confirm('Attenzione: sei sicuro di voler cancellare questo progetto?')"
                            class="d-flex"
                            method="POST"
                            action="{{route('admin.projects.destroy', ['project'=>$project->id])}}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Cancella</button>
                            </form>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
            <a class="btn btn-primary" href="{{ route('admin.projects.create')}}">Crea un nuovo progetto</a>
        </div>
    </div>

@endsection
