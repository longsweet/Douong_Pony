<?php

class CommentRatingController
{
    // Hiển thị danh sách các bình luận và đánh giá của sản phẩm
    public function showComment()
    {
        $productModel = new ProductModel();
        // Lấy danh sách tất cả sản phẩm
        $listProduct = $productModel->getAllProduct();
        
        $comment = new CommentRatingModel();

        // Duyệt qua từng sản phẩm để lấy thông tin đánh giá và số lượng bình luận
        foreach ($listProduct as $key => $value) {
            $listProduct[$key]->avRating = $comment->avgRating($value->id); // Lấy điểm đánh giá trung bình
            $listProduct[$key]->countComment = $comment->countComment($value->id); // Lấy số lượng bình luận
        }

        // Hiển thị danh sách bình luận và đánh giá trên trang admin
        include 'App/Views/Admin/comment.php';
    }

    // Hiển thị chi tiết bình luận của một sản phẩm
    public function commentDetail()
    {
        $productModel = new ProductModel();
        // Lấy thông tin chi tiết của sản phẩm
        $product = $productModel->getProductByID();

        $commentRatingModel = new CommentRatingModel();
        // Lấy chi tiết các bình luận của sản phẩm
        $commentDetail = $commentRatingModel->showCommentDetail();

        // Hiển thị chi tiết bình luận trên trang admin
        include 'App/Views/Admin/comment-detail.php';
    }

    // Phản hồi một bình luận
    public function commentReply()
    {
        $commentModel = new CommentRatingModel();
        // Thực hiện phản hồi bình luận
        $commentModel->repComment();

        // Sau khi phản hồi, chuyển hướng về trang chi tiết bình luận của sản phẩm
        header('Location: ' .   BASE_URL    .   "?role=admin&act=comment-detail&id="    .   $_POST['product-id']);
    }

    // Xóa một bình luận
    public function commentDelete()
    {
        $commentModel = new CommentRatingModel();
        // Thực hiện xóa bình luận
        $commentModel->commentDelete();

        // Sau khi xóa, chuyển hướng về trang chi tiết bình luận của sản phẩm
        header('Location: ' .   BASE_URL    .   "?role=admin&act=comment-detail&id="    .   $_POST['productId']);
    }
}
