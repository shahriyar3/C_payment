@extends('layouts.admin.app')

@section('content')
{{--    @livewireStyles--}}
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Payments</h1>

<livewire:styles />
<div>
    <livewire:table :config="App\Tables\PaymentsTable::class"/>
</div>
<livewire:scripts />

{{--    @livewireStyles--}}
@endsection
