@extends('admin.layout.app')
@section('admin')
<div class="card-body m-4 p-4">
        
    <form action="{{route('smtp.update', $data->id)}}" method="POST">
        @csrf
        <div class="mb-4">
            <div class="row mb-3">
                <label class="col-form-label col-lg-3">Mailer</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" placeholder="mailer" name="mailer" id="mailer" value="{{$data->mailer}}" >
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-form-label col-lg-3">Host</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" placeholder="host" name="host" id="host" value="{{$data->host}}">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-form-label col-lg-3">Port</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" placeholder="port" name="port" id="port" value="{{$data->port}}">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-form-label col-lg-3">User Name</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" placeholder="user_name" name="user_name" id="user_name" value="{{$data->user_name}}">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-form-label col-lg-3">Password</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" placeholder="password" name="password" id="password" value="{{$data->password}}">
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection