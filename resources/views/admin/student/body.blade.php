@php
    $permissions = isset(Auth::user()->role->permission) ? json_decode(Auth::user()->role->permission,true) : null
@endphp
<div class="card card-custom col-xxl-12">
    <div class="card-header flex-wrap border-0 pt-6 pb-0 mr-1 pr-1">
        <div class="card-title">
            &nbsp;
        </div>
        @if(!is_null($permissions) && isset($permissions['user']) && $permissions['student']['creating'] == 1)
            <div class="card-toolbar">
                <a href="javascript:;" class="btn btn-light-primary font-weight-bolder mr-2" name="user-add-btn">
                    <i class="fas fa fa-file-excel"></i> @lang('body.import_of_excel')
                </a>
                <a href="javascript:;" class="btn btn-light-primary font-weight-bolder mr-2" name="user-add-multi-btn">
                    <i class="fas fa fa-users"></i> @lang('body.multiple_student_add')
                </a>
                <a href="javascript:;" class="btn btn-light-primary font-weight-bolder" name="student-add-btn">
                    <i class="fas fa fa-user-plus"></i> @lang('body.student_add')
                </a>
            </div>
        @endif
    </div>
    <div class="card-body m-1 p-1">
        <div
            class="table-responsive table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl table-responsive-xxl">
            <table class="table table-striped table-hover flex-nowrap" name="student_datatable" data-label="student">
                <thead>
                <tr>
                    <th class="w-5px">#</th>
                    <th class="w-5px">@lang('body.status')</th>
                    <th class="w-5px">@lang('body.class_name')</th>
                    <th>@lang('body.full_name')</th>
                    <th>@lang('body.email')</th>
                    <th class="w-125px">@lang('body.created_at')</th>
                    <th class="w-100px">@lang('body.edit')</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
