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
    <h2 class="title ">Add new server</h2>
    <form name="edit" action="<?php echo site_url('servers/add'); ?>" method="POST">
	
        <div class="group-input">
            <label class="label_input">IP <span class="red"></span></label>
            <input placeholder="IP" type="text" value="" name="ip" required="">
			<?php echo form_error('ip', '<div class="error">', '</div>'); ?>
        </div>
		
        <div class="group-input">
            <label class="label_input">Key <span class="red"></span></label>
            <input placeholder="Key" type="text" value="" name="key" required="">
			<?php echo form_error('key', '<div class="error">', '</div>'); ?>
        </div>
		
        <div class="group-input">
            <label class="label_input">Password <span class="red"></span></label>
            <input placeholder="Password" type="text" value="" name="password" required="">
			<?php echo form_error('password', '<div class="error">', '</div>'); ?>
        </div>
		
      <!--<input type="hidden" name="uid" value="1"> -->
        
        <input type="submit" name="save" value="Save">
    </form>
</div>
<?php $this->load->view('_base/footer'); ?>