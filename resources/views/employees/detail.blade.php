@extends('layouts.app')

@section('title', 'Employee Detail')

@section('employee', 'active')


@section('content')


    <div class=" card shadow">
        <div class=" card-body row ">

            <div class=" col-md-6">
                <div class=" text-center">
                    <img src="{{ $user->profile_img ? $user->profile_img_path() : "https://ui-avatars.com/api/?background=fff&color=000&name=$user->name" }}"
                        class="profile_img" alt="">
                    <div class=" py-3 px-2">
                        <h4>{{ $user->name }}</h4>
                        <p class=" text-muted mb-1">{{ $user->employee_id }} | <span
                                class=" text-theme">{{ $user->phone }}</span></p>
                        <p class=" text-muted mb-1"><span
                                class="badge badge-secondary text-black badge-pill">{{ $user->department ? $user->department->title : '-' }}</span>
                        </p>
                        <p class=" text-muted mb-1">
                            @foreach ($user->roles as $role)
                                <span class="badge badge-primary badge-pill">{{ $role->name }}</span>
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>

            <div class=" col-md-6 border-start">
                <div>
                    <p class=" mb-1"><strong>Phone</strong> : <span class=" text-muted">{{ $user->phone }}</span></p>
                    <p class=" mb-1"><strong>Email</strong> : <span class=" text-muted">{{ $user->email }}</span></p>
                    <p class=" mb-1"><strong>NRC Number</strong> : <span class=" text-muted">{{ $user->nrc_number }}</span>
                    </p>
                    <p class=" mb-1"><strong>Gender</strong> : <span
                            class=" text-muted">{{ Str::ucfirst($user->gender) }}</span></p>
                    <p class=" mb-1"><strong>Birthday</strong> : <span class=" text-muted">{{ $user->birthday }}</span>
                    </p>
                    <p class=" mb-1"><strong>Address</strong> : <span class=" text-muted">{{ $user->address }}</span></p>
                    <p class=" mb-1"><strong>Date Of Join</strong> : <span
                            class=" text-muted">{{ $user->date_of_join }}</span>
                    </p>
                    <p class=" mb-1"><strong>Is Present?</strong> : <span
                            class=" badge badge-pill {{ $user->is_present == 1 ? 'badge-success' : 'badge-danger' }}">{{ $user->is_present == 1 ? 'Yes' : 'No' }}</span>
                    </p>
                </div>
            </div>

        </div>

    </div>
@endsection


@section('js')

@endsection
