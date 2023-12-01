<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\StorePermission;
use App\Http\Requests\UpdatePermission;
use App\Http\Requests\StoreDepartment;
use App\Http\Requests\UpdateDepartment;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        if (
            !auth()
                ->user()
                ->can('view_permission')
        ) {
            abort(403);
        }
        if ($request->ajax()) {
            $data = Permission::query();
            return DataTables::of($data)
                ->addColumn('action', function ($each) {
                    $edit_icon = '';
                    $delete_icon = '';

                    if (
                        auth()
                            ->user()
                            ->can('edit_permission')
                    ) {
                        $edit_icon = '<a href="' . route('permission.edit', $each->id) . '" class=" btn btn-info btn-icon btn-sm "><i class="bi bi-pencil"></i></a>';
                    }

                    if (
                        auth()
                            ->user()
                            ->can('delete_permission')
                    ) {
                        $delete_icon = '<a href="#" class="btn btn-danger btn-icon btn-sm  delete" data-id="' . $each->id . '"><i class="bi bi-trash3-fill"></i></a>';
                    }

                    return '<div class="action-icon d-inline-block">' . $edit_icon . $delete_icon . '</div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('permission.index');
    }

    public function create()
    {
        if (
            !auth()
                ->user()
                ->can('create_employee')
        ) {
            abort(403);
        }
        return view('permission.create');
    }

    public function store(StorePermission $request)
    {
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->save();

        return redirect()
            ->route('permission.index')
            ->with('create', 'Permission is successfully created');
    }

    public function edit($id)
    {
        if (
            !auth()
                ->user()
                ->can('edit_employee')
        ) {
            abort(403);
        }
        $permission = Permission::findOrFail($id);
        return view('permission.edit', compact(['permission']));
    }

    public function update(UpdatePermission $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->name = $request->name;
        $permission->update();

        return redirect()
            ->route('permission.index')
            ->with('create', 'Permission is successfully updated');
    }

    public function destroy($id)
    {
        if (
            !auth()
                ->user()
                ->can('delete_employee')
        ) {
            abort(403);
        }
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return 'success';
    }
}
