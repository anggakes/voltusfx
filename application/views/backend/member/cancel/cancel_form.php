<div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><i class='fa fa-close'></i> Form Cancel</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body" style="">

<br>         
 <form role="form" action="<?= base_url('member/cancel/req?type='.$type) ?>" method="post" class="" id='form-registrasi'>

  <div class="form-group">
    You can cancel your payment and request your money back.
    please fill this form:<br><br>
    <label for="exampleInputPassword1">Reason / message</label> 
    <textarea name='message' class="form-control" id="" placeholder="Message or reason why you cancel ?.." required><?= set_value('message')?></textarea>
    <div style='color:red'><?= form_error('message') ?></div>
  </div>
  
  <div class="form-group">
    
    <button type="submit" class="btn btn-success pull-right"><i class='fa fa-sign-in'></i> Send </button>
  </div>
  <br>
                          </form>


            </div><!-- /.box-body -->
          
</div>