<?php $user = unserialize($_SESSION['login_user']); ?>
          <?php 
              function active_menu($menu,$active){
                return ($menu==$active) ? "active" : "";
              }

               $member = $user->getMember();

          ?>
          
          <ul class="sidebar-menu">
             
             <!-- ###### Member ##################################-->
             <?php if($user->hasRole('member')){ ?>
                
                <li class="header">MEMBER MENU</li>
                <li class="<?= active_menu($menu,"dashboard_member") ?>">
                  <a href="<?= base_url(); ?>member/home"><i class="fa  fa-dashboard"></i> Dashboard
                    
                  </a>
                </li>

<?php // untuk member aktif 
if($member->dataMember->status != "tidak aktif"){ 
?> 
                
                <li class="<?= active_menu($menu,"dashboard_admin") ?>">
                  <a href="../UI/general.html"><i class="fa  fa-star"></i> Bonus
                    
                  </a>
                </li>
                 <li class="treeview">
                    <a href="#">
                      <i class="fa fa-money"></i>
                      <span>Withdraw</span>
                      <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu" style="display: none;">
                      <li class="<?= active_menu($menu,"dashboard_admin") ?>">
                          <a href="../UI/general.html"><i class="fa  fa-circle-o"></i> Request Withdraw
                          </a>
                      </li>
                      <li class="<?= active_menu($menu,"dashboard_admin") ?>">
                          <a href="../UI/general.html"><i class="fa  fa-circle-o"></i> History Withdraw
                          </a>
                      </li>
                      
                    </ul>
                 </li>   
                 <li <?= active_menu($menu,"dashboard_admin") ?>>
                  <a href="../UI/general.html"><i class="fa  fa-sitemap"></i> Downline
                    
                  </a>
                </li>
                 <li <?= active_menu($menu,"dashboard_admin") ?>>
                  <a href="../UI/general.html"><i class="fa  fa-comment"></i> Feedback 
                    
                  </a>
                </li>

<?php } ?>     
              
             <?php } ?>






             <!-- ###### ADMIN ##################################-->
             <?php if($user->hasRole('admin')){ ?>
                
                <li class="header">ADMIN MENU</li>
                <li class="<?= active_menu($menu,"dashboard_admin") ?>">
                  <a href="<?= base_url(); ?>admin/home"><i class="fa  fa-dashboard"></i> Dashboard</a>
                </li>      
               <li class="<?= active_menu($menu,"member_lists") ?>">
                  <a href="<?= base_url(); ?>admin/member/lists"><i class="fa  fa-user"></i> Members List</a>
                </li>
                <li class="<?= active_menu($menu,"member_cancel") ?>">
                  <a href="<?= base_url(); ?>admin/member/cancel"><i class="fa fa-close"></i> Member Cancel</a>
                </li>
                <li class="<?= active_menu($menu,"withdraw_list") ?>">
                  <a href="../UI/general.html"><i class="fa  fa-money"></i> Withdraw List</a>
                </li>
                <li class="<?= active_menu($menu,"pages") ?>">
                  <a href="<?= base_url(); ?>admin/contents/pages"><i class="fa  fa-columns"></i> Pages</a>
                </li>
                 <li class="<?= active_menu($menu,"news") ?>">
                  <a href="<?= base_url(); ?>admin/contents/news"><i class="fa  fa-newspaper-o"></i> News</a>
                </li>
                 <li class="<?= active_menu($menu,"announcement") ?>">
                  <a href="<?= base_url(); ?>admin/announcement"><i class="fa  fa-bullhorn"></i> Announcement</a>
                 </li>
                 <li class="<?= active_menu($menu,"configuration") ?>">
                  <a href="../UI/general.html"><i class="fa  fa-gears"></i> Configuration</a>
                </li>

             <?php } ?>

             <!--########## SUPER ADMIN ###########################S-->
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
