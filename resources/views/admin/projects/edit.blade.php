@extends('layouts.app')

@section('page-title', $project->title)
@section ('main-content')
<div class="col">
    <h1 class="pb-2">Modifica il progetto {{$project->title}}</h1>
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


    <form action="{{route('admin.projects.update', ['project' => $project->id])}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Titolo *</label>
            <input type="text"
            name="title"
            class="form-control"
            id="title"
            required
            minlength="3"
            maxlength="64"
            value="{{$project->title}}"
            placeholder="Inserisci il titolo">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione *</label>
            <textarea class="form-control"
             id="description"
             name="description"
             minlength="3"
             maxlength="1024"
             value="{{$project->description}}"
             placeholder="Inserisci la descrizione"
             rows="3">{{$project->description}}</textarea>
        </div>
        <div class="mb-3">
            <label for="cover" class="form-label">Inserisci un'immagine</label>
            <input type="file" class="form-control"
             id="cover"
             name="cover"
             placeholder="Inserisci un'immagine">
        </div>

        @if ($project->cover != null)
        <div>
            <p>Attuale copertina:</p>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="coverRemover" value="1" id="coverRemover">
                <label class="form-check-label" for="coverRemover">
                    Spunta qui per rimuovere questa copertina
                </label>
              </div>
            <img src="{{asset('storage/'.$project->cover)}}" alt="{{$project->title}}">
        </div>
        @endif

        <div class="mb-3">
            <p>
                Tecnologie:
            </p>
            @foreach ($technologies as $technology)
                <span class="form-check form-check-inline">
                    <label class="form-check-label" for="tech-{{$technology->id}}">
                        {{$technology->name}}
                    </label>
                    <input class="form-check-input"
                    @if ($project->technologies->contains($technology->id))
                    checked
                    @endif
                    type="checkbox" name="technologies[]" value="{{$technology->id}}" id="tech-{{$technology->id}}">
                </span>
            @endforeach
        </div>
        <div class="mb-3">
            <label for="completed" class="form-label">Stato del progetto</label>
            <select id="completed" name="completed" class="form-select" aria-label="Default select example">
                <option class="d-none" disabled selected>Seleziona lo stato del progetto</option>
                <option value="0">In lavorazione</option>
                <option value="1">Completato</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="starting_date" class="form-label">Data di inizio progetto</label>
            <input type="date"
            name="starting_date"
            class="form-control"
            value="{{$project->starting_date}}"
            id="starting_date">
        </div>
        <div class="mb-3">
            <label for="type_id" class="form-label">Tipo di progetto</label>
            <select id="type_id" name="type_id" class="form-select">
                @foreach ($types as $type)
                    <option
                    @if (old('type_id') == $type->id)
                        selected
                    @endif
                    value="{{$type->id}}">{{ucfirst($type->name)}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="level" class="form-label">Livello del programmatore</label>
            <select id="level" name="level" class="form-select" aria-label="Default select example">

                <option
                @if ($project->level == 'junior')
                selected
                @endif
                value="junior">Principiante</option>
                <option
                @if ($project->level == 'experienced')
                selected
                @endif
                value="experienced">Con esperienza</option>
                <option
                @if ($project->level == 'senior')
                selected
                @endif
                value="senior">Senior</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">
            Modifica il progetto
        </button>
        <a class="btn btn-secondary" href="{{route('admin.projects.index')}}">Torna alla lista progetti</a>
    </form>

    <div class="fw-bold fs-5">
        I CAMPI CONTRASSEGNATI CON * SONO OBBLIGATORI
    </div>
</div>
</div>
@endsection
