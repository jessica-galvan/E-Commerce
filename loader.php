<?php
// require_once('Clases/Usuario.php');
require_once('Clases/DB.php');
require_once('Clases/Auth.php');
require_once('Clases/Validator.php');


// //creo el autenticador
$auth = new Auth();

//creo un validador
$validator = new Validator();

/*creo DB*/
$baseDatos = new DB();

$conex = new PDO('mysql:host=localhost;dbname=fancybeauty;charset=utf8mb4;port=3306', 'root', '');
$consultaUsuarios = $conex->query("SELECT * FROM usuarios");

if($auth->checkSessionEmail()) {
    $nombre_usuario  = $_SESSION['nombre_usuario'];
    $linkUsuario = "perfilUsuario.php";
    $textoBienvenida = "Hola $nombre_usuario";
    $textoHamburguesa = "Perfil";
    $textoLogout = "Cerrar Sesión";
} else {
    $textoBienvenida = "Ingresar";
    $textoHamburguesa = "Ingresar";
    $linkUsuario = 'login.php';
    $nombre_usuario = "";
    $textoLogout = "";
}
