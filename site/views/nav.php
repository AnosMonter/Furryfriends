<nav>
    <div class="nav-container">
        <li class="Category"><i class="fa-solid fa-bars"></i>DANH MỤC SẢN PHẨM
            <ul class="Category-List">
                <li class="List">
                    <a href="index.php?Page=tim_kiem&Search=chó">Đồ Cho Chó</a>
                    <ul>
                        <?php
                        foreach ($this->Database->Get_Category_By_Like_Name('Cho Chó') as $category_Cho) {
                            echo '<li><a href="index.php?Page=san_pham_dm&id=' . $category_Cho['ID'] . '">' . $category_Cho['Name'] . '</a></li>';
                        }
                        ?>
                    </ul>
                </li>
                <li class="List"><a href="index.php?Page=tim_kiem&Search=mèo">Đồ Cho Mèo</a>
                    <ul>
                        <?php
                        foreach ($this->Database->Get_Category_By_Like_Name('Cho Mèo') as $category_Meo) {
                            echo '<li><a href="index.php?Page=san_pham_dm&id=' . $category_Meo['ID'] . '">' . $category_Meo['Name'] . '</a></li>';
                        }
                        ?>
                    </ul>
                </li>
                <li class="List"><a href="index.php?Page=tim_kiem&Search=thẻ tên">Thẻ Tên Thú Cưng</a>
                    <ul>
                        <?php
                        foreach ($this->Database->Get_Category_By_Like_Name('Thẻ Tên') as $category) {
                            echo '<li><a href="index.php?Page=san_pham_dm&id=' . $category['ID'] . '">' . $category['Name'] . '</a></li>';
                        }
                        ?>
                    </ul>
                </li>
                <li class="List"><a href="">Dịch Vụ Spa</a>
                    <ul>
                        <?php
                        foreach ($this->Database->Get_Category_By_Like_Name('Dịch Vụ') as $category) {
                            echo '<li><a href="index.php?Page=dich_vu&ID=' . $category['ID'] . '">' . $category['Name'] . '</a></li>';
                        }
                        ?>
                    </ul>
                </li>
                <li class="List"><a href="index.php?Page=lien_he">Liên Hệ</a>
                    <ul>
                        <li><a href="">SĐT</a></li>
                        <li><a href="">Email</a></li>
                    </ul>
                </li>
                <li><a onclick="" href="">Khuyến Mãi</a></li>
            </ul>
        </li>
        <li class="Category">Dịch Vụ
            <ul style="width: max-content; position: absolute; left: 0;"  class="Category-List">
                <?php
                foreach ($this->Database->Get_Category_By_Like_Name('Dịch Vụ') as $category) {
                    echo '<li class="List"><a href="index.php?Page=dich_vu&ID=' . $category['ID'] . '">' . $category['Name'] . '</a></li>';
                }
                ?>
            </ul>
        </li>
        <li><a href="index.php?Page=tim_kiem&Search=chó">Chó</a></li>
        <li><a href="index.php?Page=tim_kiem&Search=mèo">Mèo</a></li>
        <li><a href="index.php?Page=tim_kiem&Search=thẻ tên">Thẻ Tên Thú Cưng</a></li>
        <li><a href="index.php?Page=bai_viet">Tin Tức</a></li>
        <li><a href="index.php?Page=lien_he">Liên Hệ</a></li>
        <li><a href="index.php?Page=gioi_thieu">Giới Thiệu</a></li>
    </div>
</nav>