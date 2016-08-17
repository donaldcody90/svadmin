<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url('servers'); ?>">Server List</a></li>
    <li><a href="<?php echo site_url('servers/add'); ?>">Add new SV</a></li>
    <li><a href="<?php echo site_url('vps'); ?>">VPS List</a></li>
    <li><a href="<?php echo site_url('vps/add'); ?>">Add new VPS</a></li>
</ul>
<?php
    // echo "<pre>";
    // print_r($data);die;
?>
<div id="content" class="container fullwidth">
     <?php $this->load->view('_base/message'); ?>
    <h2 class="title ">Edit VPS infomation</h2>
	
    <form name="edit" action="" method="POST">
        <div class="group-input">
            <label class="label_input">IP <span class="red">*</span></label>
            <input type="text" value="<?php echo $vps['vps_ip']; ?>" name="ip">
			<?php echo form_error('ip', '<div class="error">', '</div>'); ?>
        </div>
		
        <div class="group-input">
            <label class="label_input">Label <span class="red">*</span></label>
            <input type="text" value="<?php echo $vps['vps_label']; ?>" name="label">
			<?php echo form_error('key', '<div class="error">', '</div>'); ?>
        </div>
		
        <div class="group-input">
            <label class="label_input">Rootpass <span class="red">*</span></label>
            <input type="text" value="<?php echo $vps['rootpass']; ?>" name="rootpass">
			<?php echo form_error('password', '<div class="error">', '</div>'); ?>
        </div>
      <!--   <input type="hidden" name="uid" value="1"> -->
        
        <input type="submit" name="save" value="Save">
    </form>
</div>
<?php $this->load->view('_base/footer'); ?>