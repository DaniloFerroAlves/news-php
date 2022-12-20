<?php 
include_once('includes/config.php');

if (isset($_POST['update'])) {
   $imgfile = $_FILES["postimage"]["name"];
   $extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
   $allowed_extensions = array(".jpg","jpeg",".png",".gif");
   if(!in_array($extension,$allowed_extensions)){
   echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
   } else {
   $imgnewfile=md5($imgfile).$extension;
   move_uploaded_file($_FILES["postimage"]["tmp_name"],"postimages/".$imgnewfile);
   }
   $query = mysqli_query($conexao,'UPDATE posts SET PostImage = "' .$imgnewfile. '", UpdationDate = now() WHERE id = '.$_GET['pid'].' ');

   if($query){
   $msg = "Imagem atualizada";      
   } else {
   $error = "Algo deu errado, tente novamente";
   }    
}
?>
<!DOCTYPE html>
<html lang="pt-br">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Portal de notícias do Senac">
      <meta name="author" content="Senac">
      <!-- App favicon -->
      <link rel="shortcut icon" href="assets/images/favicon.ico">
      <!-- App title -->
      <title>Newsportal | Add Post</title>
      <!-- Summernote css -->
      <link href="../plugins/summernote/summernote.css" rel="stylesheet" />
      <!-- Select2 -->
      <link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
      <!-- Jquery filer css -->
      <link href="../plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
      <link href="../plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />
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
                           <h4 class="page-title">Atualizar Imagem</h4>
                           <ol class="breadcrumb p-0 m-0">
                              <li>
                                 <a href="#">Admin</a>
                              </li>
                              <li>
                                 <a href="#">Notícias</a>
                              </li>
                              <li>
                                 <a href="#">Atualizar Notícia</a>
                              </li>
                              <li class="active">
                                 Atualizar Imagem
                              </li>
                           </ol>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                  </div>
                  <!-- end row -->
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
                  <form name="addpost" method="post" enctype="multipart/form-data">
                     <?php
                       //notícias
                       $select = mysqli_query($conexao,'SELECT id, PostImage, PostTitle FROM posts WHERE id = ' .$_GET['pid']. '');
                       while($row = mysqli_fetch_assoc($select)){
                        ?>
                     <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                           <div class="p-6">
                              <div class="">
                  <form name="addpost" method="post">
                  <div class="form-group m-b-20">
                  <label for="exampleInputEmail1">Post Title</label>
                  <input type="text" class="form-control" id="posttitle" value="<?php echo $row['PostTitle'];?>" name="posttitle"  readonly>
                  </div>
                  <div class="row">
                  <div class="col-sm-12">
                  <div class="card-box">
                  <h4 class="m-b-30 m-t-0 header-title"><b>Imagem atual</b></h4>
                  <img src="postimages/<?php echo $row['PostImage'];?>" width="300"/>
                  <br />
                  </div>
                  </div>
                  </div>
                  <?php } ?>
                  <div class="row">
                  <div class="col-sm-12">
                  <div class="card-box">
                  <h4 class="m-b-30 m-t-0 header-title"><b>Nova imagem</b></h4>
                  <input type="file" class="form-control" id="postimage" name="postimage"  required>
                  </div>
                  </div>
                  </div>
                  <button type="submit" name="update" class="btn btn-success waves-effect waves-light">Atualizar</button>
                  </form>
                  </div>
                  </div> <!-- end p-20 -->
                  </div> <!-- end col -->
                  </div>
                  <!-- end row -->
               </div>
               <!-- container -->
            </div>
            <!-- content -->
            <?php include('includes/footer.php');?>
         </div>
         <!-- ============================================================== -->
         <!-- End Right content here -->
         <!-- ============================================================== -->
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
      <!--Summernote js-->
      <script src="../plugins/summernote/summernote.min.js"></script>
      <!-- Select 2 -->
      <script src="../plugins/select2/js/select2.min.js"></script>
      <!-- Jquery filer js -->
      <script src="../plugins/jquery.filer/js/jquery.filer.min.js"></script>
      <!-- page specific js -->
      <script src="assets/pages/jquery.blog-add.init.js"></script>
      <!-- App js -->
      <script src="assets/js/jquery.core.js"></script>
      <script src="assets/js/jquery.app.js"></script>
      <script src="../plugins/switchery/switchery.min.js"></script>
      <!--Summernote js-->
      <script src="../plugins/summernote/summernote.min.js"></script>
   </body>
</html>
<?php //} ?>