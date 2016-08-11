<div rel="title">
   Đổi mật khẩu
</div>
<div rel="body" class="contentPopup">
	<div id="response_ajax"></div>
	<form name="resetpassword" action="<?php echo site_url().'customers/resetpassword'; ?>" class="align-center ajaxForm" method="POST" >
		<div class="group-input">
			<label class="label_input">Username</label>
			<input placeholder="Tài khoản" type="text" readonly=true name="username" value="<?php echo $user['username'] ?>" />
		</div>
		<div class="group-input">
			<label class="label_input">New password</label>
			<input placeholder="Mật khẩu" type="password" name="password" />
		</div>
		<div class="group-input">
			<label class="label_input">Confirm Password</label>
			<input placeholder="Xác nhận mật khẩu" type="password" name="confirmspassword" />
		</div>
		<input type="hidden" name="cid" value="<?php echo $user['id'] ?>" />
		<input type="hidden" name="controller" value="customers" />
		<input type="hidden" name="task" value="resetpassword" />
		<input type="submit" name="save" value="Lưu"  />
	</form>
</div>
<?php $this->load->view('_base/ajax_script'); ?>