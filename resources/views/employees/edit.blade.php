@extends('layouts.app')

@section('title', 'Employee Edit')

@section('employee', 'active')


@section('content')


    <div class=" card">
        <div class=" card-body">
            <h1>{{ $user->name }}</h1>

            <form action="{{ route('employees.update', $user->id) }}" method="POST" enctype="multipart/form-data"
                class="row g-3 justify-content-between">
                @csrf
                @method('PUT')
                <div class=" col-12 col-md-6 ">
                    <div class=" form-group">
                        <input name="employee_id" type="text" class="form-control" value="{{ $user->employee_id }}"
                            placeholder="Employee ID" required />
                    </div>
                </div>

                <div class=" col-12 col-md-6 ">
                    <div class=" form-group">
                        <input name="name" type="text" placeholder="Name" value="{{ $user->name }}"
                            class="form-control" required />
                    </div>
                </div>

                <div class=" col-12 col-md-6 ">
                    <div class="form-group">
                        <input name="phone" type="number" value="{{ $user->phone }}" placeholder="Phone"
                            class="form-control" required />
                    </div>
                </div>

                <div class=" col-12 col-md-6 ">
                    <div class="form-group">
                        <input name="email" value="{{ $user->email }}" placeholder="Email" type="email"
                            class="form-control " required />
                    </div>
                </div>

                <div class=" col-12 col-md-6 ">
                    <div class="form-group">
                        <input name="nrc_number" value="{{ $user->nrc_number }}" type="text" class="form-control"
                            placeholder="NRC Number" required />
                    </div>
                </div>


                <div class=" col-12 col-md-6 ">
                    <div class=" form-group">
                        <textarea class="form-control" name="address" id="textAreaExample" placeholder="Address" rows="1">{{ $user->address }}</textarea>
                    </div>
                </div>

                <div class=" col-12 col-md-6 ">
                    <div class="form-group">
                        <input name="pin_code" type="number" placeholder="PIN Code" class="form-control " required />
                    </div>
                </div>

                <div class=" col-12 col-md-6 ">
                    <div class="form-group">
                        <input name="password" type="password" placeholder="Password" class="form-control " required />
                    </div>
                </div>


                <div class=" col-12 col-md-6 ">
                    <div class=" form-group">
                        <select name="department_id" class="form-select">
                            <option value="" disabled>Department</option>
                            @foreach ($departments as $department)
                                <option value="{{ rand(1, 2) }}" @if ($department->id == $user->department_id) selected @endif>
                                    {{ $department->title }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>

                <div class=" col-12 col-md-6 ">
                    <div class=" form-group">
                        <select class="form-select select-2" data-placeholder="Choose Role" multiple name="roles[]">
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}" @if (in_array($role->name, $old_roles)) selected @endif>
                                    {{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class=" col-12 col-md-6 ">
                    <div class=" form-group">
                        <select name="gender" class="form-select">
                            <option value="" disabled>Gender</option>
                            <option value="male" @if ($user->gender == 'male') selected @endif>Male</option>
                            <option value="female" @if ($user->gender == 'female') selected @endif>Female</option>
                        </select>

                    </div>
                </div>

                <div class=" col-12 col-md-6 ">
                    <div class="form-group">
                        <select name="is_present" class="form-select">
                            <option value="" disabled>Is Present?</option>
                            <option value="1" @if ($user->is_present == 1) selected @endif>Yes</option>
                            <option value="0" @if ($user->is_present == 0) selected @endif>No</option>
                        </select>
                    </div>
                </div>

                <div class=" col-12 col-md-6">
                    <div class="form-group">
                        <input class="form-control datepicker" name="birthday" placeholder="Birthday"
                            value="{{ $user->birthday }}" type="text">
                        {{-- <input type="text" name="birthday" placeholder="Birthday"> --}}
                    </div>
                </div>

                <div class=" col-12 col-md-6">
                    <div class="form-group">
                        <input class="form-control datepicker" name="date_of_join" placeholder="Date Of Join"
                            value="{{ $user->date_of_join }}" type="text">
                        {{-- <input type="text" name="date_of_join" placeholder="Date Of Join"> --}}

                    </div>
                </div>

                <div class=" col-12">
                    <div class="">
                        <label for="">Choose your profile</label>
                        <input class="form-control" id="profile_img" name="profile_img" type="file">
                    </div>

                    <div class=" preview_img">
                        <img src="{{ $user->profile_img_path() }}" alt="">
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
@endsection


@section('js')

    {!! JsValidator::formRequest('App\Http\Requests\UpdateEmployee') !!}

    <script>
        $(document).ready(function() {

            $('#profile_img').on('change', function() {
                var file_length = document.getElementById('profile_img').files.length;
                $('.preview_img').html('');

                for (var i = 0; i < file_length; i++) {
                    $('.preview_img').append(`<img src="${URL.createObjectURL(event.target.files[i])}"/>`)
                }
            })

            // var Datepicker = (function() {
            //     // Variables
            //     var $datepicker = $('.datepicker-yyyymmdd');

            //     // Methods
            //     function init($this) {
            //         var options = {
            //             disableTouchKeyboard: true,
            //             autoclose: true,
            //             format: "YYYY-MM-DD"
            //         };
            //         $this.datepicker(options);
            //     }

            //     // Events
            //     if ($datepicker.length) {
            //         $datepicker.each(function() {
            //             init($(this));
            //         });
            //     }
            // })();

            // $('.datepicker').datepicker({
            //     dateFormat: 'yy-mm-dd' // Set the desired format here
            // });


            $('.birthday').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                "autoApply": false,
                'autoUpdateInput': false,
                "maxDate": moment(),
                "drops": "auto",
                "opens": "center",
                "locale": {
                    "format": "YYYY-MM-DD",
                },
            });

            $('.date_of_join').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                "autoApply": false,
                'autoUpdateInput': false,
                "maxDate": moment(),
                "drops": "auto",
                "opens": "center",
                "locale": {
                    "format": "YYYY-MM-DD",
                },
            });


            $('.birthday').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD'));
            });

            $('.birthday').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val(null);
            });

            $('.date_of_join').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD'));
            });

            $('.date_of_join').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val(null);
            });



        })
    </script>
@endsection
