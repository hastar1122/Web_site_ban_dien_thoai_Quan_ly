@foreach ($errors->all() as $message)
    <p class="alert alert-danger"> {{$message}}</p>
@endforeach
