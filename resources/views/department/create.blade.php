@extends('layouts.app')

@section('title', 'Employee')

@section('employee', 'active')



@section('content')


    <div class=" card">
        <div class=" card-body">
            <form action="{{ route('department.store') }}" method="POST" class="row g-3 justify-content-between">
                @csrf
                <div class=" col-12 ">
                    <div class=" form-group">
                        <input name="title" type="text" class="form-control" placeholder="Department Title" required />
                    </div>
                </div>

                <div class=" d-flex justify-content-center my-3">
                    <div class="col-12 col-md-6 ">
                        <button type="submit" class=" btn btn-success btn-block">Create</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection


@section('js')
    {!! JsValidator::formRequest('App\Http\Requests\StoreDepartment') !!}


@endsection
