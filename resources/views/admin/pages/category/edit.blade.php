<div class="modal fade" id="modal-category-edit">
    <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable">
        <div class="modal-content">
            <form action="" data-url="" id="form-category-edit" method="POST" role="form">
                @csrf
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-info">Cập nhật loại sản phẩm</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="form-group ">
                            <label class="control-label col-md">Tên loại sản phẩm</label>
                            <div class="col-md">
                                <input type="text" name="category_name" id="category-name-edit" type="text"
                                    class="form-control form-control-user" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="" class="control-label col-md">Của loại sản phẩm</label>
                                <div class="col-md">
                                    <select name="category_parent" id="category-parent-edit"
                                        onmousedown="if(this.options.length>4){this.size=4;}" onchange='this.size=0;'
                                        onblur="this.size=0;" class="form-control">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="">
                        <button type="submit" class=" btn btn-outline-success"><i class="far fa-edit"></i>
                            Cập nhật</button>
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><i
                                class="fas fa-times"></i> Đóng</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
