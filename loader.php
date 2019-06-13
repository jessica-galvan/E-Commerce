<?php
require_once('Clases/DB.php');
require_once('Clases/Auth.php');
require_once('Clases/Validator.php');
require_once('Clases/Usuario.php');
require_once('Clases/Producto.php');

$auth = new Auth();
$validator = new Validator();
$baseDatos = new DB('fancybeauty', 'root', '');
$conex = $baseDatos->getConex();
$usuario = new Usuario();
$producto = new Producto();

// $consultaUsuarios = $conex->query("SELECT * FROM usuarios");
/*Es necesario $consultaCategorias y $categorias para que funcione el menú*/
$consultaCategorias = $conex->query('SELECT * FROM categorias');
$categorias = $consultaCategorias->fetchAll(PDO::FETCH_ASSOC);

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
