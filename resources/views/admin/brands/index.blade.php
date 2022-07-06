@extends('admin.layouts.app')

@section('subtitle')Brands @endsection

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Brands</h1>
      {{ Breadcrumbs::render('admin.brands.index') }}
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
                <a class="btn btn-success admin-create-btn" href="{{ route('admin.brands.create') }}">
                    <i class="bi bi-plus-circle-fill"></i> Create
                </a>
  
                <!-- Default Table -->
                <table id="table" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
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
        ajax: '{{ route('admin.brands-data') }}',
        columns: [
          { data: 'id', name: 'id' },
          { data: 'name', name: 'name' },
          { data: 'created_at', name: 'created_at' },
          { render: (data,type,row) => { return `<a class="btn btn-info rounded-pill" href='brands/${row.id}/edit'>Edit</a>`;}}
        ]
    });
});
</script>
@endsection