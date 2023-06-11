<div class="card card-custom col-xxl-12">
    <div class="card-header flex-wrap border-0 pt-6 pb-0 mr-1 pr-1">
        <div class="card-title">
            &nbsp;
        </div>
        <div class="card-toolbar">
            <a href="javascript:;" class="btn btn-light-primary font-weight-bolder" name="user-add-btn">
                <i class="fas fa fa-user-plus"></i> @lang('body.user_add')
            </a>
        </div>
    </div>
    <div class="card-body m-1 p-1">
        <div class="table-responsive table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl table-responsive-xxl">
            <table class="table table-striped table-hover" name="users_datatable" data-label="user">
                <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('body.role')</th>
                    <th>@lang('body.class_name')</th>
                    <th>@lang('body.username')</th>
                    <th>@lang('body.full_name')</th>
                    <th>@lang('body.email')</th>
                    <th>@lang('body.status')</th>
                    <th>@lang('body.created_at')</th>
                    <th>@lang('body.edit')</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
