<?php


require_once("pdo.php");

class getData{

    public $pdo;
    public $data;

    //コンストラクタ
    function __construct()  {
        $this->pdo = db_connect();

    }

    /**
     * ユーザ情報の取得
     *
     * @param 
     * @return array $users_data ユーザ情報
     */
    public function getUserData(){
        $getusers_sql = "SELECT * FROM users limit 1";
        $users_data = $this->pdo->query($getusers_sql)->fetch(PDO::FETCH_ASSOC);
        return $users_data;
    }
    
    /**
     * 記事情報の取得
     *
     * @param 
     * @return array $post_data 記事情報
     */
    public function getPostData(){
        $getposts_sql = "SELECT * FROM posts ORDER BY id desc";
        $post_data = $this->pdo->query($getposts_sql)->fetchAll(PDO::FETCH_ASSOC);
        
        // カテゴリ情報を追加
        foreach ($post_data as &$post) {
            switch ($post['category_no']) {
                case 1:
                    $post['category'] = '食事';
                    break;
                case 2:
                    $post['category'] = '旅行';
                    break;
                default:
                    $post['category'] = 'その他';
                    break;
            }
        }
        unset($post); 
    
        return $post_data;
    }
}