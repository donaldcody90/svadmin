<div rel="title">
   Chọn tư vấn
</div>
<div rel="body" class="contentPopup">
	<div id="response_ajax"></div>
	<form name="changesupport" action="" class="align-center ajaxForm Support" method="POST" >
		<div class="group-input">
		<b>Tài khoản </b><input placeholder="Tài khoản" type="text" readonly=true name="c_username" value="<?php echo $user['c_username'] ?>" /></div>
		<div class="group-input">
			<b>Chọn tư vấn</b>
            <select name="uid" required="">
                <option value="">Chọn tư vấn</option>
                <?php
                    foreach ($advisory as $key => $value) {
                ?>
                    <option value="<?php echo $value['uid']; ?>" <?php echo (isset($user['uid']) && $user['uid']==$value['uid'])?'selected':''; ?>><?php echo $value['username']; ?></option>
                <?php
                    }
                ?>
            </select>
		</div>
		<input type="hidden" name="cid" value="<?php echo $user['cid'] ?>" />
		<input type="hidden" name="controller" value="customers" />
		<input type="hidden" name="task" value="changesupport" />
		<input type="submit" name="save" value="Lưu"  />
	</form>
</div>
<?php $this->load->view('_base/ajax_script'); ?>