<?= include 'App/Views/Admin/layouts/header.php' ?>

<div class="main-content">
    <!-- main-content-wrap -->
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Tất cả User & Admin</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="index.html">
                            <div class="text-tiny">Trang chủ</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="<?= BASE_URL_ADMIN  ?>act=product">
                            <div class="text-tiny">Sản phẩm</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="<?= BASE_URL_ADMIN  ?>act=category">
                            <div class="text-tiny">danh mục</div>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="wg-box">

                <form action="#">
                    <div class="mb-5">
                        <div class="body-title mb-10">Tên tài khoản <span class="tf-color-1">*</span></div>
                        <input type="text" name="name" id="name" placeholder="Name" class="form-control" value="<?= $user->name ?>" readonly>
                    </div>
                    <div class="mb-5">
                        <div class="body-title mb-10">Email <span class="tf-color-1">*</span></div>
                        <input type="email" name="email" id="email" placeholder="Email" class="form-control" value="<?= $user->email ?>" readonly>
                    </div>
                    <div class="mb-5">
                        <div class="body-title mb-10">Địa chỉ <span class="tf-color-1">*</span></div>
                        <input type="text" name="address" id="address" placeholder="Address" class="form-control" value="<?= $user->address ?>" readonly>
                    </div>
                    <div class="mb-5">
                        <div class="body-title mb-10">Số điện thoại <span class="tf-color-1">*</span></div>
                        <input type="text" name="phone" id="phone" placeholder="Phone" class="form-control" value="<?= $user->phone ?>" readonly>
                    </div>
                    <div class="mb-5">
                        <div class="body-title mb-10">Ảnh đại diện <span class="tf-color-1">*</span></div>
                        <img src="<?= $user->image ?>" alt="" width="50">
                    </div>
                    <div class="mb-5">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="mb-10" readonly>
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
                </form>
            </div>
        </div>
    </div>
    <!-- /main-content-wrap -->        <?= include 'App/Views/Admin/layouts/footer.php' ?>

</div>


