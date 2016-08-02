<div rel="title">
   Đổi mật khẩu
</div>
<div rel="body" class="contentPopup">
	<div id="response_ajax"></div>
	<form name="resetpassword" action="" class="align-center ajaxForm" method="POST" >
		<div class="group-input">
		<label class="label_input">Username</label><input placeholder="Username" type="text" readonly=true name="username" value="<?php echo $user['username'] ?>" /></div>
		<div class="group-input">
		<label class="label_input">Mật khẩu mới</label><input placeholder="Password" type="password" name="password" /></div>
		<div class="group-input">
		<label class="label_input">Xác nhận mật khẩu</label><input placeholder="Password" type="password" name="confirmspassword" /></div>
		<input type="hidden" name="uid" value="<?php echo $user['uid'] ?>" />
		<input type="hidden" name="controller" value="users" />
		<input type="hidden" name="task" value="resetpassword" />
		<input type="submit" name="save" value="Lưu"  />
	</form>
</div>
<?php $this->load->view('_base/ajax_script'); ?>