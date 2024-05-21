@extends('admin.layout.base_layout')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit color</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit color</li>
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
            <form action="{{ route('editColor',['id'=>$color->id]) }}" method="post">
                @csrf
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="name">Color Name</label>
                    <input type="text" id="name" class="form-control @error('name')
                        is-invalid
                    @enderror " name="name" value="{{old('name',$color->name)}}" placeholder="Enter Name">
                    <span id="exampleInputEmail1-error" class="error invalid-feedback">@error('name')
                        {{$message}}
                    @enderror</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="color" id="code" class="form-control @error('code')
                    is-invalid
                @enderror " name="code" value="{{old('code',$color->code)}}" placeholder="Enter code">
                    <span id="code-error" class="error invalid-feedback">@error('code')
                        {{$message}}
                    @enderror</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" class="form-control custom-select @error('status')
                    is-invalid
                @enderror" name="status">
                      <option selected="" disabled="" value="">Select Status</option>
                      <option value="1" 
                      {{ old('status',$color->status) == '1' ? 'selected' : '' }}
                      >Active</option>
                      <option value="0"
                      {{ old('status',$color->status) == '0' ? 'selected' : '' }}
                      >Deactive</option>
                    </select>
                    <span id="status-error" class="error invalid-feedback">@error('status')
                        {{$message}}
                    @enderror</span>
                  </div>
                </div> 
              </div>  
              
              <div class="row">
                <div class="col-md-4 offset-md-5">
                  <button type="submit" class="btn btn-success">Update Color</button>
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