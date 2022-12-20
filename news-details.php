<?php 
session_start();
include('includes/config.php');
//Genrating CSRF Token
if (empty($_SESSION['token'])) {
   $_SESSION['token'] = bin2hex(random_bytes(32));
}
if(isset($_POST['submit'])) {
    //Verifying CSRF Token
    if (!empty($_POST['csrftoken'])) {
        if (hash_equals($_SESSION['token'], $_POST['csrftoken'])) {
            $name = mysqli_real_escape_string($conexao, $_POST['name']);
            $email = mysqli_real_escape_string($conexao, $_POST['email']);
            $comment = mysqli_real_escape_string($conexao, $_POST['comment']);
            $postid = intval($_GET['nid']);
            $st1 = '0';
            $query = mysqli_query($conexao,'insert into comments(postId,name,email,comment,status) values("' . $postid . '","' . $name . '","' . $email . '","' . $comment . '", ' . $st1 . ')');
            if ($query) {
                echo "<script>alert('comentário enviado com sucesso. Ele será mostrado depois de rivisão dos administradores ');</script>";
                unset($_SESSION['token']);
            } else {
            echo "<script>alert('Aconteceu algo errado, tente novamente.');</script>";  
            }
        }
    }
}

//token
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Senac">
    <meta name="author" content="Senac">
    <title>Portal Notícias | Home Page</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">
  </head>
  <body>
    <!-- Navigation -->
   <?php include('includes/header.php');?>
    <!-- Page Content -->
    <div class="container">
      <div class="row" style="margin-top: 4%">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
          <!-- Blog Post -->
<?php
//pega notícia
?>
<?php
$nid = intval($_GET['nid']);
$query = 'SELECT category.CategoryName as category, posts.PostTitle as posttitle, posts.CategoryId as cid, posts.PostDetails as postdetails,posts.PostingDate as postingdate, posts.UpdationDate, posts.Is_Active, posts.PostUrl, posts.PostImage FROM posts LEFT JOIN category ON category.id = posts.CategoryId WHERE posts.Is_Active = 1 AND posts.id = ' . $nid . '';
$result = mysqli_query($conexao, $query);
if(!$result) echo "Erro ao realizar o SELECT: " . mysqli_error($conexao);
if($row = mysqli_fetch_array($result)){
?>
          <div class="card mb-4">
            <div class="card-body">
              <h2 class="card-title"><?php echo htmlentities($row['posttitle']);?></h2>
              <p><b>Editoria : </b> <a href="category.php?catid=<?php echo $row['cid']?>"><?php echo htmlentities($row['category']);?></a> |
                <hr />
                <img class="img-fluid rounded" src="admin/postimages/<?php echo $row['PostImage'];?>" alt="<?php echo htmlentities($row['posttitle']);?>">
              <p class="card-text"><?php echo (substr($row['postdetails'], 0));?></p>
            </div>
            <div class="card-footer text-muted">
            </div>
          </div>
<?php } ?>
        </div>
        <!-- Sidebar Widgets Column -->
      <?php include('includes/sidebar.php');?>
      </div>
      <!-- /.row -->
      <!---Comment Section --->
      <div class="row" style="margin-top: -8%">
        <div class="col-md-8">
          <div class="card my-4">
            <h5 class="card-header">Comente aqui:</h5>
            <div class="card-body">
              <form name="Comment" method="post">
                <input type="hidden" name="csrftoken" value="<?php echo $_SESSION['token']; ?>" />
                <div class="form-group">
                  <input type="text" name="name" class="form-control" placeholder="Entre seu nome completo" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Entre um e-mail válido" required>
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="comment" rows="3" placeholder="Comentário" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Enviar</button>
              </form>
              <?php ?>
            </div>
          </div>
  <!---Comment Display Section --->
<?php 
//comentários
$conexao = mysqli_connect('localhost', 'root', '', 'news');
$query = 'SELECT comments.name, comments.email, comments.comment, comments.postingDate FROM comments WHERE status = 1 AND comments.postId = '  . $_GET['nid'] . '';
$result = mysqli_query($conexao, $query);
while($row = mysqli_fetch_array($result)){
?>
          <div class="media mb-4">
            <img class="d-flex mr-3 rounded-circle" src="images/usericon.png" alt="">
            <div class="media-body">
              <h5 class="mt-0"><?php echo $row['name'];?> <br />
                  <span style="font-size:11px;"><b>em</b> <?php echo date_format(date_create($row['postingdate']), 'd-m-Y H:i');?></span>
              </h5>
              <?php echo $row['comment'];?>
            </div>
          </div>
<?php } ?>
        </div>
      </div>
    </div>
    <?php include('includes/footer.php');?>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>