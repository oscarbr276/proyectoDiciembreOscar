<?php
require_once "cargarPost.php";
if (isset($_GET['buscar']) && !empty($_GET['buscar'])) {
  $result = buscarPublicaciones($conn, $_GET['buscar']);
} else {
  $result = cargarPublicaciones($conn);
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
<div class="wrapper" >
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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Motoby</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
  <!-- <div class="col-sm-9" style="margin-left:5%;">
    <?php 
           session_start();
           ?>
    </div> -->
    <!-- Main content -->
    <section class="content" >
      <div class="container-fluid" >
        <div class="row">
          <!-- /.col -->
          <div class="col-md-9" >
            <div class="card" style="background-color:lightgrey">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="index.php" data-toggle="tab">Publicaciones</a></li>
                  <li class="nav-item"><a class="nav-link" href="tienda.php" data-toggle="tab">Tienda</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
             <a href="crearPost.php"> <button type="button"  class="btn btn-block btn-success btn-lg">Crear publicacion</button></a>
             <hr>
             <form method="GET" action="index.php" class="form-inline mt-2 mt-md-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Buscar" name="buscar">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                </form>
             <hr>
             <?php
             
             if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $username = $row['username'];
        $user_id = $row['user_id'];
        $content = $row['content'];
        $post_id = $row['post_id'];
        $fecha_publicacion = $row['fecha_publicacion'];

        ?>
        <div class="tab-content">
            <div class="active tab-pane" id="activity">
                <div class="post">
                    <div class="user-block">
                        <?php if ($row['profile_image']) { ?>
                            <img class="img-circle img-bordered-sm"
                                src="data:image/png;base64, <?php echo base64_encode(stripslashes($row['profile_image'])) ?>"
                                alt="user image">
                        <?php } else { ?>
                            <img class="img-circle img-bordered-sm" src="default.png" alt="user image">
                        <?php } ?>
                        <span class="username">
                          <?php
                       
                       if (isset($_SESSION['user_id'])) {
                           if ($_SESSION['user_id'] == $user_id) {
                               echo "<a href='perfil.php'>$username</a>";
                           } else {
                               echo "<a href='mostrarPerfilDatos.php?user_id=$user_id'>$username</a>";
                           }
                       } else {
                           echo "<a href='mostrarPerfilDatos.php?user_id=$user_id'>$username</a>";
                       }
                       ?>
                            
                        </span>
                        <span class="description">Compartido el <?php echo $fecha_publicacion ?></span>
                    </div>
                    <p>
                        <?php echo $content ?>
                        <form class="form-horizontal" action="guardarComentario.php" method="post">
                        <div class="input-group input-group-sm mb-0">
                          <input class="form-control form-control-sm" name="content" placeholder="Escribe tu comentario">
                          <div class="input-group-append">
                          <input type="hidden" name="post_id" value="<?= $post_id ?>">
                            <button type="submit" class="btn btn-success">Enviar</button>
                          </div>
                        </div>
                      </form>
                        
                    </p>
               
                <?php
$comentarios_query = "SELECT c.*, u.username, u.profile_image FROM comentarios c
                      INNER JOIN users u ON c.user_id = u.user_id
                      WHERE c.post_id = :post_id";
$stmt_comentarios = $conn->prepare($comentarios_query);
$stmt_comentarios->bindParam(':post_id', $post_id, PDO::PARAM_INT);
$stmt_comentarios->execute();

$numeroComentarios = $stmt_comentarios->rowCount();

if ($stmt_comentarios->rowCount() > 0) {
    echo '<div class="comentarios-container" id="comentarios_' . $post_id . '" style="display: none;">';

    while ($comentario = $stmt_comentarios->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="comment">';
        echo '<div class="user-block">';
        if ($comentario['profile_image']) {
            echo '<img class="img-circle img-bordered-sm" src="data:image/png;base64, ' . base64_encode(stripslashes($comentario['profile_image'])) . '" alt="user image">';
        } else {
            echo '<img class="img-circle img-bordered-sm" src="default.png" alt="user image">';
        }

        echo '<span class="username">';
        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $comentario['user_id']) {
            echo '<a href="perfil.php">' . $comentario['username'] . '</a>';
        } else {
            echo '<a href="mostrarPerfilDatos.php?user_id=' . $comentario['user_id'] . '">' . $comentario['username'] . '</a>';
        }
        echo '</span>';
        echo '</div>';
        echo '<p>' . $comentario['content'] . '</p>';
        echo '</div>';
    }

    echo '</div>';
} 
?>


