<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.setting.lesson.index');
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
            $lesson = new Lesson([
                'status' => isset($request->status) ? $request->status : 0,
                'name' => isset($request->lessonName) ? $request->lessonName : null,
            ]);
            if ($lesson->save()) return 1;
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
            return Lesson::where('id', $id)->first();
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
            $lesson = Lesson::where('id', $request->lessonId)->first();

            $lesson->status = isset($request->status) ? ($request->status) : $lesson->status;
            $lesson->name = isset($request->lessonName) ? $request->lessonName : $lesson->name;
            if ($lesson->update()) return 1;
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
            $lesson = Lesson::where('id', $request->lessonId)->first();
            if ($lesson->delete()) return 1;
            return 0;
        } else {
            echo "Sadece AJAX sorgular için";
        }
    }


    public function dataTables(Request $request)
    {
        if ($request->ajax()) {
            if (isset($request->search->value) && $request->search->value != '' && $request->search->value > 0) {
                $lessons = Lesson::where('name', 'LIKE', '%' . strtolower($_GET['search']['value']) . '%')
                    ->orderBy('id')
                    ->get();
            } else {
                $lessons = Lesson::all();
            }

            $data = array();
            $i = 1;
            foreach ($lessons as $lesson) {
                $row = array();
                $row['id'] = $lesson->id;
                $row['status'] = $lesson->status;
                $row['orderNumber'] = $i++;
                $row['lessonName'] = $lesson->name;
                $row['createdAt'] = $this->DD_MM_YYYY_rotate(substr(date($lesson->created_at), 0, 10)) . substr(date($lesson->created_at), 10);
                $row['edit'] = "";
                $data[] = $row;
            }
            return DataTables::of($data)
                ->editColumn('status', function ($data) {
                    return $data['status'] ? '<i class="fas fa-check-circle text-success"></i>' : '<i class="far fa-times-circle text-danger"></i>';
                })
                ->editColumn('edit', function ($data) {
                    return '
                        <a href="javascript:;" class="btn btn-sm btn-icon text-primary" onclick="edit_lesson(' . $data['id'] . ')" title="' . Lang::get('body.edit') . '"><i class="fas fa fa-edit text-warning"></i></a>
                        <a href="javascript:;" class="btn btn-sm btn-icon" onclick="delete_lesson(' . $data['id'] . ')" title="' . Lang::get('body.delete') . '"><i class="fas fa fa-trash text-danger"></i></a>
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
