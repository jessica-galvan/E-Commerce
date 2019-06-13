<?php
    require_once('loader.php');

    echo 'Sin funciones';
    $consulta2 = $conex->query("SELECT carritos.id FROM carritos INNER JOIN usuarios ON carritos.usuario_id = usuarios.id WHERE usuarios.email = 'jessica.galvan@hotmail.com'");
    $dato2 = $consulta2->fetch(PDO::FETCH_ASSOC);
    var_dump($dato2);

    $consulta = $conex->query("SELECT carritos.id FROM carritos INNER JOIN usuarios ON carritos.usuario_id = usuarios.id WHERE usuarios.email = 'harry@hotmail.com'");
    $dato = $consulta->fetch(PDO::FETCH_ASSOC);
    var_dump($dato);

    echo 'Con funciones';
    $prueba = $baseDatos->getCarrito_id('harry@hotmail.com');
    var_dump($prueba);

    $prueba2 = $baseDatos->getCarrito_id('jessica.galvan@hotmail.com');
    var_dump($prueba2);

    echo 'direccion';
    $prueba3 = $baseDatos->updateCarritoDireccion('jessica.galvan@hotmail.com', 'Hogwarts 1234');
    var_dump($prueba3);

    $prueba4 = $baseDatos->crearCarrito_Producto('')
 ?>
