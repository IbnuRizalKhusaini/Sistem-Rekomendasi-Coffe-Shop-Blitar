 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="index.html">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->


  <li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('admin.alternatives.index') }}">
      <i class="bi bi-layout-text-window-reverse"></i><span>Alternatives</span><i ></i>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('admin.criterias.index') }}">
      <i class="bi bi-layout-text-window-reverse"></i><span>Criterias</span><i ></i>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('admin.input-matrix.index') }}">
      <i class="bi bi-layout-text-window-reverse"></i><span>Input Matriks</span><i ></i>
    </a>
  </li>
  
  <!-- End Tables Nav -->

</aside><!-- End Sidebar-->