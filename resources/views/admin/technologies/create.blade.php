@extends('layouts.app')

@section('page-title', 'Crea una nuova tecnologia')

@section ('main-content')
<div class="col">
    <h1 class="pb-2">Crea una nuova tecnologia</h1>
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
    <form action="{{route('admin.technologies.store')}}" method="POST">
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
            value="{{old('name')}}"
            placeholder="Inserisci la tecnologia">
        </div>

        <button type="submit" class="btn btn-primary">
            Crea la nuova tecnologia
        </button>
        <a class="btn btn-secondary" href="{{route('admin.technologies.index')}}">Torna alla lista tecnologie</a>
    </form>

    <div class="fw-bold fs-5">
        I CAMPI CONTRASSEGNATI CON * SONO OBBLIGATORI
    </div>
</div>
</div>
@endsection
