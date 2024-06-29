@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1>Product Details</h1>
                <div class="form-group">
                    <label>Name</label>
                    <p>{{ $product->name }}</p>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <p>{{ $product->description }}</p>
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <p>{{ $product->price }}</p>
                </div>
                <div class="form-group">
                    <label>Stock</label>
                    <p>{{ $product->stock }}</p>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <p>{{ $product->category->name }}</p>
                </div>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
@endsection
