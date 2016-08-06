<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url(); ?>customers">Customer List</a></li>
    <li><a href="<?php echo site_url(); ?>customers/add">Add new</a></li>
</ul>
<div id="content" class="container fullwidth">
     <?php $this->load->view('_base/message'); ?>
    <h2 class="title ">Edit customer's information</h2>
    <form name="edit" action="<?php echo site_url().'customers/update/'.$data->id; ?>" method="POST">
	
        <div class="group-input">
            <label class="label_input">Username <span class="red">*</span></label>
            <input type="text" placeholder="<?php echo $data->username; ?>" name="username">
			<?php echo form_error('username', '<div class="error">', '</div>'); ?>
		</div>
        
		<div class="group-input">
            <label class="label_input">Firstname <span class="red">*</span></label>
            <input type="text" placeholder="<?php echo $data->firstname; ?>" name="firstname">
			<?php echo form_error('firstname', '<div class="error">', '</div>'); ?>
        </div>
		
        <div class="group-input">
            <label class="label_input">Lastname <span class="red">*</span></label>
            <input type="text" placeholder="<?php echo $data->lastname; ?>" name="lastname">
			<?php echo form_error('lastname', '<div class="error">', '</div>'); ?>
        </div>
		
        <div class="group-input">
            <label class="label_input">Email <span class="red">*</span></label>
            <input type="text" placeholder="<?php echo $data->email; ?>" name="email">
			<?php echo form_error('email', '<div class="error">', '</div>'); ?>
		</div>
		
        <div class="group-input">
            <label class="label_input">Password <span class="red">*</span></label>
            <input type="text" placeholder="******" name="password">
			<?php echo form_error('password', '<div class="error">', '</div>'); ?>
		</div>
		
        <!--<div class="group-input">
            <label class="label_input">Role <span class="red">*</span></label>
            <select name="role" required="">
                <option value="Administrator" <?php //echo ($data->role =='Administrator')?'selected':'';  ?>>Administrator</option>
                <option value="Customer" <?php //echo ($data->role =='Customer')?'selected':'';  ?>>Customer</option>
            </select>
        </div>-->
		
      <!--   <input type="hidden" name="uid" value="1"> -->
        
        <input type="submit" name="save" value="Save">
    </form>
</div>
<?php $this->load->view('_base/footer'); ?>