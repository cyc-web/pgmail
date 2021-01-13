
<div style="margin-bottom: 50px;">
  <form wire:submit.prevent="addNewMessage" enctype="multipart/form-data">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Compose New</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">New Chat</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row"> 
             
        <div class="col-md-8">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">General Information</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">Name <span class="text-danger"></span></label>
                <input type="text" id="inputName" wire:model="owner" placeholder="Name 
                " class="form-control">
              
              </div>
              <div class="form-group">
                <label for="inputName">Telephone <span class="text-danger"></span></label>
                <input type="text" id="inputName" wire:model="phone" placeholder="Telephone
                " class="form-control">
              
              </div>
               <div class="form-group">
                <label for="inputName">Subject <span class="text-danger"></span></label>
                <input type="text" id="inputName" wire:model="subject" placeholder="Subject of the mail (optional)" class="form-control">
               
              </div>
              <div class="form-group" wire:ignore>
                <label for="">Description <span class="text-danger"></span></label>
                <textarea id="my-editor" wire:model="description" name="content" class="form-control"></textarea>
               
              </div>        
             
              <div class="form-group">
                <label for="inputProjectLeader"><i class="fas fa-paperclip"></i> Attachment</label><br>
                <input type="file" id="image" wire:model="photos" multiple>
               
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-4">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-user-plus"></i> Select Recipent (s)</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
                @error('person')
            <span class="text-danger">{{$message}}</span>
            @enderror
                @if(count($users) == 0)
                <p>No available recipents</p>
                @else
                @foreach($users as $user)
      
              <div class="form-group">
                <input type="checkbox" id="inputEstimatedBudget" wire:model="person" value="{{$user->id}}"> {{$user->name}} {{$user->othername}}
              </div>
              
             @endforeach
             @endif
             
            </div>
            <button type="submit" class="btn btn-success">
              <div wire:loading wire:target="addNewMessage">
                            <i class="fas fa-spinner fa-spin"></i>
                            Sending message...
                        </div>    
                        <span wire:loading.remove>
                        <i class="fas fa-envelope"></i>
                          Send
                        </span>
              </button>

            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
     
    </section>
    <!-- /.content -->
  </div>
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

<script>
    window.livewire.on('fileChoosen', ()=>{
        let inputField = document.getElementById("image")
        let file = inputField.files[0]
        let reader = new FileReader();
        reader.onloadend=()=>{
            window.livewire.emit('fileUpload', reader.result)
        }
        reader.readAsDataURL(file);
    })
</script>
