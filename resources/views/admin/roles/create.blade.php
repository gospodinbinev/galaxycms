@extends('admin.layouts.app')

@section('subtitle')Create Role @endsection

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Create Role</h1>
      {{ Breadcrumbs::render('admin.roles.create') }}
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                    
                      <!-- Multi Columns Form -->
                      
                      {!! Form::open(['method' => 'post', 'action' => 'App\Http\Controllers\Admin\RolesController@store', 'class' => 'row g-3', 'style' => 'margin-top: 0;']) !!}
                        <div class="col-md-12">
                          {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}
                          {!! Form::text('name', old('name'), ['class' => 'form-control '.($errors->has('name') ? 'is-invalid':'')]) !!}
                        
                          <div class="invalid-feedback">
                            @error('name') {{ $message }} @enderror
                          </div>
                        </div>
                        <div>
                          <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle-fill"></i> Create</button>
                          <a class="btn btn-link" style="float: right;" href="{{ route('admin.roles.index') }}"><i class="bi bi-box-arrow-left"></i> Back to Roles</a>
                        </div>
                      {!! Form::close() !!}<!-- End Multi Columns Form -->
        
                    </div>
                  </div>
            </div>
        </div>
    </section>
</main>    
@endsection