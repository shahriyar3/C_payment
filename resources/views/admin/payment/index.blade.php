@extends('layouts.admin.app')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Payments</h1>

    <livewire:table :config="App\Tables\PaymentsTable::class"/>

@endsection
