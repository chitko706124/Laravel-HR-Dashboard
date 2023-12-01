@extends('layouts.app')

@section('title', 'NINJA HR')

@section('home', 'active')


@section('content')

    <div class=" card shadow">
        <div class=" card-body row ">
            <div class=" col-12">
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
        </div>

    </div>
@endsection


@section('js')

@endsection
