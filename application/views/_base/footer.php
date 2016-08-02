		</div>
		<div id="footer">
			<p>Copyright <?php echo date("Y") ?> by DonaldCody. All rights reserved.</p>
		</div>
		</div>
		<script>
			var baseURL="<?php echo base_url() ?>";
		</script>
		<?php 
		global $siteSconfig;
		if($siteSconfig['scripts']['foot']){
		
			foreach ($siteSconfig['scripts']['foot'] as $file)
			{
				$url = starts_with($file, 'http') ? $file : base_url($file);
				echo "<script src='$url'></script>".PHP_EOL;
			}
			
		}
		?>
		<div id="ajaxPopup" style="display: none; overflow: auto">
		   
		</div>
	</body>
</html>