@extends('base')

@section('content')
    <h1 class="text-center">Create new Order</h1>
    <form action="{{ route('orders_store') }}" method="POST" id="order">
        @csrf

        <div class="form-row">
            <div class="col-md-6 mb-3">
                <input type="text" name="client_full_name" class="form-control" placeholder="Full Name" required maxlength="80">
            </div>
            <div class="col-md-6 mb-3" id="">
                <input type="tel" name="client_phone" class="form-control" pattern="\+[0-9]{1}\([0-9]{3}\)[0-9]{3}-[0-9]{4}" placeholder="+7(123)456-7890" required>
            </div>
        </div>
        <div class="text-center">
            <h3 class="text-success d-none">Success</h3>
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </form>

    <h2 class="text-center mt-5">Clients List</h2>
    <table class="table table-hover table-bordered" id="clients" data-url="{{ route('clients_index') }}">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Full Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Created At</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <h2 class="text-center">Orders List</h2>
    <table class="table table-hover table-bordered" id="orders" data-url="{{ route('orders_index') }}">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Client ID</th>
                <th scope="col">Tariff ID</th>
                <th scope="col">Address</th>
                <th scope="col">Delivery Date</th>
                <th scope="col">Created At</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection