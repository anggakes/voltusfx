<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Permata Network </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    
    <!-- Bootstrap 3.3.4 -->
    <link href="<?= base_url() ?>assets/theme/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="<?= base_url() ?>assets/theme/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css" />
  
   
    
     <!-- jQuery 2.1.4 -->
    <script src="<?= base_url() ?>assets/theme/jQuery/jQuery-2.1.4.min.js"></script>
 

    <style type="text/css">
    .navbar-no-bg {background: none;
        color:white;
        border:0;
    }
    .navbar-brand{
      color:#fff;
    }
    .text{
      background:white;
      margin-top: 50px;
      margin-bottom: 50px;
      -webkit-box-shadow: -9px 11px 5px 0px rgba(0,0,0,0.75);
      -moz-box-shadow: -9px 11px 5px 0px rgba(0,0,0,0.75);
      box-shadow: -9px 11px 5px 0px rgba(0,0,0,0.75);
      border-radius: 10px 10px 10px 10px;
      -moz-border-radius: 10px 10px 10px 10px;
      -webkit-border-radius: 10px 10px 10px 10px;
      border: 0px solid #000000;
    }
    .text h3{
      margin-bottom: 20px;
      padding-bottom: 15px;
    }
    label{
      font-weight: normal;
    }
    </style>

  </head>
  <body class="">

        <!-- Top content -->
        <div class="top-content">
          
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 text">

                          <?= $contents ?>  
                        

                        </div>
                       
                    </div>
                </div>
            </div>
            
        </div>



      <!-- jQuery UI 1.11.2 -->
    <script src="<?= base_url() ?>theme/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?= base_url() ?>assets/theme/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
     <!-- Slimscroll -->
    <script src="<?= base_url() ?>assets/theme/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?= base_url() ?>assets/theme/fastclick/fastclick.min.js'></script>
     <!-- FastClick full screen background -->
    <script src="<?= base_url() ?>assets/theme/backstretch/jquery.backstretch.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function(){

    /*
        Fullscreen background
    */
    $.backstretch("<?= base_url() ?>assets/theme/auth/images/background.jpg");
    
    $('#top-navbar-1').on('shown.bs.collapse', function(){
      $.backstretch("resize");
    });
    $('#top-navbar-1').on('hidden.bs.collapse', function(){
      $.backstretch("resize");
    });


    });

    </script>
    
  </body>
</html>