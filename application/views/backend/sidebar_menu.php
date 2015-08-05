<?php $user = unserialize($_SESSION['login_user']); ?>
          <?php 
              function active_menu($menu,$active){
                return ($menu==$active) ? "active" : "";
              }
          ?>
  
          <ul class="sidebar-menu">
             
             <!-- SUPER ADMIN -->
             <?php if($user->hasRole('admin')){ ?>
                 <li class="header">ADMIN MENU</li>
            
             
            
            <li <?= active_menu($menu,"member_list") ?>><a href="../UI/general.html"><i class="fa  fa-user"></i> Members List</a></li>
            <li ><a href="icons.html"><i class="fa fa-close"></i> Member Cancel</a></li>
            <li <?= active_menu($menu,"withdraw_list") ?>><a href="../UI/general.html"><i class="fa  fa-money"></i> Withdraw List</a></li>
             <li <?= active_menu($menu,"news") ?>><a href="../UI/general.html"><i class="fa  fa-newspaper-o"></i> News</a></li>
             <li <?= active_menu($menu,"announcement") ?>><a href="../UI/general.html"><i class="fa  fa-bullhorn"></i> Announcement</a></li>
             <li <?= active_menu($menu,"configuration") ?>><a href="../UI/general.html"><i class="fa  fa-gears"></i> Configuration</a></li>

             <?php } ?>

             <!-- SUPER ADMIN -->
             <?php if($user->hasRole('super_admin')){ ?>
             <li class="header">SUPER ADMIN MENU</li>
            
                  <li class="<?= active_menu($menu,"users_management") ?>" >
                    <a href="<?= base_url("admin/management/users"); ?>">
                      <i class="fa fa-user"></i> <span>Users Management</span>
                    </a>
                  </li>
                  <li class="<?= active_menu($menu,"roles_management") ?>">
                    <a href="<?= base_url("admin/management/roles"); ?>">
                      <i class="fa fa-group"></i> <span>Roles Management</span>
                    </a>
                  </li>
                  <li class="<?= active_menu($menu,"privileges_management") ?>">
                    <a href="<?= base_url("admin/management/privileges"); ?>">
                      <i class="fa fa-warning"></i> <span>Privileges Management</span>
                    </a>
                  </li>
              <?php } ?>



         </ul>
