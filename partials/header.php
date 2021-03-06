<!DOCTYPE html>
<html>
    <head>
        <title>Fancy Beauty</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <link rel="stylesheet" href="css/master.css">
        <?php
        foreach($CSS as $variable => $valor){
            echo '<link rel="stylesheet" href="css/'.$valor.'.css">';
        }
        ?>
    </head>
    <body>
        <div class="xl-screen">
            <div class="body-container">
                <header>
                    <?php /*MENU MOBILE*/?>
                    <nav class="menu-mobile">
                        <nav role="navigation">
                            <div id="menuToggle">
                                <input type="checkbox" />

                                <?php /*Los spans actuan como el icono de hamburgersa y se transforman en la cruz*/?>
                                <span></span>
                                <span></span>
                                <span></span>

                                <?php /*Lo que va dentro del menu desplegable*/?>
                                <ul id="menu">
                                    <a href="index.php"><li>Inicio</li></a>
                                    <a href="#"><li>Categorias</li></a>
                                    <a href="#"><li>Contacto</li></a>
                                    <a href="faq.php"><li>Preguntas Frecuentes</li></a>
                                    <a href="<?=$linkUsuario?>"><li><?=$textoHamburguesa?></li></a>
                                    <a href="actions/logout.php"><li><?=$textoLogout?></li></a>
                                </ul>
                            </div>
                        </nav>

                        <a href="index.php"><img class="logo" src="img/icons/LogoMobile.png" alt="Logo"></a>

                        <div class="icons">
                            <a id="user-icon" href="<?=$linkUsuario?>">
                                <img id="icon-img" class="icon-img" src="img/icons/logInRegister.png" alt="User">
                            </a>

                            <a href="#">
                                <img class="icon-img" src="img/icons/BolsaDeCompra.png" alt="Carrito">
                            </a>
                        </div>
                    </nav>

                    <?php /*MENU DESKTOP*/?>
                    <nav class="menu-desktop">
                        <?php /*Primera Linea del Menu*/ ?>
                        <div class="menu-top">
                            <div class="icons">
                                <a href="#">
                                    <div class="icon-box">
                                        <img id="lupa" class="icon-img" src="img/icons/LupaDeBusqueda.png" alt="Busqueda">
                                        <p>Buscar</p>
                                    </div>
                                </a>
                            </div>

                            <a href="index.php">
                                <img class="logo" src="img/icons/LogoComputadora.png" alt="Logo">
                            </a>

                            <div class="icons">
                                <a href="<?=$linkUsuario?>">
                                    <div id="user-box" class="icon-box">
                                        <img id="user" class="icon-img" src="img/icons/logInRegister.png" alt="User">
                                        <p><?=$textoBienvenida?></p>
                                    </div>
                                </a>
                                <?php if(isset($_SESSION['email_usuario'])) :?>
                                <div class="dropdown">
                                    <button class="dropbtn">
                                    <i class="fa fa-caret-down"></i>
                                    </button>
                                    <div class="dropdown-content">
                                        <a href="perfilUsuario.php">Perfil</a>
                                        <a href="editarPerfil.php">Editar Perfil</a>
                                        <a href="actions/logout.php">Cerrar Sesión</a>
                                    </div>
                                </div>
                                <?php endif;?>

                                <a href="#">
                                    <div id='bag-box' class="icon-box">
                                        <img id="bag" class="icon-img" src="img/icons/BolsaDeCompra.png" alt="Carrito">
                                        <p>Carrito</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php/*Segunda Linea del Menu*/ ?>
                        <div class="menu-bottom">
                            <ul>
                                <li><a href="index.php">INICIO</a></li>
                                <li>|</li>
                                <li class="dropdown">
                                    <a href="#">CATEGORIAS</a>
                                    <div class="dropdown-category">
                                        <?php foreach($categorias as $categoria):?>
                                        <a href="filtro.php?id=<?=$categoria['id']?>&tabla=categorias">
                                            <?=$categoria['nombre']?>
                                        </a>
                                        <?php endforeach; ?>
                                    </div>
                                </li>
                                <li>|</li>
                                <li><a href="#">CONTACTO</a></li>
                                <li>|</li>
                                <li><a href="faq.php">PREGUNTAS FRECUENTES</a></li>
                            </ul>
                        </div>
                    </nav>
            </header>
