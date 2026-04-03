<?php $script = '';?>

<?php include './partials/layouts/layoutTop.php' ?>

<div class="dashboard-main-body">

    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">403</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">403</li>
        </ul>
    </div>
    
    <div class="card basic-data-table">
      <div class="card-body py-80 px-32 text-center">
        <div class="max-w-454-px mx-auto">
            <img src="assets/images/error/403-img.png" alt="Thumbnail" class="mb-24">
        </div>
        <h6 class="mb-16">403 Forbidden</h6>
        <p class="text-secondary-light max-w-650-px mx-auto">403 Forbidden response status code indicates that the server understands the request but refuses to authorize it.</p>
        <a href="index.php" class="btn btn-primary-600 radius-8 px-40 py-16">Back to Home</a>
      </div>
    </div>
</div>

<?php include './partials/layouts/layoutBottom.php' ?>