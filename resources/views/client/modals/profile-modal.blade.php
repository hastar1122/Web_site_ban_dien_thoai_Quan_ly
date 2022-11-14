    <!-- Profile Modal -->
    <div class="modal fade" id="infUserModal">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
            <div class="modal-content" form-url="{{ route('Account.update', Auth::check() ? Auth::user()->UserID : 0) }}">

                {{--  --}}
                {{-- <form method="POST" enctype="multipart/form-data" id="form-profile" action="{{route('Account.update')}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT"> --}}
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-info">Hồ sơ</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">


                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md">Họ tên</label>
                                    <div class="col-md">
                                        <input type="text" id="nameid" name="name" type="text" required
                                            class="form-control form-control-user" value="<?php if (Auth::check()) {
                                                echo Auth::user()->UserName;
                                            } ?>">
                                        @if ($errors->has('name'))
                                            <span class="text-danger small">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label col-md">Địa chỉ</label>
                                    <div class="col-md">
                                        <input type="text" id="addressid" name="address" type="text"
                                            class="form-control form-control-user" value="<?php if (Auth::check()) {
                                                echo Auth::user()->Address;
                                            } ?>">
                                        @if ($errors->has('address'))
                                            <span class="text-danger small">{{ $errors->first('address') }}</span>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md">Email</label>
                                    <div class="col-md">
                                        <input type="email" id="emailid" name="email" type="text" required
                                            class="form-control form-control-user" value="<?php if (Auth::check()) {
                                                echo Auth::user()->Email;
                                            } ?>">
                                        @if ($errors->has('email'))
                                            <span class="text-danger small">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label col-md">Số điện thoại</label>
                                    <div class="col-md">
                                        <input type="text" id="phoneid" name="phone" type="text" required
                                            class="form-control form-control-user" value="<?php if (Auth::check()) {
                                                echo Auth::user()->PhoneNumber;
                                            } ?>">
                                        @if ($errors->has('phone'))
                                            <span class="text-danger small">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <button type="button" id="btn-update-profile"
                                    class="btn-update-profile btn btn-outline-success"><i class="far fa-edit"></i>Cập
                                    nhật</button>
                                <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><i
                                        class="fas fa-times"></i>Đóng</button>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label col-md">Ảnh</label>
                                <div class="card border-info shadow-sm">
                                    <div class="card-header">Ảnh cập nhật</div>
                                    <div class="card-body">
                                        <div class="text-center">
                                            <img height="100" width="150" src="<?php if (Auth::check()) {
                                                echo $image = 'http://127.0.0.1:8000/admin/img/' . '' . Auth::user()->Image;
                                            } ?>"
                                                id="image_preview_container" class="img-profile" alt="avatar" />
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="custom-file">
                                            <input hidden type="text" id="fakeimageid" name="fakeimage"
                                                value="<?php if (Auth::check()) {
                                                    echo Auth::user()->Image;
                                                } ?>">
                                            <input type="file" id="imageid" name="image" value="cc">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                {{-- </form> --}}
            </div>
        </div>
    </div>

    {{-- Update profile js --}}
    <script>
        $(document).ready(function() {
            // image preview
            $("#imageid").change(function() {
                let reader = new FileReader();

                reader.onload = (e) => {
                    $("#image_preview_container").attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            })

            //update
            $(".btn-update-profile").click(function() {
                var input = document.getElementById('imageid');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var formdata = new FormData();
                formdata.append("name", $("#nameid").val());
                formdata.append("address", $("#addressid").val());
                formdata.append("email", $("#emailid").val());
                formdata.append("phone", $("#phoneid").val());

                // fake image
                if ($("#imageid").get(0).files[0])
                    formdata.append("image", $("#imageid").get(0).files[0]);
                else
                    formdata.append("image", $("#fakeimageid").val());
                formdata.append("fakeimage", $("#fakeimageid").val());
                for (const value of formdata.values()) {
                    console.log(value);
                }
                formdata.append("_method", "PUT");
                var url = "{{ route('Account.update', Auth::check() ? Auth::user()->UserID : 0) }}";
                $.ajax({
                    url: url,
                    contentType: false,
                    processData: false,
                    cache: false,
                    data: formdata,
                    dataType: 'json',
                    type: 'POST',

                    success: function(data) {
                        toastr.success("Cập nhật thành công", "Thành công");
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000);
                    },
                    error: function(response) {
                        var respArray = JSON.parse(response.responseText).errors;
                        if (respArray == null) {
                            toastr.error('Cập nhật thất bại', "Thất bại");
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
