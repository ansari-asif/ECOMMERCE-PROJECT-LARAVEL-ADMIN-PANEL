@extends('admin.layout.base_layout')
@section('links')
    @include('admin.incld.links.datatables')
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Color List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Color List</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  @include('admin.errors.error')
  <section class="content">
    <div class="container-fluid">        
        <a href="{{ route('addColor') }}"  class="btn btn-md btn-primary mb-2">Add Color</a>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <table id="table" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Name</th>
                  <th>Code</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($colorList as $color)
                    <tr>
                      <td>{{$color->id}} </td>
                      <td>{{$color->name}}
                      </td>    
                      <td>{{$color->code}}
                      </td>                      
                      <td>
                        
                        <a href="{{ route('statusColor', ['id'=>$color->id]) }}" class="">{{$color->status_color()}}</a>
                      </td>
                      <td>
                        <a href="{{ route('editColor', ['id'=>$color->id]) }}" class="btn btn-md btn-primary"
                          >Edit</a>
                        <a href="{{ route('deleteColor', ['id'=>$color->id]) }}" class="btn btn-md btn-danger" onclick="return confirm('Are you sure you want to delete this color?')">Delete</a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

         
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
@endsection

@section('scripts')
<script>
  $(function () {
    $("#table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,"searching": true,
    }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
  });
</script>
@endsection
