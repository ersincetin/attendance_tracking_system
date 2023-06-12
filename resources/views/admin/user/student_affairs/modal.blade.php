<div class="modal fade" id="user_modal" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header m-2 p-2">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" name="user-form" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="userId">
                    <input type="hidden" name="userType" value="5">
                    <div class="form-group mb-0 pb-0 text-center">
                        <div class="image-input image-input-outline image-input-circle" id="kt_image_3">
                            <div class="image-input-wrapper"
                                 style="background-image: url({{asset("media/users/blank.png")}})"></div>
                            <label
                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="change" data-toggle="tooltip" title=""
                                data-original-title="Change avatar">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg"/>
                                <input type="hidden" name="profile_avatar_remove"/>
                            </label>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                  data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                        </div>
                    </div>
                    <div class="form-group mb-0 pb-0 row">
                        <label class="col-auto col-form-label">@lang('body.status')</label>
                        <div class="col-auto">
                           <span class="switch switch-outline switch-icon switch-success">
                            <label>
                             <input type="checkbox" name="status"/>
                             <span></span>
                            </label>
                           </span>
                        </div>
                        <label class="col-auto col-form-label text-sm-right text-uppercase"
                               name="status_action"></label>
                    </div>
                    <div class="form-group mb-0 pb-0 row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <label>@lang('body.sex'): <span class="text-danger">*</span></label>
                            <select class="form-control form-control-solid" name="sex">
                                <option value="0">@lang('body.choose')</option>
                                <option value="M">@lang('body.male')</option>
                                <option value="F">@lang('body.female')</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-0 pb-0">
                        <label name="username-label">@lang('body.username'): </label>
                        <input type="text" class="form-control form-control-solid" name="username" required
                               placeholder="Enter @lang('body.username')"/>
                    </div>
                    <div class="form-group mb-0 pb-0">
                        <label name="identityNumber-label">@lang('body.identity_number'): </label>
                        <input type="text" class="form-control form-control-solid" name="identityNumber"
                               placeholder="Enter @lang('body.identity_number')"/>
                    </div>
                    <div class="form-group mb-0 pb-0 row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                            <label name="firstname-label">@lang('body.firstname'): </label>
                            <input type="text" class="form-control form-control-solid" name="firstname" required
                                   placeholder="Enter @lang('body.firstname')"/>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                            <label name="secondName-label">@lang('body.second_name'):</label>
                            <input type="text" class="form-control form-control-solid" name="secondName"
                                   placeholder="Enter @lang('body.second_name')"/>
                        </div>
                    </div>
                    <div class="form-group mb-0 pb-0">
                        <label name="lastname-label">@lang('body.lastname'): </label>
                        <input type="text" class="form-control form-control-solid" name="lastname" required
                               placeholder="Enter @lang('body.lastname')"/>
                    </div>

                    <div class="form-group mb-0 pb-0">
                        <label name="email-label">@lang('body.email'): </label>
                        <input type="email" class="form-control form-control-solid" name="email" required
                               placeholder="Enter @lang('body.email')"/>
                    </div>
                    <div class="form-group mb-0 pb-0">
                        <label name="password-label">@lang('body.password'): </label>
                        <input type="password" class="form-control form-control-solid" name="password" required
                               placeholder="Enter @lang('body.password')"/>
                    </div>
                    <div class="form-group mb-0 pb-0">
                        <label name="re-password-label">@lang('body.re_password'): </label>
                        <input type="password" class="form-control form-control-solid" name="re-password" required
                               placeholder="Enter @lang('body.re_password')"/>
                    </div>

                </form>
            </div>
            <div class="modal-footer m-1 p-1">
                <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">@lang('body.cancel')
                </button>
                <button type="button" class="btn btn-light-primary font-weight-bold" name="save-btn">@lang('body.save')
                </button>
            </div>
        </div>
    </div>
</div>
