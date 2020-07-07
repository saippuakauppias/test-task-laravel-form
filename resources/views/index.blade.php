@extends('base')

@section('content')
    <h1 class="text-center">Clients List</h1>
    <table class="table table-hover table-bordered" id="clients">
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

@endsection