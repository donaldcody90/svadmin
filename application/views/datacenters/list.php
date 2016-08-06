<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url('datacenters'); ?>">Datacenter List</a></li>
    <li><a href="<?php echo site_url('datacenters/add'); ?>">Add new</a></li>
</ul>
<div id="content" class="container fullwidth">
    <?php $this->load->view('_base/message'); ?>
    <h2 class="title ">Datacenter List</h2>
    <div class="filer_box">
        <?php
            $filter_id = $this->input->get('filter_id');
            $filter_username = $this->input->get('filter_username');
            $filter_ip = $this->input->get('filter_ip');
            $filter_svkey = $this->input->get('filter_svkey');
            $filter_svpass = $this->input->get('filter_svpass');
        ?>
        <form name="filter_form" action="<?php echo site_url("datacenters/lists"); ?>" method="GET">
            ID:<input type="text" value="<?php echo isset($filter_id)?$filter_id:''; ?>" name="filter_id">
            Customer:<input type="text" value="<?php echo isset($filter_username)?$filter_username:''; ?>" name="filter_username">
            IP Address:<input type="text" value="<?php echo isset($filter_ip)?$_GET['filter_ip']:''; ?>" name="filter_ip">
            Key:<input type="text" value="<?php echo isset($filter_svkey)?$_GET['filter_svkey']:''; ?>" name="filter_svkey">
            Password:<input type="text" value="<?php echo isset($filter_svpass)?$_GET['filter_svpass']:''; ?>" name="filter_svpass">
            
            <input class="button" type="submit" value="Search" />
            <input class="button" type="reset" value="Clear" />
        </form>
    </div>
    <div class="gridtable">
        <table>
            <tr>
				<td>ID</td>
				<td>Customer</td>
				<td>IP Address</td>
				<td>Key</td>
				<td>Password</td>
				<td>Action</td>
			</tr>
			<?php foreach($result as $key => $row){ ?>
			<tr>
				<td><?php echo $row->id; ?></td>
				<td><?php echo $row->username; ?></td>
				<td><?php echo $row->ip; ?></td>
				<td><?php echo $row->svkey; ?></td>
				<td><?php echo $row->svpass; ?></td>
				<td>
					<a class="edit" href="<?php echo site_url() . 'datacenters/update/' . $row->id; ?>">Edit</a>
					<a class="delete" href="<?php echo site_url() . 'datacenters/deletedc/' . $row->id; ?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
				</td>
			</tr>
			<?php } ?>
        </table>
    </div>
    <?php echo $this->pagination->create_links(); ?>
    <p><strong>Total: <span class="green"><?php   if( isset($total_rows) && count($total_rows)>0 ){ echo $total_rows; } ?></span> (Items)</strong></p>
</div>
<?php $this->load->view('_base/footer'); ?>