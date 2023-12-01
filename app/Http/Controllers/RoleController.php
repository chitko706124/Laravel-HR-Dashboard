<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRole;
use App\Http\Requests\UpdateRole;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreDepartment;
use App\Http\Requests\UpdateDepartment;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if (
            !auth()
                ->user()
                ->can('view_role')
        ) {
            abort(403);
        }
        if ($request->ajax()) {
            $data = Role::query();
            return DataTables::of($data)
                ->addColumn('action', function ($each) {
                    $edit_icon = '';
                    $delete_icon = '';

                    if (
                        auth()
                        ->user()
                        ->can('view_role')
                    ) {
                        $edit_icon = '<a href="' . route('role.edit', $each->id) . '" class=" btn btn-info btn-icon btn-sm "><i class="bi bi-pencil"></i></a>';
                    }

                    if (
                        auth()
                        ->user()
                        ->can('view_role')
                    ) {
                        $delete_icon = '<a href="#" class="btn btn-danger btn-icon btn-sm  delete" data-id="' . $each->id . '"><i class="bi bi-trash3-fill"></i></a>';
                    }

                    return '<div class="action-icon d-inline-block">' . $edit_icon . $delete_icon . '</div>';
                })
                ->addColumn('permissions', function ($each) {
                    $output = '';
                    foreach ($each->permissions as $permission) {
                        $output .= '<span class="badge badge-pill badge-primary m-1">' . $permission->name . '</span>';
                    }
                    return '<div class=" text-wrap">' . $output . '</div>';
                })
                ->rawColumns(['action', 'permissions'])
                ->make(true);
        }
        return view('role.index');
    }

    public function create()
    {
        if (
            !auth()
                ->user()
                ->can('create_role')
        ) {
            abort(403);
        }
        $permissions = Permission::all();
        return view('role.create', compact('permissions'));
    }

    public function store(StoreRole $request)
    {
        // $role = new Role();
        // $role->name =  $request->name;
        // $role->save();
        // $permissionArr = $request->permissions;
        // $permissionArr[] = "view_profile";
        // $permissionArr[] = "edit_profile";

        $role = Role::create(['name' => $request->name]);
        $permissionArr = array_merge([$request->permissions], ['view_profile', 'edit_profile']);

        $role->givePermissionTo($permissionArr);

        return redirect()
            ->route('role.index')
            ->with('create', 'Role is successfully created');
    }

    public function edit($id)
    {
        if (
            !auth()
                ->user()
                ->can('edit_role')
        ) {
            abort(403);
        }
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $old_permission = $role
            ->getAllPermissions()
            ->pluck('id')
            ->toArray();
        return view('role.edit', compact(['role', 'permissions', 'old_permission']));
    }

    public function update(UpdateRole $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->update();

        $old_permissions = $role
            ->getAllPermissions()
            ->pluck('name')
            ->toArray();
        $role->revokePermissionTo($old_permissions);

        $permissionArr = array_merge([$request->permissions], ['view_profile', 'edit_profile']);
        $role->givePermissionTo($permissionArr);

        return redirect()
            ->route('role.index')
            ->with('create', 'Role is successfully updated');
    }

    public function destroy($id)
    {
        if (
            !auth()
                ->user()
                ->can('delete_role')
        ) {
            abort(403);
        }
        $role = Role::findOrFail($id);
        $role->delete();
        return 'success';
    }
}
