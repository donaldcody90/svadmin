<?php $this->load->view('_base/head'); ?>

<ul id="dropdow_menu">
    <li><a href="<?php echo site_url(); ?>customers">Customer List</a></li>
    <li><a href="<?php echo site_url(); ?>customers/add">Add new</a></li>
</ul>
<div id="content" class="container fullwidth">
	<?php $this->load->view('_base/message'); ?>
	<h2>Add new customer</h2>
	<form action="<?php echo site_url('customers/add'); ?>"  method="POST" >
		<div class="group-input">
			<label class="label_input">Username <span class="red">*</span></label>
			<input placeholder="Username" type="text" value="" name="username" required /></div>
		<div class="group-input">
			<label class="label_input">Password <span class="red">*</span></label>
			<input placeholder="Password" type="password" name="password" required /></div>
		<div class="group-input">
			<label class="label_input">Firstname <span class="red">*</span></label>
			<input placeholder="firstname" type="text" name="firstname" required /></div>
		<div class="group-input">
			<label class="label_input">Lastname <span class="red">*</span></label>
			<input placeholder="lastname" type="text" name="lastname" required /></div>
		<div class="group-input">
			<label class="label_input">Email <span class="red">*</span></label>
			<input placeholder="Email" type="text" name="email" required /></div>
		
		<input type="submit" name="save" value="Add new" />
	</form>
</div>

<?php $this->load->view('_base/footer'); ?>