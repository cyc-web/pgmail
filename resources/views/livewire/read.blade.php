

<div class="wrapper">
  <!-- Navbar -->
  <livewire:navbar />
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
   <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('images/pg.jpg')}}" alt="PGC Logo" class="brand-image img-circle elevation-3"
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
                <a href="/create" class="nav-link">
                  <i class="fas fa-comments nav-icon"></i>
                  <p>Create Message</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="/inbox" class="nav-link active">
                  <i class="fas fa-comments nav-icon"></i>
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
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
             
            <h1>{{$mcode->subject}}</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-10">
         
          <!-- /.card -->

          <div class="card">
            <div class="card-header" style="text-align: right;">
              <!-- Button trigger modal -->
                  <button type="button" class="btn btn-default" data-bs-toggle="modal" data-bs-target="#exampleModal">
                   <div class="fas fa-reply"></div> Reply
                  </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body" wire:ignore>
                
                <div class="row">
                    <div class="col-md-6">
                        <strong>From : {{$sender->name}} {{$sender->othername}} </strong>
                    </div>
                    <div class="col-md-6" style="text-align: right;">
                        {{$mcode->created_at}} ({{ \Carbon\Carbon::parse($mcode->created_at)->diffForHumans() }})
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p>To :
                        @foreach($recipents as $user)
                        @if($user->fname === $userName && $user->oname === $userOtherName)
                        me,
                        @else
                        {{$user->fname}} {{$user->oname}},
                       @endif
                        @endforeach
                        
                        </p>
                    </div>
                </div>
                @foreach($results as $result)
                <div class="row" style="padding: 10px;">
                <div class="col-md-8">
                  {!! $result->description !!}
                   By : @if($result->rname === $userName && $result->roname === $userOtherName)
                   Me 
                   @else
                   {{$result->rname}} {{$result->roname}}
                   @endif
                   @if($result->attachments)
                   @foreach($result->attachments as $image)
                   <div class="row" style="padding: 10px;">
                    <div class="col-md-8">
                        <a href="/{{'storage/'.$image->attachment}}" class="text-success" download="Attachment"><i class="fas fa-paperclip"></i> download</a>&nbsp;&nbsp; <a href="/{{'storage/'.$image->attachment}}" target="_blank"><i class="fas fa-edit"></i> preview</a>
                    </div>
                   </div>
                   @endforeach
                   @endif
                </div>
                <div class="col-md-4">
                {{$result->created_at}} ({{ \Carbon\Carbon::parse($result->created_at)->diffForHumans() }})
                </div>
                <hr>
                </div>
                 @endforeach
                
                    
                   
                <br>
                
                 
                 

                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore>
                  <form wire:submit.prevent="reply" enctype="multipart/form-data">

                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Reply</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                            
                              <label for="">Description <span class="text-danger"></span></label>
                              <textarea id="my-editor" wire:model="message" name="content" class="form-control">
                              </textarea>
                               @error('message')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            
                            </div>     
                             <div class="form-group">
                                <label for="inputProjectLeader"><i class="fas fa-paperclip"></i> Attachment</label><br>
                                <input type="file" id="image" wire:model="photos" multiple>
                              
                              </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Send Message</button>
                        </div>
                        
                      </div>
                    </div>
                  </form>
                  </div>
                </div>
          


            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div><br><br>
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
@this.set('message', e.editor.getData());
});
</script>

