<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url(); ?>customers">Danh sách</a></li>
    <li><a href="<?php echo site_url(); ?>customers/add">Thêm mới</a></li>
</ul>
<div id="content" class="container fullwidth">
    <?php $this->load->view('_base/message'); ?>
    <h2 class="title ">Support List</h2>
    <div class="filer_box">
        <?php
            $filter_cid = $this->input->get('filter_cid');
        ?>
        <form name="filter_form" action="<?php echo site_url("customers/lists"); ?>" method="GET">
            <input type="text" value="<?php echo isset($filter_cid)?$filter_cid:''; ?>" name="filter_cid">
        </form>
    </div>
    <div class="gridtable">
        <table>
            <tr>
				<td>ID</td>
				<td>Title</td>
				<td>Last reply</td>
				<td>Customer Name</td>
				<td>Status</td>
			</tr>
			<?php foreach($result as $key => $row){ ?>
			<tr>
				<td><?php echo $row->c_id; ?></td>
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