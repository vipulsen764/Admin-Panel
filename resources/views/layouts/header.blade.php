@if (session()->has('username'))
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Laravel Project</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        {{-- <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a> --}}
        <a class="nav-item nav-link active"  href="{{ route('companies') }}">Companies<span class="sr-only">(current)</span></a>
        <a class="nav-item nav-link"  href="{{ route('employees') }}">Employees<span class="sr-only">(current)</span></a>
        
      </div>
    </div>
        
    {{ session('username') }}
    <a class="nav-item nav-link" href="{{ route('logout') }}" style="float:right;">Logout</a>
  </nav>
  @endif
