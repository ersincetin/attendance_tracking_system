<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Lang;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.setting.role.index');
    }

    /**
     * Display a permission of the resource.
     */
    public function permission($id = null): View
    {
        return view('admin.setting.role.permission.index')->with('id', $id);
    }

    /**
     * Update permissions the specified resource in storage.
     */
    public function permissionUpdate(Request $request)
    {
        if ($request->ajax()) {
            $role = Role::where('id', $request->roleId)->first();
            $role->permission = isset($request->permission) ? json_encode($request->permission) : $role->permission;
            if ($role->update()) return 1;
            return 0;
        } else {
            echo "Sadece AJAX sorgular için";
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $role = new Role([
                'status' => isset($request->status) ? $request->status : 0,
                'name' => isset($request->roleName) ? $request->roleName : null,
            ]);
            if ($role->save()) return 1;
            return 0;
        } else {
            echo "Sadece AJAX sorgular için";
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $id = isset($request->id) ? $request->id : 0;
            return Role::where('id', $id)->first();
        } else {
            echo "Sadece AJAX sorgular için";
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        if ($request->ajax()) {
            $role = Role::where('id', $request->roleId)->first();

            $role->status = isset($request->status) ? ($request->status) : $role->status;
            $role->name = isset($request->roleName) ? $request->roleName : $role->name;
            if ($role->update()) return 1;
            return 0;
        } else {
            echo "Sadece AJAX sorgular için";
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $user = Role::where('id', $_POST['roleId'])->first();
            if ($user->delete()) return 1;
            return 0;
        } else {
            echo "Sadece AJAX sorgular için";
        }
    }

    public function dataTables(Request $request)
    {
        if ($request->ajax()) {
            if (isset($request->search->value) && $request->search->value != '' && $request->search->value > 0) {
                $roles = Role::where('name', 'LIKE', '%' . strtolower($_GET['search']['value']) . '%')
                    ->orderBy('id')
                    ->get();
            } else {
                $roles = Role::all();
            }

            $data = array();
            $i = 1;
            foreach ($roles as $role) {
                $row = array();
                $row['id'] = $role->id;
                $row['status'] = $role->status;
                $row['orderNumber'] = $i++;
                $row['roleName'] = $role->name;
                $row['createdAt'] = $this->DD_MM_YYYY_rotate(substr(date($role->created_at), 0, 10)) . substr(date($role->created_at), 10);
                $row['edit'] = "";
                $data[] = $row;
            }
            return DataTables::of($data)
                ->editColumn('status', function ($data) {
                    return $data['status'] ? '<i class="fas fa-check-circle text-success"></i>' : '<i class="far fa-times-circle text-danger"></i>';
                })
                ->editColumn('edit', function ($data) {
                    return '
                        <a href="javascript:;" class="btn btn-sm btn-icon text-primary" onclick="edit_role(' . $data['id'] . ')" title="' . Lang::get('body.edit') . '"><i class="fas fa fa-edit text-warning"></i></a>
                        <a href="' . url('admin/settings/role/permission') . '/' . $data['id'] . '" class="btn btn-sm btn-icon" title="' . Lang::get('body.permission') . '"><i class="la la-bars text-info"></i></a>
                        <a href="javascript:;" class="btn btn-sm btn-icon" onclick="delete_role(' . $data['id'] . ')" title="' . Lang::get('body.delete') . '"><i class="fas fa fa-trash text-danger"></i></a>
                    ';
                })
                ->rawColumns(['status', 'edit'])
                ->make(true);
        } else {
            echo "Sadece AJAX sorgusunda kullanılır.";
        }
    }

    public static function DD_MM_YYYY_rotate($date)
    {
        $rotate = explode('-', $date);
        return $rotate[2] . '-' . $rotate[1] . '-' . $rotate[0];
    }
}
