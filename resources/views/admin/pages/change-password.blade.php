@extends('layouts.app')

@section('content')
     <!-- Changes pasword Modal -->
    <form method="POST" action="{{URL::to('/changePassword')}}">
        {{ csrf_field() }}
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title text-info">Change Your Passowrd</h4>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            @if (session('success'))
                <div class="alert alert-success col-md-3">
                    {{session('success')}}
                </div>
            @endif
            @if (session('fail'))
                <div class="alert alert-danger col-md-3">
                    {{session('fail')}}
                </div>
            @endif
            <div class="form-group">
                <label class = "control-label col-md">Current password</label>
                <div class="col-md-3">
                    <input type="password" name="oldpassword" type="text" class="form-control form-control-user" required>
                </div>
                @if ($errors->has('oldpassword'))
                    <span class="text-danger small">{{ $errors->first('oldpassword') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class = "control-label col-md">New password</label>
                <div class="col-md-3">
                    <input type="password" name="newpassword" type="text" class="form-control form-control-user" required>
                </div>
                @if ($errors->has('newpassword'))
                    <span class="text-danger small">{{ $errors->first('newpassword') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class = "control-label col-md">Comfirm password</label>
                <div class="col-md-3">
                    <input type="password" name="confirm_newpassword" type="text" class="form-control form-control-user" required>
                </div>
                @if ($errors->has('confirm_newpassword'))
                    <span class="text-danger small">{{ $errors->first('confirm_newpassword') }}</span>
                @endif
            </div>
            <div class="col-md">
                <input type="submit" class="change btn btn-outline-success" value="Update">
                <a class="btn btn-outline-primary" href="{{url('/index')}}">Back</a>

            </div>
        </div>

    </form>
@endsection



