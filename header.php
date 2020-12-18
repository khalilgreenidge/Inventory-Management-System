<!--
Author: Khalil Greenidge
Email: khalilgreenidge16@gmail.com
Created: 37/04/2015
--> 
 <!-- Logo -->
        <a href="index.php" class="logo"><img src="dist/img/logo.gif" width="50" height="45" /> H E D U</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              
				 <li class="dropdown user user-menu" style="color: white;position: absolute;left: 30%; font-size: 3.5vh;">
					Inventory Management System
				 </li>
				  
				  <!-- USER ACCOUNT: style can be found in dropdown.less -->
				  <li class="dropdown user user-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						  <img src="<?php echo $_SESSION["avatar"]; ?>" class="user-image" alt="User Image"/>
						  <span class="hidden-xs"><?php echo $_SESSION["name"]; ?></span>
						</a>
						<ul class="dropdown-menu">
						  <!-- User image -->
						  <li class="user-header">
							<img src="<?php echo $_SESSION["avatar"]; ?>" class="img-circle" alt="User Image" />
							<p>
							  <?php echo $_SESSION["name"]; ?>
							  <small>H E D U</small>
							</p>
						  </li>
						  <!-- Menu Body -->
						  <li class="user-body">
							<div class="col-xs-4 text-center">
							  <a href="#">Followers</a>
							</div>
							<div class="col-xs-4 text-center">
							  <a href="#">Sales</a>
							</div>
							<div class="col-xs-4 text-center">
							  <a href="#">Friends</a>
							</div>
						  </li>
						  <!-- Menu Footer-->
						  <li class="user-footer">
							<div class="pull-left">
							  <a href="#" class="btn btn-default btn-flat">Profile</a>
							</div>
							<div class="pull-right">
							  <a href="signout.php" class="btn btn-default btn-flat">Sign out</a>
							</div>
						  </li>
					</ul>
				  </li>
            </ul>
          </div>
        </nav>