<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDepartment;
use App\Http\Requests\UpdateDepartment;
use Yajra\DataTables\Facades\DataTables;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        if (
            !auth()
                ->user()
                ->can('view_department')
        ) {
            abort(403);
        }

        if ($request->ajax()) {
            $data = Department::query();
            return DataTables::of($data)
                ->addColumn('action', function ($each) {
                    $edit_icon = '';
                    $delete_icon = '';

                    if (
                        auth()
                            ->user()
                            ->can('edit_department')
                    ) {
                        $edit_icon = '<a href="' . route('department.edit', $each->id) . '" class=" btn btn-info btn-icon btn-sm "><i class="bi bi-pencil"></i></a>';
                    }
                    if (
                        auth()
                            ->user()
                            ->can('delete_department')
                    ) {
                        $delete_icon = '<a href="#" class="btn btn-danger btn-icon btn-sm  delete" data-id="' . $each->id . '"><i class="bi bi-trash3-fill"></i></a>';
                    }

                    return '<div class="action-icon d-inline-block">' . $edit_icon . $delete_icon . '</div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('department.index');
    }

    public function create()
    {
        if (
            !auth()
                ->user()
                ->can('create_department')
        ) {
            abort(403);
        }
        return view('department.create');
    }

    public function store(StoreDepartment $request)
    {
        $department = new Department();
        $department->title = $request->title;
        $department->save();

        return redirect()
            ->route('department.index')
            ->with('create', 'Department is successfully created');
    }

    public function edit($id)
    {
        if (
            !auth()
                ->user()
                ->can('edit_department')
        ) {
            abort(403);
        }
        $department = Department::findOrFail($id);
        return view('department.edit', compact(['department']));
    }

    public function update(UpdateDepartment $request, $id)
    {
        $department = Department::findOrFail($id);
        $department->title = $request->title;
        $department->update();

        return redirect()
            ->route('department.index')
            ->with('create', 'Department is successfully updated');
    }

    public function destroy($id)
    {
        if (
            !auth()
                ->user()
                ->can('delete_department')
        ) {
            abort(403);
        }
        $department = Department::findOrFail($id);
        $department->delete();
        return 'success';
    }
}
