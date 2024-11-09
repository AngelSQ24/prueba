<?php
$servername = "localhost";
$username = "root";
$password = "";  
$dbname = "mi_base_datos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_completo = $_POST['nombre_completo'];
    $telefono = $_POST['telefono'];

    if (preg_match("/^[0-9]{10}$/", $telefono)) {
        $sql = "INSERT INTO usuarios (nombre_completo, telefono) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nombre_completo, $telefono);

        if ($stmt->execute()) {
            echo "<div class='success'>Datos guardados exitosamente</div>";
        } else {
            echo "<div class='error'>Error al guardar los datos: " . $stmt->error . "</div>";
        }
        $stmt->close();
    } else {
        echo "<div class='error'>Por favor, ingresa un número de teléfono válido de 10 dígitos.</div>";
    }
}

$conn->close();
?>
