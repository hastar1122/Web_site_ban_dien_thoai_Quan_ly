<div class="modal fade" id="modal-user-add">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <form action="" data-url="{{ URL::to('/add-user') }}" id="form-user-add" method="POST" role="form">
                @csrf
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-info">Thêm tài khoản</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md">Vai trò</label>
                                    <div class="col-md">
                                        <select name="user_role" id="user-role-add" class="form-control" onmousedown="if(this.options.length>4){this.size=4;}"  onchange='this.size=0;' onblur="this.size=0;"  required>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="" class="control-label col-md">Tên người dùng</label>
                                        <div class="col-md">
                                            <input type="text" name="user_name" id="user-name-add" type="text"
                                            class="form-control form-control-user" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md">Tên tài khoản</label>
                                    <div class="col-md">
                                        <input type="text" name="user_account" id="user-account-add" type="text"
                                            class="form-control form-control-user" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md">Địa chỉ</label>
                                    <div class="col-md">
                                        <input type="text" name="user_address" id="user-address-add" type="text"
                                            class="form-control form-control-user" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md">Mật khẩu</label>
                                    <div class="col-md">
                                        <input type="text" name="user_password" id="user-password-add" type="text"
                                            class="form-control form-control-user" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md">Email</label>
                                    <div class="col-md">
                                        <input type="email" name="user_address" id="user-address-add" type="text"
                                            class="form-control form-control-user" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md">Nhập lại mật khẩu</label>
                                    <div class="col-md">
                                        <input type="text" name="user_password2" id="user-password2-add" type="text"
                                            class="form-control form-control-user">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md">Số điện thoại</label>
                                    <div class="col-md">
                                        <input type="tel" name="user_phone" id="user-phone-add" tpattern="[0-9]"
                                            class="form-control form-control-user" >
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
                                            <img height="50" src="<?php echo $image = 'http://127.0.0.1:8000/img/' . '' . Session::get('admin_image'); ?>"
                                                class="img-profile rounded-circle" alt="avatar" />
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="custom-file">
                                            <input type="file" name="ImageFile" id="customFile3"
                                                class="text-center center-block file-upload3 custom-file-input">
                                            <label class="custom-file-label loadtext3" for="customFile3">Chọn file
                                                ảnh</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br><br><br>
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
