
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     
    </ul>

 

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    
     
    </ul>
  </nav>  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('images/pg.jpg')}}" alt="Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">PGC</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/{{'storage/profile/'.Auth::user()->passport}}" class="brand-image img-circle elevation-3" alt="User Image">
        </div>
        <div class="info">
          <a href="/profile" class="d-block"><i class="fa fa-circle text-success"></i> {{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/profile" class="nav-link">
                  <i class="far fa-edit nav-icon"></i>
                  <p>My Profile</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/create" class="nav-link active">
                  <i class="far fa-comment nav-icon"></i>
                  <p>Create Message</p>
                </a>
              </li>

               <li class="nav-item">
                <a href="/inbox" class="nav-link">
                  <i class="far fa-comments nav-icon"></i>
                  <p>Inbox</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/archives" class="nav-link">
                  <i class="fas fa-archive nav-icon"></i>
                  <p>Archives</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/sent" class="nav-link">
                  <i class="fas fa-file-export nav-icon"></i>
                  <p>Sent</p>
                </a>
              </li>
               @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
              <li class="nav-item">
                <a href="/incoming" class="nav-link">
                  <i class="fas fa-user-plus nav-icon"></i>
                  <p>All Users</p>
                </a>
              </li>
              @endif
              <li class="nav-item">

                    <livewire:logout />
                
              </li>
            </ul>
          </li>
        
        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->

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
              <!--div class="form-group">
                <label for="inputName">Name <span class="text-danger"></span></label>
                <input type="text" id="inputName" wire:model="owner" placeholder="Name 
                " class="form-control">
              
              </div>
              <div class="form-group">
                <label for="inputName">Telephone <span class="text-danger"></span></label>
                <input type="text" id="inputName" wire:model="phone" placeholder="Telephone
                " class="form-control">
              
              </div-->
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
                @elseif(Auth::user()->role_id == 0)
                <p>Contact admin to get started</p>
                @else
                @foreach($users as $user)
      
              <div class="form-group">
                <input type="checkbox" id="inputEstimatedBudget" wire:model="person" value="{{$user->id}}"> {{$user->name}} {{$user->othername}}
              </div>
              
             @endforeach
             @endif
             
            </div>
            <button type="submit" class="btn btn-success" wire:offline.attr="disabled">
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
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      
    </div>
    <strong>Copyright &copy; <?php echo date("Y")?> <a href="https://www.pgcollege.ui.edu.ng" target="_blank">PGC</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

