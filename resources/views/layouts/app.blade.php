<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Binary City CRM</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{url('/')}}">Binary city CRM</a>
            <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav ml-auto d-md-none mt-4">
                    <li class="nav-item mb-2">
                            <a class="nav-link @if(Request::is('/')) active @endif fw-bold text-uppercase" href="{{route('index.dashboard')}}">
                            <span class="dot"></span>
                                DASHBOARD
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link @if(Request::is('binary-city')) active @endif fw-bold text-uppercase" href="{{ route('index.client') }}">
                                <span class="dot"></span>
                                CLIENTS
                            </a>

                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link @if(Request::is('binary-city/contacts')) active @endif fw-bold text-uppercase" href="{{url('/binary-city/contacts')}}">
                            <span class="dot"></span>
                                CONTACTS
                            </a>
                        </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            
            <nav id="sidebar" class="col-md-3 col-lg-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky mt-4">
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <a class="nav-link @if(Request::is('/')) active @endif fw-bold" href="{{url('/')}}">
                            <span class="dot"></span>
                                DASHBOARD
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                        
                            <a class="nav-link @if(Request::is('binary-city')) active @endif fw-bold" href="{{url('/binary-city')}}">
                            <span class="dot"></span>
                                CLIENTS
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link @if(Request::is('binary-city/contacts')) active @endif fw-bold" href="{{route('index.contact')}}">
                            <span class="dot"></span>
                                CONTACTS
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- /Sidebar -->

            <!-- Main Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 relative">
                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show message" role="alert">
                        <strong class="text-white">{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show message" role="alert">
                        <strong class="text-white">{{ session('error') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show message" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <strong class="text-white">{{ $error }}</strong>
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </ul>
                    </div>
                @endif
                
                @yield('content')

               
            </main>
            <!-- /Main Content -->
        </div>
    </div>

   
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="{{asset('assets/js/script.js')}}"></script>
</body>
</html>
