<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link collapsed" href="dashboard.php">
      <i class="bi bi-grid"></i>
      <span >Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->
 
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#Users-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-person"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="Users-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="../admin/userAdd.php">
          <i class="bi bi-circle"></i><span>Add Users</span>
        </a>
      </li>
      <li>
        <a href="userManage.php">
          <i class="bi bi-circle"></i><span>Manage Users</span>
        </a>
      </li>
    </ul>
  </li><!-- End Users Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="../admin/table.php">
      <i class=" bi bi-layout-text-window-reverse"></i>
      <span>Table</span>
    </a>
  </li><!-- End Table Page Nav -->



  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#Product-nav" data-bs-toggle="collapse" href="">
        <i class="bi bi-journal-text"></i><span>Product</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="Product-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
        <a href="../admin/addProduct.php">
            <i class="bi bi-circle"></i><span>Add Product</span>
        </a>
        </li>
        <li>
        <a href="../admin/product.php">
            <i class="bi bi-circle"></i><span>Manage Product</span>
        </a>
        </li>
    </ul>
  </li><!-- End Users Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href=" ../admin/history.php">
      <i class=" bi bi-menu-button-wide"></i>
      <span>History</span>
    </a>
  </li><!-- End History Page Nav -->

  <li class="nav-heading">Pages</li>



  <li class="nav-item">
    <a class="nav-link collapsed" href="../index.php">
      <i class="bi bi-box-arrow-in-right"></i>
      <span>Logout</span>
    </a>
  </li><!-- End Login Page Nav -->

</ul>

</aside><!-- End Sidebar-->