@extends('admin.master')

@section('pageTitle')
Edit brand | Online shop
@endsection

@section('headerScriptArea2')


    <!--Custom CSS for image preview -->
    <link href="{{ asset('/') }}admin-panel/image-preview/image-preview.css" rel="stylesheet" type="text/css">

@endsection

@section('body')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Edit brand</h1>

    </section>





    <!-- Main content -->
    <section class="content">

        <div class="box">
          <div class="box-body">
                {{Form::open(['route' => ['brand.update', $brand->id], 'method' => 'PATCH', 'files' => true])}}

                    <input type="hidden" name="id" value="{{ $brand->id }}">

                    <div class="form-group">
                        <label for="exampleInputEmail1">brand Name</label>
                        <input type="text" name="brand_name" required="required" class="form-control" value="{{ $brand->brand_name }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">brand Description</label>
                        <textarea class="form-control" name="brand_desc" required="required" >{{ $brand->brand_desc }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>brand image</label>
                        <input type="file" name="brand_image" class="form-control" id="imageInputFile">
                        <div class="image-preview" id="imagePreview">
                            <img src="{{ asset('/') }}uploads/brand-images/{{ $brand->brand_image }}" alt="" class="image-preview__image">
                            <span class="image-preview__default-text" style="display: none !important;">Image preview</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="radio-inline">
                            <input type="radio" name="status" id="optionsRadiosInline1" value="1" {{ $brand->status == 1 ? 'checked' : '' }}><strong>Published</strong> 
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" id="optionsRadiosInline2" value="0" {{ $brand->status == 0 ? 'checked' : '' }}><strong>Unpublished</strong>
                        </label>
                    </div>
                                        
                    <div class="form-group">
                        <input type="submit" name="btn" class="btn btn-primary btn-lg btn-block" value="Update">
                    </div>
                {{ Form::close() }}
          </div>            
        </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>


@include('admin.brand.add-modal')


@endsection

@section('footerScriptArea')

    <!-- Image preview -->
    <script src="{{ asset('/') }}admin-panel/image-preview/image-preview.js"></script>



@endsection