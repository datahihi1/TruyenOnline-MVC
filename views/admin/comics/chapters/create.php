<?php include_once PATH_VIEW_ADMIN . 'layout/header.php'; ?>
<div class="container mt-5">
  <h1 class="mb-4">Thêm chương mới: <?= htmlspecialchars($comic['comic_name']) ?></h1>
  <form method="POST" action="<?=BASE_URL_ADMIN.'&act=chapters-store&comic_id='.$comic['comic_id']?>" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="chap_number" class="form-label">Chương số</label>
      <input type="number" id="chap_number" name="chap_number" class="form-control" value="<?= $comic['chap_total'] + 1 ?>" readonly>
    </div>
    <div class="mb-3">
      <label for="title" class="form-label">Mô tả ngắn</label>
      <textarea id="title" name="title" class="form-control" rows="3" placeholder="Nhập mô tả ngắn..."></textarea>
    </div>
    <div class="mb-3">
      <label for="page_number" class="form-label">Số lượng ảnh</label>
      <input type="number" id="page_number" name="page_number" class="form-control" value="0" readonly>
    </div>
    <div class="mb-3">
      <label for="img_content" class="form-label">Vị trí lưu</label>
      <input type="text" id="img_content" name="img_content" class="form-control" value="<?='chap_' . ($comic['chap_total'] + 1) . '/' ?>" readonly>
    </div>
    <div class="mb-3">
      <label for="images" class="form-label">Tải lên ảnh</label>
      <input type="file" id="images" name="images[]" class="form-control" multiple accept="image/*">
    </div>
    <ul id="imageList" class="list-group"></ul>
    <button type="submit" class="btn btn-primary mt-3">Lưu Chapter</button>
  </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const imageInput = document.getElementById("images");
  const imageList = document.getElementById("imageList");
  const pageNumber = document.getElementById("page_number");

  let images = [];

  imageInput.addEventListener("change", (event) => {
    const files = Array.from(event.target.files);
    images = files.map((file, index) => ({
      id: index,
      file,
      src: URL.createObjectURL(file),
    }));

    renderImages();
    pageNumber.value = images.length; // Cập nhật số lượng ảnh
  });

  const renderImages = () => {
    imageList.innerHTML = "";
    images.forEach((image, index) => {
      const listItem = document.createElement("li");
      listItem.className = "list-group-item d-flex align-items-center draggable";
      listItem.setAttribute("data-id", index);
      listItem.innerHTML = `
        <img src="${image.src}" alt="image" class="img-thumbnail me-3" style="width: 60px; height: 60px;">
        <span>#${String(index + 1).padStart(3, "0")}</span>
      `;
      imageList.appendChild(listItem);
    });
  };

  // Kích hoạt sắp xếp bằng SortableJS
  new Sortable(imageList, {
    animation: 150,
    onEnd: (evt) => {
      const oldIndex = evt.oldIndex;
      const newIndex = evt.newIndex;

      if (oldIndex !== newIndex) {
        const movedItem = images.splice(oldIndex, 1)[0];
        images.splice(newIndex, 0, movedItem);
      }
    },
  });
});

</script>