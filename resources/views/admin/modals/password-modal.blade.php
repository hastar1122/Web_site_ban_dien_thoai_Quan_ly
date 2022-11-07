<!-- Changes pasword Modal -->
<div class="modal fade" id="changePassword">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-info">Change Your Passowrd</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <ul id="errorlist" style="list-style:none;"></ul>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label class = "control-label col-md">Current password</label>
                        <div class="col-md">
                            <input type="password" name="oldpassword" id="oldpassword" type="text" class="form-control form-control-user" required>
                            <span toggle="#oldpassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class = "control-label col-md">New password</label>
                        <div class="col-md">
                            <input type="password" name="newpassword" id="newpassword" type="text" class="form-control form-control-user" required>
                            <span toggle="#newpassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class = "control-label col-md">Comfirm password</label>
                        <div class="col-md">
                            <input type="password" name="confirm_newpassword" id="confirm_newpassword" type="text" class="form-control form-control-user" required>
                            <span toggle="#confirm_newpassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                    </div>


                    <div class="form-group col-md">
                        <button type="button" class="btn-change-pass btn btn-outline-success"><i class="far fa-edit"></i> Update</button>
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                    </div>
                </div>

                <!-- Modal footer -->

        </div>
    </div>
</div>
