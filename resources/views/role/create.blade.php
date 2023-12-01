@extends('layouts.app')

@section('title', 'Role Create')

@section('role', 'active')



@section('content')

    <div class=" card">
        <div class=" card-body">
            <form action="{{ route('role.store') }}" method="POST" class="row g-3 justify-content-between">
                @csrf
                <div class=" col-12 ">
                    <div class=" form-group">
                        <input name="name" type="text" class="form-control" placeholder="Role Name" required />
                    </div>
                </div>

                <div class=" row">
                    <label for="">Permissions</label>
                    @foreach ($permissions as $permission)
                        <div class=" col-md-3 col-6">
                            <div class="custom-control custom-checkbox mb-3">
                                <input name="permissions[]" value="{{ $permission->name }}"
                                    @if (in_array($permission->id, [2, 3])) disabled checked @endif class="custom-control-input"
                                    id="{{ $permission->id }}" type="checkbox">
                                <label class="custom-control-label"
                                    for="{{ $permission->id }}">{{ $permission->name }}</label>
                            </div>
                        </div>
                    @endforeach
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
    {!! JsValidator::formRequest('App\Http\Requests\StoreRole') !!}


@endsection
