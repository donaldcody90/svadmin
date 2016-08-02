<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url(); ?>users">Danh sách</a></li>
    <li><a href="<?php echo site_url(); ?>users/add">Thêm mới</a></li>
</ul>
<div id="content" class="container fullwidth">
    <?php $this->load->view('_base/message'); ?>
    <h2 class="title "> Danh sách nhân viên</h2>
    <div class="filer_box">
         <form action="<?php echo site_url('users/lists') ?>" method="GET">
            UID:<input type="text" value="<?php echo isset($_GET['filter_uid'])?$_GET['filter_uid']:''; ?>" name="filter_uid">
            Username:<input type="text" value="<?php echo isset($_GET['filter_username'])?$_GET['filter_username']:''; ?>" name="filter_username">
            Họ Tên:<input type="text" value="<?php echo isset($_GET['filter_fullname'])?$_GET['filter_fullname']:''; ?>" name="filter_fullname">
            Phone:<input type="text" value="<?php echo isset($_GET['filter_phone'])?$_GET['filter_phone']:''; ?>" name="filter_phone">
            Email:<input type="text" value="<?php echo isset($_GET['filter_email'])?$_GET['filter_email']:''; ?>" name="filter_email">
            Khu Vực:
            <select name="filter_location">
                <option value="">Chọn khu vực</option>
                <option value="0" <?php echo (isset($_GET['filter_location']) && $_GET['filter_location']==0 && $_GET['filter_location']!='' )?'selected':''; ?> >Hà Nội</option>
                <option value="1" <?php echo (isset($_GET['filter_location']) && $_GET['filter_location']==1 )?'selected':''; ?> >Sài Gòn</option>
            </select>
            Chức vụ:
            <select name="filter_role">
                <option value="">Chọn chức vụ</option>
                <option value="1" <?php echo (isset($_GET['filter_role']) && $_GET['filter_role']==1 )?'selected':''; ?>>Admin</option>
                <option value="2" <?php echo (isset($_GET['filter_role']) && $_GET['filter_role']==2 )?'selected':''; ?>>Quản lý</option>
                <option value="3" <?php echo (isset($_GET['filter_role']) && $_GET['filter_role']==3 )?'selected':''; ?>>Tư vấn</option>
                <option value="4" <?php echo (isset($_GET['filter_role']) && $_GET['filter_role']==4 )?'selected':''; ?>>Mua hàng</option>
                <option value="5" <?php echo (isset($_GET['filter_role']) && $_GET['filter_role']==5 )?'selected':''; ?>>Kho - Trung Quốc</option>
                <option value="6" <?php echo (isset($_GET['filter_role']) && $_GET['filter_role']==6 )?'selected':''; ?>>Kho - Việt Nam</option>
            </select>
            <input class="button" type="submit" value="Tìm kiếm">
        </form> 
    </div>
    <div class="gridtable">
        <table>
            <tbody>
                <tr>
                    <td>
                        UID
                    </td>
                    <td>
                        Tài khỏan
                    </td>
                    <td>
                        Họ Tên
                    </td>
                    <td>
                        Phone
                    </td>
                    <td>
                        Email
                    </td>
                    <td>
                        Chức vụ
                    </td>
                    <td>
                        IsActive
                    </td>
                    <td>
                        Truy cập cuối / IP Address
                    </td>
                    <td>
                        Thao tác
                    </td>
                </tr>
                <?php
                    if( isset($data) && count($data)>0 ){

                        $stt = $this->input->get('page');
                        if( $stt==NULL){
                            $stt = 1;
                        }else{
                            $stt = $this->input->get('page') +1;
                        }

                        foreach ($data as $key => $value) {
                ?>
                            <tr>
                                <td class="align-center">
                                    <?php echo $stt; ?>                        
                                </td>
                                <td>
                                    <a href="<?php echo site_url(); ?>users/edit/<?php echo $value['uid']; ?>"><?php echo $value['username']; ?></a>
                                </td>
                                <td>
                                    <?php echo $value['fullname']; ?>                        
                                </td>
                                <td>
                                    <?php echo $value['phone']; ?>                        
                                </td>
                                <td>
                                    <?php echo $value['email']; ?>                        
                                </td>
                                <td>
                                    <?php
                                        if( $value['role']==1 ){
                                            echo "Admin";
                                        }elseif( $value['role']==2 ){
                                            echo "Quản lý";
                                        }elseif( $value['role']==3 ){
                                            echo "Tư vấn";
                                        }elseif( $value['role']==4 ){
                                            echo "Kho TQ";
                                        }elseif( $value['role']==5 ){
                                            echo "Kho VN";
                                        }
                                    ?>                        
                                </td>
                                <td>
                                    <?php
                                        if( $value['isactive']==1 ){
                                            echo "Yes";
                                        }else{
                                            echo "No";
                                        }
                                    ?>                      
                                </td>
                                <td>
                                    <?php echo $value['lastlogin']; ?>                       
                                </td>
                                <td>
									<a href="<?php echo site_url('users/edit/'.$value['uid']); ?>">
Sửa</a> 
                                    |
                                    <a href="<?php echo site_url('users/delete/'.$value['uid']); ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa ???')">
 Xóa</a> 
                                    |
									<button class="link_ajax" onclick="openPopup('<?php echo site_url('users/changepassword'); ?>',{uid:<?php echo $value['uid']; ?>},600,500)">
 Đổi mật khẩu</button>
                                </td>
                            </tr>
                <?php
                            $stt++;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <?php echo $this->pagination->create_links(); ?>
    <p><strong>Total: <span class="green"><?php   if( isset($total_rows) && count($total_rows)>0 ){ echo $total_rows; } ?></span> (Items)</strong></p>
</div>
<?php $this->load->view('_base/footer'); ?>