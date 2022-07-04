@extends('admin.layouts.app')

@section('subtitle')Roles @endsection

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Roles</h1>
      {{ Breadcrumbs::render('admin.roles.index') }}
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
                <a class="btn btn-success admin-create-btn" href="{{ route('admin.roles.create') }}">
                    <i class="bi bi-plus-circle-fill"></i> Create
                </a>
  
                <!-- Default Table -->
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Created at</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach ($roles as $role)
                      <tr>
                        <th scope="row">{{ $role->id }}</th>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->created_at }}</td>
                        <td><a class="btn btn-info rounded-pill" href="{{ route('admin.roles.edit', $role->id) }}">Edit</a></td>
                      </tr>   
                    @endforeach
                    
                  </tbody>
                </table>
                <!-- End Default Table Example -->
              </div>
            </div>
          </div>
        </div>
    </section>
</main>
@endsection