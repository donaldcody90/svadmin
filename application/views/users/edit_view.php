<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url('users/lists'); ?>">Users</a></li>
    <li><a href="<?php echo site_url('users/add'); ?>">Add user</a></li>
</ul>
<div id="content" class="container fullwidth">
    <?php $this->load->view('_base/message'); ?>
    <h2 class="title ">Edit user's information</h2>
    <form name="edit" action="" method="POST">
	
        <div class="group-input">
            <label class="label_input">Username <span class="red">*</span></label>
            <input type="text" value="<?php echo $users['username']; ?>" name="username" readonly required>
			<?php echo form_error('username', '<div class="error">', '</div>'); ?>
		</div>
        
		<div class="group-input">
            <label class="label_input">Fullname <span class="red">*</span></label>
            <input type="text" value="<?php echo $users['fullname']; ?>" name="fullname" required>
			<?php echo form_error('fullname', '<div class="error">', '</div>'); ?>
        </div>
		
        <div class="group-input">
            <label class="label_input">Email <span class="red">*</span></label>
            <input type="text" value="<?php echo $users['email']; ?>" name="email" required>
			<?php echo form_error('email', '<div class="error">', '</div>'); ?>
		</div>
		
		
        <input type="hidden" name="uid" value="<?php echo $users['id']; ?>">
        
        <input type="submit" name="save" value="Save">
    </form>
</div>
<?php $this->load->view('_base/footer'); ?>