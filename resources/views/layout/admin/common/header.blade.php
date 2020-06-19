<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    <div class="topbar">

        <!-- LOGO -->
        <div class="topbar-left">
            <a href="{{url('index')}}" class="logo">
                <span>
                    <img src="{{url('resources/assets/admin/images/logo.jpg')}}" alt="" height="28">
                </span>
                <i>
                    <img src="{{url('resources/assets/admin/images/logo.jpg')}}" alt="" height="40" width="100">
                </i>
            </a>
        </div>

        <nav class="navbar-custom">

            <ul class="list-inline float-right mb-0">
                <li class="list-inline-item dropdown notification-list">
                    
                </li>

                <li class="list-inline-item dropdown notification-list">
                    <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <?php
                        $image = Auth::user()->image;
                    ?>
                    <img src="{{url('storage/app/'.$image)}}" alt="user" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5 class="text-overflow"><strong>{{ Auth::user()->name }}</strong> </h5>
                    </div>
                    
                    <div class="dropdown-item notify-item" aria-labelledby="navbarDropdown">

                        <a href = "{{url('admin/profile')}}"> My Profile</a>
                        
                    </div>

                    <div class="dropdown-item notify-item" aria-labelledby="navbarDropdown">
                        <a class="zmdi zmdi-powe" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </div>
                
            </li>

        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-light waves-effect">
                    <i class="dripicons-menu"></i>
                </button>
            </li>
        </ul>
    </nav>
</div>
<!-- Top Bar End -->