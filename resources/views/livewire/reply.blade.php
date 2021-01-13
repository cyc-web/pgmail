<div>
                          <form wire:submit.prevent="reply">
                                <div class="form-group" wire:ignore>
                                        <textarea id="my-editor" wire:model="desc" name="content" class="form-control"></textarea>
                                    
                                    </div> 
                                    <button type="submit">Submit</button>
                            </form>
</div>

<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
  var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
  };
</script>
<script>
CKEDITOR.replace('my-editor').on('change', function(e){
@this.set('description', e.editor.getData());
});
</script>
