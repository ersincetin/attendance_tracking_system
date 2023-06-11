<div class="modal fade" id="user_modal_xl" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl-special" role="document">
        <div class="modal-content">
            <div class="modal-header m-2 p-2">
                <h5 class="modal-title"></h5>
                <div class="card-toolbar text-right">
                    <a href="javascript:;" class="btn btn-light-primary font-weight-bolder" name="row-add">
                        <i class="fas fa fa-user-plus"></i> Yeni Alan Ekle
                    </a>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body m-1 p-1">
                <form class="form" name="multi-user-form">
                    <input type="hidden" name="userType" value="6">
                    <div
                        class="table-responsive table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl table-responsive-xxl">
                        <table
                            class="table table-bordered table-head-borderless table-striped table-hover nowrap m-0 p-0"
                            name="multi-student-add-table">
                            <thead class="d-none">
                            <tr>
                                <th>#</th>
                                <th>Sınıf</th>
                                <th>Cinsiyet</th>
                                <th>T.C. Kimlik Numarası</th>
                                <th>Ad</th>
                                <th>İkinci Ad</th>
                                <th>Soyad</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr name="row-item-1">
                                <td name="row-count">1</td>
                                <td>
                                    <div class="form-group mb-0 pb-0 row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <select class="form-control form-control-sm form-control-solid"
                                                    name="class" required>
                                                <option value="0">@lang('body.choose')</option>
                                                <option value="6">M</option>
                                                <option value="7">L</option>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0 pb-0 row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <select class="form-control form-control-sm form-control-solid"
                                                    name="sex" required>
                                                <option value="0">@lang('body.choose')</option>
                                                <option value="M">@lang('body.male')</option>
                                                <option value="F">@lang('body.female')</option>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0 pb-0">
                                        <input type="text" class="form-control form-control-sm form-control-solid"
                                               name="identityNumber" required
                                               placeholder="Enter @lang('body.identity_number')"/>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0 pb-0">
                                        <input type="text" class="form-control form-control-sm form-control-solid"
                                               name="firstname" required
                                               placeholder="Enter @lang('body.firstname')"/>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0 pb-0">
                                        <input type="text" class="form-control form-control-sm form-control-solid"
                                               name="secondName"
                                               placeholder="Enter @lang('body.second_name')"/>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0 pb-0">
                                        <input type="text" class="form-control form-control-sm form-control-solid"
                                               name="lastname" required
                                               placeholder="Enter @lang('body.lastname')"/>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0 pb-0">
                                        <a href="javascript:;" class="btn btn-sm btn-icon"
                                           title="@lang('body.delete')">
                                            <i class="fas fa fa-trash text-danger" data-value="item-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </form>
            </div>
            <div class="modal-footer m-1 p-1">
                <button type="button" class="btn btn-light-danger font-weight-bold"
                        data-dismiss="modal">@lang('body.cancel')
                </button>
                <button type="button" class="btn btn-light-primary font-weight-bold"
                        name="multi-save-btn">@lang('body.save')
                </button>
            </div>
        </div>
    </div>
</div>
