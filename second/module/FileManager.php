<?
namespace Store;

use PDO;

class FileManager {

    private $db = 'TWLinza';
    private $host = 'localhost';
    private $table = 'files';
    private $mysql_user = 'root';
    private $mysql_password = '';

    // private $dbh;
    public $dbh;

    public $displayed_el = 5;

    static $pathFiles = '../store/';

    public function __construct(){
        $this->db_connect();
    }

    public function db_connect(){
        try {
            $this->dbh = new PDO("mysql:dbname=$this->db;host=$this->host", $this->mysql_user, $this->mysql_password);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function get_count_page(){
        
        $query = $this->dbh->prepare("SELECT COUNT(id) FROM $this->table");
        $query->execute();
        $count_files = $query->fetchAll(PDO::FETCH_ASSOC);
        $count_page = $count_files[0]["COUNT(id)"]/$this->displayed_el;
        $count_page = ceil($count_page);

        return $count_page;
    }
    
    public function get_files(int $currPage = 1){
        
        $from = ($currPage * $this->displayed_el) - $this->displayed_el;
        $to = (($currPage++) * $this->displayed_el);

        $query = $this->dbh->prepare("SELECT * FROM $this->table ORDER BY `id` LIMIT $from, $to");
        $query->execute();

        $elements = $query->fetchAll(PDO::FETCH_ASSOC);

        return $elements;
    }

    public function show(int $currPage = 1){

        $files = $this->get_files($currPage);
        $data = '';

        if (empty($files)){
            $data .= '<p><b>В хранилище нет файлов</b></p>';
        } else {
    
            foreach ($files as $file => $value){
    
                $name = $value["name"];
                $size = $value["size"]/1024;
                $size = round($size, 2);
        
                $data .= "<div class='file uk-flex uk-width-1-1'>
                        <div class='info'>
                            <h4 class='name'>$name</h4>
                            <div class='description'>
                                <p>Размер в Кбайт</p>
                                <small><b>$size</b></small>
                            </div>
                        </div>
                        
                        <div class='remove' data-remove='$name'>
                            <span class='uk-margin-small-right' uk-icon='icon: close; ratio: 2'></span>
                        </div>
                    </div>
                ";
            }
        }

        return $data;
    }

    public function upload($file){

        $input_name = 'file';

        $allow = array();

        $deny = array(
            'phtml', 'php', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps', 'cgi', 'pl', 'asp', 
            'aspx', 'shtml', 'shtm', 'htaccess', 'htpasswd', 'ini', 'log', 'sh', 'js', 'html', 
            'htm', 'css', 'sql', 'spl', 'scgi', 'fcgi', 'exe'
        );

        $path = self::$pathFiles;
        
        $error = $success = '';

        $file = $file[$input_name];

        if (!isset($file)) {
            $error = 'Файл не загружен.';
        } else {

            if (!empty($file['error']) || empty($file['tmp_name'])) {
                $error = 'Не удалось загрузить файл.';
            } elseif ($file['tmp_name'] == 'none' || !is_uploaded_file($file['tmp_name'])) {
                $error = 'Не удалось загрузить файл.';
            } else {
                $pattern = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";
                $name = mb_eregi_replace($pattern, '-', $file['name']);
                $name = mb_ereg_replace('[-]+', '-', $name);
                $parts = pathinfo($name);
        
                if ( $file["size"] > 1048576) {
                    // Если файл больше мегабайта (размер в байтах
                    $error = 'Ваш файл больше мегабайта.';
                } elseif ( file_exists($path.$file["name"]) ) {
                    $error = "Файл ".$file["name"]." уже существует в хранилище";
                } elseif (empty($name) || empty($parts['extension'])) {
                    $error = 'Недопустимый тип файла';
                } elseif (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) {
                    $error = 'Недопустимый тип файла';
                } elseif (!empty($deny) && in_array(strtolower($parts['extension']), $deny)) {
                    $error = 'Недопустимый тип файла';
                } else {
                    
                    $size = $file["size"];
                    
                    $query = $this->dbh->prepare("INSERT INTO $this->table SET `name` = :name, `size` = :size");

                    if ($insert_id = $query->execute(array('name' => $name,'size' => $size))){
                        if (move_uploaded_file($file['tmp_name'], $path . $name)) {
                            $success = '<p style="color: green">Файл «' . $name . '» успешно загружен.</p>';
                        } else {
                            $error = 'Не удалось загрузить файл потому что - '.$file[$input_name]["error"];
                            $query_delete = $this->dbh->prepare("DELETE FROM $this->table WHERE `id` = $insert_id");
                            if ($query_delete->execute()){
                                $error .= '<br> Мы удалили созданную вамизапись в базе данных';
                            }
                        }
                    } else {
                        $error = 'Не удалось записать файл на сервер';
                    }
                }
            }
        }
        
        $data = array(
            'error'   => $error,
            'success' => $success,
        );
        
        header('Content-Type: application/json');
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function delete($file){

        if( unlink(self::$pathFiles.$file) ){
            echo 'Файл '.$file.' удален';
        } else {
            echo 'Ошибка удаления';
        }

    }

    // public function read($file){
    //     readfile(self::$pathFiles.$file);
    // }
}