<?php $this->load->view('_base/head'); ?>

<ul id="dropdow_menu">
    <li><a href="<?php echo site_url('datacenters'); ?>">Datacenter List</a></li>
    <li><a href="<?php echo site_url('datacenters/add'); ?>">Add new DC</a></li>
    <li><a href="<?php echo site_url('vps'); ?>">VPS List</a></li>
    <li><a href="<?php echo site_url('vps/add'); ?>">Add new VPS</a></li>
</ul>
<div id="content" class="container fullwidth">
	<?php $this->load->view('_base/message'); ?>
	<h2>Add new VPS</h2>
	<form action="<?php echo site_url('vps/add'); ?>"  method="POST" >
		<div class="group-input">
			<label class="label_input">Username <span class="red">*</span></label>
			<select name="username">
				<option value="" selected>None</option>
				<?php foreach($username as $value){
					echo '<option value="'.$value['id'].'">'.$value['username'].'</option>';
				} ?>
			</select>
		</div>
		<div class="group-input">
			<label class="label_input">Datacenter <span class="red">*</span></label>
			<select name="datacenter">
				<option value="" selected>None</option>
				<?php foreach($datacenters as $value2){
					echo '<option value="'.$value2['id'].'">'.$value2['ip'].'</option>';
				} ?>
			</select>
		</div>
		<div class="group-input">
			<label class="label_input">Label <span class="red">*</span></label>
			<input placeholder="label" type="text" name="label" required />
			<?php echo form_error('label', '<div class="error">', '</div>'); ?></div>
		<div class="group-input">
			<label class="label_input">VPS IP <span class="red">*</span></label>
			<input placeholder="vps_ip" type="text" name="vps_ip" required />
			<?php echo form_error('vps_ip', '<div class="error">', '</div>'); ?></div>
		<div class="group-input">
			<label class="label_input">Space <span class="red">*</span></label>
			<input placeholder="space" type="text" name="space" required />
			<?php echo form_error('email', '<div class="error">', '</div>'); ?></div>
		<div class="group-input">
			<label class="label_input">Ram <span class="red">*</span></label>
			<select name="ram">
				<option value="512" selected>512 MB</option>
				<option value="1024">1024 MB</option>
				<option value="2048">2048 MB</option>
				<option value="4096">4096 MB</option>
			</select>
		</div>
		<input type="submit" name="save" value="Add new" />
	</form>
</div>

<?php $this->load->view('_base/footer'); ?>