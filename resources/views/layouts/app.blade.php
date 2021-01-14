
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PG INTRA-MAILING SYSTEM</title>
        

  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
         
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
         <link rel="stylesheet" href="{{asset('style.css')}}">
           <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
           <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
        
        
         <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>


         <livewire:styles />
         
    </head>
    <body style="background-color: whitesmoke;" class="hold-transition sidebar-mini">
           
<div>
    @yield('content')
</div>
<livewire:scripts />
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>



<script src="{{asset('dist/js/adminlte.min.js')}}"></script>


</body>
</html>
