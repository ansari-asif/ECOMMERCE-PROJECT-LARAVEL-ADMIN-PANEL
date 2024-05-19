@extends('admin.layout.base_layout')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add Product Category</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add Product Category</li>
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
            <form action="{{ route('addCategory') }}" method="post">
                @csrf
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" id="name" class="form-control @error('name')
                        is-invalid
                    @enderror " name="name" value="{{old('name')}}" placeholder="Enter Name">
                    <span id="exampleInputEmail1-error" class="error invalid-feedback">@error('name')
                        {{$message}}
                    @enderror</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" id="slug" class="form-control @error('slug')
                    is-invalid
                @enderror " name="slug" value="{{old('slug')}}" placeholder="Enter slug">
                    <span id="slug-error" class="error invalid-feedback">@error('slug')
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
                      {{ old('status') == '1' ? 'selected' : '' }}
                      >Active</option>
                      <option value="0"
                      {{ old('status') == '0' ? 'selected' : '' }}
                      >Deactive</option>
                    </select>
                    <span id="status-error" class="error invalid-feedback">@error('status')
                        {{$message}}
                    @enderror</span>
                  </div>
                </div> 
              </div>  
              <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="meta_title">Meta Title</label>
                        <input type="text" id="meta_title" class="form-control @error('meta_title')
                            is-invalid
                        @enderror " name="meta_title" value="{{old('meta_title')}}" placeholder="Enter meta_title">
                        <span id="exampleInputEmail1-error" class="error invalid-feedback">@error('meta_title')
                            {{$message}}
                        @enderror</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="meta_description">Meta Description</label>
                        <input type="text" id="meta_description" class="form-control @error('meta_description')
                            is-invalid
                        @enderror " name="meta_description" value="{{old('meta_description')}}" placeholder="Enter meta_description">
                        <span id="exampleInputEmail1-error" class="error invalid-feedback">@error('meta_description')
                            {{$message}}
                        @enderror</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="meta_keywords">Meta Keywords</label>
                        <input type="text" id="meta_keywords" class="form-control @error('meta_keywords')
                            is-invalid
                        @enderror " name="meta_keywords" value="{{old('meta_keywords')}}" placeholder="Enter meta_keywords">
                        <span id="exampleInputEmail1-error" class="error invalid-feedback">@error('meta_keywords')
                            {{$message}}
                        @enderror</span>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 offset-md-5">
                  <button type="submit" class="btn btn-success">Add Category</button>
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