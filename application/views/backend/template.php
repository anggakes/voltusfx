<?php 

  $user = unserialize($_SESSION['login_user']);
  $member = $user->getMember();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Voltus Fx</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    
    <!-- Bootstrap 3.3.4 -->
    <link href="<?= base_url() ?>assets/theme/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
 
    <!-- FontAwesome 4.3.0 -->
    <link href="<?= base_url() ?>assets/theme/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css" />
  
    <!-- Theme style -->
   
    <link href="<?= base_url() ?>assets/theme/backend/css/_all-skins.min.css" rel="stylesheet" type="text/css" />
     <link href="<?= base_url() ?>assets/theme/backend/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->

   
     <!-- DATA TABLES 
    <link href="<?= base_url() ?>theme/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    -->

    <!-- jQuery 2.1.4 -->
    <script src="<?= base_url() ?>assets/theme/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.2 -->
    <script src="<?= base_url() ?>assets/theme/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

     <!-- DATA TABES SCRIPT 
    <script src="<?= base_url() ?>theme/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>theme/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    -->
 
  </head>
    <?php 
      $theme = ($user->hasRole("admin")) ? "skin-green-light" : "skin-blue-light";
    ?>

  <body class="<?= $theme ?> sidebar-mini layout-boxed">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="<?= base_url() ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>Vfx</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Voltus</b>Fx
            
            <sup style='color:red'><?= $user->dataRoles[0]->name ?></sup>

          </span> 
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a> -->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <?php if($user->hasRole('member')) { ?>
              <li>
                  <a href="#!" >eWallet : $<?= $member->getWallet() ?></a>

              </li>
              <li>
                  <a href="#!" >Status : <span class='lbl'><?= strtoupper($member->dataMember->status) ?></span></a>

              </li>
              <?php } ?>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs">
                  
                </span>
                <img src="<?php //base_url() ?>foto_profil/<?php //($user->profile('foto') != '')? $user->profile('foto')  :"default.png"?>" class="user-image" alt="User Image"/>
                
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    
                    <img src="<?php base_url() ?>foto_profil/<?php //($user->profile('foto') != '')? $user->profile('foto')  :"default.png"?>" class="img-circle" alt="User Image" />
                    
                    <p>
                        
                        <?php /*
                        if ($_SESSION['login_role'] == "members") { 
                          echo $user->attributes('code'); 
                        }else{ 
                          echo $user->getRole();
                        }
                        ?> 
                        - 
                        <?php echo($user->profile('nama')) */?>
                      

                      <small>Bergabung Sejak : <? /*php echo($user->attributes('created_at')) */?></small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                 
                  <!-- Menu Footer-->
                  <li class="user-footer">

                    <?php /* if($_SESSION['login_role'] == "members"){?>
                    <div class="pull-left">
                      <a href="<?= base_url('profile/edit'); ?>" class="btn btn-default btn-flat">Edit Profil</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?= base_url('profile/'.$user->attributes('username')) ?>" class="btn btn-default btn-flat">Lihat Profil</a>
                    </div>
                    <?php } ?>
                    <?php if($_SESSION['login_role'] == "admin"){?>
                    <div class="pull-right">
                      <a href="<?= base_url('admin/profileadmin/edit') ?>" class="btn btn-default btn-flat">Edit Profil</a>
                    </div>
                    <?php } */?>
                  </li>
                </ul>
              </li>
               <style type="text/css">
                .lbl{
                  background:#ca195a !important;
                  color: white;
                  padding:5px ;
                  border-radius: .25em;
                  font-weight: bold;
                }
               </style>
               
            <li>
                  <a href="<?= base_url('auth/logout/'.$user->dataRoles[0]->name) ?>" ><i class='fa fa-sign-out'></i> Log out</a>

              </li>
           
              
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
          <!-- Sidebar user panel -->
<?php /*if ($_SESSION['login_role'] == "members") : ?> 
          <div class="user-panel" style='background:#000'>
            <h5 style='color:#c0c0c0'>Kode Member :</h5>
            <h2 style='text-align:center;color:#c0c0c0'><?= $user->attributes('code') ?></h2>
              
          </div>
<?php endif;*/ ?>

          <!-- sidebar menu: : style can be found in sidebar.less -->

          <?php include_once('sidebar_menu.php'); ?>


        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           <?= @$title ?>
           <br>
          </h1>
          <ol class="breadcrumb">
            <?php if(isset($breadcrumb)){ 
                foreach($breadcrumb as $b){
              ?>

            <li><a href="<?=@$b['link'] ?>"><?= @$b['icon']?> <?= @$b['nama']?> </a></li>
            <?php } }?>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <?= $contents ?>
          
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
       <span class='pull-right'>email : <strong>info@voltusfx.com</strong></span>
        <strong>Copyright &copy; 2015 <a href="#"></a>.</strong> All rights reserved.
      </footer>
      
    
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      
    </div><!-- ./wrapper -->

    <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-body">
              loading...
            </div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->

    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>

    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?= base_url() ?>assets/theme/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
    <!-- Slimscroll -->
    <script src="<?= base_url() ?>assets/theme/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?= base_url() ?>assets/theme/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>assets/theme/backend/js/app.min.js" type="text/javascript"></script>    
    <!-- Countdown -->
    <script type="text/javascript" src="<?= base_url() ?>assets/theme/jquery-countdown/jquery.countdown.min.js"></script>
    

    <script type="text/javascript">

        function refreshModal(loading){

          $(document.body).on('hidden.bs.modal', function () {
              $('#myModal .modal-content').html("<div class='modal-body'>"+loading+"</div>");
              $('#myModal').removeData('bs.modal')
          });
        }


        /* refresh modal u can change the text with img */
        refreshModal("Loading..");

        // jika tombol dengan id proses di tekan. hanya boleh satu kali.
        $(".proses").one("click", function() {
            $(this).click(function () { 
              $(this).attr('disabled','disabled');
              return false; 
            });
            
            $(".proses").click(function () { 
              $(this).prop('disabled',true);
            });

        });
    </script>
  </body>
</html>