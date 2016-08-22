<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url(); ?>support">Tikets</a></li>
    <li><a href="<?php echo site_url(); ?>support/categories">Categories</a></li>
    <li><a href="<?php echo site_url(); ?>support/add">Add category</a></li>
</ul>
<div id="content" class="container fullwidth">
    <?php $this->load->view('_base/message'); ?>
    <h2 class="title ">Categories List</h2>
    <div class="filer_box">
        
		<?php
			$filter_id = $this->input->get('filter_id');
			$filter_name = $this->input->get('filter_name');
			$filter_username = $this->input->get('filter_username');
			$filter_status = $this->input->get('filter_status');
		?>
		<form name="filter_form" action="<?php echo site_url('support/categories'); ?>" method="GET">
            ID:<input type="text" value="<?php echo isset($filter_id)?$filter_id:''; ?>" name="filter_id">
            Type:<input type="text" value="<?php echo isset($filter_name)?$filter_name:''; ?>" name="filter_name">
            User:<input type="text" value="<?php echo isset($filter_username)?$filter_username:''; ?>" name="filter_username">
			Status:
			<select name="filter_status">
				<option value="" selected>All ticket</option>
				<option value="1" <?php echo (isset($filter_status) && $filter_status=='1' )?'selected':''; ?>>Enable</option>
				<option value="0" <?php echo (isset($filter_status) && $filter_status=='0' )?'selected':''; ?>>Disable</option>
			</select>
          <input class="button" type="submit" value="Search" >
          <a href="<?php echo site_url('support/categories') ?>"><input class="button" type="button" value="Clear"></a>
        </form> 
    </div>
    <div class="gridtable">
        <table>
            <tbody>
                <tr>
                    <td>ID</td>
                    <td>Type</td>
                    <td>User</td>
                    <td>Status</td>
                    <td>Action</td>
                </tr>
                <?php foreach ($result as $key => $row) { ?>
					<tr>
						<td><?php echo $row->id ; ?></td>
						<td><?php echo $row->name ; ?></td>
						<td><?php echo $row->username ; ?></td>
						<td><?php echo getStatusCategories($row->status); ?></td>
						<td>
							<a href="<?php echo site_url().'support/edit_cat/'.$row->id; ?>" >Edit</a>
							<a href="<?php echo site_url().'support/delete/'.$row->id; ?>"onclick="return confirm('Are you sure you want to delete?')" >Delete</a>
						</td>
					</tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php echo $this->pagination->create_links(); ?>
    <p><strong>Total: <span class="green"><?php   if( isset($total_rows) && count($total_rows)>0 ){ echo $total_rows; } ?></span> (Items)</strong></p>
</div>
<?php $this->load->view('_base/footer'); ?>