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
                <form action="{{ route('upcadmin.url_slect_upload') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="file">File</label>
                        <input type="file" class="form-control" name="file"
                               id="file">
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
