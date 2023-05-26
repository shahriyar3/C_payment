@extends('layouts.admin.app')

@section('content')
    <div class="row col-md-12 mb-3">
        <a href="{{ route('upcadmin.payments.index') }}" class="m-1 btn btn-success btn-user">Payments</a>
    </div>

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
                <form action="{{ route('upcadmin.payments.update', $payment) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="page_title">User ID</label>
                        <input type="text" class="form-control" name="user_id" value="{{ $payment->user_id }}"
                               id="user_id">
                    </div>

                    <div class="form-group">
                        <label for="page_title">User Name</label>
                        <input type="text" class="form-control" name="user_name" value="{{ $payment->user_name }}"
                               id="user_name">
                    </div>

                    <div class="form-group">
                        <label for="page_title">Amount</label>
                        <input type="text" class="form-control" name="amount" value="{{ $payment->amount }}"
                               id="amount">
                    </div>


                    <div class="form-group">
                        <label for="category_id"></label><span class="text-danger"> *</span>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="failed" @selected('failed' == $payment->status)>failed</option>
                            <option value="pending" @selected('pending' == $payment->status)>pending</option>
                            <option value="success" @selected('success' == $payment->status)>success</option>
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
