<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.setting.class.index');
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
            $class = new Classes([
                'status' => isset($request->status) ? $request->status : 0,
                'name' => isset($request->className) ? $request->className : null,
            ]);
            if ($class->save()) return 1;
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
            return Classes::where('id', $id)->first();
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
            $class = Classes::where('id', $request->classId)->first();

            $class->status = isset($request->status) ? ($request->status) : $class->status;
            $class->name = isset($request->className) ? $request->className : $class->name;
            if ($class->update()) return 1;
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
            $class = Classes::where('id', $request->classId)->first();
            if ($class->delete()) return 1;
            return 0;
        } else {
            echo "Sadece AJAX sorgular için";
        }
    }


    public function dataTables(Request $request)
    {
        if ($request->ajax()) {
            if (isset($request->search->value) && $request->search->value != '' && $request->search->value > 0) {
                $classes = Classes::where('name', 'LIKE', '%' . strtolower($_GET['search']['value']) . '%')
                    ->orderBy('id')
                    ->get();
            } else {
                $classes = Classes::all();
            }

            $data = array();
            $i = 1;
            foreach ($classes as $class) {
                $row = array();
                $row['id'] = $class->id;
                $row['status'] = $class->status;
                $row['orderNumber'] = $i++;
                $row['assignedCourses'] = $class->assigning_course;
                $row['className'] = $class->name;
                $row['createdAt'] = $this->DD_MM_YYYY_rotate(substr(date($class->created_at), 0, 10)) . substr(date($class->created_at), 10);
                $row['edit'] = "";
                $data[] = $row;
            }
            return DataTables::of($data)
                ->editColumn('status', function ($data) {
                    return $data['status'] ? '<i class="fas fa-check-circle text-success"></i>' : '<i class="far fa-times-circle text-danger"></i>';
                })
                ->editColumn('assignedCourses', function ($data) {
                    $courseIdList = !is_null($data['assignedCourses']) ? json_decode($data['assignedCourses'], true) : null;
                    $list = array();
                    $html = '';
                    if (!is_null($courseIdList)) {
                        foreach ($courseIdList as $key => $value)
                            if ($value == 1) array_push($list, $key);
                    }
                    if (count($list) > 0) {
                        $courses = Course::whereIn('id', $list)
                            ->orderBy('id')
                            ->get();
                        if (count($courses) > 0) {
                            foreach ($courses as $course) {
                                $html .= '<button class="btn font-weight-bold btn-light-primary mr-2">' . $course->name . '</button>';
                            }
                        }
                    }
                    return $html;
                })
                ->editColumn('edit', function ($data) {
                    return '
                        <a href="javascript:;" class="btn btn-sm btn-icon text-primary" onclick="edit_class(' . $data['id'] . ')" title="' . Lang::get('body.edit') . '"><i class="fas fa fa-edit text-warning"></i></a>
                        <a href="javascript:;" class="btn btn-sm btn-icon text-primary" onclick="assigning_course(' . $data['id'] . ')" title="' . Lang::get('body.edit') . '"><i class="fas fa fa-compass text-info"></i></a>
                        <a href="javascript:;" class="btn btn-sm btn-icon" onclick="delete_class(' . $data['id'] . ')" title="' . Lang::get('body.delete') . '"><i class="fas fa fa-trash text-danger"></i></a>
                    ';
                })
                ->rawColumns(['status', 'assignedCourses', 'edit'])
                ->make(true);
        } else {
            echo "Sadece AJAX sorgusunda kullanılır.";
        }
    }

    public function setAssigningCourse(Request $request)
    {
        if ($request->ajax()) {
            $class = Classes::where('id', $request->classId)->first();
            $class->assigning_course = isset($request->courseList) ? $request->courseList : $class->assigning_course;
            if ($class->update()) return 1;
            return 0;
        } else {
            echo "Sadece AJAX sorgular için";
        }
    }

    public static function DD_MM_YYYY_rotate($date)
    {
        $rotate = explode('-', $date);
        return $rotate[2] . '-' . $rotate[1] . '-' . $rotate[0];
    }
}
