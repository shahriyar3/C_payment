@extends('layouts.admin.app')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="col-md-8">
                <div id="result">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if($errors->any())
                        <ul class="alert alert-danger">
                            @foreach($errors->all() as $key => $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <form action="{{ route('upcadmin.store_active_payment') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="active_payment"></label><span class="text-danger">select active payment *</span>
                        <select name="active_payment" id="active_payment" class="form-control">
                            <option value="KENZO" @selected('KENZO' == $active_payment)>kenzo</option>
                            <option value="IRGATE" @selected('IRGATE' == $active_payment)>irgate</option>
                            <option value="VODA" @selected('VODA' == $active_payment)>voda</option>
                        </select>
                    </div>

                    <hr>

                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
