<?php 
	$siteSconfig = $this->config->item('site');
	if($siteSconfig['scripts']['ajax']){
		foreach ($siteSconfig['scripts']['ajax'] as $file)
			{
				$url = starts_with($file, 'http') ? $file : base_url($file);
				echo "<script src='$url'></script>".PHP_EOL;
			}
			
	}
?>