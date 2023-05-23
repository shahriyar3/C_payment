<!-- Nav Item - Search Dropdown (Visible Only XS) -->
<li class="nav-item dropdown no-arrow d-sm-none">
    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-search fa-fw"></i>
    </a>
    <!-- Dropdown - Messages -->
    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
         aria-labelledby="searchDropdown">
        <form class="form-inline mr-auto w-100 navbar-search">
            <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small"
                       placeholder="بدنبال ..." aria-label="Search"
                       aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</li>

<!-- Nav Item - Alerts -->
<li class="nav-item dropdown no-arrow mx-1 ml-auto">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - Alerts -->

        <span id="notification-number"
              class="badge badge-danger badge-counter">@if(auth()->user()->unreadNotifications->count() > 0) {{ auth()->user()->unreadNotifications->count() }} @endif</span>

    </a>
    <!-- Dropdown - Alerts -->

    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
         aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">
            اعلان ها
        </h6>
        <div id="notification-content" >
            @if(auth()->user()->unreadNotifications->count() > 0)
                @foreach(auth()->user()->unreadNotifications as $notification)
                    <a href="javascript:" data-title="{{ $notification->id }}" onclick="mynotif(this, '{{ route('admin.notification.read', ['notification' => $notification->id]) }}')" class="dropdown-item d-flex align-items-center" data-url="{{ url($notification->data['link']) }}">
                        <div class="ml-3">
                            <div class="icon-circle bg-primary">
                                <i class="fas fa-file-alt text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div
                                class="small text-gray-500">{{ jdate('H:i:s - d F Y ', $notification->created_at->timestamp) }}</div>
                            <span class="font-weight-bold">{{ $notification->data['title'] }}</span>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
        <a class="dropdown-item text-center small text-gray-500" href="{{ route('admin.notification.list') }}">نمایش همه اعلان ها</a>
    </div>
</li>

<!-- Nav Item - Messages -->
{{--<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-envelope fa-fw"></i>
        <!-- Counter - Messages -->
        <span class="badge badge-danger badge-counter">0</span>
    </a>
</li>--}}

<div class="topbar-divider d-none d-sm-block"></div>

<!-- Nav Item - User Information -->
<li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="ml-2 d-none d-lg-inline text-gray-600 small">
                                {{ auth()->user()->name . ' ' . auth()->user()->family }}
                            </span>
        <img alt="image" class="img-profile rounded-circle"
             src="{{ asset('assets/admin/img/user.png') }}">
    </a>
    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
         aria-labelledby="userDropdown">
        <a class="dropdown-item" href="{{ route('admin.users.edit', ['user' => auth()->id()]) }}">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            پروفایل
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            خروج
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</li>
