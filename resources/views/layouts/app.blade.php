<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Character Checked APP</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

  </head>

  <body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand fw-bolder" href="/">CharCheck App</a>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-link active" aria-current="page" href="/">Home</a>
            </div>
          </div>
          <form class="d-flex" action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-outline-danger" type="submit">Logout</button>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
          </form>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    @yield('page-script')
  </body>
</html>
