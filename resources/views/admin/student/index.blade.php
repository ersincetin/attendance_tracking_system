@extends('layouts.adminLayout')
@section('Title')
    @lang('body.student_list')
@endsection
@section('Meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('Css')
    <link href="{{asset("plugins/custom/datatables/datatables.bundle.css")}}" rel="stylesheet" type="text/css"/>
@endsection
@section('SubHeader')
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h5 class="text-dark font-weight-bold my-1 mr-5"> @lang('body.students')</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="javascript:;" class="text-muted"> @lang('body.students')</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="javascript:;" class="text-muted"> @lang('body.student_list')</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('Body')
    @include("admin.student.body")
@endsection
@section('Modal')
    @include("admin.student.modal")
    @include("admin.student.multiStudentModal")
@endsection
@section('Javascript')
    <script src="{{asset("plugins/custom/datatables/datatables.bundle.js")}}"></script>
    @include("admin.student.script")
    @include("admin.student.multiStudentScript")
    @include("generalJS.sweetAlert.alert")
    @include("generalJS.identityNumberControl.script")
    @include("generalJS.formValidation.script")
    @include("generalJS.requiredControl.script")
@endsection

