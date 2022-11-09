
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Đăng ký</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('admin/css/sb-admin-2.min.css')}}" rel="stylesheet">
    {{-- <script src="{{asset('js/jquery.form-validator.min.js')}}"></script> --}}
    <!--  jquery script  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--  validation script  -->
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>


    <!--  jsrender script  -->
    {{-- <script src="http://cdn.syncfusion.com/js/assets/external/jsrender.min.js"></script>

    <!-- Essential JS UI widget -->
    <script src="http://cdn.syncfusion.com/16.4.0.52/js/web/ej.web.all.min.js"></script> --}}
<!--Add custom scripts here -->

    {{-- <style type="text/css">
        label.error {
            color:red;
            font-size: 12px;
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#registerForm").validate({
                rules: {
                    name: "required",
                    account: {
                        required: true,
                        minlength: 3
                    },
                    password: {
                        required: true,
                        minlength: 1
                    },
                    repassword: {
                        required: true,
                        minlength: 1,
                        equalTo: "#password"
                    },
					},
					messages: {
						name: "Please enter name",
						account: {
							required: "Please enter a username",
							minlength: "Username must be at least 3 charaters"
						},
						password: {
							required: "Please provide a password",
							minlength: ""
						},
						repassword: {
							required: 'Please repeat your password',
							equalTo: 'Repassword not match'
						}
					}
                }
            )
        })
    </script> --}}

</head>

<body class="bg-gradient-primary">
    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Đăng ký</h1>
                            </div>
                            {{-- @include('errors/note') --}}
                            <form class="user" id="registerForm" {{URL::to('/register')}} method="POST">
                                {{ csrf_field() }} <!--token tránh lỗi injection-->
                                {{ method_field('POST') }}
                                <div class="form-group">
                                    <input id="name" name="name" type="text" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Nhập họ tên" required value="{{old('name')}}">
                                    @if ($errors->has('name'))
                                        <span class="text-danger small">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input id="account" name="account" type="text" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Nhập tài khoản" required value="{{old('account')}}">
                                    @if ($errors->has('account'))
                                        <span class="text-danger small">{{ $errors->first('account') }}</span>
                                    @endif
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input id="password" name="password" type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Nhập mật khẩu" required >
                                        @if ($errors->has('password'))
                                            <span class="text-danger small">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        <input id="repassword" name="repassword" type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Xác nhận mật khẩu" required value="{{old('repassword')}}">
                                        @if ($errors->has('repassword'))
                                            <span class="text-danger small">{{ $errors->first('repassword') }}</span>
                                        @endif
                                    </div>
                                    <input id="role" name="role" type="number" value="1" class="form-control form-control-user" hidden>
                                </div>
                                <?php
                                    $message = Session::get('message');
                                    if ($message) {
                                        echo '<span class="small" style = "color: red;">'.$message.'</span>';
                                        Session::put('message', NULL);
                                    }
                                ?>
                                <input type="submit" value="Đăng ký"  class="btn btn-primary btn-user btn-block">
                            </form>
                            <hr>
                            <div class="text-center">
                            <div class="text-center">
                                <a class="small" href="{{URL::to('/login')}}">Tôi đã có tài khoản? Đăng nhập!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <!-- Bootstrap core JavaScript-->
    {{-- <script src="vendor/jquery/jquery.min.js"></script> --}}
    <script src=" {{asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('admin/js/sb-admin-2.min.js')}}"></script>

</body>

</html>
