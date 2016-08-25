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
    <h2 class="title ">Edit server infomation</h2>
	
    <form name="edit" action="" method="POST">
        <div class="group-input">
            <label class="label_input">Label <span class="red"></span></label>
            <input type="text" value="<?php echo $server['label']; ?>" name="label" required >
        </div>
		
        <div class="group-input">
            <label class="label_input">Description <span class="red"></span></label>
            <input type="text" value="<?php echo $server['description']; ?>" name="description">
        </div>
		
        <div class="group-input">
            <label class="label_input">IP <span class="red"></span></label>
            <input type="text" value="<?php echo $server['ip']; ?>" name="ip" required >
        </div>
		
        <div class="group-input">
            <label class="label_input">Key <span class="red"></span></label>
            <input type="text" value="<?php echo $server['svkey']; ?>" name="key" required >
        </div>
		
        <div class="group-input">
            <label class="label_input">Password <span class="red"></span></label>
            <input type="text" value="<?php echo $server['svpass']; ?>" name="password" required >
        </div>
		
        <div class="group-input">
            <label class="label_input">Location <span class="red"></span></label>
            <input type="text" value="<?php echo $server['location']; ?>" name="location" required >
        </div>
		
      <!--   <input type="hidden" name="uid" value="1"> -->
        
        <input type="submit" name="save" value="Save">
    </form>
</div>
<?php $this->load->view('_base/footer'); ?>