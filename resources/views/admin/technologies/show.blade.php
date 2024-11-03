@extends('layouts.app')

@section('page-title', $technology->name)

@section('main-content')
<div class="row">
    <div class="col">
        <h1>Progetto: {{$technology->name}}</h1>
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
            <h5 class="card-header">{{$technology->name}}</h5>
            <div class="card-body">
                <h5 class="card-title mb-4">Tecnologia: {{$technology->name}}</h5>
                <a class="btn btn-primary me-2" href="{{route('admin.technologies.index')}}">Torna alla lista tecnologie</a>
                <a href="{{route('admin.technologies.edit', ['technology'=> $technology->id])}}" class="btn btn-warning">
                    Modifica
                </a>
                <form
                    onsubmit="return confirm('Attenzione: sei sicuro di voler cancellare questa tecnologia?')"
                    class="d-flex justify-content-end"
                    method="POST"
                    action="{{route('admin.technologies.destroy', ['technology'=>$technology->id])}}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Cancella</button>
                </form>
            </div>
          </div>
    </div>
</div>

@endsection
