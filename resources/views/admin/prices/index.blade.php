@extends('layouts.admin.app')

@section('content')
    {{--    @livewireStyles--}}
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Prices</h1>
    <div class="row col-md-12 mb-3">
        <a href="{{ route('upcadmin.prices.create') }}" class="m-1 btn btn-success btn-user">New</a>
    </div>






    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Price List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">

                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0"
                                   role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                <tr role="row">
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Name: activate to sort column descending" style="width: 271px;">
                                        #
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Position: activate to sort column ascending" style="width: 404px;">
                                        price
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Position: activate to sort column ascending" style="width: 404px;">
                                        delete
                                    </th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th rowspan="1" colspan="1">Name</th>
                                    <th rowspan="1" colspan="1">Position</th>
                                    <th rowspan="1" colspan="1">Salary</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($prices as $price)
                                    <tr class="odd">
                                        <td class="sorting_1">{{ $price->id }}</td>
                                        <td>{{ $price->price }}</td>
                                        <td><a href="{{ route('upcadmin.remove', $price) }}"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
