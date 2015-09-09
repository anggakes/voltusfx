<div class='row'>
<?php 
if(isset($_SESSION['message'])):
?>
<div class='alert alert-<?= ($_SESSION['sukses']) ? 'success' : 'danger'?>'>
<?= $_SESSION['message']?>
</div>
<?php endif; ?>

  <div class='col-md-12'>
	<div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><i class='fa fa-money'></i> Withdraw</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body" style="">
  <form role="form" action="<?= base_url('member/withdraw/request') ?>" method="post" class="col-md-5" id='form-registrasi'>

  <div class="form-group">
    please fill this form to withdraw your money:<br><br>
    <label for="exampleInputPassword1">Amount</label> 
    <input type='number' name='amount' class="form-control" id="amount" placeholder="amount.." required value="<?= set_value('message')?>">
    <div style='color:red'><?= form_error('message') ?></div>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Message for Admin</label> 
    <textarea name='message' class="form-control" id="" placeholder="Message or reason why you cancel ?.."><?= set_value('message')?></textarea>
    <div style='color:red'><?= form_error('message') ?></div>
  </div>
  
  <div class="form-group">
    
    <button type="submit" class="btn btn-success pull-right"><i class='fa fa-sign-in'></i> Send </button>
  </div>
  <br>
                          </form>
            </div><!-- /.box-body -->
          
</div>
</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
  $("#amount").val(0);
  $("#amount").focus();
})
</script>
