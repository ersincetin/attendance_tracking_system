<div class="d-flex flex-row">
    <div class="flex-row-auto offcanvas-mobile w-250px w-xxl-350px" id="kt_profile_aside">
        <div class="card card-custom card-stretch">
            <div class="card-body pt-4">
                <div class="d-flex align-items-center">
                    <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                        <div class="symbol-label" name="profile-photo"
                             style="background-image: url({{asset("media/users/blank.png")}})"></div>
                        <i class="symbol-badge bg-success"></i>
                    </div>
                    <div>
                        <a href="javascript:;" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">
                            <span class="bold" name="fullName"></span>
                        </a>
                        {{--                        <div class="text-muted">Application Developer</div>--}}
                    </div>
                </div>

                <div class="py-9">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="font-weight-bold mr-2">@lang('container.email')</span>
                        <a href="#" class="text-muted text-hover-primary"><span name="email"></span></a>
                    </div>
                </div>
                <div class="navi navi-bold navi-hover navi-active navi-link-rounded">
                    <div class="navi-item mb-2">
                        <a href="javascript:;" class="navi-link py-4 active" data-label="information-field">
                            <span class="navi-icon mr-2"><i class="fas fa-user-circle fa-2x"></i></span>
                            <span class="navi-text font-size-lg">@lang('container.personal_information')</span>
                        </a>
                    </div>
                    <div class="navi-item mb-2">
                        <a href="javascript:;" class="navi-link py-4" data-label="password-field">
                            <span class="navi-icon mr-2"><i class="fas fa-edit fa-2x"></i></span>
                            <span class="navi-text font-size-lg">Change Passwort</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex-row-fluid ml-lg-8">
        <div class="card card-custom card-stretch">
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                </div>
                <div class="card-toolbar">
                    <button class="btn btn-outline-primary mr-2" name="save-btn">@lang('container.update')</button>
{{--                    <button class="btn btn-outline-danger" name="cancel-btn">@lang('container.cancel')</button>--}}
                </div>
            </div>
            <form class="form" name="user-form">
                <input type="hidden" name="userId">
                <input type="hidden" name="userType">
                <div class="card-body" name="information-field">
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">&nbsp;</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="image-input image-input-outline" id="kt_profile_avatar">
                                <div class="image-input-wrapper" name="profile-photo"
                                     style="background-image: url({{asset("media/users/blank.png")}})"></div>
                                <label
                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="change" data-toggle="tooltip" title=""
                                    data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="profile_avatar" accept=".jpg, .jpeg"/>
                                    <input type="hidden" name="profile_avatar_remove"/>
                                </label>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                      data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                      <i class="ki ki-bold-close icon-xs text-muted"></i>
								</span>
                            </div>
                            <span class="form-text text-muted">Allowed file types: jpg, jpeg.</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">@lang('container.sex')</label>
                        <div class="col-lg-9 col-xl-6">
                            <select class="form-control  form-control-solid" name="sex">
                                <option value="0">@lang('container.choose')</option>
                                <option value="M">@lang('container.male')</option>
                                <option value="F">@lang('container.female')</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">@lang('container.username')</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control  form-control-solid" type="text"
                                   placeholder="@lang('container.username')" name="username"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">@lang('container.identity_number')</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control  form-control-solid" type="text"
                                   placeholder="@lang('container.identity_number')" name="identityNumber"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">@lang('container.name')</label>
                        <div class="col-lg-9 col-xl-6 mr-0 pr-0 row">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                <input class="form-control form-control-solid" type="text"
                                       placeholder="@lang('container.firstname')" name="firstname"/>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mr-0 pr-0">
                                <input class="form-control form-control-solid" type="text"
                                       placeholder="@lang('container.second_name')" name="second_name"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">@lang('container.lastname')</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control  form-control-solid" type="text"
                                   placeholder="@lang('container.lastname')" name="lastname"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">@lang('container.email')</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control  form-control-solid" type="text"
                                   placeholder="@lang('container.email')" name="email"/>
                        </div>
                    </div>
                </div>
                <div class="card-body d-none" name="password-field">
                    <div class="alert alert-custom alert-light-info fade show mb-10 col-9" role="alert">
                        <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                        <div class="alert-text font-weight-bold">Şifrenizi unuttuysanız yöneticiniz ile iletişime
                            geçiniz.
                        </div>
                        <div class="alert-close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">
							    <i class="ki ki-close"></i>
                            </span>
                            </button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label text-alert">Current Password</label>
                        <div class="col-lg-9 col-xl-6">
                            <input type="password" class="form-control form-control-lg form-control-solid mb-2" value=""
                                   placeholder="Current password"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label text-alert">New Password</label>
                        <div class="col-lg-9 col-xl-6">
                            <input type="password" class="form-control form-control-lg form-control-solid" value=""
                                   placeholder="New password"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label text-alert">Verify Password</label>
                        <div class="col-lg-9 col-xl-6">
                            <input type="password" class="form-control form-control-lg form-control-solid" value=""
                                   placeholder="Verify password"/>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
