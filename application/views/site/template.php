<!DOCTYPE html>
<!-- Template by freewebsitetemplates.com -->
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Voltus FX | Your Trading Solutions</title>

<link href='http://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'>


<link href="<?= base_url() ?>assets/theme/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
<link href="<?= base_url() ?>assets/theme/bootstrap/css/non-responsive.css" rel="stylesheet" type="text/css" />    

<!-- FontAwesome 4.3.0 -->
<link href="<?= base_url() ?>assets/theme/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css" />


<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/theme/main/style.css" media="all" />  
<script type="text/javascript" src="<?= base_url() ?>assets/theme/jQuery/jQuery-2.1.4.min.js"></script>


  
</head>
<body>
	<div id="header">
			<div id="logo">
				<a href="index.html"><img src="<?= base_url() ?>assets/theme/main/images/voltus.png" alt="" /></a>		
			</div>		
			<ul>
			<?php
			$li=array(array(
					"href"=>base_url(),
					"nama"=>'home',
					"slug"=>''
				),
				array(
					"href"=>base_url()."site/halaman/about",
					"nama"=>'about us',
					"slug"=>'about'
				),
				array(
					"href"=>base_url()."site/halaman/product",
					"nama"=>'products',
					"slug"=>'product'
				),
				array(
					"href"=>base_url()."site/halaman/contact",
					"nama"=>'contact us',
					"slug"=>'contact'
				),
				array(
					"href"=>base_url()."auth/login/member",
					"nama"=>'Login',
					"slug"=>'login'
				),

			);
			foreach($li as $menu){
				$selectedpage= (@$slug==$menu['slug'])? "class='selected'":"";
				echo "<li ".$selectedpage."><a href=".$menu['href']."><span>".$menu['nama']."</span></a></li>";
			}	
		?>		
			</ul>
	</div>
	<div id="body">

			<?= $contents ?>

	</div>
	<div id="footer">
		<div>
			<div>
				<h3>america</h3>
				<ul>
					<li>457-380-1654 main</li>				
					<li>257-301-9417 toll free</li>
				</ul>			
			</div>		
			<div>
				<h3>europe</h3>
				<ul>
					<li>457-380-1654 main</li>				
					<li>257-301-9417 toll free</li>
				</ul>			
			</div>	
			<div>
				<h3>canada</h3>
				<ul>
					<li>457-380-1654 main</li>				
					<li>257-301-9417 toll free</li>
				</ul>			
			</div>	
			<div>
				<h3>middle east</h3>
				<ul>
					<li>457-380-1654 main</li>				
					<li>257-301-9417 toll free</li>
				</ul>			
			</div>	
			<div>
				<h3>follow us:</h3>
				<a class="facebook" href="http://facebook.com/freewebsitetemplates" target="_blank">facebook</a>		
				<a class="twitter" href="http://twitter.com/fwtemplates" target="_blank">twitter</a>
			</div>	
		</div>
		<div>
			<p>&copy Copyright 2012. All rights reserved</p>
		</div>
	</div>
</body>

 <!-- Bootstrap 3.3.2 JS -->
    <script src="<?= base_url() ?>assets/theme/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    

</html>