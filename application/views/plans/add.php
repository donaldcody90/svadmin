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
    <h2 class="title ">Add new plan</h2>
    <form name="edit" action="" method="POST">
		
        <div class="group-input">
            <label class="label_input">Name <span class="red">*</span></label>
            <input placeholder="Name" type="text" value="" name="name" required="">
        </div>
		
        <div class="group-input">
            <label class="label_input">Price (USD)<span class="red">*</span></label>
            <input placeholder="Price" type="text" value="" name="price" required="">
        </div>
		
        <div class="group-input">
            <label class="label_input">CPU (core) <span class="red">*</span></label>
            <input placeholder="CPU" type="text" value="" name="cpu_core" required="">
        </div>
		
        <div class="group-input">
            <label class="label_input">Disk space (GB)<span class="red">*</span></label>
            <input placeholder="Disk space" type="text" value="" name="disk_space" required="">
        </div>
		
        <div class="group-input">
            <label class="label_input">Ram (MB)<span class="red">*</span></label>
            <input placeholder="Ram" type="text" value="" name="ram" required="">
        </div>
		
        <div class="group-input">
            <label class="label_input">Bandwidth (GB)<span class="red">*</span></label>
            <input placeholder="Bandwidth" type="text" value="" name="bandwidth" required="">
        </div>
		
      <!--<input type="hidden" name="uid" value="1"> -->
        
        <input type="submit" name="save" value="Save">
    </form>
</div>
<?php $this->load->view('_base/footer'); ?>