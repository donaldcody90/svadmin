<div rel="title">
   Đổi mật khẩu
</div>
<div rel="body" class="contentPopup">
	<div id="response_ajax"></div>
	<form name="resetpassword" action="" class="align-center ajaxForm" method="POST" >
		<div class="group-input">
		<label class="label_input">Tài khoản</label><input placeholder="Tài khoản" type="text" readonly=true name="c_username" value="<?php echo $user['c_username'] ?>" /></div>
		<div class="group-input">
		<label class="label_input">Mật khẩu mới</label><input placeholder="Mật khẩu" type="password" name="password" /></div>
		<div class="group-input">
		<label class="label_input">Xác nhận mật khẩu</label><input placeholder="Xác nhận mật khẩu" type="password" name="confirmspassword" /></div>
		<input type="hidden" name="cid" value="<?php echo $user['cid'] ?>" />
		<input type="hidden" name="controller" value="customers" />
		<input type="hidden" name="task" value="resetpassword" />
		<input type="submit" name="save" value="Lưu"  />
	</form>
</div>
<?php $this->load->view('_base/ajax_script'); ?>