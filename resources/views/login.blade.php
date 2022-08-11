@extends('Layout/isLogin')

@section('content')
    <section class="vh-100" style="background-color: #508bfc;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">
                    <img src="{{ asset('/img/logo.png') }}" alt="Darticles Logo" width="150" height="70" class="d-inline-block align-text-top mb-4">
                    <h3 class="mb-4">Login Admin</h3>
                    @if ( session()->get('flash_message') )
                        <div class="alert {{ session()->get('flash_type') }}" role="alert">
                            {{ session()->get('flash_message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <i>{{session()->get('error')}}</i>
                    <i>{{session()->get('message')}}</i>
                        <form method="POST" action={{route('login_action')}}>
                            @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control" name="username" placeholder="Username" value="{{old('username')}}">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" name="password" placeholder="Password" value="{{old('password')}}">
                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="submit">Login</button>
                            </div>
                        </form>
                        <div class="form-text mt-5">Don't have an admin's account? <a href="/register">Register here</a></div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>
@endsection