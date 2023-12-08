<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'context.php';

$user_id_actual = $_SESSION['user_id'];

if (isset($_GET['user_id'])) {
    $user_id_destino = $_GET['user_id'];
} else {
    
    header("Location: index.php"); 
    exit();
}
require_once 'context.php';

$obtener_mensajes = $conn->prepare("SELECT mensaje_id, emisor_id, receptor_id, contenido, fecha_envio FROM mensajes WHERE (emisor_id = ? AND receptor_id = ?) OR (emisor_id = ? AND receptor_id = ?) ORDER BY fecha_envio");
$obtener_mensajes->execute([$user_id_actual, $user_id_destino, $user_id_destino, $user_id_actual]);
$mensajes = $obtener_mensajes->fetchAll(PDO::FETCH_ASSOC);

$usuario_actual_query = $conn->prepare("SELECT user_id, username, profile_image FROM users WHERE user_id = ?");
$usuario_actual_query->execute([$user_id_actual]);
$usuario_actual = $usuario_actual_query->fetch(PDO::FETCH_ASSOC);

$usuario_destino_query = $conn->prepare("SELECT user_id, username, profile_image FROM users WHERE user_id = ?");
$usuario_destino_query->execute([$user_id_destino]);
$usuario_destino = $usuario_destino_query->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Motoby</title>
  
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="estilo.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body style="width: 100%;">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="navbar navbar-expand navbar-white navbar-light" id="header">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="index.php" class="nav-link">
                    <i class="nav-icon fas fa-home"></i>
                </a>
            </li>
            <li class="nav-item">
                <a href="perfil.php" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                </a>
            </li>
            <li class="nav-item">
                <a href="config.php" class="nav-link">
                    <i class="nav-icon fas fa-gear"></i>
                </a>
            </li>
            <li class="nav-item">
                <a href="logout.php" class="nav-link">
                    <i class="nav-icon fas fa-door-open"></i>
                </a>
            </li>
            <li class="nav-item">
                <a href="mostrarChats.php" class="nav-link">
                    <i class="nav-icon fas fa-message"></i>
                </a>
            </li>
            <li class="nav-item">
            <a href="mostrarChats.php" class="nav-link">
              <i class="nav-icon fas fa-message"></i>
            </a>
          </li>
        </ul>
    </nav>
    <!-- /.navbar -->
  
    <div class="content-wrapper" style="margin-left:0px;">
        <div class="card direct-chat direct-chat-primary" style="height:100%; width:100%;">
    <div class="card-header">
        <h3 class="card-title">Chat con <?php echo $usuario_destino['username'] ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body"style="overflow-y: auto; max-height: 75vh;">
        <!-- Conversations are loaded here -->
        <div class="direct-chat" >
            <?php foreach ($mensajes as $mensaje) : ?>
                <?php if ($mensaje['emisor_id'] == $user_id_actual) : ?>
                    <!-- Mensaje enviado por el usuario actual -->
                    <div class="direct-chat-msg right" style="margin=2%">
                        <div class="direct-chat-infos clearfix" style="margin=2%">
                            <span class="direct-chat-name float-right"><?php echo $usuario_actual['username']; ?></span>
                            <span class="direct-chat-timestamp float-left"><?php echo $mensaje['fecha_envio']; ?></span>
                        </div>
                        <?php if (!empty($usuario_actual['profile_image'])) : ?>
                            <img class="direct-chat-img" src="data:image/png;base64, <?php echo base64_encode(stripslashes($usuario_actual['profile_image'])); ?>" alt="message user image">
                        <?php else : ?>
                            <img class="direct-chat-img" src="default.png" alt="message user image">
                        <?php endif; ?>
                        <div class="direct-chat-text">
                            <?php echo $mensaje['contenido']; ?>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="direct-chat-msg">
                        <div class="direct-chat-infos clearfix">
                            <span class="direct-chat-name float-left"><?php echo $usuario_destino['username']; ?></span>
                            <span class="direct-chat-timestamp float-right"><?php echo $mensaje['fecha_envio']; ?></span>
                        </div>
                        <?php if (!empty($usuario_destino['profile_image'])) : ?>
                            <img class="direct-chat-img" src="data:image/png;base64, <?php echo base64_encode(stripslashes($usuario_destino['profile_image'])); ?>" alt="message user image">
                        <?php else : ?>
                            <img class="direct-chat-img" src="default.png" alt="message user image">
                        <?php endif; ?>
                        <div class="direct-chat-text">
                            <?php echo $mensaje['contenido']; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!--/.direct-chat-messages-->
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <form id="formulario-chat" method="post" action="enviarMensaje.php">
            <div class="input-group">
                <input type="hidden" name="usuario_destino_id" value="<?php echo $user_id_destino; ?>">
                <input type="text" name="contenido" placeholder="Escribe tu mensaje" class="form-control">
                <span class="input-group-append">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /.card-footer-->
                        </div>
</div>
        <footer class="main-footer" style="margin-left:0px;">
            <div class="float-right d-none d-sm-block"></div>
            <strong> Motoby</strong> 
        </footer>
</div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
</body>
</html>
<script>
var pagina = <?php echo $pagina; ?>;
var cargando = false;

document.querySelector('.card-body').addEventListener('scroll', function () {
    var container = this;
    if (container.scrollTop + container.clientHeight >= container.scrollHeight - 10 && !cargando) {
        cargando = true;
        pagina++;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'cargarMensajes.php?pagina=' + pagina, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                if (xhr.responseText.trim() !== '') {
                    document.querySelector('.direct-chat').innerHTML += xhr.responseText;
                    cargando = false;
                }
            }
        };
        xhr.send();
    }
});
</script>