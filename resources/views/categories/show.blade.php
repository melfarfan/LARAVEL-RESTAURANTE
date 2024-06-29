@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1>Category Details</h1>
                <div class="form-group">
                    <label>Name</label>
                    <p>{{ $category->name }}</p>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <p>{{ $category->description }}</p>
                </div>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
@endsection

