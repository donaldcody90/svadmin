<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url('datacenters/lists'); ?>">Datacenter List</a></li>
    <li><a href="<?php echo site_url('datacenters/add'); ?>">Add new</a></li>
</ul>
<?php
    // echo "<pre>";
    // print_r($data);die;
?>
<div id="content" class="container fullwidth">
     <?php $this->load->view('_base/message'); ?>
    <h2 class="title ">Add new Datacenters</h2>
    <form name="edit" action="<?php echo site_url('datacenters/add'); ?>" method="POST">
	
        <div class="group-input">
            <label class="label_input">IP <span class="red"></span></label>
            <input placeholder="IP" type="text" value="" name="ip" required="">
        </div>
		
        <div class="group-input">
            <label class="label_input">Key <span class="red"></span></label>
            <input placeholder="Key" type="text" value="" name="key" required="">
        </div>
		
        <div class="group-input">
            <label class="label_input">Password <span class="red"></span></label>
            <input placeholder="Password" type="text" value="" name="password" required="">
        </div>
		
      <!--<input type="hidden" name="uid" value="1"> -->
        
        <input type="submit" name="save" value="Lưu">
    </form>
</div>
<?php $this->load->view('_base/footer'); ?>