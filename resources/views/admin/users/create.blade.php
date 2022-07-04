@extends('admin.layouts.app')

@section('subtitle')Create User @endsection

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Create User</h1>
      {{ Breadcrumbs::render('admin.users.create') }}
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                    
                      <!-- Multi Columns Form -->
                      
                      {!! Form::open(['method' => 'post', 'action' => 'App\Http\Controllers\Admin\UsersController@store', 'files' => true, 'class' => 'row g-3', 'style' => 'margin-top: 0;']) !!}
                        <div class="col-md-12">
                            {!! Form::label('role', 'Role', ['class' => 'form-label']) !!}
                            {!! Form::select('role', $roles, null, ['placeholder' => 'Choose', 'class' => 'form-control '.($errors->has('role') ? 'is-invalid':'')]) !!}
                        
                            <div class="invalid-feedback">
                                @error('role') {{ $message }} @enderror
                            </div>
                        </div>
                      
                        <div class="col-md-6">
                          {!! Form::label('first_name', 'First name', ['class' => 'form-label']) !!}
                          {!! Form::text('first_name', old('first_name'), ['class' => 'form-control '.($errors->has('first_name') ? 'is-invalid':'')]) !!}
                        
                          <div class="invalid-feedback">
                            @error('first_name') {{ $message }} @enderror
                          </div>
                        </div>

                        <div class="col-md-6">
                            {!! Form::label('last_name', 'Last name', ['class' => 'form-label']) !!}
                            {!! Form::text('last_name', old('last_name'), ['class' => 'form-control '.($errors->has('last_name') ? 'is-invalid':'')]) !!}
                          
                            <div class="invalid-feedback">
                              @error('last_name') {{ $message }} @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            {!! Form::label('display_name', 'Display name', ['class' => 'form-label']) !!}
                            {!! Form::text('display_name', old('display_name'), ['class' => 'form-control '.($errors->has('display_name') ? 'is-invalid':'')]) !!}
                          
                            <div class="invalid-feedback">
                              @error('display_name') {{ $message }} @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}
                            {!! Form::text('email', old('email'), ['class' => 'form-control '.($errors->has('email') ? 'is-invalid':'')]) !!}
                          
                            <div class="invalid-feedback">
                              @error('email') {{ $message }} @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            {!! Form::label('password', 'Password', ['class' => 'form-label']) !!}
                            {!! Form::password('password', ['class' => 'form-control '.($errors->has('password') ? 'is-invalid':'')]) !!}
                          
                            <div class="invalid-feedback">
                              @error('password') {{ $message }} @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            {!! Form::label('password_confirmation', 'Password confirmation', ['class' => 'form-label']) !!}
                            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                        </div>

                        <div class="col-md-12">
                            {!! Form::label('image', 'Profile image', ['class' => 'col-form-label']) !!}
                            {!! Form::file('image', ['class' => 'form-control '.($errors->has('image') ? 'is-invalid':'')]) !!}
                            
                            <div class="invalid-feedback">
                                @error('image') {{ $message }} @enderror
                            </div>
                        </div>

                        <div>
                          <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle-fill"></i> Create</button>
                          <a class="btn btn-link" style="float: right;" href="{{ route('admin.users.index') }}"><i class="bi bi-box-arrow-left"></i> Back to Users</a>
                        </div>
                      {!! Form::close() !!}<!-- End Multi Columns Form -->
        
                    </div>
                  </div>
            </div>
        </div>
    </section>
</main>    
@endsection