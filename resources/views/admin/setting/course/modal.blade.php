<div class="modal fade" name="course-modal" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header m-2 p-2">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" name="course-form" method="POST">
                    <input type="hidden" name="courseId">
                    <div class="row">
                        <div class="col-auto">
                            <div class="form-group mb-0 pb-0">
                                <label>@lang('body.status')</label>
                                <div class="col-auto">
                                       <span class="switch switch-outline switch-icon switch-success">
                                            <label>
                                             <input type="checkbox" name="status" checked/>
                                             <span></span>
                                            </label>
                                       </span>
                                </div>
                                <label class="col-auto col-form-label text-sm-right text-uppercase"
                                       name="status_action"></label>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="form-group mb-0 pb-0">
                                <label name="className-label">@lang('body.name'): </label>
                                <input type="text" class="form-control form-control-solid" name="courseName" required
                                       placeholder="Enter @lang('body.course_name')"/>
                            </div>
                        </div>
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
