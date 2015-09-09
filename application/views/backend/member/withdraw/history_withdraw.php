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
              <h3 class="box-title"><i class='fa fa-history'></i> Withdraw history</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body" style="">
              
              <table class='table' id="datatable">
                <thead>
                  <tr>
                    <td>Created At</td>
                    <td>Amount</td>
                    <td>status</td>
                  </tr>
                </thead>  
            	<?php 
                foreach ($withdraw as $key => $value) {
              ?>

              <tr>
                <td><?= $value->created_at ?></td>
                <td><?= $value->amount ?></td>
                <td><?= $value->status?></td>
                </tr>
              <?php } ?>
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

      

      });
    </script>