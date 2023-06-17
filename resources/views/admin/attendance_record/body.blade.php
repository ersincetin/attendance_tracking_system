@php
    $permissions = isset(Auth::user()->role->permission) ? json_decode(Auth::user()->role->permission,true) : null
@endphp
<div class="card card-custom col-xxl-12">
    <div class="card-header flex-wrap border-0 pt-6 pb-0 mr-1 pr-1">
        <div class="card-title">
            &nbsp;
        </div>
        <div class="card-toolbar">
            @if(!is_null($permissions) && isset($permissions['user']) && $permissions['attendance-record']['creating'] == 1)
                <a href="javascript:;" class="btn btn-light-primary font-weight-bolder" name="attendance-record-add-btn">
                    <i class="fas fa fa-plus"></i> @lang('body.record_add')
                </a>
            @endif
        </div>
    </div>
    <div class="card-body m-1 p-1">
        <div class="table-responsive table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl table-responsive-xxl">
            <table class="table table-striped table-hover table-light-primary nowrap" name="attendance_record_datatable"
                   data-label="attendance-record">
                <thead>
                <tr>
                    <th class="w-5px">#</th>
                    <th class="w-15px">@lang('body.user')</th>
                    <th class="w-15px">@lang('body.class')</th>
                    <th class="w-15px">@lang('body.semester')</th>
                    <th class="w-auto">@lang('body.name')</th>
                    <th class="w-125px">@lang('body.created_at')</th>
                    <th class="w-100px">@lang('body.actions')</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
