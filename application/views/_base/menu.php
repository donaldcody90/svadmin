<?php 
$cController=vst_getController();
$cMedthod=vst_getMethod();
?>
<div id="main_menu">
	<ul>
		<li <?php echo $cController == 'users' ? 'class="active"':'' ?> ><a href="<?php echo site_url( 'users' );?>">Users</a></li>
		<li <?php echo $cController == 'datacenters' ? 'class="active"':'' ?>><a href="<?php echo site_url( 'datacenters' );?>">Servers</a></li>
		<li <?php echo $cController == 'support' ? 'class="active"':'' ?>><a href="<?php echo site_url( 'support' );?>">Support</a></li>
	</ul>
	
</div>
