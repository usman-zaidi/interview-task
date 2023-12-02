@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Import CSV Data With Bus QUEUE</h1>
        <form method="post" action="{{route('products.import')}}" enctype="multipart/form-data">
            @csrf

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="form-group">
                <strong>CSV File:</strong>
                <input type="file" name="csv" class="form-control"/>
            </div>
            <br/>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-block">Import</button>
            </div>
        </form>
    </div>
@endsection
