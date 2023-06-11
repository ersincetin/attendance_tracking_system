@extends('layouts.mainLayout')
@section('Title','Öğrenci Devamsızlık Takip Sistemi')
@section('Meta')
    <meta charset="utf-8"/>
    <meta name="description" content="Öğrenci Devamsızlık Takip Sistemi"/>
    <meta name="keywords" content="Öğrenci Devamsızlık Takip Sistemi"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:locale" content="tr_TR"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="Öğrenci Devamsızlık Takip Sistemi"/>
    <meta property="og:url" content="{{url('/')}}"/>
    <meta property="og:site_name" content="Öğrenci Devamsızlık Takip Sistemi"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('Css')
@endsection
@section('Body')
    <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid  " id="kt_login">
        <div class="d-flex flex-column flex-row-fluid position-relative p-7 overflow-hidden">
            <div
                class="position-absolute top-0 right-0 text-right mt-5 mb-15 mb-lg-0 flex-column-auto justify-content-center py-5 px-10">
                <a href="{{url('student/login')}}" class="btn btn-outline-info font-weight-bold ml-2">Öğrenci Girişi</a>
                <a href="{{url('admin/login')}}" class="btn btn-outline-primary font-weight-bold ml-2">Yetkili /
                    Öğretmen Girişi</a>
            </div>
            <div class="d-flex flex-column-fluid flex-center mt-30 mt-lg-0">
                <div class="col-12 col-sm-8 col-md-6 col-lg-6 col-xl-4">
                    <div class="text-center mb-10 mb-lg-20">
                        <h3 class="font-size-h1">Sign In</h3>
                        <p class="text-muted font-weight-bold">Enter your username and password</p>
                    </div>
                    <form class="form" novalidate="novalidate">
                        <div class="form-group mb-0">
                            <input class="form-control form-control-solid h-auto py-5 px-6" type="text"
                                   placeholder="Identitty Number" name="username" autocomplete="off"/>
                        </div>
                        {{--                        <div class="form-group">--}}
                        {{--                            <input class="form-control form-control-solid h-auto py-5 px-6" type="password" placeholder="Password" name="password" autocomplete="off" />--}}
                        {{--                        </div>--}}
                        <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
                            <button type="button" id="kt_login_signin_submit"
                                    class="btn btn-primary font-weight-bold px-9 py-4 my-3 mt-0 col-12">Sign In
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('Javascript')
@endsection

