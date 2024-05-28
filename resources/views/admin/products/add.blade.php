@extends('admin.layout.base_layout')
@section('style')
    <style>
      .field_set{
        border: 1px solid red;
        border-radius: 7px;
        padding: 8px;
      }
    </style>
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add Product</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add Product</li>
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
                    <label for="name">Product Name</label>
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
                    <label for="slug">Product Slug</label>
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
                    is-invalid @enderror" name="status">
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
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="brand">Brand</label>
                      <select id="brand" class="form-control custom-select @error('brand')
                      is-invalid @enderror" name="brand">
                        <option selected="" disabled="" value="">Select Brand</option>
                        @foreach ($brands as $brand)
                        <option value="{{$brand->id}}" 
                        {{ old('brand') == $brand->id ? 'selected' : '' }}
                        >{{$brand->name}} </option>
                        @endforeach
                      </select>
                      <span id="status-error" class="error invalid-feedback">@error('brand')
                          {{$message}}
                      @enderror</span>
                    </div>
                  </div> 
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="category">Category</label>
                      <select id="category" class="form-control custom-select @error('status')
                      is-invalid @enderror" name="category">
                        <option selected="" disabled="" value="">Select Category</option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}" 
                        {{ old('category') == $category->id ? 'selected' : '' }}
                        >{{$category->name}} </option>
                        @endforeach
                      </select>
                      <span id="status-error" class="error invalid-feedback">@error('category')
                          {{$message}}
                      @enderror</span>
                    </div>
                  </div> 
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="sub_category">Sub Category</label>
                      <select id="sub_category" class="form-control custom-select @error('sub_category')
                      is-invalid @enderror" name="sub_category">
                        <option selected="" disabled="" value="">Select Sub Category</option>
                      </select>
                      <span id="status-error" class="error invalid-feedback">@error('sub_category')
                          {{$message}}
                      @enderror</span>
                    </div>
                  </div> 
              </div>
              <fieldset class="field_set">
                <div id="product_color_amount_box">
                  <div class="row" id="row_1">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="color">Product Color</label>
                        <select id="color" class="form-control" name="color[]">
                          <option>--select Color---</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="slug">Product Size</label>
                        <input type="text" id="size" class="form-control @error('size')
                        is-invalid @enderror " name="size" value="{{old('size')}}" placeholder="Enter size">
                        
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="slug">Product Amount</label>
                        <input type="text" id="amount" class="form-control @error('amount')
                        is-invalid @enderror " name="amount" value="{{old('amount')}}" placeholder="Enter amount">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <br>
                        <button type="button" class="btn btn-sm btn-danger">DELETE</button>
                      </div>
                    </div>
                  </div>                  
                </div>
                <div class="text-center py-3">
                  <button class="btn btn-sm btn-primary" type="button">Add Product Size/amount/color</button>
                </div>
              </fieldset>
              
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="meta_title">Short Description</label>
                        <textarea id="my-textarea" class="form-control" name="" rows="3"></textarea>
                        <span id="exampleInputEmail1-error" class="error invalid-feedback">@error('meta_title')
                            {{$message}}
                        @enderror</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="meta_description">Description</label>
                        <textarea id="my-textarea" class="form-control" name="" rows="3"></textarea>
                        <span id="exampleInputEmail1-error" class="error invalid-feedback">@error('meta_description')
                            {{$message}}
                        @enderror</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="meta_keywords">Additional Info</label>
                        <textarea id="my-textarea" class="form-control" name="" rows="3"></textarea>
                        <span id="exampleInputEmail1-error" class="error invalid-feedback">@error('meta_keywords')
                            {{$message}}
                        @enderror</span>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="meta_keywords">Shipping Returns</label>
                      <textarea id="my-textarea" class="form-control" name="" rows="3"></textarea>
                      <span id="exampleInputEmail1-error" class="error invalid-feedback">@error('meta_keywords')
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
                  <button type="submit" class="btn btn-success">Add Product</button>
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

@section('scripts')
    <script>
      $(document).ready(function(){

        $(document).on('change','#category',function(e){
          var $el=$(this);
          var id =this.value;
          $.ajax({
            url:"{{ route('ajax_get_sub_category') }}",
            method:"POST",
            dataType:"json",
            data:{id,_token:'{{csrf_token()}}'},
            success:function(data){
              $('#sub_category').html(data);
            }
          })
        });
      });
    </script>
@endsection