@extends('layouts.admin.app')

@section('content')
    {{--    @livewireStyles--}}
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Prices</h1>
    <div class="row col-md-12 mb-3">
        <a href="{{ route('upcadmin.prices.create') }}" class="m-1 btn btn-success btn-user">New</a>
    </div>

    <livewire:styles />
    <div>
        <livewire:table :config="App\Tables\PriceTable::class"/>
    </div>
    <livewire:scripts />

    {{--    @livewireStyles--}}
@endsection
