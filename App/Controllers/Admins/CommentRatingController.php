<?php

class CommentRatingController
{
    public function showComment()
    {
        $productModel = new ProductModel();
        $listProduct = $productModel->getAllProduct();
        $comment = new CommentRatingModel();

        foreach ($listProduct as $key => $value)
            // {
            $listProduct[$key]->avRating = $comment->avgRating($value->id);
        $listProduct[$key]->countComment = $comment->countComment($value->id);
        // }

        include 'App/Views/Admin/comment.php';
    }

    public function commentDetail()
    {
        $productModel = new ProductModel();
        $product = $productModel->getProductByID();

        $commentRatingModel = new CommentRatingModel();
        $commentDetail = $commentRatingModel->showCommentDetail();

        include 'App/Views/Admin/comment-detail.php';
    }

    public function commentReply()
    {
        $commentModel = new CommentRatingModel();
        $commentModel->repComment();

        header('Location: ' .   BASE_URL    .   "?role=admin&act=comment-detail&id="    .   $_POST['product-id']);
    }

    public function commentDelete()
    {
        $commentModel = new CommentRatingModel();
        $commentModel->commentDelete();

        header('Location: ' .   BASE_URL    .   "?role=admin&act=comment-detail&id="    .   $_POST['productId']);
    }
}
