<nav class="navbar navbar-light bg-white border-bottom navbar-expand">
    <div class="container-lg d-flex justify-content-between px-lg-5">
        <a class="navbar-brand logo-font" href="{{ url('/') }}">M4L4Gram</a>
        <ul class="navbar-nav d-flex align-items-center">
            @guest
                <li class="nav-item"><a class="btn btn-primary px-3 font-weight-bold" href="{{ route('login') }}">Log in</a></li>
                <li class="nav-item"><a class="btn text-primary px-3 font-weight-bold" href="{{ route('register') }}">Sign Up</a></li>
            @else
                <li class="nav-item"><a class="btn" href="{{route('profiles.show', Auth::user()->id)}}">{{ Auth::user()->username }}</a></li>
                <li class="nav-item">
                    <a class="btn" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Log out</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </li>
            @endguest
        </ul>
    </div>
</nav>