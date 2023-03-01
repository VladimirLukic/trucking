<nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Fifth navbar example">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">{{ config('app.name') }}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample05">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        @if(Auth::user())
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/home">Home</a>
        </li>
         {{-- @if (Auth::user()->role === 'admin')
            <li class="nav-item dropdown ">
              <a class="nav-link dropdown-toggle active" href="#" data-bs-toggle="dropdown" aria-expanded="false">{{ __('Users') }}</a>
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item" href="/users">
                    {{ __('All') }}
                  </a>
                </li>
                <li><a class="dropdown-item" href="/users/role/{{'admin'}}">Admins</a></li>
                <li><a class="dropdown-item" href="/users/role/{{'assistant'}}">Assistants</a></li>
                <li><a class="dropdown-item" href="/users/role/{{'doctor'}}">Doctors</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="/users/create">{{ __('Add user') }}</a>
            </li>
          @endif --}}
          {{-- @if (Auth::user()->role === 'assistant' or Auth::user()->role === 'doctor')
          <li class="nav-item dropdown ">
            <a class="nav-link dropdown-toggle active" href="#" data-bs-toggle="dropdown" aria-expanded="false">{{ __('Patients') }}</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/patients">List</a></li>
              <li><a class="dropdown-item" href="/patients/create">New patient</a></li>
            </ul>
          </li>
        <li class="nav-item dropdown ">
          <a class="nav-link dropdown-toggle active" href="#" data-bs-toggle="dropdown" aria-expanded="false">{{ __('Records') }}</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/records">List</a></li>
            <li><a class="dropdown-item" href="/records/create">New record</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown ">
          <a class="nav-link dropdown-toggle active" href="#" data-bs-toggle="dropdown" aria-expanded="false">{{ __('Conditions') }}</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/conditions">List</a></li>
            <li><a class="dropdown-item" href="/conditions/create">New condition</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown ">
          <a class="nav-link dropdown-toggle active" href="#" data-bs-toggle="dropdown" aria-expanded="false">{{ __('Medicines') }}</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/medicines">List</a></li>
            <li><a class="dropdown-item" href="/medicines/create">New medicine</a></li>
          </ul>
        </li>
        @endif --}}
        </li>
        @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        {{-- @else --}}

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }}</a>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
            </li>
          </ul>
        </li>
        @endguest
      </ul>
      <form action="{{ $data['search'] }}" method="GET" id="find" role="search">
        @csrf
       <input name="search" class="form-control" type="search" placeholder="Search" aria-label="Search">
      </form>
      @endif
    </div>
  </div>
</nav>
