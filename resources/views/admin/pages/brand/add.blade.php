    <div class="modal fade" id="modal-brand-add">
        <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable">
            <div class="modal-content">
                <form action="" data-url="{{ URL::to('/add-brand') }}" id="form-brand-add" method="POST"
                    role="form">
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-info">Thêm thương hiệu</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group ">
                                <label class="control-label col-md">Tên thương hiệu</label>
                                <div class="col-md">
                                    <input type="text" name="brand_name" id="brand-name-add" type="text"
                                        class="form-control form-control-user" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="" class="control-label col-md">Của thương hiệu</label>
                                    <div class="col-md">
                                        <select name="brand_parent" id="brand-parent-add" class="form-control" onmousedown="if(this.options.length>4){this.size=4;}"  onchange='this.size=0;' onblur="this.size=0;"  >
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>

                    <div class="modal-footer">
                        <div class="">
                            <button type="submit" class="update2 btn btn-outline-success"><i class="far fa-edit"></i>
                                Thêm</button>
                            <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><i
                                    class="fas fa-times"></i>Đóng</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
