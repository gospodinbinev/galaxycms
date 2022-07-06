@extends('admin.layouts.app')

@section('subtitle')Edit Category @endsection

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Edit Category</h1>
      {{ Breadcrumbs::render('admin.categories.edit', $category) }}
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                    
                      <!-- Multi Columns Form -->
                      
                      {!! Form::open(['method' => 'PATCH', 'action' => ['App\Http\Controllers\Admin\CategoriesController@update', $category->id], 'files' => true, 'class' => 'row g-3', 'style' => 'margin-top: 0;']) !!}
                        
                        <div class="col-md-12">
                          {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}
                          {!! Form::text('name', $category->name, ['class' => 'form-control '.($errors->has('name') ? 'is-invalid':'')]) !!}
                        
                          <div class="invalid-feedback">
                            @error('name') {{ $message }} @enderror
                          </div>
                        </div>

                        <div class="col-md-12">
                            {!! Form::label('parent', 'Parent', ['class' => 'form-label']) !!}
                            {!! Form::select('parent', $categories, $category->parent_id, ['placeholder' => 'Choose', 'class' => 'form-control']) !!}
                        </div>

                        <div class="col-md-12">
                            {!! Form::label('slug', 'Slug', ['class' => 'form-label']) !!}
                            {!! Form::text('slug', $category->slug, ['class' => 'form-control '.($errors->has('slug') ? 'is-invalid':'')]) !!}
                          
                            <div class="invalid-feedback">
                              @error('slug') {{ $message }} @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <img height="100" style="margin-bottom: 15px;" src="{{ asset($category->image) }}" alt="">

                            {!! Form::label('image', 'Image', ['class' => 'col-form-label']) !!}
                            {!! Form::file('image', ['class' => 'form-control '.($errors->has('image') ? 'is-invalid':'')]) !!}
                            
                            <div class="invalid-feedback">
                                @error('image') {{ $message }} @enderror
                            </div>
                        </div>

                        <div>
                          <button type="submit" class="btn btn-info"><i class="bi bi-pencil-fill"></i> Update</button>
                          <a class="btn btn-link" style="float: right;" href="{{ route('admin.categories.index') }}"><i class="bi bi-box-arrow-left"></i> Back to Categories</a>
                        </div>

                      {!! Form::close() !!}<!-- End Multi Columns Form -->

                      {!! Form::open(['method' => 'DELETE', 'action' => ['\App\Http\Controllers\Admin\CategoriesController@destroy', $category->id]]) !!}
                        <button style="float: right;" class="btn btn-danger">Delete</button>
                      {!! Form::close() !!}
        
                    </div>
                  </div>
            </div>
        </div>
    </section>
</main>    
@endsection

@section('add-js')
<script>
  $('#name').keyup(function(e) {
    $.get('{{ route('admin.categories-check-slug') }}', 
      { 'name': $(this).val() }, 
      function( data ) {
        $('#slug').val(data.slug);
      }
    );
  });
</script>
@endsection