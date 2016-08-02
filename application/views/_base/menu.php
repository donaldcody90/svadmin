<?php 
$cController=vst_getController();
$cMedthod=vst_getMethod();
?>
<div id="main_menu">
	<ul>
		<li <?php echo $cController == 'customers' ? 'class="active"':'' ?> ><a href="<?php echo site_url( 'customers' );?>">Khách hàng</a></li>
		<li <?php echo $cController == 'orders' ? 'class="active"':'' ?>><a href="<?php echo site_url( 'orders' );?>">Đơn hàng</a></li>
		<li <?php echo $cController == 'sales' ? 'class="active"':'' ?>><a href="<?php echo site_url( 'sales' );?>">Sales</a></li>
		<li <?php echo $cController == 'storecn' ? 'class="active"':'' ?>><a href="<?php echo site_url( 'storecn' );?>">Kho Trung Quốc</a></li>
		<li <?php echo $cController == 'storevn' ? 'class="active"':'' ?>><a href="<?php echo site_url( 'storevn' );?>">Kho Việt Nam</a></li>
		<li <?php echo $cController == 'users' ? 'class="active"':'' ?>><a href="<?php echo site_url( 'users' );?>">Nhân viên</a></li>
		<li <?php echo $cController == 'checkshop' ? 'class="active"':'' ?>><a href="<?php echo site_url( 'checkshop' );?>">Mua hàng</a></li>
	</ul>
	
</div>
