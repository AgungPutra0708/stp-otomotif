@extends('admin.layout.auth')
@section('title', 'Register')
@section('content-auth')
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="{{ asset('assets-admin/images/logo.png') }}" alt="STP OTOMOTIF" />
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="{{ route('register.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="au-input au-input--full" type="text" name="name" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="au-input au-input--full" type="email" name="email"
                                        placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password"
                                        placeholder="Password">
                                </div>
                                <button class="au-btn au-btn--block au-btn--blue m-b-20" type="submit">Sign Up</button>
                                <div class="register-link">
                                    <p>
                                        Already have account?
                                        <a href="{{ route('login') }}">Sign In</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
