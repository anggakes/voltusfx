<style type="text/css">
  h4{
    display:block;
    height:30px;
    background-image: -webkit-linear-gradient(#ededed, #ededed 38%, #dedede);
text-shadow: 0 1px 0 rgb(240, 240, 240);
box-shadow: 0 1px 0 rgba(0, 0, 0, 0.08), inset 0 1px 2px rgba(255, 255, 255, 0.75);
    text-align: center;
    padding:5px;
    border-radius: 10 10px 0px 0px;
-moz-border-radius: 10px 10px 0px 0px;
-webkit-border-radius: 10px 10px 0px 0px;
color:#444;
  }

  #loading, #dataReferral{
    border:1px dashed #c0c0c0;
    padding:10px;
    display:none;
    margin:10px 0px;

  }
</style>
<script type="text/javascript">
var RecaptchaOptions = {
    theme : 'red'
};  
</script>

<h3 class='col-sm-8'><strong>Member</strong> <small>Registration Form</small></h3>
    
   <a class='pull-right btn btn-link' href="<?= base_url() ?>"><i class='fa fa-home'> </i> Back To Homepage</a>
   <a href="<?= base_url() ?>auth/login" class='btn btn-link pull-right'> Sudah Punya Akun ?</a>
<div class='clearfix'></div>
  <form role="form" action="<?= base_url() ?>auth/daftar" method="post" class="col-sm-11" id='form-registrasi'>
    <div class="form-group">
<h4>Akun </h4>
    <label for="exampleInputEmail1">Username</label>
    <input type="text" name='member[username]' value = "<?= set_value('member[username]')?>" class="form-control" id="" placeholder="Username.." required>
    <div style='color:red'><?= form_error('member[username]') ?></div>
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Alamat Email</label>
    <input type="email" name='member[email]' value = "<?= set_value('member[email]')?>" class="form-control" id="" placeholder="Email.." required>
    <div style='color:red'><?= form_error('member[email]') ?></div>
    </div>
  <div class='row'>
  <div class="form-group col-sm-6">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name='member[password]' class="form-control" id="" placeholder="Password.." required>
    <div style='color:red'><?= form_error('member[password]') ?></div>
  </div>
  <div class="form-group col-sm-6">
    <label for="exampleInputPassword1">Konfirmasi Password</label>
    <input type="password" name='member[repassword]' class="form-control" id="" placeholder=" Retype Password.." required>
    <div style='color:red'><?= form_error('member[repassword]') ?></div>
  </div>
</div>
  <div class="form-group">
    
    <label for="exampleInputPassword1">Kode Referal Atau Username</label>
    <input  type="text" name='member[referral_code]' value = "<?= (isset($kode_referral))? $kode_referral : set_value('member[referral_code]')?>" class="form-control" id="usernameOrRefcode" placeholder=" Kode Referal.:C67TY8I" required>
    <div style='color:red'><?= form_error('member[referral_code]') ?></div>
    <br>
    <div id='loading'> <center>loading</center></div>
    <div id='dataReferral' class='row'>
        <div id='foto' class='col-md-4'>

        </div>
        <div id='dataReferralProfile' class='col-md-8' >

        </div>
    </div>
  </div>
 <hr>
 <h4>Biodata </h4>
<div class="form-group">
    <label for="exampleInputPassword1">Nama Lengkap</label>
    <input type="text" name='profile[nama]' value = "<?= set_value('profile[nama]')?>" class="form-control" id="" placeholder=" Nama Lengkap Anda.." required>
    <div style='color:red'><?= form_error('profile[nama]') ?></div>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Alamat</label>
    <input type="text" name='profile[alamat]' value = "<?= set_value('profile[alamat]')?>" class="form-control" id="" placeholder=" Alamat Tempat Tinggal.." required>
    <div style='color:red'><?= form_error('profile[alamat]') ?></div>
  </div>
<div class='row'>
  <div class="form-group col-sm-6">
    <label for="exampleInputPassword1">Provinsi</label>
    <input type="text" name='profile[provinsi]' value = "<?= set_value('profile[provinsi]')?>" class="form-control" id="" placeholder=" Provinsi.." required>
    <div style='color:red'><?= form_error('profile[provinsi]') ?></div>
  </div>
  <div class="form-group col-sm-6">
    <label for="exampleInputPassword1">Kota</label>
    <input type="text" name='profile[kota]' value = "<?= set_value('profile[kota]')?>" class="form-control" id="" placeholder=" Kota.." required>
    <div style='color:red'><?= form_error('profile[kota]') ?></div>
  </div>

