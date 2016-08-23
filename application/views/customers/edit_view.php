<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url('customers/lists'); ?>">Customers</a></li>
    <li><a href="<?php echo site_url('customers/add'); ?>">Add</a></li>
</ul>
<div id="content" class="container fullwidth">
     <?php $this->load->view('_base/message'); ?>
    <h2 class="title ">Edit customer's information</h2>
    <form name="edit" action="" method="POST">
	
        <div class="group-input">
            <label class="label_input">Username <span class="red">*</span></label>
            <input type="text" value="<?php echo $customer['username']; ?>" name="username" readonly="true">
			<?php echo form_error('username', '<div class="error">', '</div>'); ?>
		</div>
        
		<div class="group-input">
            <label class="label_input">Fullname <span class="red">*</span></label>
            <input type="text" value="<?php echo $customer['fullname']; ?>" name="fullname" required>
			<?php echo form_error('fullname', '<div class="error">', '</div>'); ?>
        </div>
		
        <div class="group-input">
            <label class="label_input">Email <span class="red">*</span></label>
            <input type="text" value="<?php echo $customer['email']; ?>" name="email" required>
			<?php echo form_error('email', '<div class="error">', '</div>'); ?>
		</div>
		<input type="hidden" name="cid" value="<?php echo $customer['id']; ?>"> 
        
        <input type="submit" name="save" value="Save">
    </form>
</div>
<?php $this->load->view('_base/footer'); ?>