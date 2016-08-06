<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url(); ?>support">Support List</a></li>
    <li><a href="<?php echo site_url(); ?>support/add"></a></li>
</ul>
<div id="content" class="container fullwidth">
    <?php $this->load->view('_base/message'); ?>
    <h2 class="title ">Support List</h2>
    <div class="filer_box">
        
		<?php
			$filter_cid = $this->input->get('filter_cid');
			$filter_title = $this->input->get('filter_title');
			$filter_content = $this->input->get('filter_content');
			$filter_username = $this->input->get('filter_username');
			$filter_status = $this->input->get('filter_status');
			$filter_type = $this->input->get('filter_type');
		?>
		<form name="filter_form" action="<?php echo site_url('support/lists'); ?>" method="GET">
            ID:<input type="text" value="<?php echo isset($filter_cid)?$filter_cid:''; ?>" name="filter_cid">
            Title:<input type="text" value="<?php echo isset($filter_title)?$filter_title:''; ?>" name="filter_title">
            Last reply:<input type="text" value="<?php echo isset($filter_content)?$filter_content:''; ?>" name="filter_content">
            Customer Name:<input type="text" value="<?php echo isset($filter_username )?$filter_username:''; ?>" name="filter_username">
            Type:
            <select name="filter_type">
                <option value="" selected>All type</option>
                <option value="General" <?php echo (isset($filter_type) && $filter_type=='General' )?'selected':''; ?>>General</option>
                <option value="Billing" <?php echo (isset($filter_type) && $filter_type=='Billing' )?'selected':''; ?>>Billing</option>
            </select>
			Status:
			<select name="filter_status">
				<option value="" selected>All ticket</option>
				<option value="opening" <?php echo (isset($filter_status) && $filter_status=='opening' )?'selected':''; ?>>opening</option>
				<option value="closed" <?php echo (isset($filter_status) && $filter_status=='closed' )?'selected':''; ?>>closed</option>
			</select>
          <input class="button" type="submit" value="Search" >
          <input class="button" type="reset" value="Clear" >
        </form> 
    </div>
    <div class="gridtable">
        <table>
			<tbody>
				<tr>
					<td>ID</td>
					<td>Type</td>
					<td>Title</td>
					<td>Last reply</td>
					<td>Customer Name</td>
					<td>Status</td>
				</tr>
			
				<?php foreach($result as $key => $row){ ?>
				<tr>
					<td><?php echo $row->cid; ?></td>
					<td><?php echo $row->type; ?></td>
					<td><a href="<?php echo site_url().'support/ticket/'.$row->cid; ?>"><?php echo $row->title; ?></a></td>
					<td><?php echo substr($row->content, 0, 30); ?></td>
					<td><?php echo $row->username; ?></td>
					<td><?php echo $row->status; ?></td>
				</tr>
				<?php } ?>
			</tbody>
        </table>
    </div>
    <?php echo $this->pagination->create_links(); ?>
    <p><strong>Total: <span class="green"><?php   if( isset($total_rows) && count($total_rows)>0 ){ echo $total_rows; } ?></span> (Items)</strong></p>
</div>
<?php $this->load->view('_base/footer'); ?>