@extends('layouts.app')

@section('page-title', 'I tuoi progetti')

@section('main-content')
    <div class="row">
        <div class="col">
            <h1 class="pb-2">Tipologie progetti</h1>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tipologia progetto</th>

                  </tr>
                </thead>
                <tbody>
                  @foreach ($types as $type)
                    <tr>
                        <th scope="row">{{$type->id}}</th>
                        <td class="d-flex w-100 justify-content-between">{{ucfirst($type->name)}}
                            <div>
                                <a href="{{route('admin.types.show', ['type'=> $type->id])}}" class="btn btn-primary">
                                    Mostra di più
                                </a>
                                <a href="{{route('admin.types.edit', ['type'=> $type->id])}}" class="btn btn-warning">
                                    Modifica
                                </a>
                                <form
                                class="d-inline-block"
                                onsubmit="return confirm('Attenzione: sei sicuro di voler cancellare questa tipologia?')"
                                method="POST"
                                action="{{route('admin.types.destroy', ['type'=>$type->id])}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Cancella</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
            <a class="btn btn-primary" href="{{ route('admin.types.create')}}">Crea una nuova tipologia</a>
        </div>
    </div>

@endsection
