<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.student.index');
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
            /** Multi user add */
            if (isset($request->students) && count($request->students)) {
                foreach ($request->students as $key => $student) {
                    $student = new Student([
                        'sex' => isset($student['sex']) ? $student['sex'] : null,
                        'status' => isset($student['status']) ? $student['status'] : 0,
                        'class_id' => isset($student['class']) ? $student['class'] : null,
                        'identity_number' => isset($student['identityNumber']) ? $student['identityNumber'] : null,
                        'firstname' => isset($student['firstname']) ? $student['firstname'] : null,
                        'second_name' => isset($student['secondName']) ? $student['secondName'] : null,
                        'lastname' => isset($student['lastname']) ? $student['lastname'] : null,
                        'password' => isset($student['identityNumber']) ? $student['identityNumber'] : null
                    ]);
                    $student->save();
                }
                return 1;
            }
            $student = new Student([
                'sex' => isset($request->sex) ? $request->sex : null,
                'status' => isset($request->status) ? $request->status : 0,
                'class_id' => isset($request->classId) ? $request->classId : null,
                'identity_number' => isset($request->identityNumber) ? $request->identityNumber : null,
                'firstname' => isset($request->firstname) ? $request->firstname : null,
                'second_name' => isset($request->second_name) ? $request->second_name : null,
                'lastname' => isset($request->lastname) ? $request->lastname : null,
                'email' => isset($request->email) ? $request->email : null,
                'photo_url' => $request->hasFile('file') ? $this->uploadPhoto($request->file) : null,
                'password' => isset($request->identityNumber) ? Hash::make($request->identityNumber) : null
            ]);
            if ($student->save()) return 1;
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
            return Student::where('id', $id)->first();
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
            $student = Student::where('id', $request->studentId)->first();
            $student->sex = isset($request->sex) ? $request->sex : $student->sex;
            $student->status = isset($request->status) ? $request->status : $student->status;
            $student->identity_number = isset($request->identityNumber) ? $request->identityNumber : $student->identity_number;
            $student->firstname = isset($request->firstname) ? $request->firstname : $student->firstname;
            $student->second_name = isset($request->second_name) ? $request->second_name : $student->second_name;
            $student->lastname = isset($request->lastname) ? $request->lastname : $student->lastname;
            $student->email = isset($request->email) ? $request->email : $student->email;
            $student->photo_url = $request->hasFile('file') ? $this->uploadPhoto($request->file, $student->photo_url) : $student->photo_url;
            if ($student->update()) return 1;
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
            $student = Student::where('id', $request->studentId)->first();
            if ($student->delete()) return 1;
            return 0;
        } else {
            echo "Sadece AJAX sorgular için";
        }
    }

    /** Kullanıcı Datatable*/
    public function dataTables(Request $request)
    {
        if ($request->ajax()) {
            if (isset($request->search->value) && $request->search->value != '' && $request->search->value > 0) {
                $students = Student::where('identity_number', 'LIKE', '%' . strtolower($_GET['search']['value']) . '%')
                    ->orWhere('firstname', 'LIKE', '%' . strtolower($_GET['search']['value']) . '%')
                    ->orWhere('second_name', 'LIKE', '%' . strtolower($_GET['search']['value']) . '%')
                    ->orWhere('lastname', 'LIKE', '%' . strtolower($_GET['search']['value']) . '%')
                    ->orWhere('email', 'LIKE', '%' . strtolower($_GET['search']['value']) . '%')
                    ->orderBy('id')
                    ->get();
            } else {
                $students = Student::all();
            }

            $data = array();
            $i = 1;
            foreach ($students as $student) {
                $row = array();
                $row['id'] = $student->id;
                $row['status'] = $student->status;
                $row['orderNumber'] = $i++;
                $row['className'] = $student->class_id;
                $row['fullName'] = $student->firstname . ' ' . $student->second_name . ' ' . $student->lastname;
                $row['email'] = $student->email;
                $row['createdAt'] = $this->DD_MM_YYYY_rotate(substr(date($student->created_at), 0, 10)) . substr(date($student->created_at), 10);
                $row['edit'] = "";
                $data[] = $row;
            }
            return DataTables::of($data)
                ->editColumn('status', function ($data) {
                    return $data['status'] ? '<i class="fas fa-check-circle text-success"></i>' : '<i class="far fa-times-circle text-danger"></i>';
                })
                ->editColumn('edit', function ($data) {
                    return '
                        <a href="javascript:;" class="btn btn-sm btn-icon text-primary" onclick="edit_student(' . $data['id'] . ')"><i class="fas fa fa-user-edit text-warning"></i></a>
                        <a href="javascript:;" class="btn btn-sm btn-icon" id="user-delete" onclick="delete_student(' . $data['id'] . ')"><i class="fas fa fa-trash text-danger"></i></a>
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
