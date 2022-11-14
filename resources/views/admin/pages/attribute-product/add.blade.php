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

<script type="text/javascript">
    $(document).ready(function() {

        $('.btn-them-dac-trung').click(function(e) {
            var value = $('#dropdownProduct').val();
            url = "{{ URL::to('/add-attribute-product/')}}" +'/'+ value;
            console.log(url);
            console.log($("#dropdownProductAttribute").val());
            $.ajax({
                type: 'post',
                url: url,
                dataType: "html",
                data: {
                    attr_id: $("#dropdownProductAttribute").val(),
                },
                success: function(data) {
                    toastr.success("Thêm mới đặc trưng thành công!","Thành công");
                    window.location.href = "{{ URL::to('/show-attribute-product-all/') }}" +'/'+ value;
                },
                error: function(jqXHR, textStatus, errorThrown) {
                }
            })
        });

        $(".btn-delete-attr").click(function() {
                var value = $('#dropdownProduct').val();
                var url = $(this).attr("delete-attr-url");
                console.log(url);
                console.log( $("#dropdownProduct").val());
                if (confirm("Bạn có chắc muốn xóa không?")) {
                    $.ajax({
                        type: "get",
                        dataType: "html",
                        url: url,
                        data: {
                            value: value,
                        },
                        success: function(data) {
                            toastr.success("Xóa đặc trưng thành công!");
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            window.location.href = "{{ URL::to('/show-attribute-product-all/') }}" +'/'+ value;
                            toastr.success("Xóa đặc trưng thành công!");
                        },
                    });
                }
            });
    });
</script>
