<?php
//verifica
session_start();
include('../includes/config.php');

if (isset($_POST['submit'])) {

   if (!empty($_POST['login']) && !empty($_POST['senha'])) {

      $login = $_POST['login'];    
      $senha = $_POST['senha'];
      
      $query = mysqli_query($conexao, 'SELECT login, password FROM usuario WHERE login = "' . $login . '" AND password = password("' . $senha . '")');

      if (mysqli_num_rows($query) < 1) {
         echo "<script>alert('Senha e/ou Login errado');</script>";         
      } else {
         $_SESSION['login'] = $login;
         $_SESSION['senha'] = $senha;
         header('location: manage-posts.php');
      }  
   } else {
      echo "<script>alert('Senha e/ou Login errado');</script>";
   }

}
?>
<!DOCTYPE html>
<html lang="pt-br">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Portal Notícias">
      <meta name="author" content="Senac">
      <!-- App title -->
      <title>Portal Notícias | Painel Admin</title>
      <!-- App css -->
      <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
      <script src="assets/js/modernizr.min.js"></script>
   </head>
   <body class="bg-transparent">
      <!-- HOME -->
      <section>
         <div class="container-alt">
            <div class="row">
               <div class="col-sm-12">
                  <div class="wrapper-page">
                     <div class="m-t-40 account-pages">
                        <div class="text-center account-logo-box">
                           <h2 class="text-uppercase">
                              <a href="index.php" class="text-success">
                              <span><img src="assets/images/cata-vento.png" alt="" height="50"></span>
                              </a>
                           </h2>
                           <!--<h4 class="text-uppercase font-bold m-b-0">Sign In</h4>-->
                        </div>
                        <div class="account-content">
                           <form class="form-horizontal" method="post">
                              <div class="form-group ">
                                 <div class="col-xs-12">
                                    <input class="form-control" type="text" required="" name="login" placeholder="Usuário" autocomplete="off">
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="col-xs-12">
                                    <input class="form-control" type="password" name="senha" required="" placeholder="Senha" autocomplete="off">
                                 </div>
                              </div>
                              <div class="form-group account-btn text-center m-t-10">
                                 <div class="col-xs-12">
                                    <button class="btn w-md btn-bordered btn-danger waves-effect waves-light" type="submit" name="submit">Entrar</button>
                                 </div>
                              </div>
                           </form>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                     <!-- end card-box-->
                  </div>
                  <!-- end wrapper -->
               </div>
            </div>
         </div>
      </section>
      <!-- END HOME -->
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
      <!-- App js -->
      <script src="assets/js/jquery.core.js"></script>
      <script src="assets/js/jquery.app.js"></script>
   </body>
</html>