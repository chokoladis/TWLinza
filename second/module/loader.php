<?
namespace Store;

class fileManager {

    static $pathFiles = '../store/';

    public function show(){

        $path = self::$pathFiles;

        $files = array();
        $dh = opendir($path);
        while (false !== ($file = readdir($dh))) {
            
            if ($file != '.' && $file != '..' && !is_dir($path.$file) && $file[0] != '.') {
                $files[] = $file;
            }
        }
        
        closedir($dh);
        return $files;
    }

    public function getLocalFile($file){
        return stat(self::$pathFiles.$file);
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
                    
                    if (move_uploaded_file($file['tmp_name'], $path . $name)) {
                        $success = '<p style="color: green">Файл «' . $name . '» успешно загружен.</p>';
                    } else {
                        $error = 'Не удалось загрузить файл потому что - '.$file[$input_name]["error"];
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