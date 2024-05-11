@extends('admin.layout.base_layout')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Project Add</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Project Add</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-body" style="display: block;">
            <div class="form-group">
              <label for="inputName">Project Name</label>
              <input type="text" id="inputName" class="form-control">
            </div>
            <div class="form-group">
              <label for="inputDescription">Project Description</label>
              <textarea id="inputDescription" class="form-control" rows="4"></textarea>
            </div>
            <div class="form-group">
              <label for="inputStatus">Status</label>
              <select id="inputStatus" class="form-control custom-select">
                <option selected="" disabled="">Select one</option>
                <option>On Hold</option>
                <option>Canceled</option>
                <option>Success</option>
              </select>
            </div>
            <div class="form-group">
              <label for="inputClientCompany">Client Company</label>
              <input type="text" id="inputClientCompany" class="form-control">
            </div>
            <div class="form-group">
              <label for="inputProjectLeader">Project Leader</label>
              <input type="text" id="inputProjectLeader" class="form-control">
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <a href="#" class="btn btn-secondary">Cancel</a>
        <input type="submit" value="Create new Project" class="btn btn-success float-right">
      </div>
    </div>
  </section>
@endsection