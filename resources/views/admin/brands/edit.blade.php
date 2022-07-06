@extends('admin.layouts.app')

@section('subtitle')Edit Brand @endsection

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Edit Brand</h1>
      {{ Breadcrumbs::render('admin.brands.edit', $brand) }}
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                    
                      <!-- Multi Columns Form -->
                      
                      {!! Form::open(['method' => 'PATCH', 'action' => ['App\Http\Controllers\Admin\BrandsController@update', $brand->id], 'class' => 'row g-3', 'style' => 'margin-top: 0;']) !!}
                        
                        <div class="col-md-12">
                          {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}
                          {!! Form::text('name', $brand->name, ['class' => 'form-control '.($errors->has('name') ? 'is-invalid':'')]) !!}
                        
                          <div class="invalid-feedback">
                            @error('name') {{ $message }} @enderror
                          </div>
                        </div>

                        <div class="col-md-12">
                          {!! Form::label('slug', 'Slug', ['class' => 'form-label']) !!}
                          {!! Form::text('slug', $brand->slug, ['class' => 'form-control '.($errors->has('slug') ? 'is-invalid':'')]) !!}
                        
                          <div class="invalid-feedback">
                            @error('slug') {{ $message }} @enderror
                          </div>
                        </div>

                        <div>
                          <button type="submit" class="btn btn-info"><i class="bi bi-pencil-fill"></i> Update</button>
                          <a class="btn btn-link" style="float: right;" href="{{ route('admin.brands.index') }}"><i class="bi bi-box-arrow-left"></i> Back to Brands</a>
                        </div>

                      {!! Form::close() !!}<!-- End Multi Columns Form -->

                      {!! Form::open(['method' => 'DELETE', 'action' => ['\App\Http\Controllers\Admin\BrandsController@destroy', $brand->id]]) !!}
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
    $.get('{{ route('admin.brands-check-slug') }}', 
      { 'name': $(this).val() }, 
      function( data ) {
        $('#slug').val(data.slug);
      }
    );
  });
</script>
@endsection