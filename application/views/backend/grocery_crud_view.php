            <?php 
            foreach($css_files as $file): ?>
                <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
             
            <?php endforeach; ?>
            <?php foreach($js_files as $file): ?>
             
                <script src="<?php echo $file; ?>"></script>
            <?php endforeach; ?>



<div class="box">
          <div class="box-body" style="display: block;">
                           <?php echo $output; ?>
            </div><!-- /.box-body -->
            
          </div>