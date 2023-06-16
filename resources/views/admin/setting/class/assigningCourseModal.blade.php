<div class="modal fade" name="assigning-course-modal" data-backdrop="static" tabindex="-1" role="dialog"
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
                <form class="form" name="assigning-course-form">
                    <input type="hidden" name="classId">
                    <div class="row">
                        <div class="form-group col-12 row" name="assigning-course-inputs">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer m-1 p-1">
                <button type="button" class="btn btn-light-danger font-weight-bold"
                        data-dismiss="modal">@lang('body.cancel')
                </button>
                <button type="button" class="btn btn-light-primary font-weight-bold" name="assigning-course-save-btn">@lang('body.save')
                </button>
            </div>
        </div>
    </div>
</div>
