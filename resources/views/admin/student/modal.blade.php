<div class="modal fade" id="student_modal" data-backdrop="static" tabindex="-1" role="dialog"
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
                <form class="form" name="student-form" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="studentId">
                    <input type="hidden" name="studentType" value="6">
                    <div class="form-group mb-0 pb-0 text-center">
                        <div class="image-input image-input-outline image-input-circle" id="kt_image_3">
                            <div class="image-input-wrapper"
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
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                            <label>Sınıf: <span class="text-danger">*</span></label>
                            <select class="form-control selectpicker" required name="class" data-live-search="true" data-none-selected-text="@lang('body.choose')">
                            </select>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                            <label>@lang('body.sex'): <span class="text-danger">*</span></label>
                            <select class="form-control " name="sex">
                                <option value="0">@lang('body.choose')</option>
                                <option value="M">@lang('body.male')</option>
                                <option value="F">@lang('body.female')</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-0 pb-0">
                        <label name="identityNumber-label">@lang('body.identity_number'): </label>
                        <input type="text" class="form-control " name="identityNumber" required
                               placeholder="Enter @lang('body.identity_number')"/>
                    </div>
                    <div class="form-group mb-0 pb-0 row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                            <label name="firstname-label">@lang('body.firstname'): </label>
                            <input type="text" class="form-control " name="firstname" required
                                   placeholder="Enter @lang('body.firstname')"/>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                            <label name="secondName-label">@lang('body.second_name'):</label>
                            <input type="text" class="form-control " name="secondName"
                                   placeholder="Enter @lang('body.second_name')"/>
                        </div>
                    </div>
                    <div class="form-group mb-0 pb-0">
                        <label name="lastname-label">@lang('body.lastname'): </label>
                        <input type="text" class="form-control " name="lastname" required
                               placeholder="Enter @lang('body.lastname')"/>
                    </div>

                    <div class="form-group mb-0 pb-0">
                        <label name="email-label">@lang('body.email'): </label>
                        <input type="email" class="form-control " name="email"
                               placeholder="Enter @lang('body.email')"/>
                    </div>

                </form>
            </div>
            <div class="modal-footer m-1 p-1">
                <button type="button" class="btn btn-light-danger font-weight-bold"
                        data-dismiss="modal">@lang('body.cancel')
                </button>
                <button type="button" class="btn btn-light-primary font-weight-bold" name="save-btn">@lang('body.save')
                </button>
            </div>
        </div>
    </div>
</div>
