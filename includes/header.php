<header>
  <!--MENU MOBILE-->
  <nav class="menu-mobile">
    <nav role="navigation">
      <div id="menuToggle">
        <!-- A fake / hidden checkbox is used as click reciever, so you can use the :checked selector on it.-->
        <input type="checkbox" />

        <!--Los spans actuan como el icono de hamburgersa y se transforman en la cruz-->
        <span></span>
        <span></span>
        <span></span>

        <!--Lo que va dentro del menu desplegable-->
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

    <a href="index.php"> <img class="logo" src="img/icons/LogoMobile.png" alt="Logo"> </a>

    <div class="icons">
      <a id="user-icon" href="<?=$linkUsuario?>">
        <img id="icon-img" class="icon-img" src="img/icons/logInRegister.png" alt="User">
      </a>

      <a href="#">
        <img class="icon-img" src="img/icons/BolsaDeCompra.png" alt="Carrito">
      </a>
    </div>
  </nav>

  <!--MENU DESKTOP-->
  <nav class="menu-desktop">
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

          <a href="#">
            <div class="icon-box">
              <img id="bag" class="icon-img" src="img/icons/BolsaDeCompra.png" alt="Carrito">
              <p>Carrito</p>
            </div>
          </a>
        </div>
      </div>

      <div class="menu-bottom">
        <ul>
          <li><a href="index.php">INICIO</a></li>
          <li>|</li>
          <li><a href="#">CATEGORIAS</a></li>
          <li>|</li>
          <li><a href="#">CONTACTO</a></li>
          <li>|</li>
          <li><a href="faq.php">PREGUNTAS FRECUENTES</a></li>
        </ul>
      </div>
  </nav>
</header>
