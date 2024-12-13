<?php

class ComicController{
    private $comic;
    private $chapter;
    private $genre;
    public function __construct(){
        if(empty($_SESSION['admin_user'])){
            header('Location:'.BASE_URL_ADMIN . '&act=login-form');
            exit();
        }
        $this->comic = new Comics();
        $this->chapter =  new Chapters();
        $this->genre = new Genres();
    }
    public function index(){
        $comic = $this->comic->getAll();
        require_once PATH_VIEW_ADMIN .'comics/index.php';
        exit();
    }
    public function comicDetail(){
        if(!isset($_GET['comic_id'])){
            $_SESSION['app_err'] = "Yêu cầu không hợp lệ";
            header('Location:'.BASE_URL_ADMIN . '&act=comics-list');
            exit();
        }
        $id = $_GET['comic_id'];
        dd($id);
    }
    public function create(){
        $genre = $this->genre->getAll();
        require_once PATH_VIEW_ADMIN .'comics/create.php';
        exit();
    }
    public function store(){
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            $_SESSION['app_err'] = "Yêu cầu không hợp lệ";
            header('Location:'.BASE_URL_ADMIN . '&act=comics-list');
            exit();
        }
        $comic_name = $_POST['comic_name'];
        $artist = $_POST['artist'];
        $description = $_POST['description'] ?? 'Không có mô tả';
        $comic_dir = basename(trim($_POST['comic_dir']));
        $title_img = $_FILES['title_img'];
        $coin_price = $_POST['coin_price'];
        $genres = $_POST['genres'];
        // dd($genres);
        if(empty($comic_name)){
            $_SESSION['app_err'] = "Cần nhập tên truyện";
            header('Location:'.BASE_URL_ADMIN.'&act=comics-create');
            exit();
        }
        if(empty($artist)){
            $_SESSION['app_err'] = "Cần nhập tác giả";
            header('Location:'.BASE_URL_ADMIN.'&act=comics-create');
            exit();
        }
        if(empty($comic_dir)){
            $_SESSION['app_err'] = "Cần nhập đường dẫn truyện";
            header('Location:'.BASE_URL_ADMIN.'&act=comics-create');
            exit();
        }
        if(empty($title_img)){
            $_SESSION['app_err'] = "Cần tải ảnh bìa";
            header('Location:'.BASE_URL_ADMIN.'&act=comics-create');
            exit();
        }
        if(empty($genres)){
            $_SESSION['app_err'] = "Cần chọn ít nhất 1 thể loại";
            header('Location:'.BASE_URL_ADMIN.'&act=comics-create');
            exit();
        }

       if(!is_dir(PATH_COMIC_UPLOAD.$comic_dir)){
                mkdir(PATH_COMIC_UPLOAD.$comic_dir,0777,true);
                $dirPost = PATH_COMIC_UPLOAD.$comic_dir.'/';
                $saveDir = $comic_dir.'/';
       }else{
        $_SESSION['app_err'] = "Thư mục đã tồn tại";
        header('Location:'.BASE_URL_ADMIN.'&act=comics-create');
        exit();
       }

       $image_path = null;
       if(isset($_FILES['title_img']) && $_FILES['title_img']['error'] == 0){
        if ($_FILES['title_img']['size'] > 10 * 1024 * 1024) {
            $_SESSION['app_err'] =  "Dung lượng ảnh vượt quá 10MB.";
            header('Location:' . BASE_URL_ADMIN.'&act=comics-create');
            exit();
        } else {
            $file_extension = strtolower(pathinfo($_FILES["title_img"]["name"], PATHINFO_EXTENSION));
            $file_name = "title.{$file_extension}";
            $target_file = $dirPost. $file_name;
            $saveFile = $saveDir.$file_name;
            $allowed_types = ["jpg", "jpeg", "png", "gif"];
            if (in_array($file_extension, $allowed_types)) {
                if (move_uploaded_file($_FILES["title_img"]["tmp_name"], $target_file)) {
                    $image_path = $target_file;
                } else {
                    $_SESSION['app_err'] =  "Đã xảy ra lỗi khi tải lên hình ảnh.";
                    header('Location:' . BASE_URL_ADMIN.'&act=comics-create');
                    exit();
                }
            } else {
                $_SESSION['app_err'] =  "Chỉ chấp nhận các định dạng JPG, JPEG, PNG và GIF.";
                header('Location:' . BASE_URL_ADMIN.'&act=comics-create');
                exit();
            }
        }
       }

