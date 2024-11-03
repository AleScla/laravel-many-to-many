@extends('layouts.app')

@section('page-title', 'Le tecnologie progetti')

@section('main-content')
    <div class="row">
        <div class="col">
            <h1 class="pb-2">Tecnologie progetti</h1>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tecnologia progetto</th>

                  </tr>
                </thead>
                <tbody>
                  @foreach ($technologies as $technology)
                    <tr>
                        <th scope="row">{{$technology->id}}</th>
                        <td class="d-flex w-100 justify-content-between">{{ucfirst($technology->name)}}
                            <div>
                                <a href="{{route('admin.technologies.show', ['technology'=> $technology->id])}}" class="btn btn-primary">
                                    Mostra di più
                                </a>
                                <a href="{{route('admin.technologies.edit', ['technology'=> $technology->id])}}" class="btn btn-warning">
                                    Modifica
                                </a>
                                <form
                                class="d-inline-block"
                                onsubmit="return confirm('Attenzione: sei sicuro di voler cancellare questa tecnologia?')"
                                method="POST"
                                action="{{route('admin.technologies.destroy', ['technology'=>$technology->id])}}">
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
            <a class="btn btn-primary" href="{{ route('admin.technologies.create')}}">Crea una nuova tipologia</a>
        </div>
    </div>

@endsection
