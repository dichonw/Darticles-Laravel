<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ARTICLES - DICHO LARAVEL</title>
    <link rel="icon" href="{{ asset('/img/icon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg pb-2 mb-2 px-4" style="background-color: #508bfc;">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="/dashboard">
            <img src="{{ asset('/img/logo2.png') }}" alt="Darticles Logo" width="110" height="52" class="d-inline-block align-text-top"></a>
            @if ( session()->get('token') != NULL )
                <div class="d-flex text-light">
                    <p class="pt-2">Wellcome, <b>{{session()->get('username')}}</b></p>
                    <form method="POST" action={{ route('dashboard_logout') }}>
                        @csrf
                        <input name="token" type="hidden" value={{session()->get('token')}} />
                        <button class="btn btn-danger ms-2">Logout</button>
                    </form>
                </div> 
            @endif  
        </div>
    </nav>
    {{-- our content --}}
    <div>
        @yield('content')
    </div>
    {{-- end of our content --}}
    <footer>
        <div class="container-fluid bg-dark text-light text-center py-2 mt-2" style="position: absolute; bottom:0;">
            &copy; Dicho-Laravel Made With Love
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</body>
</html>