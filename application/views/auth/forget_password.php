
<?php if($status == "kirim_token"){?>
<h3 class='col-sm-11'>Lupa Password</h3>
    <div class='clearfix'></div>
      
    <?php if(isset($_SESSION['error_message'])): ?> 
      <div class='alert alert-danger'>
        <?= $_SESSION['error_message'] ?>
      </div>
    <?php endif; ?>
    
    <form role="form" action="<?= base_url() ?>auth/forget_password" method="post" class="col-sm-11" id='form-registrasi'>
    <div class="form-group">
    <label for="exampleInputEmail1">Username atau Email</label> 
    <input type="text" name='usernameOrEmail' class="form-control" id="" placeholder="Username atau Email.." required>
    <div style='color:red'><?= form_error('usernameOrEmail') ?></div>
    </div>
  
  <div class="form-group">
  <button type="submit" class="btn btn-danger pull-right">Kirim </button>
  </div>
  <div class='clearfix'></div>
  <br>
                          </form>
<?php }elseif($status == "sukses_kirim"){ ?>


<h3 class='col-sm-11'>Lupa Password</h3>
    <div class='clearfix'></div>
      <br><br>
   <center> Harap periksa email anda untuk mereset password<br> harap cek juga folder spam anda</center>
<br><br><br><br>
<?php }elseif($status == "gagal_kirim"){ ?>

<h3 class='col-sm-11'>Lupa Password</h3>
    <div class='clearfix'></div>
      <br><br>
   <center> Maaf Username atau email yang anda masukan salah atau terjadi kesalahan </center>
<br><br><br><br>

<?php }elseif($status == "proses"){ ?>

<h3 class='col-sm-11'>Lupa Password</h3>
    <div class='clearfix'></div>
      
    <?php if(isset($_SESSION['error_message'])): ?> 
      <div class='alert alert-danger'>
        <?= $_SESSION['error_message'] ?>
      </div>
    <?php endif; ?>
    
    <form role="form" action="<?= base_url('auth/proses_forget_password?u='.$u.'&k='.$k) ?>" method="post" class="col-sm-11" id='form-registrasi'>
    <div class="form-group">
  <div class="form-group">
    <label for="exampleInputPassword1">Password Baru</label> 
    <input type="password" name='password' class="form-control" id="" placeholder="Password Baru Anda.." required>
    <div style='color:red'><?= form_error('password') ?></div>
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Konfirmasi Password Baru</label> 
    <input type="password" name='repassword' class="form-control" id="" placeholder="Ulangi Password Baru Anda.." required>
    <div style='color:red'><?= form_error('repassword') ?></div>
  </div>
  
  <div class="form-group">
  <button type="submit" class="btn btn-danger pull-right">Ubah </button>
  </div>
  <div class='clearfix'></div>
  <br>
                          </form>
<?php }elseif($status == "proses_ok"){ ?>
<br><br>
<center>
  Password anda sudah berhasil di ubah, silahkan login dengan password baru
<h3>
<a href='<?= base_url()."auth/login/member" ?>' class='btn btn-danger' >Login</a>
</h3>
</center>
<?php }elseif($status == "proses_gagal"){ ?>
<br><br>
<center>
Terjadi kesalahan atau kode key salah !!!
</center>
<br><br><br><br>

<?php } ?>
