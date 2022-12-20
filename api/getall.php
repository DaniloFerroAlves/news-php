<?php
class Api {
    private $conexao;
    private function Connection() {
        $this->conexao = new mysqli("localhost", "root", "", "news");
    }
    public function Get() {
        $this->Connection();
        $result = $this->conexao->query('SELECT posts.id as pid, category.CategoryName as category, posts.PostTitle as posttitle, posts.CategoryId as cid,  posts.UpdationDate, CONCAT("admin/postimages/", posts.PostImage) as postimage FROM posts LEFT JOIN category ON category.id = posts.CategoryId WHERE posts.Is_Active = 1');
        $itens = $result->fetch_all(MYSQLI_ASSOC);
        return json_encode($itens, JSON_UNESCAPED_SLASHES);
    }
}
$api = new Api();
echo $api->Get();

// mysqli_report(MYSQLI_REPORT_OFF);

// $mysqli = new mysqli("localhost", "root","","news");
// mysqli_query($mysqli, "SET NAMES 'utf8'");
// mysqli_query($mysqli,'SET character_set_connection=utf8');
// mysqli_query($mysqli, 'SET character_Set_client=utf8');
// mysqli_query($mysqli, 'SET character_set_results=utf8');
// $query = 'SELECT PostTitle, CategoryId,PostingDate,UpdationDate,PostUrl FROM posts WHERE is_active = 1';

// if ($result = $mysqli->query($query)) {
//     while ($row = $result->fetch_assoc()) {
//         echo json_encode($row);
//     }
// }

?>