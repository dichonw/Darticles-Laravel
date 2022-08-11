@extends('Layout/isLogin')

@section('content')
    <section class="vh-100" style="background-color: #508bfc;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <img src="{{ asset('/img/logo.png') }}" alt="Darticles Logo" width="150" height="70" class="d-inline-block align-text-top mb-4">
                            <h3 class="mb-4">Register New Admin</h3>
                            @if (count($errors) > 0)
                                <div class="alert alert-danger alert-dismissible fade show pb-0" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}
                                        @endforeach
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </ul>
                                </div>
                            @endif
                            <form method="POST" action={{route('register_action')}}>
                                @csrf
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="username" placeholder="Username" value="{{old('username')}}">
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" name="password" placeholder="Password" value="{{old('password')}}">
                                </div>
                                 <div class="mb-3">
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Password Confirmation" value="{{old('password_confirmation')}}">
                                </div>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary" type="submit">Register</button>
                                </div>
                            </form>
                            <div class="form-text mt-5">Already have an admin's account? <a href="/login">Login here</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection