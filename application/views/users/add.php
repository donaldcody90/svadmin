<?php $this->load->view('_base/head'); ?>

<ul id="dropdow_menu">
    <li><a href="<?php echo site_url(); ?>users/lists">Danh sách</a></li>
    <li><a href="<?php echo site_url(); ?>users/add">Thêm mới</a></li>
</ul>
<div id="content" class="container fullwidth">
	<?php $this->load->view('_base/message'); ?>
	<h2>Thêm mới nhân viên</h2>
	<form action=""  method="POST" >
		<div class="group-input">
			<label class="label_input">Username <span class="red">*</span></label>
			<input placeholder="Username" type="text" value="" name="username" required /></div>
		<div class="group-input">
			<label class="label_input">Password <span class="red">*</span></label>
			<input placeholder="Password" type="password" name="password" required /></div>
		<div class="group-input">
			<label class="label_input">Fullname <span class="red">*</span></label>
			<input placeholder="Phone" type="text" name="fullname" required /></div>
		<div class="group-input">
			<label class="label_input">Phone <span class="red">*</span></label>
			<input placeholder="Phone" type="text" name="phone" required /></div>
		<div class="group-input">
			<label class="label_input">Email <span class="red">*</span></label>
			<input placeholder="Email" type="text" name="email" required /></div>
		<div class="group-input">
			<label class="label_input">Location <span class="red">*</span></label>
			<select name="location" required>
				<option value="0">Hà Nội</option>
				<option value="1">Sài Gòn</option>
			</select>
		</div>
		<div class="group-input">
			<label class="label_input">Role <span class="red">*</span></label>
			<select name="role" required>
				<option value="1">Admin</option>
				<option value="2">Quản lý</option>
				<option value="3">Tư vấn</option>
				<option value="4">Mua hàng</option>
				<option value="5">Kho - Trung Quốc</option>
				<option value="6">Kho - Việt Nam</option>
			</select>
		</div>
		<div class="group-input">
			<label class="label_input">Active <span class="red">*</span></label>
			<select name="isactive" required>
				<option value="1">Active</option>
				<option value="0">Block</option>
			</select>
		</div>
		
		<input type="submit" name="save" value="Thêm mới" />
	</form>
</div>

<?php $this->load->view('_base/footer'); ?>