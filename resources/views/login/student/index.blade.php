@extends('layouts.mainLayout')
@section('Title','Devamsızlık Tablosu')
@section('Meta')
    <meta charset="utf-8"/>
    <meta name="description" content="Öğrenci Devamsızlık Takip Sistemi Yetkili Girişi"/>
    <meta name="keywords" content="Öğrenci Devamsızlık Takip Sistemi Yetkili Girişi"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:locale" content="tr_TR"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="Öğrenci Devamsızlık Takip Sistemi Yetkili Girişi"/>
    <meta property="og:url" content="{{url('/')}}"/>
    <meta property="og:site_name" content="Öğrenci Devamsızlık Takip Sistemi Yetkili Girişi"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('Css')
    <link href="{{asset("css/pages/login/classic/login-3.css")}}" rel="stylesheet" type="text/css"/>
@endsection
@section('Body')
    <div class="login login-3 login-signin-on d-flex flex-row-fluid" id="kt_login">
        <div class="d-flex flex-center bgi-size-cover bgi-no-repeat flex-row-fluid"
             style="background-image: url({{asset("media/bg/bg-6.jpg")}});">
            <div class="login-form text-center text-white p-7 position-relative overflow-hidden">
                <div class="d-flex flex-center mb-15">
                    <a href="#">
                        <img src="{{asset("media/logos/logo-letter-9.png")}}" class="max-h-100px" alt=""/>
                    </a>
                </div>
                <div class="login-signin">
                    <div class="mb-20">
                        <h3>Sign In To Admin</h3>
                        <p class="opacity-60 font-weight-bold">Enter your details to login to your account:</p>
                    </div>
                    <form class="form" name="sign-in-form" id="kt_login_signin_form">
                        <div class="form-group">
                            <input
                                class="form-control h-auto text-white placeholder-white opacity-70 bg-dark-o-70 rounded-pill border-0 py-4 px-8 mb-5"
                                type="text" placeholder="Identity Number" name="identity_number" autocomplete="off"/>
                        </div>
                        <div class="form-group">
                            <input
                                class="form-control h-auto text-white placeholder-white opacity-70 bg-dark-o-70 rounded-pill border-0 py-4 px-8 mb-5"
                                type="password" placeholder="Password" name="password" autocomplete="off"/>
                        </div>
                        <div class="form-group d-flex flex-wrap justify-content-between align-items-center px-8">
                            <div class="checkbox-inline">
                                <label class="checkbox checkbox-outline checkbox-white text-white m-0">
                                    <input type="checkbox" name="remember"/>
                                    <span></span>Remember me</label>
                            </div>
                            <a href="javascript:;" id="kt_login_forgot" class="text-white font-weight-bold">Forget
                                Password ?</a>
                        </div>
                    </form>
                    <div class="form-group text-center mt-10">
                        <button class="btn btn-pill btn-outline-white font-weight-bold opacity-90 px-15 py-3"
                                name="sign-in">Sign In
                        </button>
                    </div>
                </div>
                <div class="login-forgot">
                    <div class="mb-20">
                        <h3>Forgotten Password ?</h3>
                        <p class="opacity-60">Enter your email to reset your password</p>
                    </div>
                    <form class="form" id="kt_login_forgot_form">
                        <div class="form-group mb-10">
                            <input
                                class="form-control h-auto text-white placeholder-white opacity-70 bg-dark-o-70 rounded-pill border-0 py-4 px-8"
                                type="text" placeholder="Email" name="email" autocomplete="off"/>
                        </div>
                        <div class="form-group">
                            <button id="kt_login_forgot_submit"
                                    class="btn btn-pill btn-outline-white font-weight-bold opacity-90 px-15 py-3 m-2">
                                Request
                            </button>
                            <button id="kt_login_forgot_cancel"
                                    class="btn btn-pill btn-outline-white font-weight-bold opacity-70 px-15 py-3 m-2">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('Javascript')
    <script src="{{asset("js/pages/custom/login/login-general.js")}}"></script>
    @include("login.student.script")
@endsection

