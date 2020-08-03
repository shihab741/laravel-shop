@extends('admin.master')

@section('pageTitle')
Edit category | Online shop
@endsection

@section('headerScriptArea2')


    <!--Custom CSS for image preview -->
    <link href="{{ asset('/') }}admin-panel/image-preview/image-preview.css" rel="stylesheet" type="text/css">

@endsection

@section('body')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Edit category</h1>

    </section>





    <!-- Main content -->
    <section class="content">

        <div class="box">
          <div class="box-body">
                {{Form::open(['route' => ['category.update', $category->id], 'method' => 'PATCH', 'files' => true])}}

                    <input type="hidden" name="id" value="{{ $category->id }}">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Category Name</label>
                        <input type="text" name="cat_name" class="form-control" required="required" value="{{ $category->cat_name }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Category Description</label>
                        <textarea class="form-control" name="cat_desc" required="required" >{{ $category->cat_desc }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Category image</label>
                        <input type="file" name="cat_image" class="form-control" id="imageInputFile">
                        <div class="image-preview" id="imagePreview">
                            <img src="{{ asset('/') }}uploads/category-images/{{ $category->cat_image }}" alt="" class="image-preview__image">
                            <span class="image-preview__default-text" style="display: none !important;">Image preview</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="radio-inline">
                            <input type="radio" name="status" id="optionsRadiosInline1" value="1" {{ $category->status == 1 ? 'checked' : '' }}><strong>Published</strong> 
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" id="optionsRadiosInline2" value="0" {{ $category->status == 0 ? 'checked' : '' }}><strong>Unpublished</strong>
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


@include('admin.category.add-modal')


@endsection

@section('footerScriptArea')

    <!-- Image preview -->
    <script src="{{ asset('/') }}admin-panel/image-preview/image-preview.js"></script>



@endsection