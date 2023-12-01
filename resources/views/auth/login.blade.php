@extends('layouts.app_plain')

@section('title', 'Login')

@section('style')

    <style>

    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center align-content-center" style="height: 100vh">
            <div class="col-md-6">
                <div class=" text-center">
                    <img src="{{ asset('image/ninja.png') }}" class=" mb-2 " width="75px" alt="Ninja">
                </div>
                <div class="card">
                    <div class="card-body">
                        <form style="height: 290.219px" method="POST" action="{{ route('login') }}"
                            class="row gap-3 needs-validation" novalidate>
                            @csrf
                            <div class=" col-12 text-center">
                                <h5>Login</h5>
                                <p class=" text-muted mb-0">Please fill the login form</p>
                            </div>
                            <div class=" col-12">
                                <div class="form-outline">
                                    <input id="phone" name="phone" value="{{ old('phone') }}" type="text"
                                        class="form-control @error('phone') is-invalid @enderror" id="validationCustom03"
                                        required />
                                    <label for="validationCustom03" class="form-label">Phone or Email</label>
                                    <div class="invalid-feedback">
                                        @error('phone')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class=" col-12">
                                <!-- Pills navs -->
                                <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a data-mdb-pill-init class="nav-link active" id="ex3-tab-1" href="#ex3-pills-1"
                                            role="tab" aria-controls="ex3-pills-1" aria-selected="true">Password</a>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <a data-mdb-pill-init class="nav-link" id="ex3-tab-3" href="#ex3-pills-3"
                                            role="tab" aria-controls="ex3-pills-3" aria-selected="false">Biometric
                                        </a>
                                    </li>
                                </ul>
                                <!-- Pills navs -->

                                <!-- Pills content -->
                                <div class="tab-content" id="ex2-content">
                                    <div class="tab-pane fade show active" id="ex3-pills-1" role="tabpanel"
                                        aria-labelledby="ex3-tab-1">
                                        <div class="col-12 password mb-3">
                                            <div class="form-outline">
                                                <input name="password" type="password"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    id="validationCustom05" required />
                                                <label for="validationCustom05" class="form-label">Password</label>
                                                <div class="invalid-feedback">
                                                    @error('password')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 form">
                                            <button class="btn btn-theme btn-block" type="submit">Login</button>
                                        </div>
                                    </div>

                                    <div style="height: 87.81px" class="tab-pane fade text-center" id="ex3-pills-3"
                                        role="tabpanel" aria-labelledby="ex3-tab-3">
                                        <button id="login-form" class=" biometric-old-data mt-3 btn btn-sm border"><i
                                                style="font-size: 32px;color:#4CD195" class=" fas fa-fingerprint m-1"></i>
                                        </button>
                                    </div>

                                </div>
                                <!-- Pills content -->

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.nav-link').on('click', function() {
                $('.nav-link').removeClass('active');
                $(this).addClass('active');

                var target = $(this).attr('href');
                $('.tab-pane').removeClass('show active');
                $(target).addClass('show active');
            });

            $('#login-form').click(function(e) {
                e.preventDefault()

                var inputValue = $('#phone').val();
                var authenticationData = {};

                if (inputValue.includes('@')) {
                    authenticationData.email = inputValue;
                } else {
                    authenticationData.phone = inputValue;
                }

                new WebAuthn().login(authenticationData)
                    .then(function(response) {
                        window.location.replace('/');
                    })
                    .catch(error => alert('Something went wrong, try again!'));
            })
        });
    </script>

@endsection


{{-- <div class=" col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div> --}}
