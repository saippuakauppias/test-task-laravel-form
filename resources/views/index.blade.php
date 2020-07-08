@extends('base')

@section('content')
    <h1 class="text-center">Create new Order</h1>
    <form action="{{ route('orders_store') }}" method="POST" id="order">
        @csrf

        <div class="form-row">
            <div class="col-md-6 mb-3" id="base_client_full_name">
                <input type="text" name="client_full_name" class="form-control" placeholder="Full Name" required maxlength="80">
            </div>
            <div class="col-md-6 mb-3" id="base_client_phone">
                <input type="tel" name="client_phone" class="form-control" pattern="\+[0-9]{1}\([0-9]{3}\)[0-9]{3}-[0-9]{4}" placeholder="+7(123)456-7890" required>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-12 mb-3" id="base_address">
                <textarea class="form-control" name="address" placeholder="Address" required></textarea>
            </div>
        </div>

        <div class="form-row">
            <legend class="col-form-label col-sm-1 pt-0">Tariffs:</legend>
            <div class="col-md-5 mb-3" id="base_tariff_id">
                @foreach ($tariffs as $tariff)
                    <div class="form-check">
                        <input class="form-check-input order-tariffs" type="radio" name="tariff_id" id="tariff_{{ $tariff->id }}" value="{{ $tariff->id }}" data-weekdays="{{ $tariff->week_days }}" required>
                        <label class="form-check-label" for="tariff_{{ $tariff->id }}">
                            [ID: {{ $tariff->id }} | Price: {{ $tariff->price }}] {{ $tariff->name }}
                        </label>
                    </div>
                @endforeach
            </div>

            <legend class="col-form-label col-sm-1 pt-0">Delivery:</legend>
            <div class="col-md-5 mb-3" id="base_delivery_date">
                @foreach ($week as $date)
                    <div class="form-check">
                        <input class="form-check-input order-delivery-dates" type="radio" name="delivery_date" id="day_{{ $date['day'] }}" value="{{ $date['date'] }}" data-weekday="{{ $date['day'] }}" required disabled>
                        <label class="form-check-label" for="day_{{ $date['day'] }}">
                            {{ $date['date_human'] }}, {{ $date['day'] }}
                        </label>
                    </div>
                @endforeach
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

    <hr class="m-5">
    <h2 class="text-center">Advanced #1</h2>
    <table class="table table-hover table-bordered" id="adv1" data-url="{{ route('advanced_show1') }}">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Full Name</th>
                <th scope="col">Count1 (< 1000)</th>
                <th scope="col">Count2 (> 1000)</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection