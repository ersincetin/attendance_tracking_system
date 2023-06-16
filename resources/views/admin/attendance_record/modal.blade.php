<div class="modal fade" name="attendance-record-modal" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-xl-special" role="document">
        <div class="modal-content">
            <div class="modal-header m-2 p-2">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body m-1 p-1">
                <form class="mb-3">
                    <input type="hidden" name="recordId">
                    <div class="row m-0 p-0">
                        <div class="col-lg-3 mb-lg-0 mb-6">
                            <label>@lang('body.class')</label>
                            <select class="form-control datatable-input selectpicker" name="class"
                                    data-show-subtext="true"
                                    data-size="5" data-container="body" data-live-search="true"
                                    data-none-selected-text="@lang('body.choose')">

                            </select>
                        </div>
                        <div class="col-lg-3 mb-lg-0 mb-6">
                            <label>@lang('body.semester'):</label>
                            <select class="form-control datatable-input selectpicker" name="semester"
                                    data-container="body" data-size="5" data-live-search="true"
                                    data-none-selected-text="@lang('body.choose')">

                            </select>
                        </div>
                        <div class="col-lg-3 mb-lg-0 mb-6">
                            <label>@lang('body.week'):</label>
                            <select class="form-control selectpicker datatable-input" name="week" data-size="5"
                                    data-container="body" multiple="multiple"
                                    data-none-selected-text="@lang('body.choose')">

                            </select>
                        </div>
                        <div class="col-lg-3 mt-lg-8">
                            <a href="javascript:;" class="btn btn-outline-primary btn-primary--icon col-12"
                               name="search-btn">
													<span>
														<i class="la la-search"></i>
														<span>Search</span>
													</span>
                            </a>&#160;&#160;
                        </div>
                    </div>
                </form>
                <div
                    class="table-responsive table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl table-responsive-xxl overflow-x-auto">
                    <table class="table table-bordered table-checkable table-hover table-light-primary display nowrap"
                           name="attendance-record-add-datatable"
                           data-label="attendance-record">
                        <thead class="d-none">
                        <tr>
                            <th>#</th>
                            <th>@lang('body.name')</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
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
