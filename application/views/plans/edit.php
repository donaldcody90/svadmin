<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url('servers'); ?>">Servers</a></li>
    <li><a href="<?php echo site_url('servers/add'); ?>">Add server</a></li>
    <li><a href="<?php echo site_url('vps'); ?>">VPS</a></li>
    <li><a href="<?php echo site_url('vps/add'); ?>">Add VPS</a></li>
    <li><a href="<?php echo site_url('plans/lists'); ?>">Plans</a></li>
    <li><a href="<?php echo site_url('plans/add'); ?>">Add plan</a></li>
</ul>
<?php
    // echo "<pre>";
    // print_r($data);die;
?>
<div id="content" class="container fullwidth">
     <?php $this->load->view('_base/message'); ?>
    <h2 class="title ">Edit plan infomation</h2>
	
    <form name="edit" action="" method="POST">
        <div class="group-input">
            <label class="label_input">Name <span class="red">*</span></label>
            <input type="text" value="<?php echo $plan['name']; ?>" name="name" required >
        </div>
		
        <div class="group-input">
            <label class="label_input">Price (USD)<span class="red">*</span></label>
            <input type="text" value="<?php echo $plan['price']; ?>" name="price" required >
        </div>
		
        <div class="group-input">
            <label class="label_input">CPU (core)<span class="red">*</span></label>
            <input type="text" value="<?php echo $plan['cpu_core']; ?>" name="cpu_core" required >
        </div>
		
        <div class="group-input">
            <label class="label_input">Disk space (GB)<span class="red">*</span></label>
            <input type="text" value="<?php echo $plan['disk_space']; ?>" name="disk_space" required >
        </div>
		
        <div class="group-input">
            <label class="label_input">Ram (MB)<span class="red">*</span></label>
            <input type="text" value="<?php echo $plan['ram']; ?>" name="ram" required >
        </div>
		
        <div class="group-input">
            <label class="label_input">Bandwidth (GB)<span class="red">*</span></label>
            <input type="text" value="<?php echo $plan['bandwidth']; ?>" name="bandwidth" required >
        </div>
		
        <div class="group-input">
            <label class="label_input">Status <span class="red">*</span></label>
            <select name="status" >
				<option value="1" <?php echo $plan['status'] == 1?'selected':''; ?>>Enable</option>
				<option value="0" <?php echo $plan['status'] == 0?'selected':''; ?>>Disable</option>
			</select>
        </div>
		
		<!--  <input type="hidden" name="uid" value="1"> -->
        
        <input type="submit" name="save" value="Save">
    </form>
</div>
<?php $this->load->view('_base/footer'); ?>