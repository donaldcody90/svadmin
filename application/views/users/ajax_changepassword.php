<div rel="title">
   Change Password
</div>
<div rel="body" class="contentPopup">
	<div id="response_ajax"></div>
	<form name="" action="" class="align-center ajaxForm" method="POST" >
		<div class="group-input">
		<label class="label_input">Username</label><input placeholder="" type="text" readonly=true name="username" value="<?php echo $user['username'] ?>" /></div>
		<div class="group-input">
		<label class="label_input">New Password</label><input placeholder="" type="password" name="password" /></div>
		<div class="group-input">
		<label class="label_input">Confirm Password</label><input placeholder="" type="password" name="confirmspassword" /></div>
		<input type="hidden" name="uid" value="<?php echo $user['id'] ?>" />
		<input type="hidden" name="controller" value="users" />
		<input type="hidden" name="task" value="resetpassword" />
		<input type="submit" name="save" value="Save"  />
	</form>
</div>
<?php $this->load->view('_base/ajax_script'); ?>