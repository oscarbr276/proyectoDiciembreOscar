<?php
require_once "context.php";

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
          
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Crear Producto</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="editProducto.php" id="myForm" method="POST">
                <div class="card-body" >
                  
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nombre</label>
                    <input id="contenido" type="text" class="form-control" name="product_name" placeholder="Nombre" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Descripcion</label>
                    <textarea id="contenido" type="text" class="form-control" name="description" placeholder="Descripcion" required></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Precio</label>
                    <input id="contenido" type="number" class="form-control" name="price" placeholder="Precio" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nombre</label>
                    <input id="contenido" type="text" class="form-control" name="category" placeholder="Categoria" required>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                <a href="editProducto.php?product_id=<?php echo $product['product_id'];?>"><button class="btn btn-success">Editar</button></a>
                </div>
              </form>
            </div>
            
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