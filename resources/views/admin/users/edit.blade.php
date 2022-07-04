@extends('admin.layouts.app')

@section('subtitle')Edit User @endsection

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Edit User</h1>
      {{ Breadcrumbs::render('admin.users.edit', $user) }}
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                      <h3 style="margin-top: 15px;">Basic info</h3>
                    
                      <!-- Multi Columns Form -->
                      
                      {!! Form::open(['method' => 'PATCH', 'action' => ['App\Http\Controllers\Admin\UsersController@update', $user->id], 'files' => true, 'class' => 'row g-3', 'style' => 'margin-top: 0;']) !!}
                        <div class="col-md-12">
                            {!! Form::label('role', 'Role', ['class' => 'form-label']) !!}
                            {!! Form::select('role', $roles, $user->role_id, ['placeholder' => 'Choose', 'class' => 'form-control '.($errors->has('role') ? 'is-invalid':'')]) !!}
                        
                            <div class="invalid-feedback">
                                @error('role') {{ $message }} @enderror
                            </div>
                        </div>
                      
                        <div class="col-md-6">
                          {!! Form::label('first_name', 'First name', ['class' => 'form-label']) !!}
                          {!! Form::text('first_name', $user->first_name, ['class' => 'form-control '.($errors->has('first_name') ? 'is-invalid':'')]) !!}
                        
                          <div class="invalid-feedback">
                            @error('first_name') {{ $message }} @enderror
                          </div>
                        </div>

                        <div class="col-md-6">
                            {!! Form::label('last_name', 'Last name', ['class' => 'form-label']) !!}
                            {!! Form::text('last_name', $user->last_name, ['class' => 'form-control '.($errors->has('last_name') ? 'is-invalid':'')]) !!}
                          
                            <div class="invalid-feedback">
                              @error('last_name') {{ $message }} @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            {!! Form::label('display_name', 'Display name', ['class' => 'form-label']) !!}
                            {!! Form::text('display_name', $user->display_name, ['class' => 'form-control '.($errors->has('display_name') ? 'is-invalid':'')]) !!}
                          
                            <div class="invalid-feedback">
                              @error('display_name') {{ $message }} @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}
                            {!! Form::text('email', $user->email, ['class' => 'form-control '.($errors->has('email') ? 'is-invalid':'')]) !!}
                          
                            <div class="invalid-feedback">
                              @error('email') {{ $message }} @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <img height="100" style="margin-bottom: 15px; border-radius: 50%;" src="{{ asset($user->image) }}" alt="">

                            {!! Form::label('image', 'Profile image', ['class' => 'col-form-label']) !!}
                            {!! Form::file('image', ['class' => 'form-control '.($errors->has('image') ? 'is-invalid':'')]) !!}
                            
                            <div class="invalid-feedback">
                                @error('image') {{ $message }} @enderror
                            </div>
                        </div>

                        <div>
                          <button type="submit" class="btn btn-info"><i class="bi bi-pencil-fill"></i> Update</button>
                          <a class="btn btn-link" style="float: right;" href="{{ route('admin.users.index') }}"><i class="bi bi-box-arrow-left"></i> Back to Users</a>
                        </div>
                      {!! Form::close() !!}<!-- End Multi Columns Form -->

                      {!! Form::open(['method' => 'DELETE', 'action' => ['\App\Http\Controllers\Admin\UsersController@destroy', $user->id]]) !!}
                        <button style="float: right;" class="btn btn-danger">Delete</button>
                      {!! Form::close() !!}
        
                    </div>
                  </div>
            </div>

            <div class="col-lg-6">
              <div class="card">
                  <div class="card-body">
                    <h3 style="margin-top: 15px;">Password change</h3>

                    {!! Form::open(['method' => 'post', 'action' => ['App\Http\Controllers\Admin\UsersController@changePassword', $user->id], 'class' => 'row g-3', 'style' => 'margin-top: 0;']) !!}

                    <div class="col-md-6">
                      {!! Form::label('password', 'New password', ['class' => 'form-label']) !!}
                      {!! Form::password('password', ['class' => 'form-control '.($errors->has('password') ? 'is-invalid':'')]) !!}
                    
                      <div class="invalid-feedback">
                        @error('password') {{ $message }} @enderror
                      </div>
                    </div>

                    <div class="col-md-6">
                      {!! Form::label('password_confirmation', 'Password confirmation', ['class' => 'form-label']) !!}
                      {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                    </div>

                    <div>
                      <button type="submit" class="btn btn-info"><i class="bi bi-pencil-fill"></i> Update</button>
                    </div>

                    {!! Form::close() !!}

                  </div>
              </div>
            </div>
            
        </div>
    </section>
</main>    
@endsection