<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployee;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateEmployee;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if (
            !auth()
                ->user()
                ->can('view_employee')
        ) {
            abort(403);
        }
        if ($request->ajax()) {
            $data = User::with('department');
            return DataTables::of($data)
                ->addColumn('department_name', function ($each) {
                    return $each->department ? $each->department->title : '-';
                })
                ->filterColumn('department_name', function ($query, $keyword) {
                    $query->whereHas('department', function ($q1) use ($keyword) {
                        $q1->where('title', 'like', '%' . $keyword . '%');
                    });
                })
                ->addColumn('profile_img', function ($each) {
                    return $each->profile_img ? '<img src="' . $each->profile_img_path() . '" class="thumbnail_profile"/><p class="mb-0">' . $each->name . '</p>' : '<img src="https://ui-avatars.com/api/?background=fff&color=000&name=' . $each->name . '" class="thumbnail_profile"/><p class="mb-0">' . $each->name . '</p>';
                })
                ->editColumn('updated_at', function ($each) {
                    return $each->updated_at->format('Y/m/d H:i:s');
                })
                ->addColumn('role_name', function ($each) {
                    $output = '';
                    foreach ($each->roles as $role) {
                        $output .= '<span class="badge badge-pill badge-primary m-1">' . $role->name . '</span>';
                    }
                    return '<div class=" text-wrap">' . $output . '</div>';
                })
                ->addColumn('action', function ($each) {
                    $edit_icon = '';
                    $info_icon = '';
                    $delete_icon = '';

                    if (
                        auth()
                        ->user()
                        ->can('edit_employee')
                    ) {
                        $edit_icon = '<a href="' . route('employees.edit', $each->id) . '" class=" btn btn-info btn-icon btn-sm "><i class="bi bi-pencil"></i></a>';
                    }

                    if (
                        auth()
                        ->user()
                        ->can('view_employee')
                    ) {
                        $info_icon = '<a href="' . route('employees.show', $each->id) . '" class=" btn btn-success btn-icon btn-sm "><i class="bi bi-info-circle"></i></a>';
                    }

                    if (
                        auth()
                        ->user()
                        ->can('delete_employee')
                    ) {
                        $delete_icon = '<a href="#" class="btn btn-danger btn-icon btn-sm  delete" data-id="' . $each->id . '"><i class="bi bi-trash3-fill"></i></a>';
                    }

                    return '<div class="action-icon d-inline-block">' . $edit_icon . $info_icon . $delete_icon . '</div>';
                })
                ->rawColumns(['action', 'role_name', 'profile_img'])
                ->make(true);
        }
        return view('employees.index');
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
        $departments = Department::orderBy('title')->get();
        $roles = Role::all();
        return view('employees.create', compact('departments', 'roles'));
    }

    public function store(StoreEmployee $request)
    {
        $profile_img_name = null;
        if ($request->hasFile('profile_img')) {
            $profile_img_file = $request->file('profile_img');
            $profile_img_name = uniqid() . '_' . time() . '.' . $profile_img_file->getClientOriginalExtension();
            Storage::disk('public')->put('employee/' . $profile_img_name, file_get_contents($profile_img_file));
        }

        $emp = new User();
        $emp->employee_id = $request->employee_id;
        $emp->name = $request->name;
        $emp->phone = $request->phone;
        $emp->email = $request->email;
        $emp->nrc_number = $request->nrc_number;
        $emp->gender = $request->gender;
        $emp->birthday = $request->birthday;
        $emp->address = $request->address;
        $emp->department_id = $request->department_id;
        $emp->date_of_join = $request->date_of_join;
        $emp->is_present = $request->is_present;
        $emp->profile_img = $profile_img_name;
        $emp->pin_code = Hash::make($request->pin_code);
        $emp->password = Hash::make($request->password);
        $emp->save();

        $emp->syncRoles($request->roles);

        return redirect()
            ->route('employees.index')
            ->with('create', 'User is successfully created');
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
        $user = User::findOrFail($id);
        $old_roles = $user->roles->pluck('name')->toArray();
        $departments = Department::orderBy('title')->get();
        $roles = Role::all();

        return view('employees.edit', compact(['user', 'old_roles', 'roles', 'departments']));
    }

    public function update(UpdateEmployee $request, $id)
    {
        $emp = User::findOrFail($id);

        $profile_img_name = $emp->profile_img;
        if ($request->hasFile('profile_img')) {
            Storage::disk('public')->delete('employee' . $profile_img_name);

            $profile_img_file = $request->file('profile_img');
            $profile_img_name = uniqid() . '_' . time() . '.' . $profile_img_file->getClientOriginalExtension();
            Storage::disk('public')->put('employee/' . $profile_img_name, file_get_contents($profile_img_file));
        }
        $emp->employee_id = $request->employee_id;
        $emp->name = $request->name;
        $emp->phone = $request->phone;
        $emp->email = $request->email;
        $emp->nrc_number = $request->nrc_number;
        $emp->gender = $request->gender;
        $emp->birthday = $request->birthday;
        $emp->address = $request->address;
        $emp->department_id = $request->department_id;
        $emp->date_of_join = $request->date_of_join;
        $emp->is_present = $request->is_present;
        $emp->profile_img = $profile_img_name;
        $emp->pin_code = $request->pin_code ? Hash::make($request->pin_code) : $emp->pin_code;
        $emp->password = $request->password ? Hash::make($request->password) : $emp->password;
        $emp->update();

        $emp->syncRoles($request->roles);

        return redirect()
            ->route('employees.index')
            ->with('create', 'User is successfully updated');
    }

    public function show($id)
    {
        if (
            !auth()
                ->user()
                ->can('view_employee')
        ) {
            abort(403);
        }
        $user = User::findOrFail($id);
        return view('employees.detail', compact('user'));
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
        $user = User::findOrFail($id);
        $user->delete();
        return 'success';
    }
}
