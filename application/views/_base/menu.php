<?php 
$cController=vst_getController();
$cMedthod=vst_getMethod();
?>
<div id="main_menu">
	<ul>
		<li <?php echo $cController == 'customers' ? 'class="active"':'' ?> ><a href="<?php echo site_url( 'customers' );?>">Customers</a></li>
		<?php 
		if($this->session->userdata('role') == 0 && $cController == 'users'){
			echo '<li class="active"><a href="'.site_url('users').'">Users</a></li>';
		}
		if($this->session->userdata('role') == 0 && $cController != 'users'){
			echo '<li><a href="'.site_url('users').'">Users</a></li>';
		}
		?>
		<?php 
		if($this->session->userdata('role') == 0 && ($cController == 'servers' || $cController == 'vps' || $cController == 'plans')){
			echo '<li class="active"><a href="'.site_url('servers').'">Servers</a></li>';
		}
		if($this->session->userdata('role') == 0 && ($cController != 'servers' && $cController != 'vps' && $cController != 'plans')){
			
			echo '<li><a href="'.site_url('servers').'">Servers</a></li>';
		}
		?>
		<li <?php echo $cController == 'support' ? 'class="active"':'' ?>><a href="<?php echo site_url( 'support' );?>">Support</a></li>
		<li <?php echo $cController == 'settings' ? 'class="active"':'' ?>><a href="<?php echo site_url( 'settings' );?>">Settings</a></li>
	</ul>
	
</div>
