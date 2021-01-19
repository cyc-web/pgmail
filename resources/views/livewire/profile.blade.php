

<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     
    </ul>

    <!-- SEARCH FORM -->
    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
 
    </ul>
  </nav>
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
          <img src="/{{'storage/profile/'.$passport}}" class="img-circle elevation-2" alt="User Image">
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
                <a href="/profile" class="nav-link active">
                  <i class="fas fa-edit nav-icon"></i>
                  <p>My Profile</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/create" class="nav-link">
                  <i class="fas fa-comment nav-icon"></i>
                  <p>Create Message</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/inbox" class="nav-link">
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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"> Update Profile </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
  </div>

    <!-- Main content -->
    <div class="content">
      <div class="row">
        <div class="col-12">
         
          <!-- /.card -->
            @if(session()->has('message'))
            <div class="alert alert-success"><span class='closebtn' onclick='this.parentElement.style.display="none";'>&times;</span>
                {{session('message')}}
            </div>
            @endif
          <div class="card">
            <div class="card-header">
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            
            <form class="row g-3" wire:submit.prevent="updateUser" enctype="multipart/form-data">
                 <div class="col-12">
                    <label for="inputAddress" class="form-label"><i class="fas fa-tag"></i> Title</label>
                    <select name="" wire:model.debounce.900000ms="title" id="" class="form-control">
                        <option value="{{$user->title}}">{{$user->title}}</option>
                        <option value="Dr">Dr</option>
                        <option value="Prof.">Prof.</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label"><i class="fas fa-user"></i> Surname</label>
                    <input type="text" class="form-control" wire:model.debounce.900000ms="surname" value="{{$user->name}}" id="inputEmail4">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label"><i class="fas fa-user"></i> Othernames</label>
                    <input type="text" class="form-control" wire:model.debounce.900000ms="othername" value="{{$user->othername}}" id="inputPassword4">
                </div>
                
                <div class="col-12">
                @if($passport)
                <a href="/{{'storage/profile/'.$passport}}" target="_blank"><img src="/{{'storage/profile/'.$passport}}" alt="image uploaded" width="150" height="150" style="border-radius: 50%;"></a>
                @else
                 <img src="{{asset('images/avatar.png')}}" class="img-rounded" alt="" width="150" height="150" style="border-radius: 50%;">
                @endif
                   
                    
                </div>

                <div class="col-12">
                    <label for="inputAddress" class="form-label"><i class="fas fa-image"></i> Passport</label>
                    <input type="file" class="form-control" id="" name="" wire:model.debounce.900000ms="image">
                </div>
                
                <div class="col-md-6">
                    <label for="inputCity" class="form-label"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" class="form-control" value="{{$user->email}}" id="inputCity" readonly>
                </div>
                
                <div class="col-md-6">
                    <label for="inputZip" class="form-label"><i class="fas fa-phone-alt"></i> Telephone</label>
                    <input type="text" class="form-control" wire:model.debounce.900000ms="telephone" value="{{$user->telephone}}" id="inputZip">
                </div>
                
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
  </div>
    <!-- /.content -->
  </div>
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
