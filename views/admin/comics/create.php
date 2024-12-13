<?php include_once PATH_VIEW_ADMIN . 'layout/header.php'; ?>
<?php if (isset($_SESSION['app_err'])): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['app_err'];
        unset($_SESSION['app_err']); ?>
        <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<form action="<?=BASE_URL_ADMIN.'&act=comics-store'?>" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="comic_name" class="form-label">Nhập tên truyên</label>
        <input type="text" class="form-control" name="comic_name">
    </div>
    <div class="mb-3">
        <label for="artist" class="form-label">Nhập tác giả</label>
        <input type="text" class="form-control" name="artist">
    </div>
    <div class="mb-3">
        <label for="description">Example textarea</label>
        <textarea class="form-control" name="description" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <label for="comic_dir" class="form-label">Vị trí lưu ảnh(Ex: comic_1/ , ...)</label>
        <input type="text" class="form-control" name="comic_dir">
    </div>
    <div class="mb-3">
        <label for="title_img" class="form-label">Ảnh bìa</label>
        <input type="file" class="form-control" name="title_img" id="imageUpload">
        <div class="image-preview" id="imagePreview">
            <img src="" alt="" class="image-preview__image" height="100">
            <span class="image-preview__default-text"></span>
        </div>
    </div>
    <div class="mb-3">
        <label for="coin_price" class="form-label">Giấ tiền (coin)</label>
        <input type="number" class="form-control" name="coin_price" value="0">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Chọn thể loại truyện</label>

        <?php foreach ($genre as $g): ?>
            <div class="form-check">
                <input
                    class="form-check-input"
                    type="checkbox"
                    value="<?= $g['genre_id'] ?>"
                    id="genre_<?= $g['genre_id'] ?>"
                    name="genres[]">
                <label class="form-check-label" for="genre_<?= $g['genre_id'] ?>">
                    <?= $g['name'] ?>
                </label>
            </div>
        <?php endforeach; ?>

    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<script>
    const imageUpload = document.getElementById('imageUpload');
const imagePreview = document.getElementById('imagePreview');
const previewImage = imagePreview.querySelector('.image-preview__image');
const previewDefaultText = imagePreview.querySelector('.image-preview__default-text');

imageUpload.addEventListener('change', function() {
    const file = this.files[0];

    if (file) {
        const reader = new FileReader();

        previewDefaultText.style.display = "none";
        previewImage.style.display = "block";

        reader.addEventListener('load', function() {
            previewImage.setAttribute('src', this.result);
        });

        reader.readAsDataURL(file);
    } else {
        previewDefaultText.style.display = null;
        previewImage.style.display = null;
        previewImage.setAttribute('src', '');
    }
});
</script>

<?php include_once PATH_VIEW_ADMIN . 'layout/footer.php'; ?>