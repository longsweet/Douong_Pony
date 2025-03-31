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