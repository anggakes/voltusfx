
<h3 class='col-xs-9'>Login <?= ucfirst($role) ?></h3>
<div class='col-xs-2'>
<br>
  <a href="<?= base_url()?>auth/register" class='btn btn-link'><i class='fa fa-user'></i> Buat Akun</a></div>
    <div class='clearfix'></div>
     
    <?php if(isset($_SESSION['error_message'])): ?> 
      <div class='alert alert-danger'>
        <?= $_SESSION['error_message'] ?>
      </div>
    <?php endif; ?>
    
<?php 
if(isset($message)):
?>
<div class='alert alert-<?= ($success=='true') ? 'success' : 'danger'?>'>
<?= $message ?>
</div>
<?php endif; ?>

<div class='row'>
<div class='col-xs-3'>
 <center>
  <br>
<img width='100px' src='<?= base_url() ?>assets/theme/auth/images/user-login-icon.png'/>
</center>
</div>
<div class='col-xs-9'>
    <form role="form" action="<?= base_url('auth/login/'.$role) ?>" method="post" class="col-sm-11" id='form-registrasi'>
    <div class="form-group">
    <label for="exampleInputEmail1">Username atau Email</label> 
    <input type="text" name='usernameOrEmail' class="form-control" id="" placeholder="Username atau Email.." required>
    <div style='color:red'><?= form_error('usernameOrEmail') ?></div>
    </div>


  <div class="form-group">
    <label for="exampleInputPassword1">Password</label> 
    <input type="password" name='password' class="form-control" id="" placeholder="Password.." required>
    <div style='color:red'><?= form_error('password') ?></div>
  </div>
  
  <div class="form-group">
    <a href="<?= base_url()?>auth/forget_password" class='btn'> Lupa Password ?</a>
    <button type="submit" class="btn btn-success pull-right"><i class='fa fa-sign-in'></i> Masuk </button>
    <a class='pull-right btn ' href="<?= base_url() ?>"><i class='fa fa-home'></i> </a>

  </div>
  <br>
                          </form>
  

</div>
<div class='clearfix'></div>
</div>