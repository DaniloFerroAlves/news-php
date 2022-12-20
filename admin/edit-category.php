<?php 
//recebe dados
include_once('includes/config.php');
include_once('includes/library.php');
if (isset($_POST['submit'])){
   $category = mysqli_real_escape_string($conexao, $_POST['category']);
   $descricao = mysqli_real_escape_string($conexao, $_POST['description']);
   if (category_validation($category, $descricao)){ 
      $query = mysqli_query($conexao, 'UPDATE category SET CategoryName = "' . $category . '", Description = "' . $descricao . '", UpdationDate = Now() WHERE id = ' . $_GET['cid'] . '');
      if ($query) {
      $msg = 'Editoria Editada com Sucesso!';
      header('Location: manage-categories.php');
      } else {
      $error = 'Algo deu errado, Tente Novamente!';
      }         
   } else {
      $error = 'Tamanho mínimo de Editoria 2 caracteres e a primeira letra deve ser Maisucula. A Descrição precisa de no minimo 12 caracteres.';
   }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
   <head>
      <title>Portal Notícias | Editar Editoria</title>
      <!-- App css -->
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
         <!-- Top Bar End -->
         <!-- ========== Left Sidebar Start ========== -->
         <?php include('includes/leftsidebar.php');?>
         <!-- Left Sidebar End -->
         <div class="content-page">
            <!-- Start content -->
            <div class="content">
               <div class="container">
                  <div class="row">
                     <div class="col-xs-12">
                        <div class="page-title-box">
                           <h4 class="page-title">Editar Editoria</h4>
                           <ol class="breadcrumb p-0 m-0">
                              <li>
                                 <a href="#">Admin</a>
                              </li>
                              <li>
                                 <a href="#">Editoria </a>
                              </li>
                              <li class="active">
                                 Editar Editoria
                              </li>
                           </ol>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                  </div>
                  <!-- end row -->
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="card-box">
                           <h4 class="m-t-0 header-title"><b>Editar Editoria </b></h4>
                           <hr />
                           <div class="row">
                              <div class="col-sm-6">
                                 <!---Success Message--->  
                                 <?php if($msg){ ?>
                                 <div class="alert alert-success" role="alert">
                                    <strong>Feito!</strong> <?php echo $msg;?>
                                 </div>
                                 <?php } ?>
                                 <!---Error Message--->
                                 <?php if($error){ ?>
                                 <div class="alert alert-danger" role="alert">
                                    <strong>Deu erro!</strong> <?php echo $error;?>
                                 </div>
                                 <?php } ?>
                              </div>
                           </div>
                           <?php 
                              //notícias
                              if (isset($_GET['cid'])){
                                 $select = mysqli_query($conexao, 'SELECT CategoryName, Description, PostingDate, UpdationDate FROM category WHERE id = ' . $_GET['cid'] . '');
                              }
                              if ($row = mysqli_fetch_assoc($select)){
                              ?>
                           <div class="row">
                              <div class="col-md-6">
                                 <form class="form-horizontal" name="category" method="post">
                                    <div class="form-group">
                                       <label class="col-md-2 control-label">Editoria</label>
                                       <div class="col-md-10">
                                          <input type="text" class="form-control" value="<?php echo $row['CategoryName'];?>" name="category" required>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <label class="col-md-2 control-label">Descrição da editoria</label>
                                       <div class="col-md-10">
                                          <textarea class="form-control" rows="5" name="description" required><?php echo $row['Description'];?></textarea>
                                       </div>
                                    </div>
                                    <?php } ?>
                                    <div class="form-group">
                                       <label class="col-md-2 control-label">&nbsp;</label>
                                       <div class="col-md-10">
                                          <button type="submit" class="btn btn-custom waves-effect waves-light btn-md" name="submit">
                                          Atualizar
                                          </button>
                                       </div>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- end row -->
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