
<html>
    <head>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ITLH') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/mdb.dark.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.admin.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-ZmpRS6a7F5LkK3l9L9TkBsjFxtJQ4sWQ1sflsNQSTwYjSauGJNkP47VhFv8E+yJj" crossorigin="anonymous">    
     <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body class="fixed-sn dark-mode">
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <div class="container-fluid">
            <a class="navbar-brand" href="#">
              <!-- <img src="{{ asset('img/logo.jpg') }}" alt="Your Logo">-->
            </a>
          </div>
        </nav>
        <div id="admin" class="d-flex justify-content-between">  
         
        <!-- Side Navigation -->
    <aside class="sidebar-fixed position-fixed position-fixed top-0 start-0 bottom-0 bg-dark" style="width: 15vw; height: 100vh; padding:10px 2px;margin:16px 2px;">
        <a class="logo-wrapper waves-effect">
            <img src="{{ asset('img/logo.jpg') }}" class="img-fluid" alt="Logo">
        </a>

        <div class="list-group list-group-flush">
            <a href="#" class="list-group-item active waves-effect">
                <i class="fas fa-chart-pie mr-3"></i>Dashboard
            </a>
            <a href="{{ url('/') }}" class="list-group-item waves-effect">
                <i class="fas fa-home mr-3"></i>Home</a>
             @if(auth()->user()->isAdmin())    
                <a href="{{ route('admin.users.index') }}" class="list-group-item waves-effect">
                    <i class="fas fa-users mr-3"></i>Users</a>
             @endif   
            <a href="{{ route('admin.courses.index') }}" class="list-group-item waves-effect">
                <i class="fas fa-table mr-3"></i>Courses</a>
            <a href="{{ route('admin.enrollments.index') }}" class="list-group-item waves-effect">
                <i class="fas fa-map mr-3"></i>Enrollment</a>
        </div>

        <div class="mt-4">
            <div class="dropdown-divider"></div>
                                                <a class="btn btn-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
        </div>
    </aside> 
        
            <main class="pt-3 mx-lg-5" style="width:80%">
        <div class="container-fluid mt-2 admin-container" >

            <!-- Content goes here -->
                 @yield('content')
        </div>
    </main>
    </div>
        <footer class="footer bg-dark text-white mt-5">
          <div class="container">
            <div class="row">
              <div class="col-md-12 text-center">
                <p>&copy; 2023 ITLH</p>
              </div>
            </div>
          </div>
        </footer>

    
        
                
        <script src="{{ asset('js/mdb.min.js') }}"></script>
    </body>
</html>