<a href="#" class="mostrar-comentarios" data-post-id="<?php echo $post_id; ?>"><i class="nav-icon fa-regular fa-comments"></i> Comentarios (<?php echo $numeroComentarios; ?>)</a>
              
            </div>
        </div>
        </div>
        <hr>
        <?php
    }
} else {
    echo "";
}
?>     


                <div class="row">
                    <?php
                    if ($result->rowCount() > 0) {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            $username = $row['username'];
                            $user_id = $row['user_id'];
                            $content = $row['content'];
                            $post_id = $row['post_id'];
                            $fecha_publicacion = $row['fecha_publicacion'];

                            ?>
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <div class="post">
                                        <div class="user-block">
                                            <?php if ($row['profile_image']) { ?>
                                                <img class="img-circle img-bordered-sm"
                                                    src="data:image/png;base64, <?php echo base64_encode(stripslashes($row['profile_image'])) ?>"
                                                    alt="user image">
                                            <?php } else { ?>
                                                <img class="img-circle img-bordered-sm" src="default.png"
                                                    alt="user image">
                                            <?php } ?>
                                            <span class="username">
                                                <?php
                                                if (isset($_SESSION['user_id'])) {
                                                    if ($_SESSION['user_id'] == $user_id) {
                                                        echo "<a href='perfil.php'>$username</a>";
                                                    } else {
                                                        echo "<a href='mostrarPerfilDatos.php?user_id=$user_id'>$username</a>";
                                                    }
                                                } else {
                                                    echo "<a href='mostrarPerfilDatos.php?user_id=$user_id'>$username</a>";
                                                }
                                                ?>
                                            </span>
                                            <span class="description">Compartido el <?php echo $fecha_publicacion ?></span>
                                        </div>
                                        <p>
                                            <?php echo $content ?>
                                            <form class="form-horizontal" action="guardarComentario.php"
                                                method="post">
                                                <div class="input-group input-group-sm mb-0">
                                                    <input class="form-control form-control-sm" name="content"
                                                        placeholder="Escribe tu comentario">
                                                    <div class="input-group-append">
                                                        <input type="hidden" name="post_id"
                                                            value="<?= $post_id ?>">
                                                        <button type="submit"
                                                            class="btn btn-success">Enviar</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </p>

                                        <?php
                                        $comentarios_query = "SELECT c.*, u.username, u.profile_image FROM comentarios c
                                                          INNER JOIN users u ON c.user_id = u.user_id
                                                          WHERE c.post_id = :post_id";
                                        $stmt_comentarios = $conn->prepare($comentarios_query);
                                        $stmt_comentarios->bindParam(':post_id', $post_id, PDO::PARAM_INT);
                                        $stmt_comentarios->execute();

                                        $numeroComentarios = $stmt_comentarios->rowCount();

                                        if ($stmt_comentarios->rowCount() > 0) {
                                            echo '<div class="comentarios-container" id="comentarios_' . $post_id . '" style="display: none;">';

                                            while ($comentario = $stmt_comentarios->fetch(PDO::FETCH_ASSOC)) {
                                                echo '<div class="comment">';
                                                echo '<div class="user-block">';
                                                if ($comentario['profile_image']) {
                                                    echo '<img class="img-circle img-bordered-sm" src="data:image/png;base64, ' . base64_encode(stripslashes($comentario['profile_image'])) . '" alt="user image">';
                                                } else {
                                                    echo '<img class="img-circle img-bordered-sm" src="default.png" alt="user image">';
                                                }

                                                echo '<span class="username">';
                                                if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $comentario['user_id']) {
                                                    echo '<a href="perfil.php">' . $comentario['username'] . '</a>';
                                                } else {
                                                    echo '<a href="mostrarPerfilDatos.php?user_id=' . $comentario['user_id'] . '">' . $comentario['username'] . '</a>';
                                                }
                                                echo '</span>';
                                                echo '</div>';
                                                echo '<p>' . $comentario['content'] . '</p>';
                                                echo '</div>';
                                            }

                                            echo '</div>';
                                        }
                                        ?>

                                        <a href="#" class="mostrar-comentarios" data-post-id="<?php echo $post_id; ?>"><i class="nav-icon fas fa-comments"></i>Comentarios (<?php echo $numeroComentarios; ?>)</a>

                                    </div>
                                </div>
                            </div>
                            <hr>
                            <?php
                        }
                    } else {
                        echo "No se encontraron publicaciones.";
                    }
                    ?>
                </div>
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
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
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
document.addEventListener('DOMContentLoaded', function() {
  var likeButtons = document.querySelectorAll('.like-btn');
  
  likeButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      var postId = button.dataset.postId;

      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'guardarLike.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onload = function() {
        if (xhr.status === 200) {
          console.log(xhr.responseText);
        } else {
          console.log('Error ');
        }
      };

      xhr.send('post_id=' + encodeURIComponent(postId));
    });
  });
});
document.addEventListener("DOMContentLoaded", function () {
        const likeButtons = document.querySelectorAll(".like-button");

        likeButtons.forEach(function (button) {
            button.addEventListener("click", function () {
                const postID = button.getAttribute("data-postid");

                const xhr = new XMLHttpRequest();
                xhr.open("POST", "procesar_likes.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        if (xhr.responseText === "liked") {
                            const likeCount = button.nextElementSibling;
                            likeCount.textContent = parseInt(likeCount.textContent) + 1 + " likes";
                        } else if (xhr.responseText === "unliked") {
                            const likeCount = button.nextElementSibling;
                            likeCount.textContent = parseInt(likeCount.textContent) - 1 + " likes";
                        }
                    }
                };

                xhr.send("post_id=" + postID);
            });
        });
    });
    
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var mostrarComentariosLinks = document.querySelectorAll('.mostrar-comentarios');

    mostrarComentariosLinks.forEach(function (enlace) {
        enlace.addEventListener('click', function (event) {
            event.preventDefault();
            var postId = this.getAttribute('data-post-id');
            var comentariosContainer = document.getElementById('comentarios_' + postId);

            if (comentariosContainer.style.display === 'none') {
                comentariosContainer.style.display = 'block';
            } else {
                comentariosContainer.style.display = 'none';
            }
        });
    });
});
</script>
