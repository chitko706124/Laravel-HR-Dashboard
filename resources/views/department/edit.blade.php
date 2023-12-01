@extends('layouts.app')

@section('title', 'Employee Edit')

@section('employee', 'active')


@section('content')


    <div class=" card">
        <div class=" card-body">
            <form action="{{ route('department.update', $department->id) }}" method="POST"
                class="row g-3 justify-content-between">
                @csrf
                @method('PUT')

                <div class=" col-12">
                    <div class=" form-group">
                        <input name="title" type="text" class="form-control" value="{{ $department->title }}"
                            placeholder="Department Title" required />
                    </div>
                </div>

                <div class=" d-flex justify-content-center my-3">
                    <div class="col-12 col-md-6 ">
                        <button type="submit" class=" btn btn-success btn-block">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
@endsection


@section('js')

    {!! JsValidator::formRequest('App\Http\Requests\UpdateDepartment') !!}


@endsection
