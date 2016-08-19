<?php $this->load->view('_base/head'); ?>

<ul id="dropdow_menu">
    <li><a href="<?php echo site_url(); ?>support">Tikets</a></li>
    <li><a href="<?php echo site_url(); ?>support/categories">Categories</a></li>
    <li><a href="<?php echo site_url(); ?>support/add">Add category</a></li>
</ul>
<div id="content" class="container fullwidth">
	<?php $this->load->view('_base/message'); ?>
	<h2>Add new support-team member</h2>
	<form action="<?php echo site_url('support/add'); ?>"  method="POST" >
		<div class="group-input">
			<label class="label_input">Username</label>
			<select name="uid">
				<option value="" selected>Choose an user</option>
				<?php foreach($users as $value){
					echo '<option value="'.$value['id'].'">'.$value['username'].'</option>';
				} ?>
			</select>
		</div>
		
		<div class="group-input">
			<label class="label_input">Category</label>
			<input name="category" type="text" placeholder="Category" />
		</div>
		
		<input type="submit" name="save" value="Add new" />
	</form>
</div>

<?php $this->load->view('_base/footer'); ?>