<?php 
//recebe dados
include_once('includes/config.php');
 
if (isset($_GET['rid'])){
   $update = mysqli_query($conexao, 'UPDATE category SET UpdationDate = Now(), Is_Active = 0  WHERE id = ' . $_GET['rid'] . '');
   $msg = "Editoria Desativada com Sucesso!";
} else {
   $error = "Algo deu errado.";
}
// ativar
if (isset($_GET['resid'])){
   $update = mysqli_query($conexao, 'UPDATE category SET UpdationDate = Now(), Is_Active = 1  WHERE id = ' . $_GET['resid'] . '');
   $msg = "Editoria Ativada com Sucesso!";
} else {
   $error = "Algo deu errado.";
}
// deletar
if (isset($_GET['rdel'])){
   $update = mysqli_query($conexao, 'DELETE FROM category WHERE id = ' . $_GET['rdel'] . '');
   $msg = "Editoria Deletada com Sucesso!";
} else {
   $error = "Algo deu errado.";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
   <head>
      <title> | Lista de Editorias</title>
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
                        <h4 class="page-title">Lista de Editorias</h4>
                        <ol class="breadcrumb p-0 m-0">
                           <li>
                              <a href="#">Admin</a>
                           </li>
                           <li>
                              <a href="#">Editoria </a>
                           </li>
                           <li class="active">
                              Lista de Editorias
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
                           <div class="m-b-30">
                              <a href="add-category.php">
                              <button id="addToTable" class="btn btn-success waves-effect waves-light">Adicionar <i class="mdi mdi-plus-circle-outline" ></i></button>
                              </a>
                           </div>
                           <div class="table-responsive">
                              <table class="table m-0 table-colored-bordered table-bordered-primary">
                                 <thead>
                                    <tr>
                                       <th>#</th>
                                       <th> Editoria</th>
                                       <th>Descrição</th>
                                       <th>Data da postagem</th>
                                       <th>Data da última atualização</th>
                                       <th>Ação</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                    //editorias
                                    // desativar
                                    $query = 'SELECT id, CategoryName, Description, PostingDate, UpdationDate FROM category WHERE Is_Active = 1';
                                    $result = mysqli_query($conexao, $query);
                                    while($row = mysqli_fetch_array($result)){                                                                      
                                    ?>
                                    <tr>
                                       <th scope="row"><?php echo $row['id'];?></th>
                                       <td><?php echo $row['CategoryName'];?></td>
                                       <td><?php echo $row['Description'];?></td>
                                       <td><?php echo $row['PostingDate'];?></td>
                                       <td><?php echo $row['UpdationDate'];?></td>
                                       <td><a href="edit-category.php?cid=<?php echo $row['id'];?>"><i class="fa fa-pencil" style="color: #29b6f6;"></i></a> 
                                          &nbsp;<a href="manage-categories.php?rid=<?php echo $row['id'];?>&&action=del"> <i class="fa fa-trash-o" style="color: #f05050"></i></a> 
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
                              <h4><i class="fa fa-trash-o" ></i> Editorias apagadas</h4>
                           </div>
                           <div class="table-responsive">
                              <table class="table m-0 table-colored-bordered table-bordered-danger">
                                 <thead>
                                    <tr>
                                       <th>#</th>
                                       <th> Editoria</th>
                                       <th>Descrição</th>
                                       <th>Data da postagem</th>
                                       <th>Data da última atualização</th>
                                       <th>Ação</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       //categorias
                                       $query = 'SELECT id, CategoryName, Description, PostingDate, UpdationDate,Is_Active FROM category WHERE Is_Active = 0';
                                       $result = mysqli_query($conexao, $query);
                                       while($row = mysqli_fetch_assoc($result)){
                                       ?>
                                    <tr>
                                       <th scope="row"><?php echo $row['id'];?></th>
                                       <td><?php echo $row['CategoryName'];?></td>
                                       <td><?php echo $row['Description'];?></td>
                                       <td><?php echo $row['PostingDate'];?></td>
                                       <td><?php echo $row['UpdationDate'];?></td>
                                       <td><a href="manage-categories.php?resid=<?php echo $row['id'];?>"><i class="ion-arrow-return-right" title="Restore this category"></i></a> 
                                          &nbsp;<a href="manage-categories.php?rdel=<?php echo $row['id'];?>&&action=parmdel" title="Delete forever"> <i class="fa fa-trash-o" style="color: #f05050"></i> 
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