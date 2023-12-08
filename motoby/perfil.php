<?php
require_once "context.php";
require_once "cargarPerfil.php";
require_once "contadorUser.php";
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
<body class="hold-transition sidebar-mini">
<div class="wrapper">

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
  </nav>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left:0px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Motoby</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6" >
          
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                 <?php if (!empty($fila['profile_image'])) {
                 ?> <img class=" profile-user-img img-fluid img-circle" src="data:image/png;base64, <?php echo base64_encode(stripslashes($fila['profile_image'])) ?>" alt="Imagen de perfil">
                  <?php } else {
                  echo '<img class="profile-user-img img-fluid img-circle" src="default.png" alt="Imagen de perfil">';
                  }?>
                </div>

                <h3 class="profile-username text-center"><?php echo $fila['username']; ?></h3>

                <p class="text-muted text-center"><?php echo $fila['full_name'];?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Correo electronico</b> <a class="float-right"><?php echo $fila['email'];?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Nombre</b> <a class="float-right"><?php echo $fila['full_name'];?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Usuario</b> <a class="float-right"><?php echo $fila['username'];?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Publicaciones</b> <a href="mostrarPostsUser.php" class="float-right"> <?php echo $totalPosts ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Productos</b> <a href="mostrarProductsUser.php"  class="float-right"><?php echo $totalProducts ?></a>
                  </li>
                </ul>

                <a href="config.php" class="btn btn-primary btn-block"><b>Editar perfil</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
    
            
            <!-- /.card -->
          </div>
          <!-- /.col -->
          
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer" style="margin-left:0px;">
    <div class="float-right d-none d-sm-block">
    </div>
    <strong> Motoby</strong> 
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
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
<script src="https://kit.fontawesome.com/d61efcfa86.js" crossorigin="anonymous"></script>