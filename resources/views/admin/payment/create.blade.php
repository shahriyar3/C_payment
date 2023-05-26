@extends('layouts.admin.app')

@section('title')
    پست جدید
@endsection

@section('content')
    <div class="row col-md-12 mb-3">
        <a href="{{ route('admin.blog.index') }}" class="m-1 btn btn-success btn-user">بازگشت به لیست</a>
        @if(url()->previous() != url()->current())
            <a href="{{ url()->previous() }}" class="m-1 btn btn-secondary btn-user">صفحه قبلی</a>
        @endif
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
                <form action="{{ route('admin.blog.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="blog" readonly>
                    <div class="form-group">
                        <label for="page_title">عنوان صفحه (برای سئو)</label>
                        <input type="text" class="form-control" name="page_title" value="{{ old('page_title') }}"
                               id="page_title">
                    </div>
                    <div class="form-group">
                        <label for="page_description">توضیح صفحه (برای سئو)</label>
                        <textarea class="form-control" name="page_description"
                                  id="page_description">{{ old('page_description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="title">عنوان </label><span class="text-danger"> *</span>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}" id="title">
                    </div>

                    <div class="form-group">
                        <label for="category_id">انتخاب دسته بندی</label><span class="text-danger"> *</span>
                        <select name="category_id" id="category_id" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tags">کلمات کلیدی</label><span class="text-danger"> *</span>
                        <input type="text" class="form-control tag-input-basic" name="tags" id="tags"
                               placeholder="بعد از هر کلمه اینتر بزنید" value="{{ old('tags') ?? 'سروش کوشان|آموزش دف|آموزش تنبک|آموزش کاخن|آموزش موسیقی کودک|آموزش موسیقی|نوازنده دف|نوازنده تمبک|نوازنده کاخن|نوازنده سازهای کوبه ای|پرکاشنیست|دفنوازی|تمبک نوازی|کاخن نوازی|تک نوازی|گروه نوازی|ساز|آکادمی سروش کوشان|درامز|کوزه|جیمبی|داربوکا|ضرب وتمپو' }}">
                    </div>

                    <div class="form-group">
                        <label for="editor">متن</label><span class="text-danger">*</span>
                        <textarea id="editor" name="description"
                                  class="form-control">{!! old('description') !!}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">عکس</label>
                        <input type="file" class="form-control" id="image" name="image" >
                    </div>

                    <div class="form-group">
                        <label for="video">ویدئو</label>
                        <input type="file" class="form-control" id="video" name="video" >
                    </div>

                    <div class="form-group">
                        <label for="language">زبان </label>
                        <select name="language" id="language" class="form-control custom-select">
                            <option @if(old('language') == 'fa') selected @endif value="fa">فارسی</option>
                            <option @if(old('language') == 'en') selected @endif value="en">انگلیسی</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <!-- Default switch -->
                        <span>وضعیت انتشار فایل</span>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" @if(old('published_at') != 'off') checked
                                   @endif class="custom-control-input" id="published_at" name="published_at">
                            <label class="custom-control-label" for="published_at"></label>
                        </div>
                    </div>

                    <hr>

                    <button type="submit" class="btn btn-primary">
                        ثبت
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/tagsinput.css') }}">
@endpush
@push('js')
    <script src="{{ asset('assets/admin/js/typehead.js') }}"></script>
    <script src="{{ asset('assets/admin/js/tagsinput.js') }}"></script>
    <script src="{{ asset('assets/admin/ckeditor/ckeditor.js') }}"></script>
    <script>

        CKEDITOR.replace('editor', {
            filebrowserUploadUrl: "{{route('admin.editor.upload_local', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>
    <script>
        $(function () {
            // Instantiate the Bloodhound suggestion engine
            var tags = new Bloodhound({
                datumTokenizer: function (d) {
                    return Bloodhound.tokenizers.whitespace(d.tag);
                },
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                local: [
                    {tag: 'dog'},
                    {tag: 'cat'},
                    {tag: 'fish'},
                    {tag: 'catfish'},
                    {tag: 'dogfish'}
                ]
            });
            tags.initialize();
            // Set up an on-screen console for the demo
            var screenConsole = $('#console');
            // Write callback data to the screen when tags are added or removed in demo inputs
            var logCallbackDataToConsole = function (added, removed) {
                screenConsole.append('Tag Data: ' + (this.val() || null) + ', Added: ' + added + ', Removed: ' + removed + '\n');
            };

            $('.tag-input-basic').tagInput({
                onTagDataChanged: logCallbackDataToConsole
            });
            $('#results a[rel="external"]').attr('target', '_blank');
        });
    </script>
@endpush
