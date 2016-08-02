<?php $this->load->view('_base/head'); ?>
<?php $this->load->view('menu'); ?>

<ul id="dropdow_menu">
    <?php
       $siteSconfig = $this->config->item('site');
       $base_url =  $this->config->item('base_url');
    ?>
    <li><a href="<?php echo $base_url; ?>sales/lists">Danh sách</a></li>
<!--     <li><a href="<?php echo $base_url; ?>sales/add">Thêm mới</a></li> -->
</ul>

<div id="content" class="container fullwidth">
    <h2 class="title "> Nội dung đang cập nhât</h2>

</div>
<?php $this->load->view('footer'); ?>