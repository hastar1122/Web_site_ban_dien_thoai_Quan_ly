    <!-- Profile Modal -->
    <div class="modal fade" id="infUserModal">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
            <div class="modal-content" form-url="{{route('Account.update', Auth::user()->UserID )}}">

                {{--  --}}
                {{-- <form method="POST" enctype="multipart/form-data" id="form-profile" action="{{route('Account.update')}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT"> --}}
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-info">Profile Info</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">


                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class = "control-label col-md">Fullname</label>
                                        <div class="col-md">
                                            <input type="text" id="nameid" name="name" type="text" required class="form-control form-control-user" value="<?php echo Auth::user()->UserName; ?>">
                                            @if ($errors->has('name'))
                                                <span class="text-danger small">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class = "control-label col-md">Address</label>
                                        <div class="col-md">
                                            <input type="text" id="addressid" name="address" type="text" class="form-control form-control-user" value="<?php echo Auth::user()->Address; ?>">
                                            @if ($errors->has('address'))
                                                <span class="text-danger small">{{ $errors->first('address') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class = "control-label col-md">Email</label>
                                        <div class="col-md">
                                            <input type="email" id="emailid" name="email" type="text" required class="form-control form-control-user" value="<?php echo Auth::user()->Email; ?>">
                                            @if ($errors->has('email'))
                                                <span class="text-danger small">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class = "control-label col-md">Phone number</label>
                                        <div class="col-md">
                                            <input type="text" id="phoneid" name="phone" type="text" required class="form-control form-control-user" value="<?php echo Auth::user()->PhoneNumber; ?>">
                                            @if ($errors->has('phone'))
                                                <span class="text-danger small">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <button type="button" id="btn-update-profile" class="btn-update-profile btn btn-outline-success"><i class="far fa-edit"></i> Update</button>
                                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class = "control-label col-md">Image</label>
                                    <div class="card border-info shadow-sm">
                                        <div class="card-header">Update image</div>
                                        <div class="card-body">
                                            <div class="text-center">
                                                <img height="50"  src="<?php echo $image = 'http://127.0.0.1:8000/img/'.''.Auth::user()->Image;?>" id="image_preview_container" class="img-profile rounded-circle" alt="avatar" />
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="custom-file">
                                            <input hidden type="text" id="fakeimageid" name="fakeimage" value="<?php echo Auth::user()->Image; ?>">
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
