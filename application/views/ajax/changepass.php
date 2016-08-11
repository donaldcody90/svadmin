<div class="overlay"></div>
<div class="contentPopup">
	<p class="align-center popup_title">Change password</p>
	<form name="resetpassword" action="" class="align-center ajaxForm" method="POST" >
		<div class="group-input">
			<label class="label_input">Username</label>
			<input name="c_username" placeholder="Tài khoản" type="text" readonly=true value="" />
		</div>
		<div class="group-input">
			<label class="label_input">New password</label>
			<input name="password" placeholder="Mật khẩu" type="password" />
		</div>
		<div class="group-input">
			<label class="label_input">Confirm password</label>
			<input name="confirmspassword" placeholder="Xác nhận mật khẩu" type="password" />
		</div>
		
		<input type="submit" name="save" value="Lưu"  />
	</form>
</div>