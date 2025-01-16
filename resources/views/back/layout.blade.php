@php
$config = DB::table('configs')->first();
$configs = DB::table('configs')->first();
$service = DB::table('services')->get();
$pages = DB::table('pages')->get();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@lang('Administration')</title>
  <link rel="shortcut icon" type="image/x-icon" href="{{ url('public/Image/parametres/' . $config->icon) }}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.5/css/adminlte.min.css" />



  <!-- CSS -->
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet">

<!-- JavaScript -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>

  @yield('css')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

<!-- Navbar -->
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block d-inline-block">
          <a href="{{ route('home') }}"  class="btn btn-outline-warning btn-sm mr-3">@lang('Home Page')</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block d-inline-block">
          <form action="{{ route('logout') }}" method="POST" hidden>
              @csrf
          </form>
          <a class="btn btn-outline-danger btn-sm mr-3" href="{{ route('logout') }}"
              onclick="event.preventDefault(); this.previousElementSibling.submit();">
              @lang('Déconnexion')
          </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block d-inline-block">
      <a href="{{route('storage.link')}}"  class="btn btn-outline-warning btn-sm mr-3">
        Storage Link
    </a>
      </li>
    <li class="nav-item d-none d-sm-inline-block d-inline-block">
    <a href="{{route('cache.clear')}}"  class="btn btn-outline-danger btn-sm mr-3">
      Cache Clear
    </a>
    </li>
    </ul>


    

</nav>
<!-- /.navbar -->
  <!-- /.navbar -->
<style>
.custom-bg {
    background-color: #3b3232; /* Remplacez cette couleur par celle que vous souhaitez */
}

</style>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar custom-bg sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          @foreach(config('menu') as $name => $elements)
              @if($elements['role'] === 'redac' || auth()->user()->isAdmin())
                  @isset($elements['children'])
                      <li class="nav-item has-treeview {{ menuOpen($elements['children']) }}">
                          <a href="#" class="nav-link {{ currentChildActive($elements['children']) }}">
                              <i class="nav-icon fas fa-{{ $elements['icon'] }}"></i>
                              <p>
                                  @lang($name)
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              @foreach($elements['children'] as $child)
                                  @if(($child['role'] === 'redac' || auth()->user()->isAdmin()) && $child['name'] !== 'fake')
                                      <x-back.menu-item
                                          :route="$child['route']"
                                          :sub=true>
                                          @lang($child['name'])
                                      </x-back.menu-item>
                                  @endif
                              @endforeach
                          </ul>
                      </li>
                  @else
                      <x-back.menu-item
                          :route="$elements['route']"
                          :icon="$elements['icon']">
                          @lang($name)
                      </x-back.menu-item>
                  @endisset
              @endif
          @endforeach

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">@lang($title)</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        @yield('main')
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- Default to the left -->
    <strong>Copyright &copy; {{ date('Y') }} {{ config(('app.name'), 'TURBOSOFT') }}.</strong>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js" ></script>
<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.5/js/adminlte.min.js"></script>
@yield('js')

<style>
  .main-sidebar {
    position: fixed;
    height: 100vh; /* Assure que la sidebar couvre toute la hauteur de l'écran */
    overflow-y: auto; /* Permet de scroller si nécessaire */
}
.content-wrapper {
    margin-left: 250px; /* Ajuste l'espace pour que le contenu ne chevauche pas la sidebar */
}



    /* Sidebar fixe */
    .main-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh; /* Couvre toute la hauteur de l'écran */
            background-color: #3b3232; /* Couleur personnalisée */
            overflow-y: auto; /* Ajoute un défilement si le contenu déborde */
        }

       

</style>

<script>
  $("[data-widget='pushmenu']").PushMenu();
</script>

</body>
</html>
