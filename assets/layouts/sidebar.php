<aside id="sidebar" class="sidebar-wrapper open">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="user-pic">
        <a href='../profile'>
        <?php if ($user->profile_pic){ echo "<img src='../assets/uploads/users/".$user->profile_pic."'>"; }?>
        <?php if (empty($user->profile_pic)){ 
                            echo substr($_SESSION['username'], 0, 1); 
                            } ?>
        </a>
        </div>
        <div class="user-info">
        <a href='../profile'><span class="user-name">  <?php echo $_SESSION['username'] ?>          </span></a>
          <span class="user-role"> <?php echo $_SESSION['email'] ?></span>
          <span class="user-status">
          <a href="../profile-edit">
            <i class="fa fa-pencil-alt fa-1x edit-profile" aria-hidden="true"></i>  
            <span>Edit Profile</span>
            </a>
          </span>
        </div>
      </div>
      <div class="sidebar-menu">
        <ul>
          <li class="header-menu">
            <span>General</span>
          </li>

          <li class="sidebar-dropdown">
            <a href="javascript:void();">
              <i class="fa fa-user-md"></i>
              <span>Doctors</span>
              <span class="badge badge-pill badge-success">1</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
              <li>
                  <a href="../doctors">All</a>
                </li>
                <li>
                  <a href="../doctors/add.php">Add new</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fa fa-tachometer-alt"></i>
              <span>Attendant</span>
              <span class="badge badge-pill badge-success">1</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="#">Add new</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fa fa-tachometer-alt"></i>
              <span>Appointments</span>
              <span class="badge badge-pill badge-success">1</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="#">Add new</a>
                </li>
              </ul>
            </div>
          </li>
          
          
          <li><small>Last logged in at <?php echo date("m-d-Y", strtotime($_SESSION['last_login_at'])); ?></small></li>
        </ul>
      </div>
      <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-content  -->
    <div class="sidebar-footer">
      <a href="#">
        <i class="fa fa-bell"></i>
        <span class="badge badge-pill badge-warning notification">3</span>
      </a>
      <a href="#">
        <i class="fa fa-envelope"></i>
        <span class="badge badge-pill badge-success notification">7</span>
      </a>
      <a href="#">
        <i class="fa fa-cog"></i>
        <span class="badge-sonar"></span>
      </a>
      <a href="../logout">
        <i class="fa fa-power-off"></i>
      </a>
    </div>
  </aside>