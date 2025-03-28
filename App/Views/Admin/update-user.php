<div class="main-content">
    <!-- main-content-wrap -->
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Sửa tài khoản</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="<?= BASE_URL ?>?role=admin&act=home">
                            <div class="text-tiny">Bảng điều khiển</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>?role=admin&act=all-user">
                            <div class="text-tiny">Tài khoản</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Sửa tài khoản</div>
                    </li>
                </ul>
            </div>
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

                <form action="<?= BASE_URL ?>?role=admin&act=user-post-update&id=<?= $_GET['id'] ?>"
                    method="post" enctype="multipart/form-data">
                    <div class="mb-5">
                        <div class="body-title mb-10">Tên tài khoản <span class="tf-color-1">*</span></div>
                        <input type="text" name="name" id="name" placeholder="Nhập tên" class="form-control" value="<?= $user->name ?>">
                    </div>
                    <div class="mb-5">
                        <div class="body-title mb-10">Email <span class="tf-color-1">*</span></div>
                        <input type="email" name="email" id="email" placeholder="Nhập email" class="form-control" value="<?= $user->email ?>">
                    </div>
                    <div class="mb-5">
                        <div class="body-title mb-10">Mật khẩu <span class="tf-color-1">*</span></div>
                        <input type="password" name="password" id="password" placeholder="Nhập mật khẩu" class="form-control">
                    </div>
                    <div class="mb-5">
                        <div class="body-title mb-10">Địa chỉ <span class="tf-color-1">*</span></div>
                        <input type="text" name="address" id="address" placeholder="Nhập địa chỉ" class="form-control" value="<?= $user->address ?>">
                    </div>
                    <div class="mb-5">
                        <div class="body-title mb-10">Số điện thoại <span class="tf-color-1">*</span></div>
                        <input type="text" name="phone" id="phone" placeholder="Nhập sđt" class="form-control" value="<?= $user->phone ?>">
                    </div>
                    <div class="mb-5">
                        <img src="<?= $user->image ?>" alt="" width="50">
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
                        <label for="role">Role</label>
                        <select name="role" id="role" class="mb-10">
                            <option value="" hidden>Quyền</option>
                            <option value="1"
                                <?php
                                if ($user->role == "1") {
                                    echo "selected";
                                }
                                ?>>Admin
                            </option>
                            <option value="2"
                                <?php
                                if ($user->role == "2") {
                                    echo "selected";
                                }
                                ?>>User
                            </option>
                        </select>
                    </div>
                    <hr>

                    <div class="cols gap10">
                        <button class="tf-button w380" type="submit">Lưu lại</button>
                        <a href="<?= BASE_URL ?>?role=admin&act=all-user" class="tf-button style-3 w380" type="submit">Hủy bỏ</a>
                    </div>

                </form>
            </div>
        </div>
        <!-- /main-content-wrap -->
    </div>
    <!-- /main-content-wrap -->
    <!-- bottom-page -->
    <!-- /bottom-page -->
</div>