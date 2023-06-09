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
@endsection
@section('Css')
@endsection
@section('Body')
    <div class="login login-4 login-signin-on d-flex flex-row-fluid">
        <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat">
            <div class="login-form text-center p-7 position-relative overflow-hidden">
                <div class="d-flex flex-center mb-15">
                    <a href="#">
                        <img src="{{asset("media/logos/logo-letter-13.png")}}" class="max-h-75px" alt=""/>
                    </a>
                </div>
                <div class="login-signin">
                    <div class="mb-20">
                        <h3>Sign In To Admin</h3>
                        <div class="text-muted font-weight-bold">Enter your details to login to your account:</div>
                    </div>
                    <form class="form" name="search-form">
                        <div class="form-group mb-5">
                            <input class="form-control h-auto form-control-solid py-4 px-8" type="text"
                                   placeholder="T.C. Kimlik Number" name="username" autocomplete="off"/>
                        </div>
                        <button class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('Javascript')
@endsection

