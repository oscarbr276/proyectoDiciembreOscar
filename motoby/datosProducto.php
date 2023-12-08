<?php
require_once "cargarProducto.php";
require_once "mostrarDatosProducto.php";
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

  <!-- Main Sidebar Container -->
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

    <!-- Main content -->
    <section class="content">
        
    <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
            <?php if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $sql = "SELECT products.*, users.username
        FROM products
        INNER JOIN users ON products.user_id = users.user_id
        WHERE products.product_id = :product_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':product_id', $product_id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        $productUserId = $product['user_id'];
        $productUsername = $product['username'];
    
        ?>

              <div class="col-12">
              <img class="product-image"  src="data:image/png;base64, <?php echo base64_encode(stripslashes($product['image'])) ?>">
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3"><?php echo "<h2>{$product['product_name']}</h2>"; ?></h3>
              <hr>
              <p><?php  echo "<p>Descripción: {$product['description']}</p>"; ?></p>
              
              <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $productUserId): ?>
                <p>Vendedor: <a href="perfil.php"><?php echo $productUsername; ?></a></p>
              <?php else: ?>
                <p>Vendedor: <a href="mostrarPerfilDatos.php?user_id=<?php echo $productUserId; ?>"><?php echo $productUsername; ?></a></p>
              <?php endif; ?>
              <hr>            
              <div class="bg-gray py-2 px-3 mt-4">
                <h2 class="mb-0">
                <?php  echo "<p>Precio: {$product['price']}€</p>";?> 
                </h2>
 
                
    <?php } else {
        echo "Producto no encontrado.";
    }
} else {
    echo "ID de producto no proporcionado.";
}?>
              
             
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
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