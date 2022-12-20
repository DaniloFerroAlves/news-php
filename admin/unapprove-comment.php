<?php 
//recebe dados
include_once('includes/config.php');
if (isset($_GET['appid'])){
   $update = mysqli_query($conexao,'UPDATE comments SET status = 1 WHERE id = ' . $_GET['appid'] . '');
   $msg = "Comentário Aprovado com Sucesso!";
} else {
   $error = "Erro ao Aprovador Comentário!";
}
// deletar comentario
if (isset($_GET['rdel'])){
   $update = mysqli_query($conexao,'DELETE FROM comments WHERE id = ' . $_GET['rdel'] . '');
   $msg = "Comentário Aprovado com Sucesso!";
} else {
   $error = "Erro ao Aprovador Comentário!";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
   <head>
      <title>Portal Notícias | Comentários não aprovados</title>
      <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
      <script src="assets/js/modernizr.min.js"></script>
   </head>
   <body class="fixed-left">
      <!-- Begin page -->
      <div id="wrapper">
      <!-- Top Bar Start -->
      <?php include('includes/topheader.php');?>
      <!-- ========== Left Sidebar Start ========== -->
      <?php include('includes/leftsidebar.php');?>
      <!-- Left Sidebar End -->
      <!-- ============================================================== -->
      <!-- Start right Content here -->
      <!-- ============================================================== -->
      <div class="content-page">
         <!-- Start content -->
         <div class="content">
            <div class="container">
               <div class="row">
                  <div class="col-xs-12">
                     <div class="page-title-box">
                        <h4 class="page-title">Comentários não aprovados</h4>
                        <ol class="breadcrumb p-0 m-0">
                           <li>
                              <a href="#">Admin</a>
                           </li>
                           <li>
                              <a href="#">Comentários </a>
                           </li>
                           <li class="active">
                              Comentários não aprovados
                           </li>
                        </ol>
                        <div class="clearfix"></div>
                     </div>
                  </div>
               </div>
               <!-- end row -->
               <div class="row">
                  <div class="col-sm-6">
                     <?php if($msg){ ?>
                     <div class="alert alert-success" role="alert">
                        <strong>Feito!</strong> <?php echo $msg;?>
                     </div>
                     <?php } ?>
                     <?php if($delmsg){ ?>
                     <div class="alert alert-danger" role="alert">
                        <strong>Deu erro!</strong> <?php echo $delmsg;?>
                     </div>
                     <?php } ?>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="demo-box m-t-20">
                           <div class="table-responsive">
                              <table class="table m-0 table-colored-bordered table-bordered-primary">
                                 <thead>
                                    <tr>
                                       <th>#</th>
                                       <th>Nome</th>
                                       <th>Email</th>
                                       <th width="300">Comentário</th>
                                       <th>Status</th>
                                       <th>Notícia</th>
                                       <th>Data da postagem</th>
                                       <th>Ação</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       //notícia
                                       $query = mysqli_query($conexao,'SELECT comments.id, comments.postId, comments.name, comments.email, comments.comment, comments.postingDate, comments.status, posts.PostTitle FROM comments JOIN posts ON comments.postId = posts.id WHERE status = 0');
                                       while($row = mysqli_fetch_array($query)){ 
                                       ?>
                                    <tr>
                                       <th scope="row"><?php echo $cnt;?></th>
                                       <td><?php echo $row['name'];?></td>
                                       <td><?php echo $row['email'];?></td>
                                       <td><?php echo $row['comment'];?></td>
                                       <td><?php $st=$row['status'];echo "Aguardando aprovação";?></td>
                                       <td><a href="edit-post.php?pid=<?php echo $row['postid'];?>"><?php echo $row['PostTitle'];?></a> </td>
                                       <td><?php echo $row['postingDate'];?></td>
                                       <td>                                         
                                          <a href="unapprove-comment.php?appid=<?php echo $row['id'];?>" title="Aprovar este comentário"><i class="ion-arrow-return-right" style="color: #29b6f6;"></i></a>                                         
                                          &nbsp;<a href="unapprove-comment.php?rdel=<?php echo $row['id'];?>&&action=del"> <i class="fa fa-trash-o" style="color: #f05050"></i></a> 
                                       </td>
                                    </tr>
                                    <?php
                                    }?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!--- end row -->
                  <div class="row">
                     <div class="col-md-12">
                        <div class="demo-box m-t-20">
                           <div class="m-b-30">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- container -->
            </div>
            <!-- content -->
            <?php include('includes/footer.php');?>
         </div>
      </div>
      <!-- END wrapper -->
      <script>
         var resizefunc = [];
      </script>
      <!-- jQuery  -->
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>
      <script src="assets/js/detect.js"></script>
      <script src="assets/js/fastclick.js"></script>
      <script src="assets/js/jquery.blockUI.js"></script>
      <script src="assets/js/waves.js"></script>
      <script src="assets/js/jquery.slimscroll.js"></script>
      <script src="assets/js/jquery.scrollTo.min.js"></script>
      <script src="../plugins/switchery/switchery.min.js"></script>
      <!-- App js -->
      <script src="assets/js/jquery.core.js"></script>
      <script src="assets/js/jquery.app.js"></script>
   </body>
</html>
<?php //} ?>