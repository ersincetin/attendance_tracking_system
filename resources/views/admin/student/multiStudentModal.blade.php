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
