<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url('servers'); ?>">Server List</a></li>
    <li><a href="<?php echo site_url('servers/add'); ?>">Add new DC</a></li>
    <li><a href="<?php echo site_url('vps'); ?>">VPS List</a></li>
    <li><a href="<?php echo site_url('vps/add'); ?>">Add new VPS</a></li>
</ul>
<?php
    // echo "<pre>";
    // print_r($data);die;
?>
<div id="content" class="container fullwidth">
     <?php $this->load->view('_base/message'); ?>
    <h2 class="title ">Edit server infomation</h2>
	
    <form name="edit" action="<?php echo site_url('servers/update/'.$value['id']); ?>" method="POST">
        <div class="group-input">
            <label class="label_input">IP <span class="red"></span></label>
            <input type="text" placeholder="<?php echo $value->ip; ?>" name="ip">
			<?php echo form_error('ip', '<div class="error">', '</div>'); ?>
        </div>
		
        <div class="group-input">
            <label class="label_input">Key <span class="red"></span></label>
            <input type="text" placeholder="<?php echo $value->svkey; ?>" name="key">
			<?php echo form_error('key', '<div class="error">', '</div>'); ?>
        </div>
		
        <div class="group-input">
            <label class="label_input">Password <span class="red"></span></label>
            <input type="text" placeholder="<?php echo $value->svpass; ?>" name="password">
			<?php echo form_error('password', '<div class="error">', '</div>'); ?>
        </div>
      <!--   <input type="hidden" name="uid" value="1"> -->
        
        <input type="submit" name="save" value="Save">
    </form>
</div>
<?php $this->load->view('_base/footer'); ?>