<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url('servers'); ?>">Servers</a></li>
    <li><a href="<?php echo site_url('servers/add'); ?>">Add server</a></li>
    <li><a href="<?php echo site_url('vps'); ?>">VPS</a></li>
    <li><a href="<?php echo site_url('vps/add'); ?>">Add VPS</a></li>
</ul>
<div id="content" class="container fullwidth">
    <?php $this->load->view('_base/message'); ?>
    <h2 class="title ">VPS List</h2>
    <div class="filer_box">
        <?php
            $filter_username = $this->input->get('filter_username');
            $filter_svid = $this->input->get('filter_svid');
            $filter_vps_label = $this->input->get('filter_vps_label');
            $filter_vps_ip = $this->input->get('filter_vps_ip');
            $filter_create_date = $this->input->get('filter_create_date');
        ?>
        <form name="filter_form" action="<?php echo site_url('vps/lists'); ?>" method="GET">
            Customer:<input type="text" value="<?php echo isset($filter_username)?$filter_username:''; ?>" name="filter_username">
            Servers ID:<input type="text" value="<?php echo isset($filter_svid)?$filter_svid:''; ?>" name="filter_svid">
            VPS Label:<input type="text" value="<?php echo isset($filter_vps_label)?$_GET['filter_vps_label']:''; ?>" name="filter_vps_label">
            VPS IP:<input type="text" value="<?php echo isset($filter_vps_ip)?$_GET['filter_vps_ip']:''; ?>" name="filter_vps_ip">
            Create Date:<input type="text" value="<?php echo isset($filter_create_date)?$_GET['filter_create_date']:''; ?>" name="filter_create_date">
            
            <input class="button" type="submit" value="Search" />
            <a href="<?php echo site_url('vps/lists') ?>"><input class="button" type="button" value="Clear"></a>
        </form>
    </div>
    <div class="gridtable">
        <table>
            <tr>
				<td>ID</td>
				<td>Customer</td>
				<td>Servers ID</td>
				<td>VPS Label</td>
				<td>VPS IP</td>
				<td>Create Date</td>
				<td>Space</td>
				<td>Ram</td>
				<td>Action</td>
			</tr>
			<?php foreach($value as $key => $row){ ?>
			<tr>
				<td><?php echo $row->id; ?></td>
				<td><?php echo $row->username; ?></td>
				<td><?php echo $row->svid; ?></td>
				<td><?php echo $row->vps_label; ?></td>
				<td><?php echo $row->vps_ip; ?></td>
				<td><?php echo $row->create_date; ?></td>
				<td><?php echo $row->space; ?></td>
				<td><?php echo $row->ram; ?></td>
				<td>
					<a class="edit" href="<?php echo site_url() . 'vps/edit/' . $row->id; ?>">Edit</a>
					<a class="delete" href="<?php echo site_url() . 'vps/deletevps/' . $row->id; ?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
				</td>
			</tr>
			<?php } ?>
        </table>
    </div>
    <?php echo $link; ?>
    <p><strong>Total: <span class="green"><?php   if( isset($total_rows) && count($total_rows)>0 ){ echo $total_rows; } ?></span> (Items)</strong></p>
</div>
<?php $this->load->view('_base/footer'); ?>