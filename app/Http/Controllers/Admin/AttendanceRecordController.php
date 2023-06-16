<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttendanceRecord;
use App\Models\AttendanceRecordInput;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class AttendanceRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.attendance_record.index');
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
            $userId = 33;
            $record = new AttendanceRecord([
                'user_id' => $userId,
                'class_id' => $request->classId,
                'course_id' => $request->courseId,
                'semester_id' => $request->semesterId,
            ]);
            if ($record->save()) $recordId = $record->id;

            $data = array();

            foreach ($request->inputs as $key => $value) {
                /** $key => studentId*/
                foreach ($value as $weekKey => $weekValue) {
                    /** $weekKey => weekId*/
                    foreach ($weekValue as $dayKey => $dayVale) {
                        /** $dayKey => dayId*/
                        array_push($data, [
                            'record_id' => $recordId,
                            'day' => $dayKey,
                            'input' => intval($dayVale),
                            'created_at' => date("Y-m-d H:i:s")
                        ]);
                    }
                }
            }
            //echo json_encode($data);exit();
            if (AttendanceRecordInput::insert($data)) return 1;
            return 0;

        } else {
            echo "Sadece AJAX sorgusunda kullanılır.";
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $record = AttendanceRecord::where('id', $request->recordId)->first();
            if ($record->delete()){
                $inputs = AttendanceRecordInput::where('record_id',$request->recordId)->each(function ($input,$key){
                    $input->delete();
                });
                return 1;
            }
            return 0;
        } else {
            echo "Sadece AJAX sorgular için";
        }
    }

    public function dataTables(Request $request)
    {
        if ($request->ajax()) {
            if (isset($request->search->value) && $request->search->value != '' && $request->search->value > 0) {
                $records = AttendanceRecord::select('attendance_records.*', 'users.username as username', 'classes.name as classname', 'semesters.name as semestername')
                    ->join('users', 'users.id', 'attendance_records.user_id')
                    ->join('classes', 'classes.id', 'attendance_records.class_id')
                    ->join('semesters', 'semesters.id', 'attendance_records.semester_id')
                    ->orderBy('id')
                    ->get();
            } else {
                $records = AttendanceRecord::select('attendance_records.*', 'users.username as username', 'classes.name as classname', 'semesters.name as semestername')
                    ->join('users', 'users.id', 'attendance_records.user_id')
                    ->join('classes', 'classes.id', 'attendance_records.class_id')
                    ->join('semesters', 'semesters.id', 'attendance_records.semester_id')
                    ->orderBy('id')
                    ->get();
            }

            $data = array();
            $i = 1;
            foreach ($records as $record) {
                $row = array();
                $row['id'] = $record->id;
                $row['orderNumber'] = $i++;
                $row['user'] = $record->username;
                $row['class'] = $record->classname;
                $row['semester'] = $record->semestername;
                $row['recordName'] = $record->name;
                $row['createdAt'] = $this->DD_MM_YYYY_rotate(substr(date($record->created_at), 0, 10)) . substr(date($record->created_at), 10);
                $row['edit'] = "";
                $data[] = $row;
            }
            return DataTables::of($data)
                ->editColumn('edit', function ($data) {
                    return '
                        <a href="javascript:;" class="btn btn-sm btn-icon text-primary" onclick="edit_attendance_record(' . $data['id'] . ')" title="' . Lang::get('body.edit') . '"><i class="fas fa fa-edit text-warning"></i></a>
                        <a href="javascript:;" class="btn btn-sm btn-icon" onclick="delete_attendance_record(' . $data['id'] . ')" title="' . Lang::get('body.delete') . '"><i class="fas fa fa-trash text-danger"></i></a>
                    ';
                })
                ->rawColumns(['edit'])
                ->make(true);
        } else {
            echo "Sadece AJAX sorgusunda kullanılır.";
        }
    }


    public function getFilteredClassDataTable(Request $request)
    {
        if ($request->ajax()) {
            if (isset($request->search->value) && $request->search->value != '' && $request->search->value > 0) {
                $students = Student::where('class_id', $request->classId)
                    ->orderBy('id')
                    ->get();
            } else {
                $students = Student::where('class_id', $request->classId)
                    ->orderBy('id')
                    ->get();
            }

            $data = array();
            $i = 1;
            foreach ($students as $student) {
                $row = array();
                $row['id'] = $student->id;
                $row['class_id'] = $request->classId;
                $row['course_id'] = $request->courseId;
                $row['week'] = $request->week;
                $row['orderNumber'] = $i++;
                $row['student'] = $student->firstname . '' . $student->second_name . ' ' . $student->lastname;
                $row['edit'] = "";
                $data[] = $row;
            }
            return DataTables::of($data)
                ->editColumn('edit', function ($data) {
                    $html = '';
                    for ($i = 0; $i < count($data['week']); $i++) {
                        $html .= '<div class="d-inline-flex flex-wrap m-0 p-1 pb-2 bg-white border border-1 border-light-primary mr-3">
                                <a href="#" class="btn btn-icon btn-circle btn-hover-light-primary pulse pulse-primary mr-3 " title="' . $data['week'][$i] . '. Week">
                                    <i class="bg-secondary text-secondary rounded-circle p-2 text-sm">' . $data['week'][$i] . '.</i>
                                    <span class="pulse-ring"></span>
                                </a>
                                <input class="form-control form-control-sm form-control-solid form-text w-50px border border-1 border-primary text-center mr-2 p-0" type="number" min="0" placeholder="Mon" name="' . $data['id'] . '-' . $data['class_id'] . '-' . $data['course_id'] . '-' . $data['week'][$i] . '-1' . '">
                                <input class="form-control form-control-sm form-control-solid form-text w-50px border border-1 border-primary text-center mr-2 p-0" type="number" min="0" placeholder="Mon" name="' . $data['id'] . '-' . $data['class_id'] . '-' . $data['course_id'] . '-' . $data['week'][$i] . '-2' . '">
                                <input class="form-control form-control-sm form-control-solid form-text w-50px border border-1 border-primary text-center mr-2 p-0" type="number" min="0" placeholder="Mon" name="' . $data['id'] . '-' . $data['class_id'] . '-' . $data['course_id'] . '-' . $data['week'][$i] . '-3' . '">
                                <input class="form-control form-control-sm form-control-solid form-text w-50px border border-1 border-primary text-center mr-2 p-0" type="number" min="0" placeholder="Mon" name="' . $data['id'] . '-' . $data['class_id'] . '-' . $data['course_id'] . '-' . $data['week'][$i] . '-4' . '">
                                <input class="form-control form-control-sm form-control-solid form-text w-50px border border-1 border-primary text-center mr-2 p-0" type="number" min="0" placeholder="Mon" name="' . $data['id'] . '-' . $data['class_id'] . '-' . $data['course_id'] . '-' . $data['week'][$i] . '-5' . '">
                            </div>';
                    }
                    return $html;
                })
                ->rawColumns(['edit'])
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
