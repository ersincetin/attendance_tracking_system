<div class="card card-custom col-xxl-12">
    <div class="card-header flex-wrap border-0 pt-6 pb-0 mr-1 pr-1">
        <div class="card-title">
            &nbsp;
        </div>
        <div class="card-toolbar">
            <a href="javascript:;" class="btn btn-light-primary font-weight-bolder" name="class-add-btn">
                <i class="fas fa fa-plus"></i> @lang('body.class_add')
            </a>
        </div>
    </div>
    <div class="card-body m-1 p-1">
        <div
            class="table-responsive table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl table-responsive-xxl">
            <table class="table table-striped table-hover nowrap table-light-primary" name="class_datatable" data-label="class">
                <thead>
                <tr>
                    <th class="w-5px">#</th>
                    <th class="w-5px">@lang('body.status')</th>
                    <th class="w-100px">@lang('body.class_name')</th>
                    <th>@lang('body.assigned_courses')</th>
                    <th class="w-125px">@lang('body.created_at')</th>
                    <th class="w-100px">@lang('body.actions')</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
