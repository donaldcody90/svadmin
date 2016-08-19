<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url(); ?>users">Global config</a></li>
</ul>
<div id="content" class="container fullwidth">
     <?php $this->load->view('_base/message'); ?>
    <h2 class="title ">Edit user's information</h2>
    <form name="edit" action="" method="POST">
	
        <div class="group-input">
            <label class="label_input">Paypal account:</label>
            <input type="text" value="<?php echo $paypal['account']; ?>" name="paypal">
			<?php echo form_error('paypal', '<div class="error">', '</div>'); ?>
		</div>
        
		<div class="group-input">
            <label class="label_input">Bank transfer account:</label>
            <input type="text" value="<?php echo $bank['account']; ?>" name="bank_account">
			<?php echo form_error('fullname', '<div class="error">', '</div>'); ?>
        </div>
        
        <input type="submit" name="save" value="Save">
    </form>
</div>
<?php $this->load->view('_base/footer'); ?>