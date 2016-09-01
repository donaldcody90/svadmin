<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url('servers'); ?>">Servers</a></li>
    <li><a href="<?php echo site_url('servers/add'); ?>">Add server</a></li>
    <li><a href="<?php echo site_url('vps'); ?>">VPS</a></li>
    <li><a href="<?php echo site_url('vps/add'); ?>">Add VPS</a></li>
    <li><a href="<?php echo site_url('plans/lists'); ?>">Plans</a></li>
    <li><a href="<?php echo site_url('plans/add'); ?>">Add plan</a></li>
</ul>
<div id="content" class="container fullwidth">
	<?php $this->load->view('_base/message'); ?>
	<h2>Add new VPS</h2>
	<form action="<?php echo site_url('vps/add'); ?>"  method="POST" >
		<div class="group-input">
			<label class="label_input">Customer <span class="red">*</span></label>
			<select name="username">
				<option value="" selected>None</option>
				<?php foreach($customers as $value){
					echo '<option value="'.$value['id'].'">'.$value['username'].'</option>';
				} ?>
			</select>
		</div>
		<div class="group-input">
			<label class="label_input">Servers <span class="red">*</span></label>
			<select name="server">
				<option value="" selected>None</option>
				<?php foreach($servers as $value2){
					echo '<option value="'.$value2['id'].'">'.$value2['label'].'</option>';
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