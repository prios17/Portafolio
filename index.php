<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombreyapelldio'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $nota = $_POST['nota'];
    $fecha = date("d-m-Y H:i:s"); 

    $sql = "INSERT INTO comentarios (nombreyapelldio, usuario, email, nota, fechanota) VALUES ('$nombre', '$usuario', '$email', '$nota', '$fecha')";
    $conexion->query($sql);
    
    header("Location: index.php#seccion-notas");
    exit();
}

if (isset($_GET['eliminar'])) {
    $id_eliminar = $_GET['eliminar'];
    $conexion->query("DELETE FROM comentarios WHERE id=$id_eliminar");
    header("Location: index.php#seccion-notas");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es-VE">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/snoopy icono.png" type="image/x-icon">
    <title>Portafolio Snoopy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="app-bar">
        <h2>
            <img src="assets/iconosnoopy.jpg" alt="Icono Snoopy">
            Snoopy
        </h2>
        <nav>
            <a href="#biografia">Biografía</a>
            <a href="#estilos">Alter Egos</a>
            <a href="#amigos">Amigos</a>
            <a href="#seccion-notas">Notas</a>
        </nav>
    </header>

    <section id="biografia" class="banner">
        <h1>El Beagle más famoso del mundo</h1>
        <img src="assets/Snoopy.png" alt="Snoopy y Woodstock">
        <p>Aventurero, escritor y el mejor amigo que Charlie Brown podría pedir. Con una imaginación infinita sobre su casita roja.</p>
        <button>Descubrir más</button>
    </section>

    <section id="estilos" class="gallery">
        <h2>Sus Alter Egos</h2>
        <div class="tarjetas">
            <article>
                <img class="foto-tarjeta" src="assets/joe cool.jpg" alt="Joe Cool">
                <h3>Joe Cool</h3>
                <p>¡El Universitario más cool que podrás conocer!</p>
            </article>
            
            <article>
                <img class="foto-tarjeta" src="assets/snoopy aviador.jpg" alt="Snoopy Aviador">
                <h3>Snoopy Aviador</h3> 
                <p>Volando los cielos imaginarios para enfrentar al temible Barón Rojo.</p>
            </article>
        </div>
    </section>

    <section id="amigos" class="info">
        <h2>La Pandilla</h2>
        <img class="foto-amigos" src="assets/images.jpg" alt="La pandilla Peanuts completa">
        <ul class="lista-amigos">
            <li><strong>Woodstock:</strong> Su fiel amigo amarillo.</li>
            <li><strong>Charlie Brown:</strong> Su dueño y al mismo tiempo su mejor amigo.</li>
            <li><strong>Lucy van Pelt:</strong> La "psiquiatra" del vecindario.</li>
        </ul>
    </section>

    <section id="seccion-notas" class="info">
        <h2>Deja una Nota en el Portafolio</h2>
        
        <form action="index.php" method="POST" style="display: flex; flex-direction: column; gap: 10px; max-width: 500px; margin: 0 auto;">
            <input type="text" name="nombreyapelldio" placeholder="Nombre y Apellido" required style="padding: 8px;">
            <input type="text" name="usuario" placeholder="Nombre de Usuario (Opcional)" style="padding: 8px;">
            <input type="email" name="email" placeholder="Correo Electrónico" required style="padding: 8px;">
            <textarea name="nota" placeholder="Escribe tu nota..." required rows="4" style="padding: 8px;"></textarea>
            <button type="submit" style="padding: 10px; cursor: pointer;">Enviar Nota</button>
        </form>

        <div style="margin-top: 2rem; max-width: 600px; margin-left: auto; margin-right: auto;">
            <h3>Notas Recientes:</h3>
            <?php
            $notas = $conexion->query("SELECT * FROM comentarios ORDER BY id DESC");
            
            if ($notas && $notas->num_rows > 0) {
                while($fila = $notas->fetch_assoc()) {
                    echo "<div style='border: 1px solid #ccc; padding: 15px; margin-bottom: 10px; text-align: left; background-color: #f9f9f9; border-radius: 5px;'>";
                    echo "<h4 style='margin: 0 0 5px 0;'>" . htmlspecialchars($fila['nombreyapelldio']) . " <span style='color: gray; font-size: 0.9em;'>(" . htmlspecialchars($fila['usuario']) . ")</span></h4>";
                    echo "<p style='margin: 0 0 10px 0;'>" . htmlspecialchars($fila['nota']) . "</p>";
                    echo "<small style='color: #666;'>Enviado el: " . $fila['fechanota'] . "</small> <br><br>";
                    echo "<a href='index.php?eliminar=" . $fila['id'] . "' style='color: red; text-decoration: none; font-size: 0.9em;'>🗑️ Eliminar nota</a>";
                    echo "</div>";
                }
            } else {
                echo "<p>No hay notas aún. ¡Sé el primero en comentar!</p>";
            }
            ?>
        </div>
    </section>

    <footer>
        <p>Desarrollado por Pedro Rios - Proyecto de HTML para Programación IV</p>
    </footer>
</body>
</html>