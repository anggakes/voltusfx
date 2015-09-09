<div class='row'>
<div class='col-md-6'>
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
 <form role="form" action="<?= base_url('member/cancel/req/'.$cancel->id.'?type='.$type) ?>" method="post" class="" id='form-registrasi'>

  <div class="form-group">
    if you wanna send a message to admin, about your cancel request<br><br>
    <label for="exampleInputPassword1"> message</label> 
    <textarea name='message' class="form-control" id="" placeholder="Your Message .." required><?= set_value('message')?></textarea>
    <div style='color:red'><?= form_error('message') ?></div>
  </div>
  
  <div class="form-group">
    
    <button type="submit" class="btn btn-success pull-right"><i class='fa fa-sign-in'></i> Send </button>
  </div>
  <br>
                          </form>
<hr>

            </div><!-- /.box-body -->
          
</div>
</div>


<div class='col-md-6'>
  <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><i class='fa fa-info-circle'></i> Status :</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body" style="">

<br>         
<table class='table'>
<tr>
<td>Date Request </td><td>:</td><td><?= $cancel->created_at ?></td>
</tr>
<tr>
<td>Status </td><td>:</td><td><?= $cancel->status ?></td>
</tr>
</table>


            </div><!-- /.box-body -->
          
</div>
</div>
</div>

<div class='row'>

    <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><i class='fa fa-comment'></i> Message :</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body" style="">

<br>         
<?php foreach($cancel_msg as $cm){?>
<div style='margin:10px 5px; border:1px dashed #c0c0c0;padding:10px'>
  <?= ($cm->by == "member") ? "<h4 >Anda</h4>" : "<h4 class='pull-right'>".$cm->by."</h4>"; ?>
<div class='clearfix'></div>
<hr>
<?= $cm->msg ?>
<hr>
<div > <span class='label label-danger'>Date :</span> <?= $cm->created_at?></div>

</div>
<div class='clearfix'></div>
<?php } ?>


            </div><!-- /.box-body -->
          
</div>

</div>