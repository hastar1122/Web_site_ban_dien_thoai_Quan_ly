<!-- Changes pasword Modal -->
<div class="modal fade" id="changePassword">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-info">Đổi mật khẩu</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <ul id="errorlist" style="list-style:none;"></ul>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md">Mật khẩu hiện tại</label>
                    <div class="col-md">
                        <input type="password" name="oldpassword" id="oldpassword" type="text"
                            class="form-control form-control-user" required>
                        <span toggle="#oldpassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md">Mật khẩu mới</label>
                    <div class="col-md">
                        <input type="password" name="newpassword" id="newpassword" type="text"
                            class="form-control form-control-user" required>
                        <span toggle="#newpassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md">Xác nhận mật khẩu</label>
                    <div class="col-md">
                        <input type="password" name="confirm_newpassword" id="confirm_newpassword" type="text"
                            class="form-control form-control-user" required>
                        <span toggle="#confirm_newpassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                </div>


                <div class="form-group col-md">
                    <button type="button" class="btn-change-pass btn btn-outline-success"><i class="far fa-edit"></i>
                        Cập nhật</button>
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><i
                            class="fas fa-times"></i> Đóng</button>
                </div>
            </div>

            <!-- Modal footer -->

        </div>
    </div>
</div>

{{-- Changes password js --}}
<script>
    $(document).ready(function() {
        //change
        $(".btn-change-pass").click(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if ($("#newpassword").val() == '' || $("#confirm_newpassword").val() == '' || $(
                    "#confirm_newpassword").val() == '') {
                toastr.error("Không được bỏ trống", "Thất bại");
                return;
            }
            if ($("#newpassword").val() != $("#confirm_newpassword").val()) {
                toastr.error("Mật khẩu không khớp", "Thất bại");
                return;
            }
            var formdata = new FormData();
            formdata.append("oldpassword", $("#oldpassword").val());
            formdata.append("newpassword", $("#newpassword").val());
            formdata.append("confirm_newpassword", $("#confirm_newpassword").val());

            for (const value of formdata.values()) {
                console.log(value);
            }
            var url = "{{ route('Password.update', Auth::check() ? Auth::user()->UserID : 0) }}";
            formdata.append("_method", "PUT");
            $.ajax({
                url: url,
                data: formdata,
                contentType: false,
                processData: false,
                cache: false,
                dataType: 'json',
                type: 'POST',
                success: function(data) {
                    console.log(data);
                    toastr.success("Thay đổi mật khẩu thành công", "Thành công");
                    setTimeout(function() {
                        location.reload(true);
                    }, 1000);
                },
                error: function(response) {
                    var respArray = JSON.parse(response.responseText).errors;
                    if (respArray == null) {
                        toastr.error('Nhập sai mật khẩu hiện tại', "Thất bại");
                    } else {
                        // $('#errorlist').html("");
                        // $('#errorlist').addClass('alert alert-danger');
                        $.each(respArray, function(key, error_val) {
                            //$('#errorlist').append('<li>' + error_val + '</li>')
                            toastr.error(error_val, "Thất bại");
                        });
                    }
                }

            });
        });
    })
</script>

{{-- show password --}}
<script>
    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>
