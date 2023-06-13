@extends('layouts.adminLayout')
@section('Title','Kullanıcı Listesi')
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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Teachers</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="javascript:;" class="text-muted">Teachers</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="javascript:;" class="text-muted">Teacher List</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('Body')
    @include("admin.user.teacher.body")
@endsection
@section('Modal')
    @include("admin.user.teacher.modal")
    @include("admin.user.teacher.assigningClassModal")
@endsection
@section('Javascript')
    <script src="{{asset("plugins/custom/datatables/datatables.bundle.js")}}"></script>
    @include("generalJS.sweetAlert.alert")
    @include("admin.user.script")
    @include("admin.user.teacher.script")
    @include("generalJS.formValidation.script")
    @include("generalJS.requiredControl.script")
    @include("generalJS.identityNumberControl.script")
@endsection

