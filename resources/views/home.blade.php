@extends('layouts.app')

@section('content')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" rel="stylesheet" />

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Subir archivos') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <form method="POST" action="{{route('users.files.store')}}" enctype="multipart/form-data">
                            @csrf
                            @error('file')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                                <input class="form-control" type="file" name="file[]" multiple required>
                            <button type="submit" class="btn btn-primary float-right mt-2">
                                Subir archivos
                            </button>
                        </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
