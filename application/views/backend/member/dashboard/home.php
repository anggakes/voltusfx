


<?php 
$message = $this->input->get("message");
$success = $this->input->get("success");
if(isset($message)):
?>
<div class='alert alert-<?= ($success=='true') ? 'success' : 'danger'?>'>
<?= $message ?>
</div>
<?php endif; ?>

<div class='row'>
  <div class='col-md-6'>
  	<!-- Warning message -->
  	
  	<div class='alert alert-danger alert-dismissable'> 
  		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  		<h4><i class="icon fa fa-warning"></i> Alert!</h4>
  		<ul>
  			<li>Data Trading Account belum diisi </li>
  			<li>Data Trading Account belum diisi </li>
  		</ul>
  	</div>

<div class='marquee row' style='margin:10px 0px;background:white;padding:15px;'>

        <b><i class='fa fa-bullhorn'></i> Pengumuman : </b> <br><br><marquee class='col-md-12' style='font-size:10pt'>aksd
        asdaskasd
        asdaskasdsdasda
        dasdas

      </marquee></div>
<div class='clearfix'></div>


	<div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><i class='fa fa-group'></i> Link Referral</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body" style="">
              
            	<a href="http://www.voltusfx.com/ref/<?= $user->dataUser->username ?>">
            		http://www.voltusfx.com/ref/<?= $user->dataUser->username ?></a>
            </div><!-- /.box-body -->
          
</div>

</div> <!-- End col-md-6 -->

  <div class='col-md-6'>
      <?php if($member->dataMember->status == "trial") {?>
          <div class="box">
           
            <div class="box-body" style="">
              Trial time : <span class='label label-success clock'> <?= date('Y-m-j H:i:s',strtotime($member->dataMember->activation_at.'+ 14 days'));?></span> <br>
              
              On trial period you can cancel payment 
              <a href="<?= base_url('member/cancel') ?>">here</a>.
            </div><!-- /.box-body -->
          </div>

      <script type="text/javascript">
            $(document).ready(function(){


                $('.clock').each(function(){
                  $(this).countdown($(this).html(), function(event) {
                          $(this).html(event.strftime('%D Days %H:%M:%S'));
                        });

                });


            });
      </script>

      <?php } ?>
  </div>
</div> <!-- End ROW -->
