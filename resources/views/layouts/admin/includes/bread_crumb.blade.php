<ol class="breadcrumb mt-4 mb-4">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">خانه</a>
    </li>

    <li class="breadcrumb-item active">
        <a href="{{ $url }}">{{ $title }}</a>
    </li>

    <li class="breadcrumb-item active">
        {{ $current }}
    </li>
</ol>
