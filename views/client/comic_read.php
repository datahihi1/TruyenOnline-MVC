<!-- <div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="../index.php"><i class="fa fa-home"></i> Home</a>
                    <a href="../categories.html">Categories</a>
                    <a href="#">Romance</a>
                    <span>Fate Stay Night: Unlimited Blade</span>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- Breadcrumb End -->
<?php include_once PATH_VIEW_CLIENT . 'layout/header.php'; ?>
<!-- Anime Section Begin -->
<section class="anime-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="anime__details__episodes">
                    <div class="section-title">
                        <h5>List Name</h5>
                    </div>
                </div>
                <div class="container mt-5">
                    <div class="d-flex justify-content-center">
                        <a type="button" class="btn btn-primary mx-2" disabled><i class="bi bi-arrow-left"></i>Chap trước</a>
                        <a type="button" class="btn btn-secondary mx-2">Home</a>
                        <a type="button" class="btn btn-success mx-2">Chap sau<i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <div class="text-center">
                    <?php
                    $directory = "assets/uploads/comics/" . $dirChap;

                    $baseURL = BASE_URL;

                    if (is_dir($directory)) {
                        $files = scandir($directory);

                        foreach ($files as $file) {
                            if ($file !== "." && $file !== "..") {
                                $filePath = $directory . $file;
                                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                                $validExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];

                                if (in_array(strtolower($fileExtension), $validExtensions)) {
                                    echo '<img src="' . $baseURL . $filePath . '" alt="' . htmlspecialchars($file) . '" >';
                                }
                            }
                        }
                    } else {
                        echo "Thư mục không tồn tại.";
                    }
                    ?>

                </div>
                <div class="container mt-5">
                    <div class="d-flex justify-content-center">
                        <a type="button" class="btn btn-primary mx-2" disabled><i class="bi bi-arrow-left"></i>Chap trước</a>
                        <a type="button" class="btn btn-secondary mx-2">Home</a>
                        <a type="button" class="btn btn-success mx-2">Chap sau<i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
</section>
<?php include_once PATH_VIEW_CLIENT . 'layout/footer.php'; ?>