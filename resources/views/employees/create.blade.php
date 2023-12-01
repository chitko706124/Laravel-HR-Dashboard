@extends('layouts.app')

@section('title', 'Employee')

@section('employee', 'active')



@section('content')


    <div class=" card">
        <div class=" card-body">
            <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data"
                class="row g-3 justify-content-between">
                @csrf
                <div class=" col-12 col-md-6 ">
                    <div class=" form-group">
                        <input name="employee_id" type="text" class="form-control" placeholder="Employee ID" required />
                    </div>
                </div>

                <div class=" col-12 col-md-6 ">
                    <div class=" form-group">
                        <input name="name" type="text" placeholder="Name" class="form-control" required />
                    </div>
                </div>

                <div class=" col-12 col-md-6 ">
                    <div class="form-group">
                        <input name="phone" type="number" placeholder="Phone" class="form-control" required />
                    </div>
                </div>

                <div class=" col-12 col-md-6 ">
                    <div class="form-group">
                        <input name="email" value="{{ old('email') }}" placeholder="Email" type="email"
                            class="form-control " required />
                    </div>
                </div>

                <div class=" col-12 col-md-6 ">
                    <div class="form-group">
                        <input name="nrc_number" value="{{ old('nrc_number') }}" type="text" class="form-control"
                            placeholder="NRC Number" required />
                    </div>
                </div>


                <div class=" col-12 col-md-6 ">
                    <div class=" form-group">
                        <textarea class="form-control" name="address" id="textAreaExample" placeholder="Address" rows="1"></textarea>
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
                        <select name="department_id" class="form-select selectNoSearch" data-placeholder="Department">
                            <option></option>
                            @foreach ($departments as $department)
                                <option value="{{ rand(1, 2) }}">{{ $department->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class=" col-12 col-md-6 ">
                    <div class=" form-group">
                        <select class="form-select select-2" data-placeholder="Choose Role" multiple name="roles[]">
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class=" col-12 col-md-6 ">
                    <div class=" form-group">
                        <select name="gender" class="form-select selectNoSearch" data-placeholder="Gender">
                            <option></option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                </div>

                <div class=" col-12 col-md-6 ">
                    <div class="form-group">
                        <select name="is_present" class="form-select selectNoSearch" data-placeholder="Is Present?">
                            <option></option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>

                <div class=" col-12 col-md-6">
                    <div class="form-group">
                        <input class="form-control datepicker" name="birthday" placeholder="Birthday" type="text">
                    </div>
                </div>

                <div class=" col-12 col-md-6">
                    <div class="form-group">
                        <input class="form-control  datepicker" name="date_of_join" placeholder="Date Of Join"
                            type="text">
                    </div>
                </div>

                <div class=" col-12">
                    <div class="">
                        <label for="">Choose your profile</label>
                        <input class="form-control" id="profile_img" multiple name="profile_img" type="file">
                    </div>

                    <div class=" preview_img">

                    </div>
                </div>

                <div class=" d-flex justify-content-center my-4">
                    <div class="col-12 col-md-6 ">
                        <button type="submit" class=" btn btn-success btn-block">Create</button>
                    </div>
                </div>

            </form>

        </div>

    </div>
@endsection


@section('js')
    {{-- {!! JsValidator::formRequest('App\Http\Requests\StoreEmployee') !!} --}}

    <script>
        $(document).ready(function() {




            $('.birthday').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                "autoApply": false,
                'autoUpdateInput': false,
                "maxDate": moment(),
                "drops": "auto",
                // "cancelClass": "btn-group-primary",
                "opens": "center",
                "locale": {
                    "format": "YYYY-MM-DD",
                    // "cancelLabel": 'All'
                },
            });

            $('.date_of_join').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                "autoApply": false,
                'autoUpdateInput': false,
                "maxDate": moment(),
                "drops": "auto",
                // "cancelClass": "btn-group-primary",
                "opens": "center",
                "locale": {
                    "format": "YYYY-MM-DD",
                    // "cancelLabel": 'All'
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


            $('#profile_img').on('change', function() {
                var file_length = document.getElementById('profile_img').files.length;
                $('.preview_img').html('');

                for (var i = 0; i < file_length; i++) {
                    $('.preview_img').append(`<img src="${URL.createObjectURL(event.target.files[i])}"/>`)
                }
            })




        })
    </script>
@endsection
