<?php
	 defined('BASEPATH') OR exit('No direct script access allowed');
	//Debug SQL
	$this->output->enable_profiler(TRUE); 
?>
<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">	
	
	<base href="<?php echo site_url(); ?>" />
	<?php
		$siteSconfig = $this->config->item('site');
		foreach ($siteSconfig['meta'] as $name => $content)
		{
			echo "<meta name='$name' content='$content'>".PHP_EOL;
		}

		foreach ($siteSconfig['stylesheets'] as $media => $files) {
			foreach ($files as $file)
			{
				$url = starts_with($file, 'http') ? $file : base_url($file);
				echo "<link href='$url' rel='stylesheet' media='$media'>".PHP_EOL;	
			}
		}
		if($siteSconfig['scripts']['head']){
		
			foreach ($siteSconfig['scripts']['head'] as $file)
			{
				$url = starts_with($file, 'http') ? $file : base_url($file);
				echo "<script src='$url'></script>".PHP_EOL;
			}
			
		}
	?>


	<title><?php echo $siteSconfig['title']; ?></title>

<body class="<?php echo vst_getBodyClass(); ?>">
<div id="wrapper">
	<div id="header">
		<div class="logo">
			<img src="<?php echo  site_url(); ?>/static/images/logo.png" />
		</div>
		<?php
			//echo $sessiondata;
			if (is_logged_in()) {
			$currentUser=vst_getCurrentUser();
			?>
				<div class="user_info">
					<h2><span class="lightgreen">Hello!</span>&nbsp; <?php echo vst_getCurrentUser(); ?> [<a href="<?php echo site_url('auth/logout'); ?>">Logout</a>]</h2>
					<p class="bold">Account role / <span class="green">( Admin )</span></p>
					<!--<p class="bold">Tổng số khách hàng: <span class="red">444</span></p>-->
					<!--<p class="bold">Khách có giao dịch: <span class="green">222 / 25%</span></p>-->
				</div>
		<?php
			}
		?>
	</div>
	<?php 
	if (is_logged_in()) {
		$this->load->view('_base/menu'); 
	}
	?>
	