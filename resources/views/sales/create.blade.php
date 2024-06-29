@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
       <div class="col-lg-12 margin-tb">
           <div class="pull-left">
               <h2>Create New Sale</h2>
           </div>
           <div class="pull-right">
               <a class="btn btn-primary" href="{{ route('sales.index') }}"> Back</a>
           </div>
       </div>
   </div>

   @if ($errors->any())
       <div class="alert alert-danger">
           <strong>Whoops!</strong> There were some problems with your input.<br><br>
           <ul>
               @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
               @endforeach
           </ul>
       </div>
   @endif

   <form action="{{ route('sales.store') }}" method="POST">
       @csrf

       <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
               <div class="form-group">
                   <strong>User:</strong>
                   <select name="user_id" class="form-control" required>
                       @foreach ($users as $user)
                           <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                       @endforeach
                   </select>
               </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
               <div class="form-group">
                   <strong>Cliente:</strong>
                   <select name="customer_id" class="form-control" required>
                       @foreach ($customers as $customer)
                           <option value="{{ $customer->id }}">{{ $customer->first_name }} {{ $customer->last_name }}</option>
                       @endforeach
                   </select>
               </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
               <div class="form-group">
                   <label for="total_amount"><strong>Total Amount:</strong></label>
                   <input type="text" name="total_amount" class="form-control" placeholder="Total Amount" value="0" readonly>
               </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
               <div class="form-group" id="product-details">
                   <div class="product-detail">
                       <label for="product_id">Producto:</label>
                       <select name="product_id[]" class="form-control" required>
                           @foreach($products as $product)
                               <option value="{{ $product->id }}">{{ $product->name }}</option>
                           @endforeach
                       </select>
                       <label for="quantity">Cantidad:</label>
                       <input type="number" name="quantity[]" class="form-control" min="1" required>
                       <label for="unit_price">Precio Unitario:</label>
                       <input type="number" name="unit_price[]" class="form-control" step="0.01" min="0" required>
                       <button type="button" class="btn btn-danger" onclick="removeProductDetail(this)">Eliminar</button>
                   </div>
               </div>
               <button type="button" class="btn btn-success" onclick="addProductDetail()">Agregar Producto</button>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12 text-center">
               <button type="submit" class="btn btn-primary">Submit</button>
           </div>
       </div>
   </form>
</div>

<script>
    function addProductDetail() {
        const productDetail = document.querySelector('.product-detail').cloneNode(true);
        productDetail.querySelector('input[name="quantity[]"]').value = '';
        productDetail.querySelector('input[name="unit_price[]"]').value = '';
        document.getElementById('product-details').appendChild(productDetail);
    }

    function removeProductDetail(button) {
        button.parentElement.remove();
    }
</script>
@endsection
