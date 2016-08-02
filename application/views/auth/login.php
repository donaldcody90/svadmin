<?php
 $this->load->view('_base/head'); ?>
<?php $this->load->view('_base/message'); ?>
<div style="padding-top:100px;">
	<h2 class="align-center">Login Admin</h2>
	<form action="<?php echo site_url('auth'); ?>" class="align-center" method="POST">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
		<?php $error = validation_errors(); echo (isset($error) && !empty($error))?'<ul class="error">'.$error.'</ul>':''; ?>
		<div class="group-input"><input placeholder="Username" type="text" name="txt_username" /></div>
		<div class="group-input"><input placeholder="Password" type="password" name="txt_password" /></div>
		<input type="submit" name="btn_login" value="Login" />
	</form>
</div>

<?php $this->load->view('_base/footer'); ?>