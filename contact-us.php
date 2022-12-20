<?php
error_reporting(0);


require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['enviar'])) {
  //Create an instance; passing `true` enables exceptions

  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $comentario = $_POST['comentario'];

  $mail = new PHPMailer(true);

  try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP(); //Send using SMTP
    $mail->Host = 'smtpi.uni5.net'; //Set the SMTP server to send through
    $mail->SMTPAuth = true; //Enable SMTP authentication
    $mail->Username = 'mail@jumbo.com.br'; //SMTP username
    $mail->Password = 'Senac#12'; //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Enable implicit TLS encryption
    $mail->Port = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('mail@jumbo.com.br', 'Mailer');
    $mail->addAddress('leonardo.cruz1506@gmail.com', 'Nico');    //Add a recipient
    //$mail->addAddress('ellen@example.com');                    //Name is optional
    $mail->addReplyTo($email, $nome);
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');             //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');        //Optional name

    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = 'Nico';
    $mail->Body = $comentario;
    $mail->AltBody = $comentario;
    $mensage = $_POST['mensagem'];
    $mail->send();
    echo 'Messagem enviada';
  } catch (Exception $e) {
    echo "Erro ao enviar mensagem. Mailer Error: {$mail->ErrorInfo}";
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Senac">
  <meta name="author" content="Senac">
  <title>Portal Notícias | Contato</title>
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/modern-business.css" rel="stylesheet">
</head>

<body>
  <!-- Navigation -->
  <?php include('includes/header.php'); ?>
  <!-- Page Content -->
  <div class="container">
    <h1 class="mt-4 mb-3">Contate nos</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.php">Home</a>
      </li>
      <li class="breadcrumb-item active">Contato</li>
    </ol>
    <!-- Intro Content -->
    <div class="row">
      <div class="col-lg-12">

        <form  method="post" class="form-control">
          <!-- Inicio do Formulario -->
          <fieldset>
            <legend>Dados Pessoais</legend>
            <label for="nome" class="form-text">Nome:</label>
            <input type="text" id="nome" name="nome" class="box" placeholder="Digite seu nome"><br>
            <label for="email" class="">E-mail:</label>
            <input type="email" name="email" id="email" class="form-text" placeholder="você@exemplo.com"><br>
          </fieldset>
          <fieldset class="dados">
            <legend>Mensagem</legend>
            <label for="comentario" class="form-text"></label>
            <textarea name="comentario" id="comentario" cols="30" rows="10"></textarea>
          </fieldset><br>
          <input type="submit" value="Enviar" id="enviar" name="enviar" class="btn btn-primary">
        </form> <!-- Fim do Formulario -->

      </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
  <!-- Footer -->
  <?php include('includes/footer.php'); ?>
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>