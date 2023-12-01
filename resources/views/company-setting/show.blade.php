@extends('layouts.app')

@section('title', 'Company Setting')

@section('companySetting', 'active')


@section('content')

    <div class=" card shadow">
        <div class=" card-body">
            <div class=" row">
                <div class=" col-md-6 col-12 mb-3">
                    <p class=" mb-1">Company Name</p>
                    <p class=" text-muted mb-1">{{ $setting->company_name }}</p>
                </div>

                <div class=" col-md-6 col-12 mb-3">
                    <p class=" mb-1">Company Email</p>
                    <p class=" text-muted mb-1">{{ $setting->company_email }}</p>
                </div>

                <div class=" col-md-6 col-12 mb-3">
                    <p class=" mb-1">Company Phone</p>
                    <p class=" text-muted mb-1">{{ $setting->company_phone }}</p>
                </div>

                <div class=" col-md-6 col-12 mb-3">
                    <p class=" mb-1">Company Address</p>
                    <p class=" text-muted mb-1">{{ $setting->company_address }}</p>
                </div>

                <div class=" col-md-6 col-12 mb-3">
                    <p class=" mb-1">Office Start Time</p>
                    <p class=" text-muted mb-1">{{ $setting->office_start_time }}</p>
                </div>

                <div class=" col-md-6 col-12 mb-3">
                    <p class=" mb-1">Office End Time</p>
                    <p class=" text-muted mb-1">{{ $setting->office_end_time }}</p>
                </div>

                <div class=" col-md-6 col-12 mb-3">
                    <p class=" mb-1">Break Start Time</p>
                    <p class=" text-muted mb-1">{{ $setting->break_start_time }}</p>
                </div>

                <div class=" col-md-6 col-12 mb-3">
                    <p class=" mb-1">Break End Time</p>
                    <p class=" text-muted mb-1">{{ $setting->break_end_time }}</p>
                </div>

                @can('edit_company_setting')
                    <div>
                        <a href="{{ route('company-setting.edit', 1) }}" class=" btn btn-primary"><i class=" fas fa-edit"></i>
                            edit company setting</a>
                    </div>
                @endcan
            </div>
        </div>
    </div>

@endsection


@section('js')

@endsection
