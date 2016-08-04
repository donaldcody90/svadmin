<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url('datacenters/lists'); ?>">Datacenter List</a></li>
    <li><a href="<?php echo site_url('datacenters/add'); ?>">Add new</a></li>
</ul>
<div id="content" class="container fullwidth">
    <?php $this->load->view('_base/message'); ?>
    <h2 class="title ">Datacenter List</h2>
    <div class="filer_box">
        <?php
            $filter_id = $this->input->get('filter_id');
            $filter_ip = $this->input->get('filter_ip');
            $filter_sv_key = $this->input->get('filter_sv_key');
            $filter_sv_pass = $this->input->get('filter_sv_pass');
        ?>
        <form name="filter_form" action="<?php echo site_url("datacenters/lists"); ?>" method="GET">
            ID:<input type="text" value="<?php echo isset($filter_id)?$filter_id:''; ?>" name="filter_id">
            IP Address:<input type="text" value="<?php echo isset($filter_ip)?$_GET['filter_ip']:''; ?>" name="filter_ip">
            Key:<input type="text" value="<?php echo isset($filter_sv_key)?$_GET['filter_sv_key']:''; ?>" name="filter_sv_key">
            Password:<input type="text" value="<?php echo isset($filter_sv_pass)?$_GET['filter_sv_pass']:''; ?>" name="filter_sv_pass">
            
            <input class="button" type="submit" value="Tìm kiếm" />
        </form>
    </div>
    <div class="gridtable">
        <table>
            <tr>
				<td>ID</td>
				<td>IP Address</td>
				<td>Key</td>
				<td>Password</td>
				<td>Action</td>
			</tr>
			<?php foreach($result as $key => $row){ ?>
			<tr>
				<td><?php echo $row->id; ?></td>
				<td><?php echo $row->ip; ?></td>
				<td><?php echo $row->sv_key; ?></td>
				<td><?php echo $row->sv_pass; ?></td>
				<td>
					<a href="<?php echo site_url() . 'datacenters/update/' . $row->id; ?>">Edit</a>
					<a href="<?php echo site_url() . 'datacenters/deletedc/' . $row->id; ?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
				</td>
			</tr>
			<?php } ?>
        </table>
    </div>
    <?php echo $this->pagination->create_links(); ?>
    <p><strong>Total: <span class="green"><?php   if( isset($total_rows) && count($total_rows)>0 ){ echo $total_rows; } ?></span> (Items)</strong></p>
</div>
<?php $this->load->view('_base/footer'); ?>