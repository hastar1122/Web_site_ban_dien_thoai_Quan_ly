<!-- log in -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">Đăng nhập</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="form-client-login" method="post"
                    client-login-url="{{ URL::to('/postLogin') }}">
                    <div class="form-group">
                        <label class="col-form-label">Tài khoản</label>
                        <input type="text" class="form-control" placeholder=" " id="username" name="username"
                            required="">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Mật khẩu</label>
                        <input type="password" class="form-control" placeholder=" " id="password1" name="password1"
                            required="">
                    </div>
                    <div class="right-w3l">
                        <input type="submit" class="form-control" value="Đăng nhập">
                    </div>
                    <div class="sub-w3l">
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                            <label class="custom-control-label" for="customControlAutosizing">Ghi nhớ</label>
                        </div>
                    </div>
                    <p class="text-center dont-do mt-3">Bạn chưa có tài khoản?
                        <a href="#" id="btn-register" data-toggle="modal" data-target="#exampleModal2">
                            Đăng kí ngay</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('#btn-register').click(function() {
            $("#exampleModal").modal('hide');
            console.log("asadfas");
        });
        $("#form-client-login").submit(function(e) {
            e.preventDefault();
            var url = $(this).attr("client-login-url");
            $.ajax({
                type: "post",
                url: url,
                data: {
                    _token: "{{ csrf_token() }}",
                    username: $("#username").val(),
                    password1: $("#password1").val(),
                },
                success: function(data) {
                    toastr.success("Đăng nhập thành công", "Thành công");
                    $("#exampleModal").modal('hide');
                    location.reload();
                    // window.location.href = "{{ URL::to('/logClient') }}";
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    toastr.error("Sai tên tài khoản hoặc mật khẩu", "Thất bại");
                },
            });
        });
    });
</script>
