@extends('admin.layouts.app')

@section('subtitle')Users @endsection

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Users</h1>
      {{ Breadcrumbs::render('admin.users.index') }}
    </div><!-- End Page Title -->

    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-1"></i> {{ Session::get('success') }}
        </div>
    @endif

    <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <!-- Default Table -->
                <a class="btn btn-success admin-create-btn" href="{{ route('admin.users.create') }}">
                    <i class="bi bi-plus-circle-fill"></i> Create
                </a>
                <table class="table table-bordered" id="table" style="width: 100%;">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Image</th>
                      <th>First name</th>
                      <th>Last name</th>
                      <th>Email</th>
                      <th>Created at</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                </table>
                <!-- End Default Table Example -->
              </div>
            </div>
          </div>
        </div>
    </section>
</main>
@endsection

@section('add-js')
<script>
$(function() {
    $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('admin.users-data') }}',
        columns: [
          { data: 'id', name: 'id' },
          { render: (data,type,row) => { return `<img height='70' class='rounded-circle' src='{{ asset('${row.image}') }}'>`;}},
          { data: 'first_name', name: 'first_name' },
          { data: 'last_name', name: 'last_name' },
          { data: 'email', name: 'email' },
          { data: 'created_at', name: 'created_at' },
          { render: (data,type,row) => { return `<a class="btn btn-info rounded-pill" href='users/${row.id}/edit'>Edit</a>`;}}
        ]
    });
});
</script>
@endsection