<div class="wg-box">
    <?php
    if (isset($_SESSION['message'])) {
        echo "<p>" . $_SESSION['message'] . "</p>";
        unset($_SESSION['message']);
    }
    if (isset($_SESSION['error'])) {
        echo "<p>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
    ?>

    <form action="<?= BASE_URL ?>?act=user-post-add" method="post" enctype="multipart/form-data">
        <div class="mb-5">
            <div class="body-title mb-10">Tên tài khoản <span class="tf-color-1">*</span></div>
            <input type="text" name="name" id="name" placeholder="Nhập tên" class="form-control">
        </div>
        <div class="mb-5">
            <div class="body-title mb-10">Email <span class="tf-color-1">*</span></div>
            <input type="email" name="email" id="email" placeholder="Nhập email" class="form-control">
        </div>
        <div class="mb-5">
            <div class="body-title mb-10">Mật khẩu <span class="tf-color-1">*</span></div>
            <input type="password" name="password" id="password" placeholder="Nhập mật khẩu" class="form-control">
        </div>
        <div class="mb-5">
            <div class="body-title mb-10">Địa chỉ <span class="tf-color-1">*</span></div>
            <input type="text" name="address" id="address" placeholder="Nhập địa chỉ" class="form-control">
        </div>
        <div class="mb-5">
            <div class="body-title mb-10">Số điện thoại <span class="tf-color-1">*</span></div>
            <input type="text" name="phone" id="phone" placeholder="Nhập sđt" class="form-control">
        </div>
        <div class="mb-5">
            <div class="body-title mb-10">Ảnh đại diện <span class="tf-color-1">*</span></div>
            <input
                type="file"
                name="image"
                id="image"
                placeholder="Tải lên hình ảnh"
                class="form-control"
                accept="image/*"
                style="
                                                border: 1px solid #ff7433;
                                                background-color: white;  
                                                border-radius: 5px; 
                                                font-size: 15px; 
                                                cursor: pointer;
                                                transition: background-color 0.3s;
                                                margin-bottom: 15px;
                                            "
                onmouseover="this.style.backgroundColor='#ff7433'"
                onmouseout="this.style.backgroundColor='white'">
        </div>
        <div class="mb-5">
            <div class="body-title mb-10">Quyền <span class="tf-color-1">*</span></div>
            <select name="role" id="role" class="mb-10">
                <option value="" hidden>Quyền</option>
                <option value="1">user</option>
                <option value="2">Admin</option>
            </select>
        </div>
        <hr>

        <div class="cols gap10">
            <button class="tf-button w380" type="submit">Thêm tài khoản</button>
            <a href="<?= BASE_URL ?>?role=admin&act=all-user" class="tf-button style-3 w380" type="submit">Hủy bỏ</a>
        </div>

    </form>
</div>