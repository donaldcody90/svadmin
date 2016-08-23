<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url('users/lists'); ?>">Users</a></li>
    <li><a href="<?php echo site_url('users/add'); ?>">Add user</a></li>
</ul>
<div id="content" class="container fullwidth">
	<?php $this->load->view('_base/message'); ?>
	<h2>Add new user</h2>
	<form action="<?php echo site_url('users/add'); ?>"  method="POST" >
		<div class="group-input">
			<label class="label_input">Username <span class="red">*</span></label>
			<input placeholder="Username" type="text" value="" name="username" required />
			<?php echo form_error('username', '<div class="error">', '</div>'); ?></div>
		<div class="group-input">
			<label class="label_input">Password <span class="red">*</span></label>
			<input placeholder="Password" type="password" name="password" required />
			<?php echo form_error('password', '<div class="error">', '</div>'); ?></div>
		<div class="group-input">
			<label class="label_input">Fullname <span class="red">*</span></label>
			<input placeholder="Fullname" type="text" name="fullname" required />
			<?php echo form_error('fullname', '<div class="error">', '</div>'); ?></div>
		<div class="group-input">
			<label class="label_input">Email <span class="red">*</span></label>
			<input placeholder="Email" type="email" name="email" required />
			<?php echo form_error('email', '<div class="error">', '</div>'); ?></div>
		
		<input type="submit" name="save" value="Add new" />
	</form>
</div>

<?php $this->load->view('_base/footer'); ?>