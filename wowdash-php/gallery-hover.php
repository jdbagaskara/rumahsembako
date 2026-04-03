<?php include './partials/layouts/layoutTop.php' ?>

<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Gallery Hover</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Gallery Hover</li>
        </ul>
    </div>

    <?php
    // Define gallery images for each hover effect
    $hoverEffects = [
        1 => ['images' => [1, 2, 3, 4], 'style' => ''],
        2 => ['images' => [5, 6, 7, 8], 'style' => 'style-two'],
        3 => ['images' => [9, 10, 11, 12], 'style' => 'style-three'],
        4 => ['images' => [1, 2, 3, 4], 'style' => 'style-four'],
        5 => ['images' => [5, 6, 7, 8], 'style' => 'style-five'],
        6 => ['images' => [9, 10, 11, 12], 'style' => 'style-six'],
        7 => ['images' => [1, 2, 3, 4], 'style' => 'style-seven'],
        8 => ['images' => [5, 6, 7, 8], 'style' => 'style-eight'],
        9 => ['images' => [9, 10, 11, 12], 'style' => 'style-nine']
    ];

    // Render each hover effect section
    foreach ($hoverEffects as $effectNum => $effect) : ?>
        <div class="mt-24 card h-100 p-0 radius-12 overflow-hidden gallery-scale">
            <div class="card-header">
                <h6 class="mb-0">Hover Effect <?php echo $effectNum; ?></h6>
            </div>
            <div class="card-body p-24">
                <div class="row gy-4">
                    <?php foreach ($effect['images'] as $imgNum) : 
                        $imgPath = "assets/images/gallery/gallery-img{$imgNum}.png";
                        $styleClass = htmlspecialchars($effect['style'], ENT_QUOTES, 'UTF-8');
                        $imgPathEscaped = htmlspecialchars($imgPath, ENT_QUOTES, 'UTF-8');
                    ?>
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img <?php echo $styleClass; ?> border radius-16 overflow-hidden p-8">
                                <a href="<?php echo $imgPathEscaped; ?>" class="popup-img w-100 h-100 d-flex radius-12 overflow-hidden">
                                    <img src="<?php echo $imgPathEscaped; ?>" alt="Image" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>

<?php 
$script = '<script>
    $(".popup-img").magnificPopup({
        type: "image",
        gallery: {
            enabled: true
        }
    });
</script>';
include './partials/layouts/layoutBottom.php' 
?>
