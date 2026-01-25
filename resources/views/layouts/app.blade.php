<!DOCTYPE html>
<html>
<head>
    <title>3D Printing Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">3D Printing</a>
  <div class="collapse navbar-collapse">
    <ul class="navbar-nav ms-auto">
      @auth
      <li class="nav-item"><a class="nav-link" href="{{ route('orders.index') }}">Orders</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Logout</a></li>
      @else
      <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
      @endauth
    </ul>
  </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>
