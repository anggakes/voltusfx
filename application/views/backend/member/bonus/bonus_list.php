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
              <h3 class="box-title"><i class='fa fa-money'></i> Unclaimed Bonus</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body" style="">
              You can claim your bonus after trial period of your new downline.

<a href="<?= base_url("member/bonus/claimall") ?>" class='btn btn-danger pull-right'>Claim All Bonus</a>
<?php if($this->uri->segment(3) != 'history'){?>
<a href="<?= base_url("member/bonus/history") ?>" class='btn btn-link pull-right'>History</a> 
<?php }else{ ?>
<a href="<?= base_url("member/bonus") ?>" class='btn btn-link pull-right'>unclaimed</a> 
<?php } ?>
              <br><hr>
              <table class='table' id="datatable">
                <thead>
                  <tr>
                    <td>Created At</td>
                    <td>Member</td>
                    <td>Bonus Type</td>
                    <td>Amount</td>
                    <td>Status</td>
                    <td>Claim Time</td>
                  </tr>
                </thead>  
            	<?php 
                foreach ($bonus as $key => $value) {
              ?>

              <tr>
                <td><?= $value->created_at ?></td>
                <td><?= $value->username ?></td>
                <td><?= $value->bonus_type ?></td>
                <td><?= $value->amount?></td>
                <td><?= $value->status?></td>
                <td>
                  <?php 
$limit = date('Y-m-j H:i:s',strtotime($value->created_at.'+ 14 days'));

                  if(strtotime($value->created_at.'+ 14 days') > strtotime('now')) {?>
                        <span class='label label-success clock'> <?= $limit?></span>
                  <?php }else{?>
                       -
                  <?php } ?>
                </td>
              </tr>
              <?php
                }
              ?>
              </table>
            </div><!-- /.box-body -->
          
</div>
</div>
</div>

<script type="text/javascript">
      $(document).ready(function () {

         $('#datatable').dataTable( {
              "order": [[ 1, 'desc' ]],
              "scrollX": true 
          } );

         $('.clock').each(function(){
                  $(this).countdown($(this).html(), function(event) {
                          $(this).html(event.strftime('%D Days %H:%M:%S'));
                        });

                });

      });
    </script>