<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{route('home')}}">EBOOKS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                @if(Auth::guard('web')->check())
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('ebooks.index')}}">Ebooks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('categories.index')}}">Categories</a>
                </li>
                @endif
            </ul>
            <ul class="navbar-nav ml-auto">
                @if(Auth::guard('web')->check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{Auth::user()->name}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('dashboard')}}">Dashboard</a>
                            <a class="dropdown-item" href="{{url('/user/profile')}}">Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/login')}}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/register')}}">Sign Up</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
    <div class="wrapper">
        <h1>E-Books Library</h1>
    </div>
</header>

