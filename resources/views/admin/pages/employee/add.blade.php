<div class="modal fade" id="modal-employee-add">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <form action="" data-url="{{ URL::to('/add-employee') }}" id="form-employee-add" method="POST"
                role="form">
                @csrf
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-info">Thêm nhân viên</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md">Tên tài khoản</label>
                                    <div class="col-md">
                                        <input type="text" name="employee_account" id="employee-account-add"
                                            type="text" class="form-control form-control-user" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="" class="control-label col-md">Tên nhân viên</label>
                                        <div class="col-md">
                                            <input type="text" name="employee_name" id="employee-name-add"
                                                type="text" class="form-control form-control-user" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md">Mật khẩu</label>
                                    <div class="col-md">
                                        <input type="text" name="employee_password" id="employee-password-add"
                                            type="text" class="form-control form-control-user"
                                            placeholder="Mật khẩu mặc định là: 1" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md">Số điện thoại</label>
                                    <div class="col-md">
                                        <input type="tel" name="employee_phone" id="employee-phone-add"
                                            tpattern="[0-9]" class="form-control form-control-user">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md">Địa chỉ</label>
                                    <div class="col-md">
                                        <input type="text" name="employee_address" id="employee-address-add"
                                            type="text" class="form-control form-control-user">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md">Email</label>
                                    <div class="col-md">
                                        <input type="email" name="employee_email" id="employee-email-add"
                                            type="text" class="form-control form-control-user">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label col-md">Ảnh</label>
                                <div class="card border-info shadow-sm">
                                    <div class="card-header">Tải ảnh lên</div>
                                    <div class="card-body">
                                        <div class="text-center">
                                            <img height="150" width="150" src="" style="object-fit:cover;"
                                                id="image_preview_container" class="img-profile" alt="avatar" />
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="custom-file">
                                            <input type="file" id="imageid" name="imageemployee" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="d-flex justify-content-end ">
                                <button type="submit" class="update2 btn btn-outline-success"><i
                                        class="far fa-edit"></i>
                                    Thêm</button>&nbsp;&nbsp;
                                <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><i
                                        class="fas fa-times"></i> Đóng</button>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">

                </div>
            </form>
        </div>
    </div>
</div>
