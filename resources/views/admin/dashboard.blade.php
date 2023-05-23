@extends('layouts.admin.app')

@section('content')
    <div class="alert alert-primary border-0 mb-4 mt-5 px-md-5">
        <div class="position-relative">
            <div class="row align-items-center justify-content-between">
                <div class="col position-relative">
                    <h2 class="text-primary">به پنل مدیریت سایت استاد کوشان خوش آمدید!</h2>
                    <p class="text-gray-700">از طریق منوی سمت راست به تمام بخش های نرم افزار دسترسی خواهید داشت.
                        همچنین اعلانات جدید بالای
                        همه صفحات در دسترس است و در هرلحظه بصورت خودکار بروز می شود.</p>
                    <a class="btn btn-success" href="{{ route('upcadmin.prices.index') }}"> از وبلاگ شروع کن
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

