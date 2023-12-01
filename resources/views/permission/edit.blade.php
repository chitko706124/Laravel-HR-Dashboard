@extends('layouts.app')

@section('title', 'Permission Edit')

@section('permission', 'active')


@section('content')


    <div class=" card">
        <div class=" card-body">

            <form action="{{ route('permission.update', $permission->id) }}" method="POST" class="row g-3 justify-content-between">
                @csrf
                @method('PUT')

                <div class=" col-12">
                    <div class=" form-group">
                        <input name="name" type="text" class="form-control" value="{{ $permission->name }}"
                            placeholder="Permission Name" required />
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

    {!! JsValidator::formRequest('App\Http\Requests\UpdatePermission') !!}


@endsection
