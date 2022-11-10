<!-- register -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Đăng kí</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="form-client-register"
                    client-register-url="{{ URL::to('/register') }}">
                    {{ csrf_field() }}
                    <!--token tránh lỗi injection-->
                    {{ method_field('POST') }}
                    <div class="form-group">
                        <label class="col-form-label">Họ tên</label>
                        <input type="text" class="form-control" placeholder=" " name="name" id="name"
                            required="">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Tài khoản</label>
                        <input type="text" class="form-control" placeholder=" " name="account" id="account"
                            required="">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Mật khẩu</label>
                        <input type="password" class="form-control" placeholder=" " name="password" id="password"
                            required="">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Xác nhận mật khẩu</label>
                        <input type="password" class="form-control" placeholder=" " name="repassword" id="repassword"
                            required="">
                    </div>
                    <div class="right-w3l">
                        <input type="submit" id="client-register-url" class="form-control" value="Đăng ký">
                    </div>
                    <input id="role" name="role" type="number" value="4"
                        class="form-control form-control-user" hidden>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
      
        $("#form-client-register").submit(function(e) {
            e.preventDefault();

            var url = $(this).attr("client-register-url");
            console.log($("#name").val());
            console.log($("#account").val());
            console.log($("#password").val());
            console.log($("#repassword").val());
            console.log($("#role").val());
            $.ajax({
                type: "post",
                url: url,
                data: {
                    _token: "{{ csrf_token() }}",
                    name: $("#name").val(),
                    account: $("#account").val(),
                    password: $("#password").val(),
                    repassword: $("#repassword").val(),
                    role: $("#role").val(),
                },
                success: function(data) {
                    toastr.success("Đăng kí thành công", "Thành công");
                    $("#exampleModal2").modal('hide');
                    //location.reload();
                    window.location.href = "{{ URL::to('/showClient') }}";
                },
                error: function(response) {
                    var respArray = JSON.parse(response.responseText).errors;
                    if (respArray == null) {
                        toastr.error("Tài khoản đã tồn tại", "Thất bại");
                    } else {
                        // $('#errorlist').html("");
                        // $('#errorlist').addClass('alert alert-danger');
                        $.each(respArray, function(key, error_val) {
                            //$('#errorlist').append('<li>' + error_val + '</li>')
                            toastr.error(error_val, "Thất bại");
                        });
                    }
                },
            });
        });
    });
</script>
