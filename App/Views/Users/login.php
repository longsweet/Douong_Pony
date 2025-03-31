<div id="wrapper">

<!-- Header -->

<div class="tf-page-title style-2">
    <div class="container-full">
        <div class="heading text-center">Đăng nhập</div>
    </div>
</div>

<section class="flat-spacing-10">
    <div class="container">
        <div class="tf-grid-layout lg-col-2 tf-login-wrap">
            <div class="tf-login-form">
                <div id="recover">
                    <h5 class="mb_24">Reset your password</h5>
                    <p class="mb_30">We will send you an email to reset your password</p>
                    <div>
                        <form class="" id="login-form" action="#" method="post" accept-charset="utf-8" data-mailchimp="true">
                            <div class="tf-field style-1 mb_15">
                                <input class="tf-field-input tf-input" placeholder="" type="email" id="property3" name="email">
                                <label class="tf-field-label fw-4 text_black-2" for="property3">Email *</label>
                            </div>
                            <div class="mb_20">
                                <a href="#login" class="tf-btn btn-line">Cancel</a>
                            </div>
                            <div class="">
                                <button type="submit" class="tf-btn w-100 radius-3 btn-fill animate-hover-btn justify-content-center">Reset password</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="login">
                    <h5 class="mb_36">Đăng nhập</h5>
                    <?php 
                        if(isset($_SESSION['error'])){
                            echo "<p style='color:red;'>" . $_SESSION['error'] . "</p>";
                            unset($_SESSION['error']);
                        }
                        if(isset($_SESSION['message'])){
                            echo "<p style='color:#00ff00;'>" . $_SESSION['message'] . "</p>";
                            unset($_SESSION['message']);
                        }  
                        
                    ?>
                    <div>
                        <form class="" id="login-form" action="<?= BASE_URL ?>?act=post-login" accept-charset="utf-8" method="post">
                            <div class="tf-field style-1 mb_15">
                                <input class="tf-field-input tf-input" placeholder="" type="email" id="property3" name="email">
                                <label class="tf-field-label fw-4 text_black-2" for="property3">Email *</label>
                            </div>
                            <div class="tf-field style-1 mb_30">
                                <input class="tf-field-input tf-input" placeholder="" type="password" id="property4" name="password">
                                <label class="tf-field-label fw-4 text_black-2" for="property4">Password *</label>
                            </div>
                            <div class="mb_20">
                                <a href="#recover" class="tf-btn btn-line">Quên mật khẩu?</a>
                            </div>
                            <div class="">
                                <button type="submit" class="tf-btn w-100 radius-3 btn-fill animate-hover-btn justify-content-center">Log in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tf-login-content">
                <h5 class="mb_36">Tạo tài khoản</h5>
                <p class="mb_20">Đăng ký để được tiếp cận chương trình khuyến mại sớm cùng với các sản phẩm mới, xu hướng và chương trình khuyến mãi riêng. Để từ chối, hãy nhấp vào hủy đăng ký trong email của chúng tôi.</p>
                <a href="<?= BASE_URL?>?act=register" class="tf-btn btn-line">Đăng ký<i class="icon icon-arrow1-top-left"></i></a>
            </div>
        </div>
    </div>
</section>
<!-- Footer -->
<!-- /Footer -->

</div>