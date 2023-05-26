@extends('layouts.admin.app')

@section('content')
    <div class="alert alert-primary border-0 mb-4 mt-5 px-md-5">
        <div class="position-relative">
            <div class="row align-items-center justify-content-between">
                <div class="col position-relative">
                    <h2 class="text-primary">Welcome To Dashboard</h2>

                    <a class="btn btn-success" href="{{ route('upcadmin.payments.index') }}">Go To Payments >>>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-arrow-left mr-1">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 5 12 12 19 19"></polyline>
                        </svg>
                    </a>
                </div>
                <div class="col d-none d-md-block text-left pt-3">
                    <img alt="img" class="img-fluid mt-n5"
                         src="{{ asset('assets/admin/img/drawkit-content-man-alt.svg') }}" style="max-width: 25rem;">
                </div>
            </div>
        </div>
    </div>

@endsection

@section('title')
    داشبورد
@endsection

