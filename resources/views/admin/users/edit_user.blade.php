@extends('admin.layout.base_layout')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit User</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit User</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
    @include('admin.errors.error')
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-body" style="display: block;">
            <form action="{{ route('edit_user', ['id'=>$user->id]) }}" method="post">
              @csrf
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="name">User Full Name</label>
                    <input type="text" id="name" class="form-control @error('name')
                        is-invalid
                    @enderror " name="name" value="{{old('name',$user->name)}}" placeholder="Enter Name">
                    <span id="exampleInputEmail1-error" class="error invalid-feedback">@error('name')
                        {{$message}}
                    @enderror</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" class="form-control @error('email')
                    is-invalid
                @enderror " name="email" value="{{old('email',$user->email)}}" placeholder="Enter Email">
                    <span id="exampleInputEmail1-error" class="error invalid-feedback">@error('email')
                        {{$message}}
                    @enderror</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" class="form-control @error('phone')
                    is-invalid
                @enderror " name="phone" value="{{old('phone',$user->phone)}}" placeholder="Enter Phone">
                    <span id="exampleInputEmail1-error" class="error invalid-feedback">@error('phone')
                        {{$message}}
                    @enderror</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="user_type">User Type</label>
                    <select id="user_type" class="form-control custom-select @error('user_type')
                    is-invalid
                @enderror" name="user_type">
                      <option selected="" disabled="" value="">Select User Type</option>
                      <option value="normal" 
                      {{ old('user_type',$user->user_type) == 'normal' ? 'selected' : '' }}
                      >Normal</option>
                      <option value="admin"
                      {{ old('user_type',$user->user_type) == 'admin' ? 'selected' : '' }}
                      >Admin</option>
                    </select>
                    <span id="exampleInputEmail1-error" class="error invalid-feedback">@error('user_type')
                        {{$message}}
                    @enderror</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" id="password" class="form-control @error('password')
                    is-invalid
                @enderror " name="password" value="{{old('password')}}" placeholder="Enter Password">
                    <span id="exampleInputEmail1-error" class="error invalid-feedback">@error('password')
                        {{$message}}
                    @enderror</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="text" id="password_confirmation" class="form-control @error('password_confirmation')
                    is-invalid
                @enderror " name="password_confirmation" value="{{old('password_confirmation')}}" placeholder="Enter Confirm Password">
                    <span id="exampleInputEmail1-error" class="error invalid-feedback">@error('password_confirmation')
                        {{$message}}
                    @enderror</span>
                  </div>
                </div>  
              </div> 
              <div class="row">
                <div class="col-md-4 offset-md-5">
                  <button type="submit" class="btn btn-success">Add User</button>
                </div>
              </div>
            </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </section>
@endsection