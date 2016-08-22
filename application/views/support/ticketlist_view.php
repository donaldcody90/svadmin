<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url(); ?>support">Tikets</a></li>
    <li><a href="<?php echo site_url(); ?>support/categories">Categories</a></li>
    <li><a href="<?php echo site_url(); ?>support/add">Add category</a></li>
</ul>
<div id="content" class="container fullwidth">
    <?php $this->load->view('_base/message'); ?>
    <h2 class="title">Support List</h2>
    <div class="filer_box">
        
		<?php
			$filter_cid = $this->input->get('filter_cid');
			$filter_title = $this->input->get('filter_title');
			$filter_content = $this->input->get('filter_content');
			$filter_username = $this->input->get('filter_username');
			$filter_status = $this->input->get('filter_status');
			$filter_name = $this->input->get('filter_name');
		?>
		<form name="filter_form" action="<?php echo site_url('support/lists'); ?>" method="GET">
            ID:<input type="text" value="<?php echo isset($filter_cid)?$filter_cid:''; ?>" name="filter_cid">
            Name:<input type="text" value="<?php echo isset($filter_name)?$filter_name:''; ?>" name="filter_name">
            Title:<input type="text" value="<?php echo isset($filter_title)?$filter_title:''; ?>" name="filter_title">
            Customer:<input type="text" value="<?php echo isset($filter_username )?$filter_username:''; ?>" name="filter_username">
			Status:
			<select name="filter_status">
				<option value="" selected>All ticket</option>
				<option value="1" <?php echo (isset($filter_status) && $filter_status=='1' )?'selected':''; ?>>opening</option>
				<option value="0" <?php echo (isset($filter_status) && $filter_status=='0' )?'selected':''; ?>>closed</option>
			</select>
          <input class="button" type="submit" value="Search" >
          <a href="<?php echo site_url('support/lists') ?>"><input class="button" type="button" value="Clear"></a>
        </form> 
    </div>
    <div class="gridtable support_list">
        <table>
			<tbody>
				<tr>
					<td>ID</td>
					<td>Name</td>
					<td>Title</td>
					<td>Customer</td>
					<td>Status</td>
				</tr>
			
				<?php foreach($result as $key => $row){ ?>
				<tr>
					<td><?php echo $row->cid; ?></td>
					<td><?php echo $row->name; ?></td>
					<td><a href="<?php echo site_url().'support/ticket/'.$row->cid; ?>"><?php echo $row->title; ?></a></td>
					<td><?php echo $row->username; ?></td>
					<td <?php echo $row->status == 1 ? 'class="opening"' : 'class="closed"'; ?> ><?php echo getStatusConversation($row->status); ?></td>
				</tr>
				<?php } ?>
			</tbody>
        </table>
    </div>
    <?php echo $this->pagination->create_links(); ?>
    <p><strong>Total: <span class="green"><?php   if( isset($total_rows) && count($total_rows)>0 ){ echo $total_rows; } ?></span> (Items)</strong></p>
</div>
<?php $this->load->view('_base/footer'); ?>