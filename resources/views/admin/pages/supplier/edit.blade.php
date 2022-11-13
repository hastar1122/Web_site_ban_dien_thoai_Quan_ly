<div class="modal fade" id="modal-supplier-edit">
    <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable">
        <div class="modal-content">
            <form action="" data-url="" id="form-supplier-edit" method="POST"
                role="form">
                @csrf
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-info">Cập nhật nhà cung cấp</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="form-group ">
                            <label class="control-label col-md">Tên nhà cung cấp</label>
                            <div class="col-md">
                                <input type="text" name="supplier_name" id="supplier-name-edit" type="text"
                                    class="form-control form-control-user" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="control-label col-md">Địa chỉ</label>
                            <div class="col-md">
                                <input type="text" name="address_name" id="address-edit" type="text"
                                    class="form-control form-control-user" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group ">
                            <label class="control-label col-md">Email</label>
                            <div class="col-md">
                                <input type="text" name="email_name" id="email-edit" type="text"
                                    class="form-control form-control-user" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="control-label col-md">Số điện thoại</label>
                            <div class="col-md">
                                <input type="text" name="phone_number" id="phone-number-edit" type="text" tpattern="[0-9]"
                                    class="form-control form-control-user" required>
                            </div>
                        </div>
                    </div>
                   
                </div>

                <div class="modal-footer">
                    <div class="">
                        <button type="submit" class="update2 btn btn-outline-success"><i class="far fa-edit"></i>
                            Cập nhật</button>
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><i
                                class="fas fa-times"></i>Đóng</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
