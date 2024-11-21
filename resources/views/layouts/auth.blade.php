<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Character Checked APP</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

  </head>

  <body>

    <div class="container mt-5 p-5">
        @yield('content')
    </div>

  </body>
</html>
