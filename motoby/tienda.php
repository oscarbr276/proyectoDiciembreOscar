<?php
require_once "cargarProducto.php";

if (isset($_GET['q']) || isset($_GET['minPrecio']) || isset($_GET['maxPrecio']) || isset($_GET['categoria'])) {
  $nombre = isset($_GET['q']) ? $_GET['q'] : '';
  $minPrecio = isset($_GET['minPrecio']) ? $_GET['minPrecio'] : '';
  $maxPrecio = isset($_GET['maxPrecio']) ? $_GET['maxPrecio'] : '';
  $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';

  $result = buscarProductos($nombre, $minPrecio, $maxPrecio, $categoria);
} 
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
<nav class=" navbar navbar-expand navbar-white navbar-light" id="header">
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

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card" style="background-color:lightgrey">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link " href="index.php" data-toggle="tab">Publicaciones</a></li>
                  <li class="nav-item"><a class="nav-link active" href="tienda.php" data-toggle="tab">Tienda</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
              <a href="crearProducto.php"><button type="button" class="btn btn-block btn-success btn-lg">Añadir producto</button></a>
          <hr>
          <form method="GET" action="tienda.php" class="form-inline mt-2 mt-md-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Nombre" name="q">
                    <input class="form-control mr-sm-2" type="text" placeholder="Precio minimo" id="minPrecio" name="minPrecio">
                    <input class="form-control mr-sm-2" type="text" placeholder="Precio maximo" id="maxPrecio" name="maxPrecio">
                    <input class="form-control mr-sm-2" type="text" placeholder="Categoria" id="categoria" name="categoria">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                </form>
                <hr>
          <?php if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $product_id = $row['product_id'];
        $user_id = $row['user_id'];
        $username = $row['username'];
        $product_name = $row['product_name'];
        $description = $row['description'];
        $category = $row['category'];
        $price = $row['price'];
        $fecha_publicacion = $row['fecha_publicacion'];
?>
<div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                      <div class="user-block">
                      <?php if ($row['profile_image']) {?>
<img class="img-circle img-bordered-sm" src="data:image/png;base64, <?php echo base64_encode(stripslashes($row['profile_image'])) ?>"  alt="user image">
<?php } else { ?>
 <img class="img-circle img-bordered-sm" src="default.png"  alt="user image"> 
<?php } ?>
                        <span class="username">
                          <a href="datosProducto.php?product_id=<?php echo $product_id; ?>""><?php echo $product_name ?></a>
                        </span>
                        <span class="description">Creado por <?php echo $username ?> el <?php echo $fecha_publicacion ?></span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                       Categoria: <?php echo $category ?>
                      </p>
                      <p>
                       Precio: <?php echo $price ?>
                      </p>
                      <p>
                       Descripcion: <?php echo $description ?>
                      </p>
                    </div>
                    <!-- /.post -->
                  </div>
    <hr>
    <?php }
} else {
    echo "No se encontraron productos.";
}?>
                
                  
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
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