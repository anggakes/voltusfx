<hr>
<div class='container'>
<div class="col-xs-12">
<h1>Contact Us</h1>
<hr>
<form>
	<div class="form-group">
	<div class="col-xs-6">
	<label for="exampleInputEmail1">Full Real Name</label>
	</div>
	<div class="col-xs-6">
    <input type="text" name='member[nama]' value = "<?= set_value('member[nama]')?>" class="form-control" id="" placeholder="Username.." required>
    <br>
    </div>
    <!--<div style='color:red'><?= form_error('member[username]') ?></div>-->
    </div>
    
	<div class="form-group">
	<div class="col-xs-6">
	<label for="exampleInputEmail1">Email Address</label>
	</div>
	<div class="col-xs-6">
    <input type="text" name='member[email]' value = "<?= set_value('member[email]')?>" class="form-control" id="" placeholder="Username.." required>
    </div>
    <!--<div style='color:red'><?= form_error('member[username]') ?></div>-->
    </div>
    
	<div class="form-group">
	<div class="col-xs-12">
	<label for="exampleInputEmail1">Question or Comments</label>
	<textarea class='form-control' style="height:200px"></textarea>
	<br>
    <!--<div style='color:red'><?= form_error('member[username]') ?></div>-->
    </div>
    </div>

  <div class="form-group">
  <button type="submit" class="btn btn-danger pull-right">Submit</button>

  </div>
  <div class='clearfix'></div>
  <br>
</form>
</div>
</div>