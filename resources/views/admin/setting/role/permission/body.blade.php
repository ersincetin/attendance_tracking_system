<div class="card card-custom col-xxl-12">
    <div class="card-header flex-wrap border-0 pt-0 pb-0 mr-1 pr-1">
        <div class="card-title">
            &nbsp;
        </div>
        <div class="card-toolbar">
            <a href="javascript:;" class="btn btn-outline-primary font-weight-bolder" name="save-btn">
                <i class="fas fa fa-check-double"></i> @lang('body.save')
            </a>
        </div>
    </div>
    <div class="card-body m-1 p-1">
        <form class="form" name="permission-form">
            <div class="accordion  accordion-toggle-arrow" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <div class="card-title" data-toggle="collapse" data-target="#collapseOne">
                            <i class="fas fa fa-users"></i> Users
                        </div>
                    </div>
                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="form-group row" name="user-all-check">
                                <div class="col-auto col-form-label">
                                    <div class="checkbox-inline">
                                        <span class="text text-sm font-size-xs ml-3"
                                              name="user"><i class="la la-check-square la-2x text-primary"
                                                             data-label="user-all-check"></i></span>
                                    </div>
                                </div>
                                <div class="col-auto col-form-label">
                                    <div class="checkbox-inline">
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="reading" data-label="user"/>
                                            <span></span>
                                            Reading
                                        </label>
                                    </div>
                                </div>
                                <div class="col-auto col-form-label">
                                    <div class="checkbox-inline">
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="listening" data-label="user"
                                            />
                                            <span></span>
                                            Listening
                                        </label>
                                    </div>
                                </div>
                                <div class="col-auto col-form-label">
                                    <div class="checkbox-inline">
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="creating" data-label="user"/>
                                            <span></span>
                                            Creating
                                        </label>
                                    </div>
                                </div>
                                <div class="col-auto col-form-label">
                                    <div class="checkbox-inline">
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="updating" data-label="user"/>
                                            <span></span>
                                            Updating
                                        </label>
                                    </div>
                                </div>
                                <div class="col-auto col-form-label">
                                    <div class="checkbox-inline">
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="deleting" data-label="user"/>
                                            <span></span>
                                            Deleting
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo">
                            <i class="fas fa fa-users"></i> Teachers
                        </div>
                    </div>
                    <div id="collapseTwo" class="collapse" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="form-group row" name="teacher-all-check">
                                <div class="col-auto col-form-label">
                                    <div class="checkbox-inline">
                                        <span class="text text-sm font-size-xs ml-3"
                                              name="user"><i class="la la-check-square la-2x text-primary"
                                                             data-label="teacher-all-check"></i></span>
                                    </div>
                                </div>
                                <div class="col-auto col-form-label">
                                    <div class="checkbox-inline">
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="reading" data-label="teacher"/>
                                            <span></span>
                                            Reading
                                        </label>
                                    </div>
                                </div>
                                <div class="col-auto col-form-label">
                                    <div class="checkbox-inline">
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="listening" data-label="teacher"
                                            />
                                            <span></span>
                                            Listening
                                        </label>
                                    </div>
                                </div>
                                <div class="col-auto col-form-label">
                                    <div class="checkbox-inline">
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="creating" data-label="teacher"
                                            />
                                            <span></span>
                                            Creating
                                        </label>
                                    </div>
                                </div>
                                <div class="col-auto col-form-label">
                                    <div class="checkbox-inline">
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="updating" data-label="teacher"
                                            />
                                            <span></span>
                                            Updating
                                        </label>
                                    </div>
                                </div>
                                <div class="col-auto col-form-label">
                                    <div class="checkbox-inline">
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="deleting" data-label="teacher"
                                            />
                                            <span></span>
                                            Deleting
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree4">
                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree">
                            <i class="fas fa fa-users"></i> Student Affairs
                        </div>
                    </div>
                    <div id="collapseThree" class="collapse" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="form-group row" name="student-affairs-all-check">
                                <div class="col-auto col-form-label">
                                    <div class="checkbox-inline">
                                        <span class="text text-sm font-size-xs ml-3"
                                              name="user"><i class="la la-check-square la-2x text-primary"
                                                             data-label="student-affairs-all-check"></i></span>
                                    </div>
                                </div>
                                <div class="col-auto col-form-label">
                                    <div class="checkbox-inline">
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="reading" data-label="student-affairs"
                                            />
                                            <span></span>
                                            Reading
                                        </label>
                                    </div>
                                </div>
                                <div class="col-auto col-form-label">
                                    <div class="checkbox-inline">
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="listening" data-label="student-affairs"
                                            />
                                            <span></span>
                                            Listening
                                        </label>
                                    </div>
                                </div>
                                <div class="col-auto col-form-label">
                                    <div class="checkbox-inline">
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="creating" data-label="student-affairs"
                                            />
                                            <span></span>
                                            Creating
                                        </label>
                                    </div>
                                </div>
                                <div class="col-auto col-form-label">
                                    <div class="checkbox-inline">
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="updating" data-label="student-affairs"
                                            />
                                            <span></span>
                                            Updating
                                        </label>
                                    </div>
                                </div>
                                <div class="col-auto col-form-label">
                                    <div class="checkbox-inline">
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="deleting" data-label="student-affairs"
                                            />
                                            <span></span>
                                            Deleting
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFour">
                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFour">
                            <i class="fas fa fa-users"></i> Students
                        </div>
                    </div>
                    <div id="collapseFour" class="collapse" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="form-group row" name="student-all-check">
                                <div class="col-auto col-form-label">
                                    <div class="checkbox-inline">
                                        <span class="text text-sm font-size-xs ml-3"
                                              name="user"><i class="la la-check-square la-2x text-primary"
                                                             data-label="student-all-check"></i></span>
                                    </div>
                                </div>
                                <div class="col-auto col-form-label">
                                    <div class="checkbox-inline">
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="reading" data-label="student"/>
                                            <span></span>
                                            Reading
                                        </label>
                                    </div>
                                </div>
                                <div class="col-auto col-form-label">
                                    <div class="checkbox-inline">
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="listening" data-label="student"/>
                                            <span></span>
                                            Listening
                                        </label>
                                    </div>
                                </div>
                                <div class="col-auto col-form-label">
                                    <div class="checkbox-inline">
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="creating" data-label="student"/>
                                            <span></span>
                                            Creating
                                        </label>
                                    </div>
                                </div>
                                <div class="col-auto col-form-label">
                                    <div class="checkbox-inline">
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="updating" data-label="student"/>
                                            <span></span>
                                            Updating
                                        </label>
                                    </div>
                                </div>
                                <div class="col-auto col-form-label">
                                    <div class="checkbox-inline">
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="deleting" data-label="student"/>
                                            <span></span>
                                            Deleting
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFive">
                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFive">
                            <i class="fas fa fa-cogs"></i> Settings
                        </div>
                    </div>
                    <div id="collapseFive" class="collapse" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="col-12">
                                <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample3">
                                    <div class="card">
                                        <div class="card-header" id="headingOne3">
                                            <div class="card-title" data-toggle="collapse"
                                                 data-target="#collapseOne3">
                                                Roles
                                            </div>
                                        </div>
                                        <div id="collapseOne3" class="collapse show"
                                             data-parent="#accordionExample3">
                                            <div class="card-body">
                                                <div class="form-group row" name="setting-role-all-check">
                                                    <div class="col-auto col-form-label">
                                                        <div class="checkbox-inline">
                                                            <span class="text text-sm font-size-xs ml-3"
                                                                  name="user"><i
                                                                    class="la la-check-square la-2x text-primary"
                                                                    data-label="setting-role-all-check"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto col-form-label">
                                                        <div class="checkbox-inline">
                                                            <label
                                                                class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                                                <input type="checkbox" name="reading"
                                                                       data-label="setting-role"/>
                                                                <span></span>
                                                                Reading
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto col-form-label">
                                                        <div class="checkbox-inline">
                                                            <label
                                                                class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                                                <input type="checkbox" name="listening"
                                                                       data-label="setting-role"/>
                                                                <span></span>
                                                                Listening
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto col-form-label">
                                                        <div class="checkbox-inline">
                                                            <label
                                                                class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                                                <input type="checkbox" name="creating"
                                                                       data-label="setting-role"/>
                                                                <span></span>
                                                                Creating
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto col-form-label">
                                                        <div class="checkbox-inline">
                                                            <label
                                                                class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                                                <input type="checkbox" name="updating"
                                                                       data-label="setting-role"/>
                                                                <span></span>
                                                                Updating
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto col-form-label">
                                                        <div class="checkbox-inline">
                                                            <label
                                                                class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                                                <input type="checkbox" name="deleting"
                                                                       data-label="setting-role"/>
                                                                <span></span>
                                                                Deleting
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingTwo3">
                                            <div class="card-title collapsed" data-toggle="collapse"
                                                 data-target="#collapseTwo3">
                                                Period
                                            </div>
                                        </div>
                                        <div id="collapseTwo3" class="collapse" data-parent="#accordionExample3">
                                            <div class="card-body">
                                                <div class="form-group row" name="setting-period-all-check">
                                                    <div class="col-auto col-form-label">
                                                        <div class="checkbox-inline">
                                                            <span class="text text-sm font-size-xs ml-3"
                                                                  name="user"><i
                                                                    class="la la-check-square la-2x text-primary"
                                                                    data-label="setting-period-all-check"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto col-form-label">
                                                        <div class="checkbox-inline">
                                                            <label
                                                                class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                                                <input type="checkbox" name="reading"
                                                                       data-label="setting-period"/>
                                                                <span></span>
                                                                Reading
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto col-form-label">
                                                        <div class="checkbox-inline">
                                                            <label
                                                                class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                                                <input type="checkbox" name="listening"
                                                                       data-label="setting-period"/>
                                                                <span></span>
                                                                Listening
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto col-form-label">
                                                        <div class="checkbox-inline">
                                                            <label
                                                                class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                                                <input type="checkbox" name="creating"
                                                                       data-label="setting-period"/>
                                                                <span></span>
                                                                Creating
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto col-form-label">
                                                        <div class="checkbox-inline">
                                                            <label
                                                                class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                                                <input type="checkbox" name="updating"
                                                                       data-label="setting-period"/>
                                                                <span></span>
                                                                Updating
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto col-form-label">
                                                        <div class="checkbox-inline">
                                                            <label
                                                                class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                                                <input type="checkbox" name="deleting"
                                                                       data-label="setting-period"/>
                                                                <span></span>
                                                                Deleting
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

