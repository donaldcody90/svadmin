<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url(); ?>customers">Support List</a></li>
    <li><a href="<?php echo site_url(); ?>customers/add">Add new</a></li>
</ul>
<div id="content" class="container fullwidth">
    <?php $this->load->view('_base/message'); ?>
    <h2 class="title ">Support List</h2>
    <div class="filer_box">
        
		<?php
			$filter_c_id = $this->input->get('filter_c_id');
			$filter_c_title = $this->input->get('filter_c_title');
			$filter_m_content = $this->input->get('filter_m_content');
			$filter_username = $this->input->get('filter_username');
			$filter_c_status = $this->input->get('filter_c_status');
		?>
		<form name="filter_form" action="<?php echo site_url('support/lists'); ?>" method="GET">
            ID:<input type="text" value="<?php echo isset($filter_c_id)?$filter_c_id:''; ?>" name="filter_c_id">
            Title:<input type="text" value="<?php echo isset($filter_c_title)?$filter_c_title:''; ?>" name="filter_c_title">
            Last reply:<input type="text" value="<?php echo isset($filter_m_content)?$filter_m_content:''; ?>" name="filter_m_content">
            Customer Name:<input type="text" value="<?php echo isset($filter_username )?$filter_username:''; ?>" name="filter_username">
            Status:
            <select name="filter_c.c_status">
                <option value="" selected>All ticket</option>
                <option value="opening" <?php echo (isset($filter_c_status) && $filter_c_status=='opening' )?'selected':''; ?>>opening</option>
                <option value="closed" <?php echo (isset($filter_c_status) && $filter_c_status=='closed' )?'selected':''; ?>>closed</option>
            </select>
          <input class="button" type="submit" value="Search" >
          <input class="button" type="reset" value="Clear" >
        </form> 
    </div>
    <div class="gridtable">
        <table>
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
				<td><?php echo $row->c_id; ?></td>
				<td><?php echo $row->c_type; ?></td>
				<td><a href="<?php echo site_url().'support/ticket/'.$row->c_id; ?>"><?php echo $row->c_title; ?></a></td>
				<td><?php echo substr($row->m_content, 0, 30); ?></td>
				<td><?php echo $row->username; ?></td>
				<td><?php echo $row->c_status; ?></td>
			</tr>
			<?php } ?>
        </table>
    </div>
    <?php echo $this->pagination->create_links(); ?>
    <p><strong>Total: <span class="green"><?php   if( isset($total_rows) && count($total_rows)>0 ){ echo $total_rows; } ?></span> (Items)</strong></p>
</div>
<?php $this->load->view('_base/footer'); ?>