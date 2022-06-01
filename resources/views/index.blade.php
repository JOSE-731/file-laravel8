@extends('layouts.app')

@section('content')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" rel="stylesheet" />

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <table class="table table-dark">
                    <thead>
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Ver</th>
                        <th scope="col">Eliminar</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($files as $file)
                      <tr>
                          <td>{{$file->id}}</td>
                          <td>{{$file->name}}</td>
                          <td>
                              <a target="_blank" href="storage/{{Auth::id()}}/{{$file->name}}" class="btn btn-sm btn-outline-primary">Ver</a>
                          </td>
                          <td>
                            <a href="" class="btn btn-sm btn-outline-danger">Eliminar</a>
                          </td>
                      </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>
@endsection
