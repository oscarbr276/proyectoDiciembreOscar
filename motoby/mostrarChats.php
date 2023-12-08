<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'context.php';

$user_id_actual = $_SESSION['user_id'];

require_once 'context.php';

$obtener_chats = $conn->prepare("SELECT DISTINCT users.user_id, users.username
                                FROM mensajes
                                INNER JOIN users ON (mensajes.emisor_id = users.user_id OR mensajes.receptor_id = users.user_id)
                                WHERE mensajes.emisor_id = ? OR mensajes.receptor_id = ?
                                ORDER BY users.username");
$obtener_chats->execute([$user_id_actual, $user_id_actual]);
$chats = $obtener_chats->fetchAll(PDO::FETCH_ASSOC);


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
    <div >
         
            <div class="card-header">
              <h3 class="card-title">Chats</h3>
            </div>
            <div class="card-body p-0">             
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                <tbody>
    <?php foreach ($chats as $chat) : ?>
        <tr onclick="window.location='chat.php?user_id=<?php echo $chat['user_id']; ?>';" style="cursor: pointer;">
            <td class="mailbox-name">
                <a href="chat.php?user_id=<?php echo $chat['user_id']; ?>"><?php echo $chat['username']; ?></a>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
                </table>
              </div>
           
          </div>
        </div>
    
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