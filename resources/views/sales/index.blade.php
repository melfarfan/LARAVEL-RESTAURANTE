@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Sales</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('sales.create') }}"> Create New Sale</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>User</th>
            <th>Total Amount</th>
            <th width="280px">Action</th>
        </tr>

        @php $i = 0; @endphp <!-- Añadir esta línea para definir la variable $i -->

        @foreach ($sales as $sale)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $sale->user->first_name }} {{ $sale->user->last_name }}</td>
            <td>{{ $sale->total_amount }}</td>
            <td>
                <form action="{{ route('sales.destroy', $sale->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('sales.show', $sale->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('sales.edit', $sale->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {!! $sales->links() !!}
</div>
@endsection
