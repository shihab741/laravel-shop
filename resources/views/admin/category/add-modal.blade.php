<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="cat_name" required="required" class="form-control" placeholder="Enter Category Name">
                    </div>
                    <div class="form-group">
                        <label">Category Description</label>
                        <textarea class="form-control" name="cat_desc" required="required" placeholder="Enter Category Description"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Category image</label>
                        <input type="file" name="cat_image" class="form-control" id="imageInputFile">
                        <div class="image-preview" id="imagePreview">
                            <img src="" alt="" class="image-preview__image">
                            <span class="image-preview__default-text">Image preview</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="radio-inline">
                            <input type="radio" name="status" id="optionsRadiosInline1" value="1" checked><strong>Published</strong> 
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" id="optionsRadiosInline2" value="0"><strong>Unpublished</strong>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>