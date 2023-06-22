<div class="d-flex flex-row">
    <div class="flex-row-fluid ml-lg-8">
        <div class="card card-custom card-stretch">
            <div class="card-header py-3 m-0 p-0">
                <div class="card-title align-items-start flex-column">
                </div>
                <div class="card-toolbar m-1 p-1">
                    <button class="btn btn-sm btn-outline-info mr-2" name="calculate-btn">@lang('body.calculate_weeks')</button>
                    <button class="btn btn-sm btn-outline-primary mr-2" name="save-btn">@lang('body.save')</button>
                </div>
            </div>
            <form class="form" name="setting-form">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-form-label col-auto">&nbsp;</label>
                        <div class="col-lg-8 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-6">
                                    <div class="input-group date" name="start_datetimepicker"
                                         data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                               placeholder="@lang('body.start_date')" data-target='[name="start_datetimepicker"]'/>
                                        <div class="input-group-append" data-target='[name="start_datetimepicker"]'
                                             data-toggle="datetimepicker">
                                                  <span class="input-group-text">
                                                   <i class="ki ki-calendar text-primary"></i>
                                                  </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group date" name="end_datetimepicker"
                                         data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                               placeholder="@lang('body.end_date')" data-target='[name="end_datetimepicker"]'/>
                                        <div class="input-group-append" data-target='[name="end_datetimepicker"]'
                                             data-toggle="datetimepicker">
                                                  <span class="input-group-text">
                                                   <i class="ki ki-calendar text-primary"></i>
                                                  </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row" name="week-field">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