       $this->comic->newComic($comic_name, $artist,$description, $saveDir, $saveFile,$coin_price);
       $newComic = $this->comic->getComicByName($comic_name);
       $comic_id = $newComic['comic_id'];
       $this->genre->addComicGenre($genres,$comic_id);
       header('Location:' . BASE_URL_ADMIN.'&act=comics-list');
       exit();
    }
    public function listChapter(){
        if(!isset($_GET['comic_id'])){
            $_SESSION['app_err'] = "Yêu cầu không hợp lệ";
            header('Location:'.BASE_URL_ADMIN . '&act=comics-list');
            exit();
        }
        $id = $_GET['comic_id'];
        $comic = $this->comic->getComicById($id);
        $chapter = $this->comic->getChapterByComicId($id);
        
        require_once PATH_VIEW_ADMIN .'comics/chapters/list.php';
        exit();
    }
    public function createChapter(){
        $id = $_GET['comic_id'];
        $comic = $this->comic->getComicById($id);
        if(!isset($_GET['comic_id'])){
            $_SESSION['app_err'] = "Yêu cầu không hợp lệ";
            header("Location:".BASE_URL_ADMIN . '&act=comics-list');
        }
        require_once PATH_VIEW_ADMIN . 'comics/chapters/create.php';
    }
    public function chapterStore() {
        $comic_id = $_GET['comic_id'];
        $comic = $this->comic->getComicById($comic_id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $uploadDir = $_POST['img_content'];
            $baseDir = PATH_COMIC_UPLOAD . $comic['comic_dir'];
            $uploadComicDir = $comic['comic_dir'].$uploadDir;
            $fullUploadDir = $baseDir . $uploadDir;

            if (!is_dir($fullUploadDir)) {
                if (mkdir($fullUploadDir, 0777, true)) {
                    echo "Đã tạo thư mục: $fullUploadDir";
                } else {
                    die("Không thể tạo thư mục: $fullUploadDir");
                }
            }
    
            $response = ['success' => false, 'message' => '', 'files' => []];
    
            $chapNumber = $_POST['chap_number'] ?? '';
            $title = $_POST['title'] ?? '';
            $pageNumber = $_POST['page_number'] ?? 0;
    
            if (empty($_FILES['images']['name'][0])) {
                $response['message'] = 'Không có ảnh nào được tải lên.';
                echo json_encode($response);
                exit;
            }
    
            $files = $_FILES['images'];
    
            foreach ($files['tmp_name'] as $index => $tmpName) {
                if (is_uploaded_file($tmpName)) {
                    $extension = pathinfo($files['name'][$index], PATHINFO_EXTENSION);
                    $targetFile = "$fullUploadDir" . sprintf("page_%03d.%s", $index + 1, $extension);
    
                    if (move_uploaded_file($tmpName, $targetFile)) {
                        $response['files'][] = $targetFile;
                    }
                }
            }
            $this->chapter->addChapter($comic_id,$chapNumber,$title,$pageNumber,$uploadComicDir);
            if (!empty($response['files'])) {
                $response['success'] = true;
                $response['message'] = 'Chapter đã được lưu thành công.';
            } else {
                $response['message'] = 'Có lỗi xảy ra khi tải ảnh lên.';
            }
    
            echo json_encode($response);
            header('Location:'.BASE_URL_ADMIN.'&act=chapters-list&comic_id='.$comic_id);
            exit;
        }
    }
    
    
}