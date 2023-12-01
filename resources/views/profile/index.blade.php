@extends('layouts.app')

@section('title', 'Profile')

@section('employee', 'active')


@section('content')


    <div class=" card shadow mb-3">
        <div class=" card-body">
            <div class=" row">
                <div class=" col-md-6">
                    <div class=" text-center">
                        <img src="{{ $authUser->profile_img ? $authUser->profile_img_path() : "https://ui-avatars.com/api/?background=fff&color=000&name=$authUser->name" }}"
                            class="profile_img" alt="">
                        <div class=" py-3 px-2">
                            <h4>{{ $authUser->name }}</h4>
                            <p class=" text-muted mb-1">{{ $authUser->employee_id }} | <span
                                    class=" text-theme">{{ $authUser->phone }}</span></p>
                            <p class=" text-muted mb-1"><span
                                    class="badge badge-secondary text-black badge-pill">{{ $authUser->department ? $authUser->department->title : '-' }}</span>
                            </p>

                            <p class=" text-muted mb-1">
                                @foreach ($authUser->roles as $role)
                                    <span class="badge badge-primary badge-pill">{{ $role->name }}</span>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>

                <div class=" col-md-6 border-start">
                    <div>
                        <p class=" mb-1"><strong>Phone</strong> : <span class=" text-muted">{{ $authUser->phone }}</span>
                        </p>
                        <p class=" mb-1"><strong>Email</strong> : <span class=" text-muted">{{ $authUser->email }}</span>
                        </p>
                        <p class=" mb-1"><strong>NRC Number</strong> : <span
                                class=" text-muted">{{ $authUser->nrc_number }}</span>
                        </p>
                        <p class=" mb-1"><strong>Gender</strong> : <span
                                class=" text-muted">{{ Str::ucfirst($authUser->gender) }}</span></p>
                        <p class=" mb-1"><strong>Birthday</strong> : <span
                                class=" text-muted">{{ $authUser->birthday }}</span>
                        </p>
                        <p class=" mb-1"><strong>Address</strong> : <span
                                class=" text-muted">{{ $authUser->address }}</span>
                        </p>
                        <p class=" mb-1"><strong>Date Of Join</strong> : <span
                                class=" text-muted">{{ $authUser->date_of_join }}</span>
                        </p>
                        <p class=" mb-1"><strong>Is Present?</strong> : <span
                                class=" badge badge-pill {{ $authUser->is_present == 1 ? 'badge-success' : 'badge-danger' }}">{{ $authUser->is_present == 1 ? 'Yes' : 'No' }}</span>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class=" card shadow mb-3">
        <div class=" card-body">
            <h5>Biometric Authentication</h5>

            <span class=" biometric-data-render-code"></span>

            <button class=" register-form btn btn-sm border py-2"><i style="font-size: 32px;position:relative"
                    class=" fas fa-fingerprint m-1 "></i>
                <p class=" mb-0" style="font-size: 10px">Add Biometric</p>
            </button>

        </div>
    </div>

    <div class=" card mt-3 shadow">
        <div class=" card-body">
            <a id="logout-btn" class=" btn btn-block btn-theme" href="{{ route('logout') }}">
                <i class=" fas fa-sign-out-alt"></i> Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>



@endsection


@section('js')
    <script>
        $(document).ready(function() {

            biometricData();

            function biometricData() {
                $.ajax({
                    url: 'profile/biometric-data',
                    type: 'GET',
                    success: function(res) {
                        $('.biometric-data-render-code').html(res);
                    }
                })
            }

            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            $('#logout-btn').click(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to logout!",
                    icon: 'warning',
                    reverseButtons: true,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#logout-form').submit();
                    }
                })
            })

            $(document).on('click', '.biometric-delete-btn', function(e) {
                e.preventDefault();

                var id = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete!",
                    icon: 'warning',
                    reverseButtons: true,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `profile/biometric-data/${id}`,
                            type: 'DELETE'
                        }).done(function(res) {
                            biometricData();
                        })
                    }
                })

            });

            $('.register-form').click(function(event) {
                // register(event);
                event.preventDefault();

                new WebAuthn().register()
                    .then(function(response) {
                        Toast.fire({
                            icon: "success",
                            title: "Biometric data is successfully created"
                        });
                        biometricData();
                    })
                    .catch(error => console.log(error))
            })
        })
    </script>
@endsection
