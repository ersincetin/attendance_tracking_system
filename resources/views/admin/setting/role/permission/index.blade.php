@extends('layouts.adminLayout')
@section('Title')
    @lang('body.permissions')
@endsection
@section('Meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('Css')
@endsection
@section('SubHeader')
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h5 class="text-dark font-weight-bold my-1 mr-5">@lang('body.settings')</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="javascript:;" class="text-muted">@lang('body.settings')</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{url('admin/settings/role')}}" class="text-muted">@lang('body.role')</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="javascript:;" class="text-muted">@lang('body.permissions')</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('Body')
    @include('admin.setting.role.permission.body')
@endsection
@section('Modal')
@endsection
@section('Javascript')
    @include('admin.setting.role.permission.script')
@endsection

