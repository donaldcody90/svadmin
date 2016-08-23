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
    <h2 class="title ">Plan List</h2>
    <div class="filer_box">
        <?php
            $filter_name = $this->input->get('filter_name');
            $filter_price = $this->input->get('filter_price');
            $filter_cpu_core = $this->input->get('filter_cpu_core');
            $filter_disk_space = $this->input->get('filter_disk_space');
            $filter_ram = $this->input->get('filter_ram');
            $filter_bandwidth = $this->input->get('filter_bandwidth');
            $filter_status = $this->input->get('filter_status');
        ?>
        <form name="filter_form" action="" method="GET">
            Name:<input type="text" value="<?php echo isset($filter_name)?$filter_name:''; ?>" name="filter_name">
            Price:<input type="text" value="<?php echo isset($filter_price)?$_GET['filter_price']:''; ?>" name="filter_price">
            CPU:<input type="text" value="<?php echo isset($filter_cpu_core)?$_GET['filter_cpu_core']:''; ?>" name="filter_cpu_core">
            Disk space:<input type="text" value="<?php echo isset($filter_disk_space)?$_GET['filter_disk_space']:''; ?>" name="filter_disk_space">
            Ram:<input type="text" value="<?php echo isset($filter_ram)?$_GET['filter_ram']:''; ?>" name="filter_ram">
            Bandwidth:<input type="text" value="<?php echo isset($filter_bandwidth)?$_GET['filter_bandwidth']:''; ?>" name="filter_bandwidth">
            Status:	<select name="filter_status">
						<option value="">Choose one</option>
						<option value="1" <?php echo isset($filter_status) && $filter_status== 1?'selected':''; ?>>Enable</option>
						<option value="0" <?php echo isset($filter_status) && $filter_status== 0?'selected':''; ?>>Disable</option>
					</select>
            
            <input class="button" type="submit" value="Search" />
            <a href="<?php echo site_url('plans/lists') ?>"><input class="button" type="button" value="Clear"></a>
        </form>
    </div>
    <div class="gridtable">
        <table>
            <tr>
				<td>ID</td>
				<td>Name</td>
				<td>Price</td>
				<td>CPU</td>
				<td>Disk space</td>
				<td>Ram</td>
				<td>Bandwidth</td>
				<td>Status</td>
				<td>Action</td>
			</tr>
			<?php foreach($result as $key => $row){ ?>
			<tr>
				<td><?php echo $row->id; ?></td>
				<td><?php echo $row->name; ?></td>
				<td>$<?php echo $row->price; ?>/month</td>
				<td><?php echo $row->cpu_core; ?> core</td>
				<td><?php echo $row->disk_space; ?> GB</td>
				<td><?php echo $row->ram; ?> MB</td>
				<td><?php echo $row->bandwidth; ?> GB</td>
				<td><?php echo getStatusCategories($row->status); ?></td>
				<td>
					<a class="edit" href="<?php echo site_url() . 'plans/edit/' . $row->id; ?>">Edit</a>
					<a class="delete" href="<?php echo site_url() . 'plans/delete/' . $row->id; ?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
				</td>
			</tr>
			<?php } ?>
        </table>
    </div>
    <?php echo $this->pagination->create_links(); ?>
    <p><strong>Total: <span class="green"><?php   if( isset($total_rows) && count($total_rows)>0 ){ echo $total_rows; } ?></span> (Items)</strong></p>
</div>
<?php $this->load->view('_base/footer'); ?>