@extends('layouts.app')

@section('page-title', $technology->name)
@section ('main-content')
<div class="col">
    <h1 class="pb-2">Modifica la tecnologia: {{$technology->name}}</h1>
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

    <form action="{{route('admin.technologies.update', ['technology' => $technology->id])}}" method="POST">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nome tecnologia *</label>
            <input type="text"
            name="name"
            class="form-control"
            id="name"
            required
            minlength="3"
            maxlength="64"
            value="{{ucfirst($technology->name)}}"
            placeholder="Inserisci la tipologia">
        </div>

        <button type="submit" class="btn btn-primary">
            Modifica il progetto
        </button>
        <a class="btn btn-secondary" href="{{route('admin.technologies.index')}}">Torna alla lista tecnologie</a>
    </form>

    <div class="fw-bold fs-5">
        I CAMPI CONTRASSEGNATI CON * SONO OBBLIGATORI
    </div>
</div>
</div>
@endsection
