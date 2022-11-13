@extends('admin.layouts.app')

@section('content')

<div class="card shadow mb-4 border-left-info">
    <div class="card-header py-3">
        <div class="float-left mt-2">
            <h5 class="m-0 font-weight-bold text-primary">Danh sách các thuộc tính</h5>
        </div>
        <div class="float-right mb-n3">
            <a data-toggle="modal" href="#addModal" class="btn btn-primary mb-3 btn-icon-split">
                <span class="icon text-white">
                    <i class="fas fa-plus-circle"></i>
                </span>
                <span class="text">Thêm mới</span>
            </a>
        </div>
    </div>
    @php
        $i = 1;
    @endphp
    <div class="card-body LoadAllHocPhan">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th width="1%">
                            STT
                        </th>
                        <th>
                            Tên thuộc tính
                        </th>
                        <th width="90px">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attributes as $item)
                        <tr>
                            <td class="text-center">
                                {{ $i }}
                            </td>
                            <td class="text-center">
                                {{ $item->VariationName }}
                            </td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="/attributes/{{$item->VariationID}}/edit" data-toggle="tooltip" title="Sửa"> <i class="far fa-edit"></i></a>
                                <a class="btn btn-sm btn-info" data-toggle="tooltip" title="Thông tin"> <i class="fas fa-info-circle"></i></a>
                                <a class="delete btn btn-sm btn-danger" data-id="@item.MaHP" data-toggle="tooltip" title="Xóa"> <i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
    </div>
</div>


<!-- The Modal -->
<div class="modal fade" id="delModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-primary">Thông báo</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <h6 class="text text-warning text-wr">Bạn có muốn xóa loại đặc trưng này không ?</h6>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="form-actions no-color">
                    <button type="button" value="" data-dismiss="modal" class="Xoa btn btn-outline-danger far fa-trash-alt"> Xóa </button>
                </div>
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal"> Không </button>
            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();

        $(".nav-1").addClass("show");

        $('body').on('click', '.delete', function () {
            $('#delModal').modal();
            $(".Xoa").val($(this).attr('data-id'));
        });

        $('body').on('click', '.create', function () {
            var TenHP = $("#TenHP").val();
            var SoTinChi = $("#SoTinChi").val();
            var formData2 = new FormData;
            formData2.append("TenHP", TenHP);
            formData2.append("SoTinChi", SoTinChi);
            $.ajax({
                async: true,
                url: '@Url.Action("Create", "HocPhan")',
                data: formData2,
                contentType: false,
                processData: false,
                dataType: 'json',
                type: 'POST',
                success: function (data) {
                    if (data.status == true) {
                        LoadAllHocPhan();
                        toastr.options.positionClass = "toast-bottom-right";
                        toastr.success("Thêm mới thành công");
                        $('#addModal').modal('hide');
                        $("#TenHP").val('');
                        $("#SoTinChi").val('');
                    }
                    else {
                        alert(data.status);
                        toastr.options.positionClass = "toast-bottom-right";
                        toastr.warning('Thêm mới không thành công');
                    }
                },
                error: function () {
                    toastr.options.positionClass = "toast-bottom-right";
                    toastr.warning('Thêm mới không thành công');
                }
            });
        });

        $('body').on('click', '.Xoa', function () {
            var MaHP = $(".Xoa").val();
            $.ajax({
                async: true,
                url: '@Url.Action("Delete", "HocPhan")',
                data: { id: MaHP },
                dataType: 'json',
                type: "POST",
                success: function (data) {
                    if (data.status == true) {
                        LoadAllHocPhan();
                        toastr.options.positionClass = "toast-bottom-right";
                        toastr.success("Xóa thành công");
                    }
                    if (data.status == false) {
                        alert("Không thể xóa học phần này");
                        toastr.options.positionClass = "toast-bottom-right";
                        toastr.warning("Xóa không thành công");
                    }
                },
                error: function () {
                    toastr.options.positionClass = "toast-bottom-right";
                    toastr.warning('Xóa không thành công');
                }
            });
        });

        $(".update").click(function () {
            var MaHP = $("#MaHP2").val();
            var TenHP = $("#TenHP2").val();
            var SoTinChi = $("#SoTC2").val();
            var formData = new FormData;
            formData.append("MaHP", MaHP);
            formData.append("TenHP", TenHP);
            formData.append("SoTinChi", SoTinChi);
            $.ajax({
                async: true,
                url: '@Url.Action("CapNhatHocPhan", "HocPhan")',
                contentType: false,
                processData: false,
                data: formData,
                dataType: 'json',
                type: 'POST',
                success: function (data) {
                    if (data.status == true) {
                        LoadAllHocPhan();
                        toastr.options.positionClass = "toast-bottom-right";
                        toastr.success("Chỉnh sửa thành công");
                        $('#infModal').modal('hide');
                    }
                    else {
                        alert(data.status);
                        toastr.options.positionClass = "toast-bottom-right";
                        toastr.warning('Chỉnh sửa không thành công');
                    }
                },
                error: function () {
                    toastr.options.positionClass = "toast-bottom-right";
                    toastr.warning('Chỉnh sửa không thành công');
                }

            });
        });

        function LoadAllHocPhan() {
            $('#dataTable').DataTable().clear();
            $('.table-responsive').remove();
            $.ajax({
                url: '@Url.Action("LoadAllHocPhan", "HocPhan")',
                dataType: 'html',
                type: 'GET',
                contentType: false,
                processData: false,
                success: function (data) {
                    $('.LoadAllHocPhan').html(data);
                    $('#dataTable').DataTable().draw();
                    $('[data-toggle="tooltip"]').tooltip();
                },
                error: function () {
                    alert("Đã có lỗi xảy ra");
                },
            });
        }
    });
</script>
@endsection