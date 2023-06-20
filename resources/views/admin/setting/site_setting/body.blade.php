<div class="d-flex flex-row">
    <div class="flex-row-fluid ml-lg-8">
        <div class="card card-custom card-stretch">
            <div class="card-header py-3 m-0 p-0">
                <div class="card-title align-items-start flex-column">
                </div>
                <div class="card-toolbar m-1 p-1">
                    <button class="btn btn-sm btn-outline-primary mr-2" name="save-btn">@lang('body.save')</button>
                    {{--                    <button class="btn btn-outline-danger" name="cancel-btn">@lang('body.cancel')</button>--}}
                </div>
            </div>
            <form class="form" name="user-form">
                <input type="hidden" name="settingId">
                <div class="card-body" name="information-field">
                    <div class="row">
                        <div class="form-group col-4 row">
                            <label class="col-xl-3 col-lg-3 col-form-label">@lang('body.homepage_logo')</label>
                            <div class="col-lg-9 col-xl-6">
                                <div class="image-input image-input-outline" id="homepage-photo">
                                    <div class="image-input-wrapper"
                                         style="background-image: url({{asset("media/photos/blank_img.png")}})"></div>
                                    <label
                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="change" data-toggle="tooltip" title=""
                                        data-original-title="Change avatar">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="homepage-photo" accept=".jpg, .jpeg"/>
                                        <input type="hidden" name="profile_avatar_remove"/>
                                    </label>
                                    <span
                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                      <i class="ki ki-bold-close icon-xs text-muted"></i>
								</span>
                                </div>
                                <span class="form-text text-muted">Allowed file types: jpg, jpeg.</span>
                            </div>
                        </div>
                        <div class="form-group col-4 row">
                            <label class="col-xl-3 col-lg-3 col-form-label">@lang('body.admin_page_logo')</label>
                            <div class="col-lg-9 col-xl-6">
                                <div class="image-input image-input-outline" id="admin-panel-photo">
                                    <div class="image-input-wrapper"
                                         style="background-image: url({{asset("media/photos/blank_img.png")}})"></div>
                                    <label
                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="change" data-toggle="tooltip" title=""
                                        data-original-title="Change avatar">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="admin-panel-photo" accept=".jpg, .jpeg"/>
                                        <input type="hidden" name="profile_avatar_remove"/>
                                    </label>
                                    <span
                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                      <i class="ki ki-bold-close icon-xs text-muted"></i>
								</span>
                                </div>
                                <span class="form-text text-muted">Allowed file types: jpg, jpeg.</span>
                            </div>
                        </div>
                        <div class="form-group col-4 row">
                            <label class="col-xl-3 col-lg-3 col-form-label">@lang('body.admin_page_mobile_logo')</label>
                            <div class="col-lg-9 col-xl-6">
                                <div class="image-input image-input-outline" id="admin-panel-mobile-photo">
                                    <div class="image-input-wrapper"
                                         style="background-image: url({{asset("media/photos/blank_img.png")}})"></div>
                                    <label
                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="change" data-toggle="tooltip" title=""
                                        data-original-title="Change avatar">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="admin-panel-mobile-photo" accept=".jpg, .jpeg"/>
                                        <input type="hidden" name="profile_avatar_remove"/>
                                    </label>
                                    <span
                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                      <i class="ki ki-bold-close icon-xs text-muted"></i>
								</span>
                                </div>
                                <span class="form-text text-muted">Allowed file types: jpg, jpeg.</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">@lang('body.homepage_header')</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control  form-control-solid" type="text"
                                   placeholder="@lang('body.homepage_header')" name="homepage-header"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">@lang('body.homepage_subheader')</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control  form-control-solid" type="text"
                                   placeholder="@lang('body.homepage_subheader')" name="homepage-subheader"/>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
