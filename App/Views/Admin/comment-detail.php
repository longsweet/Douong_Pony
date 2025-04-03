<?= include 'App/Views/Admin/layouts/header.php' ?>

<div class="main-content">
    <!-- main-content-wrap -->
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">

                <h3>Danh sách bình luận của <?= $product->name ?></h3>
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
                        <a href="<?= BASE_URL ?>?role=admin&act=all-category">
                            <div class="text-tiny">Danh mục</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Sửa danh mục</div>
                    </li>
                </ul>

                <h3>Danh sách bình luận của <?= $product->Name ?></h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <?= include 'App/Views/Admin/layouts/nav.php' ?>
                </ul>

            </div>


            <div class="wg-box">
                <?php
                if (isset($_SESSION['message'])) {
                    echo "<p>" . $_SESSION['message'] . "</p>";
                    unset($_SESSION['message']);
                }
                ?>

                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <div class="show">
                            <div class="text-tiny">Hiển thị</div>
                            <div class="select">
                                <select class="">
                                    <option>10</option>
                                    <option>20</option>
                                    <option>30</option>
                                </select>
                            </div>
                            <div class="text-tiny">Mục nhập</div>
                        </div>
                        <form class="form-search">
                            <fieldset class="name">
                                <input type="text" placeholder="Tìm kiếm ở đây" class="" name="name" tabindex="2" value="" aria-required="true" required="">
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="wg-table table-product-list">
                    <ul class="table-title flex gap20 mb-14">
                        <li>
                            <div class="body-title">STT</div>
                        </li>
                        <li>
                            <div class="body-title">Tên tài khoản</div>
                        </li>
                        <li>
                            <div class="body-title">Nội dung</div>
                        </li>
                        <li>
                            <div class="body-title">Ngày</div>
                        </li>
                        <li>
                            <div class="body-title">Thao tác</div>
                        </li>
                    </ul>
                    <ul class="flex flex-column">
                        <?php foreach ($commentDetail as $key => $value): ?>
                            <li class="wg-product item-row gap20">
                                <div class="body-text text-main-dark mt-4"><?= $key + 1 ?></div>
                                <div class="body-text text-main-dark mt-4"><?= $value->name ?></div>
                                <div class="body-text text-main-dark mt-4">
                                    <?= $value->comment ?>
                                </div>
                                <div class="body-text text-main-dark mt-4"><?= date("d/m/Y", strtotime($value->created_at)) ?></div>
                                <div class="list-icon-function">
                                    <div class="item eye">
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal" data-commnet="<?= $value->id ?>">Trả lời</button>
                                        <form action="<?= BASE_URL ?>?role=admin&act=comment-delete" method="post">
                                            <input type="hidden" name="productId" id="" value="<?= $product->id ?>">
                                            <input type="hidden" name="commentId" id="" value="<?= $value->id ?>">
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Bạn có muốn xóa không?')">Xóa</button>
                                        </form>

                                    </div>
                                </div>

                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10">
                    <div class="text-tiny">Hiển thị 10 mục</div>
                    <ul class="wg-pagination">
                        <li>
                            <a href="#"><i class="icon-chevron-left"></i></a>
                        </li>
                        <li>
                            <a href="#">1</a>
                        </li>
                        <li class="active">
                            <a href="#">2</a>
                        </li>
                        <li>
                            <a href="#">3</a>
                        </li>
                        <li>
                            <a href="#"><i class="icon-chevron-right"></i></a>
                        </li>
                    </ul>
                </div>
            </div>



        </div>
        <!-- /main-content-wrap -->
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Phản hồi bình luận</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= BASE_URL ?>?role=admin&act=comment-reply" method="post">
                    <input type="hidden" name="product-id" value="<?= $product->id ?>">
                    <input type="hidden" name="comment-id" id="comment-id">
                    <div class="modal-body">
                        <textarea name="reply" id="" class="form-control" placeholder="Nội dung trả lời"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-warning">Gửi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /main-content-wrap -->


    <?= include 'App/Views/Admin/layouts/footer.php' ?>