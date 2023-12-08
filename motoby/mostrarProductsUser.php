<?php
require_once "productsUser.php";

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
<body class="sidebar-mini" style="width: 100%;">
<div class="wrapper" >
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
    <div class="col-sm-9" style="margin-left:5%;">
    </div>
    
    <!-- Main content -->
    <section class="content" >
    
      <div class="container-fluid" >
     
        <div class="row">
        
          <!-- /.col -->
          <div class="col-md-9" >
            <div class="card" style="background-color:lightgrey">
            
              <div class="card-body">
             <h2 class="text-center">Mis productos</h2>
          <hr>
         <?php if ($stmt->rowCount() > 0) {
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($products as $product) {
   ?>
            <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                      <div class="user-block">
                        
                        
                        <span class="username">
                        <a href="datosProducto.php?product_id=<?php echo $product['product_id'] ?>""><?php echo $product['product_name'] ?></a>
                        
                        </span>
                        <span class="description">Compartido el <?php echo $product['fecha_publicacion']?></span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                       Categoria: <?php echo $product['category'] ?>
                      </p>
                      <p>
                       Precio: <?php echo $product['price']?>
                      </p>
                      <p>
                       Descripcion: <?php echo $product['description'] ?>
                      </p>
                      <a><button class=" btn btn-danger " onclick="confirmarEliminacion(<?php echo $product['product_id']; ?>)">Eliminar</button></a>
                      
                    <hr>
                    </div> 
                    <!-- /.post -->
                  </div>
                 
                  </div>
                <?php }
            } else {
                echo "No tienes ningun producto.";
                ?> <a href="crearProducto.php"> <button type="button"  class="btn btn-block btn-success btn-lg">Crear publicacion</button></a> <?php
            }?> 
                  <!-- /.tab-pane -->
                </div>

                
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
           
          </div>
          <!-- /.col -->
          
        </div>
        <!-- /.row -->
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer" style="margin-left:0px;">
    <div class="float-right d-none d-sm-block">
    </div>
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
<script src="https://kit.fontawesome.com/d61efcfa86.js" crossorigin="anonymous"></script>
<script>
function confirmarEliminacion(product_id) {
    var confirmacion = confirm("¿Estás seguro de eliminar este producto?");

    if (confirmacion) {
        eliminarProducto(product_id);
    }
}

function eliminarProducto(product_id) {
    var xhr = new XMLHttpRequest();

    xhr.onload = function() {
        if (xhr.status === 200) {
            location.reload();
        }
    };

    xhr.open("POST", "eliminarProducto.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("product_id=" + product_id);
}
</script>