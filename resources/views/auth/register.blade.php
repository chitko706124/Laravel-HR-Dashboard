@extends('layouts.app_plain')

@section('title', 'Register')


@section('content')
    <div class="container">
        {{-- <div class="row justify-content-center align-content-center" style="height: 100vh">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="row justify-content-center align-content-center" style="height: 100vh">
            <div class="col-md-6">
                <div class="card p-3">
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" class="row gap-3 needs-validation" novalidate>
                            @csrf
                            <div class=" col-12">
                                <h5>Register</h5>
                                <p class=" text-muted mb-0">Please fill the register form</p>
                            </div>

                            <div class=" col-12">
                                <div class="form-outline">
                                    <input name="name" value="{{ old('name') }}" type="text"
                                        class="form-control @error('name') is-invalid @enderror" id="validationCustom03"
                                        required />
                                    <label for="validationCustom03" class="form-label">Name</label>
                                    <div class="invalid-feedback">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class=" col-12">
                                <div class="form-outline">
                                    <input name="email" value="{{ old('email') }}" type="text"
                                        class="form-control @error('email') is-invalid @enderror" id="validationCustom03"
                                        required />
                                    <label for="validationCustom03" class="form-label">Email</label>
                                    <div class="invalid-feedback">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-outline">
                                    <input name="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" id="validationCustom05"
                                        required />
                                    <label for="validationCustom05" class="form-label">Password</label>
                                    <div class="invalid-feedback">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-outline">
                                    <input name="password_confirmation" type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        id="validationCustom05" required />
                                    <label for="validationCustom05" class="form-label">Confirm Password</label>
                                    <div class="invalid-feedback">
                                        @error('password_confirmation')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Submit form</button>
                            </div>
                        </form>
                    </div>
                    {{-- </form> --}}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
