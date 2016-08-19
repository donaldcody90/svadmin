<?php $this->load->view('_base/head'); ?>

<ul id="dropdow_menu">
    <li><a href="<?php echo site_url(); ?>support">Tikets</a></li>
    <li><a href="<?php echo site_url(); ?>support/categories">Categories</a></li>
    <li><a href="<?php echo site_url(); ?>support/add">Add category</a></li>
</ul>
<div id="content" class="container fullwidth">
	<?php $this->load->view('_base/message'); ?>
	<h2>Edit category</h2>
	<form action=""  method="POST" >
		<div class="group-input">
			<label class="label_input">Username</label>
			<select name="uid">
				<?php foreach($users as $value){
					echo $value['id'] == $category['uid'] ? '<option value="'.$value['id'].'" selected >'.$value['username'].'</option>' : '<option value="'.$value['id'].'">'.$value['username'].'</option>';
				} ?>
			</select>
		</div>
		
		<div class="group-input">
			<label class="label_input">Category</label>
			<input name="category" type="text" value="<?php echo $category['name']; ?>" />
		</div>
		
		<div class="group-input">
			<label class="label_input">Status</label>
			<select name="status">
				<option value="2" <?php echo $category['status']=='2' ?'selected':''; ?>>Opening</option>
				<option value="1" <?php echo $category['status']=='1' ?'selected':''; ?>>Closed</option>
			</select>
		</div>
		
		
		<input type="submit" name="save" value="Edit" />
	</form>
</div>

<?php $this->load->view('_base/footer'); ?>