</div>

  <div class="form-group">
    <label for="exampleInputPassword1">Kode Pos</label>
    <input type="text" name='profile[kode_pos]' value = "<?= set_value('profile[kode_pos]')?>" class="form-control" id="" placeholder=" Kode Pos.." required>
    <div style='color:red'><?= form_error('profile[kode_pos]') ?></div>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Nomor Handphone</label>
    <input type="text" name='profile[no_hp]' value = "<?= set_value('profile[no_hp]')?>" class="form-control" id="" placeholder=" Nomor Yang Bisa Dihubungi.." required>
    <div style='color:red'><?= form_error('profile[no_hp]') ?></div>
  </div>

  <h4>Informasi Rekening </h4>
    <div class="form-group">
    <label for="exampleInputPassword1">Nama Bank</label>
    <?php echo form_dropdown('profile[nama_bank]',$bank,set_value('profile[nama_bank]'),'class=form-control') ?>
    <div style='color:red'><?= form_error('profile[nama_bank]') ?></div>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Nomor Rekening</label>
    <input type="text" name='profile[no_rekening]' value = "<?= set_value('profile[no_rekening]')?>" class="form-control" id="" placeholder=" Nomor Rekening.." required>
    <div style='color:red'><?= form_error('profile[no_rekening]') ?></div>
  </div>
      <div class="form-group">
    <label for="exampleInputPassword1">Nama Rekening</label>
    <input type="text" name='profile[nama_rekening]' value = "<?= set_value('profile[nama_rekening]')?>" class="form-control" id="" placeholder=" a.n Rekening Anda" required>
    <div style='color:red'><?= form_error('profile[nama_rekening]') ?></div>
  </div>
  <?php echo $this->recaptcha->render(); ?>
  <div style='color:red'><?= form_error('recaptcha_response_field') ?></div>
   <div class="checkbox">
    <label>
      <input class='setuju' type="checkbox" name='accept_terms_checkbox' required> Setuju dengan ketentuan dan syarat 
    </label>
      <div style='color:red'><?= form_error('accept_terms_checkbox') ?></div>
  </div>
  <hr>
    <div class="form-group">
  <button type="submit" class="btn btn-danger pull-right">Daftar <br> Menjadi Member </button>

  </div>
  <div class='clearfix'></div>
  <br>
                          </form>


<script type="text/javascript">
$(document).ready(function(){

    
// kalo ada waktu perbaiki request jika selesai ngetik aja
    //
// $('#element').donetyping(callback[, timeout=1000])
// Fires callback when a user has finished typing. This is determined by the time elapsed
// since the last keystroke and timeout parameter or the blur event--whichever comes first.
//   @callback: function to be called when even triggers
//   @timeout:  (default=1000) timeout, in ms, to to wait before triggering event if not
//              caused by blur.
// Requires jQuery 1.7+
//
;(function($){
    $.fn.extend({
        donetyping: function(callback,timeout){
            timeout = timeout || 1e3; // 1 second default timeout
            var timeoutReference,
                doneTyping = function(el){
                    if (!timeoutReference) return;
                    timeoutReference = null;
                    callback.call(el);
                };
            return this.each(function(i,el){
                var $el = $(el);
                // Chrome Fix (Use keyup over keypress to detect backspace)
                // thank you @palerdot
                $el.is(':input') && $el.on('keyup keypress paste',function(e){
                    // This catches the backspace button in chrome, but also prevents
                    // the event from triggering too premptively. Without this line,
                    // using tab/shift+tab will make the focused element fire the callback.
                    if (e.type=='keyup' && e.keyCode!=8) return;
                    
                    // Check if timeout has been set. If it has, "reset" the clock and
                    // start over again.
                    if (timeoutReference) clearTimeout(timeoutReference);
                    timeoutReference = setTimeout(function(){
                        // if we made it here, our timeout has elapsed. Fire the
                        // callback
                        doneTyping(el);
                    }, timeout);
                }).on('blur',function(){
                    // If we can, fire the event since we're leaving the field
                    doneTyping(el);
                });
            });
        }
    });
})(jQuery);


    $("#usernameOrRefcode").donetyping(function(){
           getReferral_code();
    });


    function getReferral_code(){
       
        $('#dataReferral').hide();
        $('#loading').show();
        var usernameOrRefcode = $("#usernameOrRefcode").val();
        if(usernameOrRefcode!=''){
              $.ajax({
            url: "<?= base_url()?>auth/get_referral_code/"+usernameOrRefcode,
        })
        .done(function( d ) {
            var data = jQuery.parseJSON(d);
            if(data.success == true) {
              $('#loading').hide();
              $('#dataReferral').show();
              var stat;
              var nama = "<b>Nama </b>         : "+data.nama+"<br>";
              var username = "<b>Username </b>     : "+data.username+"<br>";
              var kode = "<b>kode Referral</b> : "+data.codex+"<br>";
              var foto = data.foto;

              if(data.status_member == 1){
                stat = "Aktif";
              }else{
                stat = "Tidak Aktif";
              }
              var status = "<b>Status</b> : "+stat+"<br>";

              var dataReferral = nama+username+kode+status;

              $('#dataReferralProfile').html(dataReferral);
              $('#foto').html(foto);
              $('#usernameOrRefcode').val(data.codex);

            }else{
              $('#dataReferral').hide();
              $('#loading').hide();
            }
        }); 
        }else{
          $('#dataReferral').hide();
              $('#loading').hide();
        }
        
    }

    <?= (isset($kode_referral)) ? "getReferral_code();" : '' ?>


    
});

</script>