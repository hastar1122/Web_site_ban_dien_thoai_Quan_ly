<div class="modal fade" id="modal-category-add">
    <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable">
        <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-info">Thêm loại đặc trưng</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="" class="control-label col-md">Tên đặc trưng</label>
                                    <div class="col-md">
                                        <div >
                                            <select class="form-control" id="dropdownProductAttribute">
                                                @foreach ($all_attr_no_add as $attr)
                                                    <option value="{{$attr -> AttributeID}}">{{$attr -> AttributeName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn-them-dac-trung btn btn-outline-success"><i class="far fa-edit"></i>
                            Thêm</button>
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><i
                                class="fas fa-times"></i>Đóng</button>
                    </div>
                </div>
        </div>
    </div>
</div>
