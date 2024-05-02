<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
<?php //$activePage = basename($_SERVER['PHP_SELF'], ".php"); 
$GetPage = $_SERVER['PHP_SELF'];
$activeFile = str_replace('/caredoc/',"",$GetPage);
$activePage = str_replace('.php',"",$activeFile);

?>
<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link <?php if($activePage == 'home/index'){ echo 'active';} else{ echo 'collapsed'; } ?>" href="../home">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->
  <li class="nav-item ">
    <a class="nav-link <?php if($activePage == 'doctors/index' || $activePage == 'doctors/add' || $activePage == 'doctors/edit'){ echo 'active'; } else { echo 'collapsed'; }?>" data-bs-target="#doctors" data-bs-toggle="collapse" <?php if($activePage == 'doctors/index' || $activePage == 'doctors/add' || $activePage == 'doctors/edit'){ echo 'aria-expanded="true"'; }?> href="#">
      <i class="bi bi-menu-button-wide"></i><span>Doctors</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="doctors" class="nav-content collapse <?php if($activePage == 'doctors/index' || $activePage == 'doctors/add' || $activePage == 'doctors/edit'){ echo 'show';} ?>" data-bs-parent="#sidebar-nav">
    <li>
        <a href="../doctors" class="<?php if($activePage == 'doctors/index'){ echo 'active';} ?>">
          <i class="bi bi-circle"></i><span>Doctors List</span>
        </a>
      </li>  
    <li>
        <a href="../doctors/add"  class="<?php if($activePage == 'doctors/add'){ echo 'active';} ?>">
          <i class="bi bi-circle"></i><span>Add new</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item ">
    <a class="nav-link collapsed   <?php if($activePage == 'patients/index' || $activePage == 'patients/add' || $activePage == 'patients/edit'){ echo 'active'; } else { echo 'collapsed'; }?>" data-bs-target="#patients" data-bs-toggle="collapse" <?php if($activePage == 'patients/index' || $activePage == 'patients/add' || $activePage == 'patients/edit'){ echo 'aria-expanded="true"';} ?> href="#">
      <i class="bi bi-menu-button-wide"></i><span>Patients & Reports</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="patients" class="nav-content collapse <?php if($activePage == 'patients/index' || $activePage == 'patients/add' || $activePage == 'patients/edit'){ echo 'show';} ?>" data-bs-parent="#sidebar-nav">
    <li>
        <a href="../patients" class="<?php if($activePage == 'patients/index'){ echo 'active';} ?>">
          <i class="bi bi-circle"></i><span>Patients List</span>
        </a>
      </li>  
    <li>
        <a href="../patients/add" class="<?php if($activePage == 'patients/add'){ echo 'active';} ?>">
          <i class="bi bi-circle"></i><span>Add new</span>
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-item ">
    <a class="nav-link collapsed   <?php if($activePage == 'appointments/index' || $activePage == 'appointments/add' || $activePage == 'appointments/edit'){ echo 'active'; } else { echo 'collapsed'; }?>" data-bs-target="#appointments" data-bs-toggle="collapse" <?php if($activePage == 'appointments/index' || $activePage == 'appointments/add' || $activePage == 'appointments/edit'){ echo 'aria-expanded="true"';} ?> href="#">
      <i class="bi bi-menu-button-wide"></i><span>Appointments</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="appointments" class="nav-content collapse <?php if($activePage == 'appointments/index' || $activePage == 'appointments/add' || $activePage == 'appointments/edit'){ echo 'show';} ?>" data-bs-parent="#sidebar-nav">
    <li>
        <a href="../appointments" class="<?php if($activePage == 'appointments/index'){ echo 'active';} ?>">
          <i class="bi bi-circle"></i><span>My Appointments</span>
        </a>
      </li>  
   
    </ul>
  </li>

  <li class="nav-item ">
    <a class="nav-link collapsed   <?php if($activePage == 'staff/index' || $activePage == 'staff/add' || $activePage == 'staff/edit'){ echo 'active'; } else { echo 'collapsed'; }?>" data-bs-target="#staff" data-bs-toggle="collapse" <?php if($activePage == 'staff/index' || $activePage == 'staff/add' || $activePage == 'staff/edit'){ echo 'aria-expanded="true"';} ?> href="#">
      <i class="bi bi-menu-button-wide"></i><span>Staff</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="staff" class="nav-content collapse <?php if($activePage == 'staff/index' || $activePage == 'staff/add' || $activePage == 'staff/edit'){ echo 'show';} ?>" data-bs-parent="#sidebar-nav">
    <li>
        <a href="../staff" class="<?php if($activePage == 'staff/index'){ echo 'active';} ?>">
          <i class="bi bi-circle"></i><span>Staff List</span>
        </a>
      </li>  
    <li>
        <a href="../staff/add" class="<?php if($activePage == 'staff/add'){ echo 'active';} ?>">
          <i class="bi bi-circle"></i><span>Add new</span>
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link  <?php if($activePage == 'profile/index'){ echo 'active';} else {echo 'collapsed';} ?>" href="../profile">
      <i class="bi bi-person"></i>
      <span>Profile</span>
    </a>
  </li><!-- End Profile Page Nav -->

  <li class="nav-item">
    <a class="nav-link <?php if($activePage == 'faq/index'){ echo 'active';} else {echo 'collapsed';} ?>" href="../faqs">
      <i class="bi bi-question-circle"></i>
      <span>F.A.Q</span>
    </a>
  </li><!-- End F.A.Q Page Nav -->

  <li class="nav-item">
    <a class="nav-link <?php if($activePage == 'contact/index'){ echo 'active';} else {echo 'collapsed';} ?>" href="../contact">
      <i class="bi bi-envelope"></i>
      <span>Contact</span>
    </a>
  </li><!-- End Contact Page Nav -->
</ul>

</aside><!-- End Sidebar-->

