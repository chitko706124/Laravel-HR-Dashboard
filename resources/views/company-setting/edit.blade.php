@extends('layouts.app')

@section('title', 'Company Setting')

@section('companySetting', 'active')


@section('content')

    <div class=" card">
        <div class=" card-body">
            <div class=" row">
                <form action="{{ route('company-setting.update', 1) }}" method="POST" class="row g-3 justify-content-between">
                    @csrf
                    @method('PUT')
                    <div class=" col-12 col-md-6 ">
                        <div class=" form-group">
                            <label for="">Company Name</label>
                            <input name="company_name" type="text" class="form-control"
                                value="{{ $setting->company_name }}" placeholder="Company Name" required />
                        </div>
                    </div>

                    <div class=" col-12 col-md-6 ">
                        <div class=" form-group">
                            <label for="">Company Email</label>
                            <input name="company_email" type="text" class="form-control"
                                value="{{ $setting->company_email }}" placeholder="Company Email" required />
                        </div>
                    </div>

                    <div class=" col-12 col-md-6 ">
                        <div class=" form-group">
                            <label for="">Company Phone</label>
                            <input name="company_phone" type="text" class="form-control"
                                value="{{ $setting->company_phone }}" placeholder="Company Phone" required />
                        </div>
                    </div>

                    <div class=" col-12 col-md-6 ">
                        <div class=" form-group">
                            <label for="">Company Address</label>
                            <textarea class="form-control" name="company_address" id="textAreaExample" placeholder="Address" rows="1">{{ $setting->company_address }}</textarea>
                        </div>
                    </div>

                    <div class=" col-12 col-md-6">
                        <div class="form-group">
                            <label for="">Office Start Time</label>
                            <input class="form-control flatpickr selector" name="office_start_time"
                                value="{{ $setting->office_start_time }}" type="text">
                        </div>
                    </div>

                    <div class=" col-12 col-md-6">
                        <div class="form-group">
                            <label for="">Office End Time</label>
                            <input class="form-control flatpickr selector" name="office_end_time"
                                value="{{ $setting->office_end_time }}" type="text">
                        </div>
                    </div>

                    <div class=" col-12 col-md-6">
                        <div class="form-group">
                            <label for="">Break Start Time</label>
                            <input class="form-control flatpickr selector" name="break_start_time"
                                value="{{ $setting->break_start_time }}" type="text">
                        </div>
                    </div>

                    <div class=" col-12 col-md-6">
                        <div class="form-group">
                            <label for="">Break End Time</label>
                            <input class="form-control flatpickr selector" name="break_end_time"
                                value="{{ $setting->break_end_time }}" type="text">
                        </div>
                    </div>


                    <div class=" d-flex justify-content-center my-4">
                        <div class="col-12 col-md-6 ">
                            <button type="submit" class=" btn btn-success btn-block">Update</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection


@section('js')

    {!! JsValidator::formRequest('App\Http\Requests\UpdateCompanySetting') !!}

    <script>
        $(document).ready(function() {
            $(".selector").flatpickr({
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true
            });
        })
    </script>
@endsection
