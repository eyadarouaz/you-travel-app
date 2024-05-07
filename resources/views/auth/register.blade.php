@extends('layouts.app')
@section('title', 'Register')

@section('content')
<div class="py-5">
    <div class="container py-1">
        @include('response')
    </div>
    <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form  method="POST" action="{{ route('auth.signup') }}">
                    @csrf
                    @method('POST')

                    <div class="text-center mb-4 fs-1 fw-bold">
                        Sign Up
                    </div>
                    <!-- Email input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label">Email address</label>
                        <input type="email" class="form-control form-control-lg" name="email"
                            placeholder="Enter a valid email address" />
                    </div>

                    <!-- Password input -->
                    <div data-mdb-input-init class="form-outline mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control form-control-lg" name="password" placeholder="Enter password" />
                        <div class="form-text">Password must contain at least 8 characters.</div>
                    </div>

                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn button mb-3"
                            style="padding-left: 2.5rem; padding-right: 2.5rem;width:100%">Create an Account</button>
                        <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account ? <a href="/signin"
                                class="link-danger">Sign in</a></p>
                    </div>

                </form>
            </div>
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="{{ asset('assets/img/plan3.png') }}" class="img-fluid" alt="Sample image">
            </div>
        </div>
    </div>
</div>
@endsection