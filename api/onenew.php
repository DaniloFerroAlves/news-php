<?php
class Api {
    private $conexao;
    private function Connection() {
        $this->conexao = new mysqli("localhost", "root", "", "news");
    }
    public function Get($id) {
        $this->Connection();
        $result = $this->conexao->query('SELECT posts.id as pid, category.CategoryName as category, posts.PostTitle as posttitle, posts.CategoryId as cid,  posts.UpdationDate, CONCAT("admin/postimages/", posts.PostImage) as postimage FROM posts LEFT JOIN category ON category.id = posts.CategoryId WHERE posts.Is_Active = 1 AND posts.id = '.$id.'');
        $itens = $result->fetch_all(MYSQLI_ASSOC);
        print_r($itens);
        return json_encode($itens[0], JSON_UNESCAPED_SLASHES);
        
    }
}
$api = new Api();
if (isset($_GET['pid']) && intval($_GET['pid'] > 0)){
    echo $api->Get($_GET['pid']);
} else {
   echo json_encode(["error" => "Noticia não existente"]);
}


?>