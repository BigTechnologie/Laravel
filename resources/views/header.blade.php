<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<div class="container-fluid">
		<a class="navbar-brand" href="#">Blog Laravel</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarScroll">
			<ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="{{ route('welcome')}}">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="{{ route('blog.categories')}}">Categories</a>
				</li>


			</ul>
			{{-- <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form> --}}

			@auth
        <form action="{{ route('logout') }}" method="POST">
          @csrf 
                @method('DELETE')
          <button class="btn btn-danger me-1">
            Logout
          </button>
        </form>
        @if (auth()->user()->roles && in_array('ROLE_ADMIN', json_decode(auth()->user()->roles)))
        <a href="{{ route('admin.post.index') }}" class="btn btn-success">
          Admin
        </a>
       @endif
      @else
      <a href="{{ route('login') }}" class="btn btn-warning me-1">
        Login
      </a>
      <a href="{{ route('register') }}" class="btn btn-success">
        Register
      </a>
  @endauth
		</div>
	</div>
</nav>

