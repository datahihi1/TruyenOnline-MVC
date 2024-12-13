<?php

class HomeController{
    public $comics;
    public $users;
    public $chapters;
    public $genres;
    public $comicBought;
    public $comments;
    public function __construct(){
        if(isset($_SESSION['user_login_id'])){
            $id = $_SESSION['user_login_id'];
            $users = new User();
            $user = $users->getById($id);
            $_SESSION['name'] = $user['username'];
            $_SESSION['avatar'] = $user['avatar'];
            $_SESSION['coin'] = $user['coin'];
            $_SESSION['role'] = $user['role'];
        }
        $this->comics = new Comics();
        $this->users = new User();
        $this->chapters = new Chapters();
        $this->comicBought = new ComicBought();
        $this->genres = new Genres();
        $this->comments = new Comments();
    }

    public function index(){
        $listGenres = $this->genres->getAll();
        $comics = $this->comics->getAll();
        require_once PATH_VIEW_CLIENT . 'home.php';
    }
    public function comicDetail(){
        $listGenres = $this->genres->getAll();
        if(!isset($_GET['comic_id'])){
            echo 'Yêu cầu không hợp lệ';
            exit();
        }
        $id = $_GET['comic_id'];
        $user_id = $_SESSION['user_login_id'] ?? null;
        $comics = $this->comics->getComicById($id);
        
        if(!$comics){
            header('Location:'.BASE_URL);
            exit();
        }
        
        $check = false;
        if($comics['coin_price'] != 0){
            $check = $this->comicBought->checkBuyComic($user_id,$id);
        }
        if($check === false){
            $needCoin = $comics['coin_price'];
        }
        $genres = $this->comics->getGenresByComicId($id);
        $comment = $this->comments->getByComicId($id);
        $chap = $this->comics->getChapterByComicId($id);
        // dd($comment);
        require_once PATH_VIEW_CLIENT . 'comic_detail.php';
    }
    public function comicBuy(){
        if(!isset($_SESSION['user_login_id'])){
            echo "
            <script>
                alert('Yêu cầu đăng nhập để thực hiện chức năng!');
                window.location.href = '" . BASE_URL . '?act=login'. "';
            </script>";
            exit();
        }
        if(!isset($_GET['comic_id']) || !isset($_GET['user_id'])){
            echo 'Yêu cầu không hợp lệ';
            exit();
        }
        $comic_id = $_GET['comic_id'];
        $comicCoin = $this->comics->getPriceById($comic_id);
        $price = $comicCoin['coin_price'];

        $user_id = $_GET['user_id'];
        $userCoin = $this->users->getCoinById($user_id);
        $coin = $userCoin['coin'];

        $check = $this->comicBought->checkBuyComic($user_id,$comic_id);
        if($check){
            echo "
            <script>
                alert('Mua thất bại. Bạn đã mua truyện này!');
                window.location.href = '" . BASE_URL . '?act=comic-detail&comic_id=' . $comic_id . "';
            </script>";
            exit();
        }

        if($price > $coin){
            echo "
            <script>
                alert('Tài khoản không đủ số dư để mua truyện. Vui lòng nạp thêm!');
                window.location.href = '" . BASE_URL . '?act=comic-detail&comic_id=' . $comic_id . "';
            </script>";
            exit();
        }
        $timestamp = time();
        $now = date('Y-m-d H:i:s', $timestamp);
        
        $this->comicBought->buyComic($user_id,$comic_id,$price,$now);
        $this->users->boughtComic($user_id,$price);
        
        echo "
        <script>
            alert('Mua thành công!');
            window.location.href = '" . BASE_URL . '?act=comic-detail&comic_id=' . $comic_id . "';
        </script>";
        exit();

    }
    public function comicRead(){
        $listGenres = $this->genres->getAll();
        if(!isset($_GET['comic_id']) || !isset($_GET['chapter_id'])){
            echo 'Yêu cầu không hợp lệ';

            exit();
        }
        $id =  $_GET['comic_id'];
        $chap_id = $_GET['chapter_id'];

        $comics = $this->comics->getComicById($id);
        $comic_price = $comics['coin_price'];
        if($comic_price != 0){
            if(!isset($_SESSION['user_login_id'])){
                echo "
                <script>
                    alert('Yêu cầu đăng nhập để thực hiện chức năng!');
                    window.location.href = '" . BASE_URL . '?act=login'. "';
                </script>";
                exit();
            }
            $user_id = $_SESSION['user_login_id'];
            $check = $this->comicBought->checkBuyComic($user_id, $id);
            if(!$check){
                echo "
                <script>
                    alert('Bạn chưa mua truyện này. Vui lòng mua!');
                    window.location.href = '" . BASE_URL . '?act=comic-detail&comic_id=' . $id . "';
                </script>";
                exit();
            }
        }

        $comic = $this->comics->getComicById($id);
        if(!$comic){
            echo 'Không tìm thấy truyện';

            exit();
        }

        $chap = $this->comics->getDirChapter($id,$chap_id);
        if(!$chap){
            echo 'Không tìm thấy chapter';
            
            exit();
        }
        $comment = $this->comments->getByComicId($id);
        $this->comics->updateViewComic($id);
        $this->chapters->updateViewChapter($id,$chap_id);
        $dirChap = $chap['img_content'];

        require_once PATH_VIEW_CLIENT . 'comic_read.php';
    }
    public function comicGenre(){
        $listGenres = $this->genres->getAll();
        $id = $_GET['genre_id'];
        if(!isset($_GET['genre_id'])){
            echo "
            <script>
                alert('Yêu cầu không hợp lệ!');
                window.location.href = '" . BASE_URL . "';
            </script>";
            exit();
        }
        $comic = $this->genres->getComicByGenreId($id);
        if(empty($comic)){
            echo "
            <script>
                alert('Thể loại chưa liên kết với truyện!');
                window.location.href = '" . BASE_URL . "';
            </script>";
            exit();
        }
        require_once PATH_VIEW_CLIENT . 'comic_genre.php';
    }
    public function comment(){
        if(!isset($_GET['comic_id'])){
            echo "
            <script>
                alert('Yêu cầu không hợp lệ!');
                window.location.href = '" . BASE_URL . "';
            </script>";
            exit();
        }
        $id =  $_GET['comic_id'];
        $user_id = $_GET['user_id'];
        if(empty($_GET['user_id'])){
            echo "
            <script>
                alert('Yêu cầu không hợp lệ!');
                window.location.href = '" . BASE_URL . '?act=comic-detail&comic_id='.$id."';
            </script>";
            exit();
        }
        $content = $_POST['content'];
        if(empty($content)){
            echo "
            <script>
                alert('Cần nhập nội dung bình luận!');
                window.location.href = '" . BASE_URL . '?act=comic-detail&comic_id='.$id."';
            </script>";
            exit();
        }

        $this->comments->insert($user_id,$id,$content);

        header('Location:'.BASE_URL.'?act=comic-detail&comic_id='.$id);

    }
}