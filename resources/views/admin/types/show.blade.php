@extends('layouts.app')

@section('page-title', $type->name)

@section('main-content')
<div class="row">
    <div class="col">
        <h1>Progetto: {{$type->name}}</h1>
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
            <h5 class="card-header">{{$type->name}}</h5>
            <div class="card-body">
                <h5 class="card-title mb-4">Tipologia progetto: {{$type->name}}</h5>
                <a class="btn btn-primary me-2" href="{{route('admin.types.index')}}">Torna alla lista tipologie</a>
                <a href="{{route('admin.types.edit', ['type'=> $type->id])}}" class="btn btn-warning">
                    Modifica
                </a>
                <form
                    onsubmit="return confirm('Attenzione: sei sicuro di voler cancellare questa tipologia?')"
                    class="d-flex justify-content-end"
                    method="POST"
                    action="{{route('admin.types.destroy', ['type'=>$type->id])}}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Cancella</button>
                </form>
            </div>
          </div>
    </div>
</div>

@endsection
