<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view('admin/user/index');
    }

    /** Display a listing of the Teachers*/
    public function teachers(): View
    {
        return view('admin.user.teacher.index');
    }

    /** Display a listing of the Student Affairs*/
    public function student_affairs(): View
    {
        return view('admin.user.student_affairs.index');
    }

    public function profile(): View
    {
        return view('admin.profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            /** Multi user add */
            if (isset($request->users) && count($request->users)) {
                foreach ($request->users as $key => $user) {
                    $user = new User([
                        'sex' => isset($user['sex']) ? $user['sex'] : null,
                        'status' => isset($user['status']) ? $user['status'] : 0,
                        'role_id' => isset($user['userType']) ? $user['userType'] : null,
                        'class_id' => isset($user['class']) ? $user['class'] : null,
                        'username' => isset($user['username']) ? $user['username'] : null,
                        'identity_number' => isset($user['identityNumber']) ? $user['identityNumber'] : null,
                        'firstname' => isset($user['firstname']) ? $user['firstname'] : null,
                        'second_name' => isset($user['second_name']) ? $user['second_name'] : null,
                        'lastname' => isset($user['lastname']) ? $user['lastname'] : null,
                        'email' => isset($user['email']) ? $user['email'] : null,
                        'password' => isset($user['identityNumber']) ? $user['identityNumber'] : null
                    ]);
                    $user->save();
                }
                return 1;
            }
            $user = new User([
                'sex' => isset($request->sex) ? $request->sex : null,
                'status' => isset($request->status) ? $request->status : 0,
                'role_id' => isset($request->userType) ? $request->userType : null,
                'username' => isset($request->username) ? $request->username : null,
                'identity_number' => isset($request->identityNumber) ? $request->identityNumber : null,
                'firstname' => isset($request->firstname) ? $request->firstname : null,
                'second_name' => isset($request->second_name) ? $request->second_name : null,
                'lastname' => isset($request->lastname) ? $request->lastname : null,
                'email' => isset($request->email) ? $request->email : null,
                'photo_url' => $request->hasFile('file') ? $this->uploadPhoto($request->file) : null,
                'password' => isset($request->password) ? Hash::make($request->password) : null
            ]);
            if ($user->save()) return 1;
            return 0;
        } else {
            echo "Sadece AJAX sorgular için";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $id = isset($_POST['id']) ? $_POST : 0;
            return User::where('id', $id)->first();
        } else {
            echo "Sadece AJAX sorgular için";
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->ajax()) {
            $user = User::where('id', $request->userId)->first();

            $user->sex = isset($request->sex) ? $request->sex : $user->sex;
            $user->status = isset($request->status) ? $request->status : $user->status;
            $user->role_id = isset($request->userType) ? $request->userType : $user->role_id;
            $user->username = isset($request->username) ? $request->username : $user->username;
            $user->identity_number = isset($request->identityNumber) ? $request->identityNumber : $user->identity_number;
            $user->firstname = isset($request->firstname) ? $request->firstname : $user->firstname;
            $user->second_name = isset($request->second_name) ? $request->second_name : $user->second_name;
            $user->lastname = isset($request->lastname) ? $request->lastname : $user->lastname;
            $user->email = isset($request->email) ? $request->email : $user->email;
            $user->photo_url = $request->hasFile('file') ? $this->uploadPhoto($request->file, $user->photo_url) : $user->photo_url;
            $user->password = isset($request->password) ? Hash::make($request->password) : $user->password;
            if ($user->update()) return 1;
            return 0;
        } else {
            echo "Sadece AJAX sorgular için";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $user = User::where('id', $_POST['userId'])->first();
            if ($user->delete()) return 1;
            return 0;
        } else {
            echo "Sadece AJAX sorgular için";
        }
    }

    /** Kullanıcı Datatable*/
    public function dataTables(Request $request)
    {
        if ($request->ajax()) {
            switch ($request->userType) {
                case 'user':
                    $userType = [2, 3];
                    break;
                case 'teacher':
                    $userType = [4];
                    break;
                case 'student-affairs':
                    $userType = [5];
                    break;
                case 'student':
                    $userType = [6];
                    break;
                default:
                    return 'Kullanıcı Tipi Seçmeniz Gerekmektedir.';
            }
            if (isset($request->search->value) && $request->search->value != '' && $request->search->value > 0) {
                $users = User::select('users.*', 'roles.name as role_name')
                    ->whereIn('role_id', $userType)
                    ->where('username', 'LIKE', '%' . strtolower($_GET['search']['value']) . '%')
                    ->orWhere('firstname', 'LIKE', '%' . strtolower($_GET['search']['value']) . '%')
                    ->orWhere('second_name', 'LIKE', '%' . strtolower($_GET['search']['value']) . '%')
                    ->orWhere('lastname', 'LIKE', '%' . strtolower($_GET['search']['value']) . '%')
                    ->orWhere('email', 'LIKE', '%' . strtolower($_GET['search']['value']) . '%')
                    ->join('roles', 'users.role_id', 'roles.id')
                    ->orderBy('id')
                    ->get();
            } else {
                $users = User::select('users.*', 'roles.name as role_name')->whereIn('role_id', $userType)->join('roles', 'users.role_id', 'roles.id')->get();
            }

            $data = array();
            $i = 1;
            foreach ($users as $user) {
                $row = array();
                $row['id'] = $user->id;
                $row['orderNumber'] = $i++;
                $row['status'] = $user->status;
                $row['roleName'] = $user->role_name;
                $row['roleId'] = $user->role_id;
                $row['assignedClasses'] = $user->assigning_class;
                $row['username'] = $user->username;
                $row['fullName'] = $user->firstname . ' ' . $user->second_name . ' ' . $user->lastname;
                $row['email'] = $user->email;
                $row['createdAt'] = $this->DD_MM_YYYY_rotate(substr(date($user->created_at), 0, 10)) . substr(date($user->created_at), 10);
                $row['edit'] = "";
                $data[] = $row;
            }
            return DataTables::of($data)
                ->editColumn('status', function ($data) {
                    return $data['status'] ? '<i class="fas fa-check-circle text-success"></i>' : '<i class="far fa-times-circle text-danger"></i>';
                })
                ->editColumn('assignedClasses', function ($data) {
                    $classIdList = !is_null($data['assignedClasses']) ? json_decode($data['assignedClasses'], true) : null;
                    $list = array();
                    $html = '';
                    if (!is_null($classIdList)) {
                        foreach ($classIdList as $key => $value)
                            array_push($list, $key);
                    }
                    if (count($list) > 0) {
                        $classes = Classes::whereIn('id', $list)
                            ->orderBy('id')
                            ->get();
                        if (count($classes) > 0) {
                            foreach ($classes as $class) {
                                $html .= '<button class="btn font-weight-bold btn-light-primary mr-2">' . $class->name . '</button>';
                            }
                        }
                    }
                    return $html;
                })
                ->editColumn('edit', function ($data) {
                    if ($data['roleId'] == 4) {
                        return '
                        <a href="javascript:;" class="btn btn-sm btn-icon text-primary" onclick="edit_user(' . $data['id'] . ')" title="' . Lang::get('body.edit') . '"><i class="fas fa fa-user-edit text-warning"></i></a>
                        <a href="javascript:;" class="btn btn-sm btn-icon text-primary" onclick="assigning_class(' . $data['id'] . ')" title="' . Lang::get('body.assigning_class') . '"><i class="fas fa fa-compass text-info"></i></a>
                        <a href="javascript:;" class="btn btn-sm btn-icon" onclick="delete_user(' . $data['id'] . ')" title="' . Lang::get('body.delete') . '"><i class="fas fa fa-trash text-danger"></i></a>
                    ';
                    }
                    return '
                        <a href="javascript:;" class="btn btn-sm btn-icon text-primary" onclick="edit_user(' . $data['id'] . ')" title="' . Lang::get('body.edit') . '"><i class="fas fa fa-user-edit text-warning"></i></a>
                        <a href="javascript:;" class="btn btn-sm btn-icon" onclick="delete_user(' . $data['id'] . ')" title="' . Lang::get('body.delete') . '"><i class="fas fa fa-trash text-danger"></i></a>
                    ';
                })
                ->rawColumns(['status', 'assignedClasses', 'edit'])
                ->make(true);
        } else {
            echo "Sadece AJAX sorgusunda kullanılır.";
        }
    }


    public function setAssigningClass(Request $request)
    {
        if ($request->ajax()) {
            $user = User::where('id', $request->userId)->first();
            $user->assigning_class = isset($request->classList) ? $request->classList : null;
            if ($user->update()) return 1;
            return 0;
        } else {
            echo "Sadece AJAX sorgular için";
        }
    }

    /**Date rotate function*/
    public static function DD_MM_YYYY_rotate($date)
    {
        $rotate = explode('-', $date);
        return $rotate[2] . '-' . $rotate[1] . '-' . $rotate[0];
    }

    public static function uploadPhoto($file = null, $oldFile = null)
    {
        if ($file != null) {
            $fileName = 'user_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "media/photos/users/";
            $oldFile = $path . ($oldFile != null ? $oldFile : $fileName);
            if ($file->move(public_path($path), $fileName)) {
                switch ($file->getClientOriginalExtension()) {
                    case "jpeg":
                        $image = imagecreatefromjpeg(public_path($path . $fileName));
                        break;
                    case "jpg":
                        $image = imagecreatefromjpeg(public_path($path . $fileName));
                        break;
                }
                $sizes = getimagesize(public_path($path . $fileName));
                $imageRate = 400 / $sizes[0];
                $imageHeight = $imageRate * $sizes[1];
                $newImage = imagecreatetruecolor('400', $imageHeight);
                imagecopyresampled($newImage, $image, 0, 0, 0, 0, '400', $imageHeight, $sizes[0], $sizes[1]);
                $fileName = 'user_' . uniqid() . '.' . $file->getClientOriginalExtension();

                switch ($file->getClientOriginalExtension()) {
                    case "jpeg" || "jpg":
                        imagejpeg($newImage, public_path($path . $fileName), 100);
                        break;
                    case "png":
                        imagepng($newImage, public_path($path . $fileName), 100);
                        break;
                }
                chmod(public_path($path . $fileName), 0755);
                if (file_exists($oldFile)) {
                    @unlink(public_path($oldFile));
                }
            }
            return $fileName;
        }
        return null;
    }
}
