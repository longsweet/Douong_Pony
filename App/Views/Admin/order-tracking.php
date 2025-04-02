<?php include 'layouts/header.php'; ?>

<div class="main-content-wrap">
    <div class="flex items-center flex-wrap justify-between gap20 mb-30">
        <h3>Track Order</h3>
        <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
            <li><a href="index.php"><div class="text-tiny">Dashboard</div></a></li>
            <li><i class="icon-chevron-right"></i></li>
            <li><a href="?role=admin&act=order"><div class="text-tiny">Order</div></a></li>
            <li><i class="icon-chevron-right"></i></li>
            <li><div class="text-tiny">Track Order</div></li>
        </ul>
    </div>

    <!-- order-track -->
    <div class="wg-box mb-20">
        <div class="order-track">
            <div class="image">
                <img src="images/images-section/track-order.jpg" alt="Track Order">
            </div>
            <div class="content">
                <h5 class="mb-20"><?= htmlspecialchars($trackingInfo[0]->product_name) ?></h5>
                <div class="infor mb-10">
                    <div class="body-text">Order ID:</div>
                    <div class="body-title-2">#<?= htmlspecialchars($trackingInfo[0]->order_id) ?></div>
                </div>
                <div class="infor mb-10">
                    <div class="body-text">Order Placed:</div>
                    <div class="body-title-2"><?= htmlspecialchars($trackingInfo[0]->order_date) ?></div>
                </div>
                <div class="infor mb-10">
                    <div class="body-text">Quantity:</div>
                    <div class="body-title-2"><?= htmlspecialchars($trackingInfo[0]->quantity) ?></div>
                </div>
                <div class="flex gap10 flex-wrap">
                    <a class="tf-button style-1 w230" href="?role=admin&act=order">View Orders</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /order-track -->

    <!-- detail -->
    <div class="wg-box mb-20">
        <div>
            <h6 class="mb-10">Detail</h6>
            <div class="body-text">Your items are on the way. Tracking information will be updated soon.</div>
        </div>
        <div class="road-map">
            <?php foreach ($trackingInfo as $track) : ?>
                <div class="road-map-item <?= $track->status == 'delivered' ? 'active' : '' ?>">
                    <div class="icon"><i class="icon-check"></i></div>
                    <h6><?= htmlspecialchars($track->status) ?></h6>
                    <div class="body-text"><?= htmlspecialchars($track->timestamp) ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- /detail -->

    <!-- tracking history -->
    <div class="wg-box">
        <div class="wg-table table-order-track">
            <ul class="table-title flex mb-24 gap20">
                <li><div class="body-title">Date</div></li>
                <li><div class="body-title">Time</div></li>
                <li><div class="body-title">Description</div></li>
                <li><div class="body-title">Location</div></li>
            </ul>
            <ul class="flex flex-column gap14">
                <?php foreach ($trackingInfo as $track) : ?>
                    <li class="cart-totals-item">
                        <div class="body-text"><?= date('d M Y', strtotime($track->timestamp)) ?></div>
                        <div class="body-text"><?= date('h:i A', strtotime($track->timestamp)) ?></div>
                        <div class="body-text"><?= htmlspecialchars($track->description) ?></div>
                        <div class="body-text"><?= htmlspecialchars($track->location) ?></div>
                    </li>
                    <li class="divider"></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <!-- /tracking history -->

</div>

<?php include 'layouts/footer.php'; ?>
