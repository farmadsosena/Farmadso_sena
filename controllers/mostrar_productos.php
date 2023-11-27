<?php

require_once "../config/Conexion.php";

$stmt = "";

if (isset($_GET['AsPZ'])) {
    $id_encriptado = $_GET['AsPZ'];
    $id_farmacia_tienda = base64_decode($id_encriptado);
    $stmt = $conexion->prepare("SELECT * FROM medicamentos 
    LEFT JOIN promocion ON promocion.id_medicamento = medicamentos.idmedicamento
    INNER JOIN farmacias ON farmacias.IdFarmacia = medicamentos.idfarmacia WHERE medicamentos.idfarmacia = ?");
    $stmt->bind_param("i", $id_farmacia_tienda);
} elseif (isset($_GET['ZjAPa'])) {
    $id_encriptado = $_GET['ZjAPa'];
    $id_categoria_tienda = base64_decode($id_encriptado);
    $stmt = $conexion->prepare("SELECT * FROM medicamentos 
    LEFT JOIN promocion ON promocion.id_medicamento = medicamentos.idmedicamento
    INNER JOIN farmacias ON farmacias.IdFarmacia = medicamentos.idfarmacia 
    INNER JOIN inventario ON inventario.idmedicamento = medicamentos.idmedicamento
    INNER JOIN categoria ON categoria.idcategoria = inventario.idcategoria
    WHERE categoria.idcategoria = ?");
    $stmt->bind_param("i", $id_categoria_tienda);
} else {
    $stmt = $conexion->prepare("SELECT * FROM medicamentos 
    LEFT JOIN promocion ON promocion.id_medicamento = medicamentos.idmedicamento
    INNER JOIN farmacias ON farmacias.IdFarmacia = medicamentos.idfarmacia
    INNER JOIN inventario ON inventario.idmedicamento = medicamentos.idmedicamento");
}
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($fila = $result->fetch_assoc()) {
        $id_medicamento = $fila['idmedicamento'];
        $precio_antes = $fila['precio'];
        $descuento = $fila['valordescuento'];
        $id_promocion = $fila["idpromocion"];

        $precio_actual = $precio_antes - ($precio_antes * ($descuento / 100));

        $precio_antes = number_format($precio_antes, 0, ',', '.');
        $precio_actual = number_format($precio_actual, 0, ',', '.');
        $id_ofuscado = base64_encode($id_medicamento);

        echo " <form class='cardProductoS' autocomplete='off'  method='post'>";

        if (isset($_SESSION['id'])) {
            echo "<input type='hidden' name='idusuario' value=" . $_SESSION["id"] . ">";
        } else {
            // Si  la sesión no está iniciada se envia el invitado
            echo "<input type='hidden' name='idinvitado' value=". $_SESSION['idinvitado'].">";
        }
        echo "<input type='hidden' name='idmedicamento' value=" . $fila['idmedicamento'] . ">";

        echo "<input type='hidden' name='precio' value=" . $precio_actual . ">";

        echo "<div class='top-product' data-im='$id_ofuscado'>";
        echo "<img src='../uploads/imgProductos/" . $fila['imagenprincipal'] . "' alt=''>";
        echo "<p>" . $fila['Nombre'] . "</p>";
        echo "<h3 class='card-description'>" . $fila['nombre'] . "</h3>";
        if (isset($id_promocion)) {
            echo "<p class='ahorro-top-product'>Antes $" . $precio_antes . "</p>";
            echo "<button class='muestra_ahorro'>Ahorra $descuento%</button>";
            echo "<h2>$" . $precio_actual . "</h2>";
        } else {
            echo "<h2>$" . $precio_antes . "</h2>";
        }

        echo "<input type='number' class='card-cantidad' name='cantidadcarrito' min='1' max='" . $fila["stock"] . "' value='1'>";
        echo "<input type='submit' name='comprar' value='comprar' class='comprar-tarje-comp'>";
        echo "</div>";
        echo "</form>";
    }
} else {
?>
    <div class="no_existen_productos">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" width="400" height="400" class="empty">
            <g class="empty_svg__animable empty_svg__animator-active" style="transform-origin: 227.87px 256.639px;">
                <path d="M130.36 194.26c-.88 2-1.85 4.16-2.7 6.27s-1.73 4.28-2.5 6.44a91.35 91.35 0 00-3.79 12.93l-.29 1.6-.1.6c0 .17 0 .39-.06.59a24.53 24.53 0 00.06 2.92c.19 2.11.53 4.37 1 6.63.84 4.53 1.91 9.2 3 13.8l-5.13 2a92.65 92.65 0 01-6.09-13.59 57 57 0 01-2.12-7.47 26.81 26.81 0 01-.56-4.26v-1.21c0-.43 0-.91.07-1.19l.2-2a63 63 0 011.37-7.65c.56-2.5 1.28-4.93 2-7.33s1.62-4.76 2.57-7.08c.47-1.16 1-2.31 1.46-3.46s1-2.25 1.64-3.48z" fill="#e4897b" class="empty_svg__animable" style="transform-origin: 120.72px 218.68px;"></path>
                <path d="M124.71 244.69l3.9 3.81-8.51 4s-2.06-3.61-.63-6.87z" fill="#e4897b" class="empty_svg__animable" style="transform-origin: 123.787px 248.595px;"></path>
                <path fill="#e4897b" d="M131.76 254.17l-7.19 2.94-4.46-4.65 8.5-3.96 3.15 5.67z" class="empty_svg__animable" style="transform-origin: 125.935px 252.805px;"></path>
                <path d="M277.41 250.07A72 72 0 11357 186.5a72 72 0 01-79.59 63.57z" fill="#fafafa" opacity=".4" class="empty_svg__animable" style="transform-origin: 285.444px 178.52px;"></path>
                <path d="M329.79 121.79l-109.5 87.49c-.46-1-.91-2-1.33-3a71.24 71.24 0 01-5.21-20.48l94.58-75.57a71.15 71.15 0 0121.46 11.56z" fill="#fafafa" opacity=".4" class="empty_svg__animable" style="transform-origin: 271.77px 159.755px;">
                </path>
                <path d="M355.06 160.12l-102.95 82.25a71.86 71.86 0 01-24.77-21.28l112.41-89.82a72 72 0 0115.31 28.85z" fill="#fafafa" opacity=".4" class="empty_svg__animable" style="transform-origin: 291.2px 186.82px;">
                </path>
                <path d="M204.39 151l-.95-.32a87.68 87.68 0 016.18-14.05l.87.48a86.93 86.93 0 00-6.1 13.89zm12.14-23.34l-.81-.59a86.7 86.7 0 0131.37-26.21l.45.9a85.74 85.74 0 00-31.01 25.93zm109.59-24.53A83.6 83.6 0 00316 98.54l.36-.94a85.62 85.62 0 0110.22 4.68z" fill="#407bff" class="empty_svg__animable" style="transform-origin: 265.01px 124.3px;"></path>
                <path d="M204.39 151l-.95-.32a87.68 87.68 0 016.18-14.05l.87.48a86.93 86.93 0 00-6.1 13.89zm12.14-23.34l-.81-.59a86.7 86.7 0 0131.37-26.21l.45.9a85.74 85.74 0 00-31.01 25.93zm109.59-24.53A83.6 83.6 0 00316 98.54l.36-.94a85.62 85.62 0 0110.22 4.68z" opacity=".3" class="empty_svg__animable" style="transform-origin: 265.01px 124.3px;"></path>
                <path d="M359.87 141.74a83 83 0 00-152.65 64.73c-6.68 2.34-13.28 4.85-19.84 7.44q-14.19 5.63-28.12 11.76c-9.28 4.11-18.52 8.3-27.67 12.68-4.59 2.15-9.12 4.42-13.69 6.62a19.79 19.79 0 00-6.34 4.35 19.15 19.15 0 00-2.57 3.37 17.25 17.25 0 00-2 4.63 12.72 12.72 0 007.33 14.85 17.56 17.56 0 004.86 1.26 18.88 18.88 0 004.25 0 19.76 19.76 0 007.3-2.39c4.53-2.29 9.09-4.5 13.59-6.85 9-4.59 18-9.38 26.89-14.24S189 240 197.68 234.78c6-3.63 12.06-7.34 18-11.22a83 83 0 00144.21-81.82zm-45.46 95.53a65.53 65.53 0 1129.75-87.78 65.53 65.53 0 01-29.75 87.78z" fill="#407bff" class="empty_svg__animable" style="transform-origin: 237.695px 184.169px;"></path>
                <path d="M359.87 141.74a83 83 0 00-152.65 64.73c-6.68 2.34-13.28 4.85-19.84 7.44q-14.19 5.63-28.12 11.76c-9.28 4.11-18.52 8.3-27.67 12.68-4.59 2.15-9.12 4.42-13.69 6.62a19.79 19.79 0 00-6.34 4.35 19.15 19.15 0 00-2.57 3.37 17.25 17.25 0 00-2 4.63 12.72 12.72 0 007.33 14.85 17.56 17.56 0 004.86 1.26 18.88 18.88 0 004.25 0 19.76 19.76 0 007.3-2.39c4.53-2.29 9.09-4.5 13.59-6.85 9-4.59 18-9.38 26.89-14.24S189 240 197.68 234.78c6-3.63 12.06-7.34 18-11.22a83 83 0 00144.21-81.82zm-45.46 95.53a65.53 65.53 0 1129.75-87.78 65.53 65.53 0 01-29.75 87.78z" opacity=".3" class="empty_svg__animable" style="transform-origin: 237.695px 184.169px;"></path>
                <path d="M158 158.55c0 .59.31 1.07.7 1.07s.7-.48.7-1.07-.31-1.07-.7-1.07-.7.52-.7 1.07z" fill="#263238" class="empty_svg__animable" style="transform-origin: 158.7px 158.55px;"></path>
                <path d="M158.28 159.62a21.33 21.33 0 002.83 5.07 3.41 3.41 0 01-2.83.53z" fill="#de5753" class="empty_svg__animable" style="transform-origin: 159.695px 162.473px;"></path>
                <path d="M155.93 155.26a.37.37 0 01-.29-.14.36.36 0 01.08-.49 3.43 3.43 0 013.13-.53.35.35 0 11-.25.65 2.73 2.73 0 00-2.47.45.36.36 0 01-.2.06z" fill="#263238" class="empty_svg__animable" style="transform-origin: 157.343px 154.596px;"></path>
                <path d="M137.8 163c1 5.37 2.1 15.22-1.66 18.81 0 0 1.47 5.45 11.46 5.45 11 0 5.24-5.45 5.24-5.45-6-1.44-5.83-5.88-4.79-10.06z" fill="#e4897b" class="empty_svg__animable" style="transform-origin: 145.244px 175.13px;"></path>
                <path d="M131.65 184.64c1.19-1.85-.81-6.34-.81-6.34s17.68-4.45 24.91 2.38c1.5 1.41-.16 3.49-.16 3.49z" fill="#407bff" class="empty_svg__animable" style="transform-origin: 143.609px 180.758px;"></path>
                <path d="M131.65 184.64c1.19-1.85-.81-6.34-.81-6.34s17.68-4.45 24.91 2.38c1.5 1.41-.16 3.49-.16 3.49z" opacity=".1" class="empty_svg__animable" style="transform-origin: 143.609px 180.758px;"></path>
                <path d="M102.4 388.67c-.93 0-2.42-1.55-2.86-2.13a.17.17 0 010-.19.18.18 0 01.16-.09c.11 0 2.56.22 3.23 1.09a.81.81 0 01.16.66.72.72 0 01-.52.65zm-2.32-2c.73.84 1.9 1.79 2.4 1.67 0 0 .2-.05.26-.37a.45.45 0 00-.1-.38 4.67 4.67 0 00-2.56-.94z" fill="#407bff" class="empty_svg__animable" style="transform-origin: 101.308px 387.465px;"></path>
                <path d="M100.19 386.65a2.68 2.68 0 01-.54 0 .16.16 0 01-.14-.11.2.2 0 010-.18c.07-.06 1.54-1.59 2.65-1.59a.94.94 0 01.71.3.57.57 0 01.14.7c-.29.56-1.82.88-2.82.88zm-.13-.35c1 0 2.45-.31 2.69-.75 0 0 .07-.13-.09-.29a.59.59 0 00-.46-.19 4.23 4.23 0 00-2.14 1.23z" fill="#407bff" class="empty_svg__animable" style="transform-origin: 101.281px 385.717px;"></path>
                <path d="M168.39 411.37a13.25 13.25 0 01-2.26-.21.16.16 0 01-.13-.16.18.18 0 01.08-.18c.11-.06 2.67-1.53 3.9-1.19a.86.86 0 01.55.4.66.66 0 010 .76c-.29.45-1.2.58-2.14.58zm-1.69-.47c1.36.2 3.22.19 3.56-.29.05-.06.09-.17 0-.38a.56.56 0 00-.34-.25c-.78-.2-2.33.46-3.22.92z" fill="#407bff" class="empty_svg__animable" style="transform-origin: 168.324px 410.475px;"></path>
                <path d="M166.17 411.17a.18.18 0 01-.1 0 .16.16 0 01-.07-.17 4.88 4.88 0 011.14-2.83 1.25 1.25 0 011-.29c.48 0 .62.29.65.48.13.83-1.62 2.42-2.51 2.82zm1.79-3a.91.91 0 00-.6.22 4 4 0 00-1 2.27c.9-.55 2.1-1.79 2-2.29 0 0 0-.17-.34-.2z" fill="#407bff" class="empty_svg__animable" style="transform-origin: 167.396px 409.523px;"></path>
                <path fill="#e4897b" d="M158.09 410.99h7.35l.73-17.01h-7.35l-.73 17.01z" class="empty_svg__animable" style="transform-origin: 162.13px 402.485px;"></path>
                <path fill="#e4897b" d="M92.64 381.79l6.14 4.02 13.56-11.45-6.15-4.03-13.55 11.46z" class="empty_svg__animable" style="transform-origin: 102.49px 378.07px;"></path>
                <path d="M99.79 385.43l-6.38-5.23a.63.63 0 00-.8 0l-5.26 4.13a1.08 1.08 0 000 1.69c2.26 1.79 3.45 2.55 6.26 4.85 1.73 1.41 6 5.73 8.41 7.68s4.62-.15 3.82-1.16c-3.59-4.55-5-8.44-5.41-10.85a1.81 1.81 0 00-.64-1.11z" fill="#263238" class="empty_svg__animable" style="transform-origin: 96.4747px 389.704px;"></path>
                <path d="M165.39 410.14h-8a.65.65 0 00-.63.5l-1.45 6.53a1.07 1.07 0 001.06 1.31c2.89-.05 7.07-.22 10.71-.22 4.25 0 7.93.23 12.91.23 3 0 3.86-3.05 2.59-3.32-5.74-1.26-10.44-1.39-15.4-4.46a3.44 3.44 0 00-1.79-.57z" fill="#263238" class="empty_svg__animable" style="transform-origin: 169.215px 414.315px;"></path>
                <path d="M121.66 184c-6.37 3-10 23.1-10 23.1l15.57 6.21a115.83 115.83 0 005.51-17.15c2.14-9.26-4.56-15.26-11.08-12.16z" fill="#263238" class="empty_svg__animable" style="transform-origin: 122.403px 198.243px;"></path>
                <path d="M129.92 195.33c-3.85 3.9-5.61 11.54-6.38 16.51l3.73 1.49a116.7 116.7 0 005.4-16.65c-.33-2.12-1.15-2.97-2.75-1.35z" fill="#203048" class="empty_svg__animable" style="transform-origin: 128.105px 203.907px;"></path>
                <path d="M164.14 183.86s7.82 8.84.44 63.5h-39.29c-.27-6 3.52-35.45-2.3-63.87a100.56 100.56 0 0113.15-1.66 140.87 140.87 0 0116.7 0 74.19 74.19 0 0111.3 2.03z" fill="#263238" class="empty_svg__animable" style="transform-origin: 145.37px 214.471px;"></path>
                <path d="M167.73 205.08l-6.62-11.41a58.31 58.31 0 00-1.55 16.27c.18 3.92 3.77 18.44 7 20.56a230.84 230.84 0 001.17-25.42z" fill="#203048" class="empty_svg__animable" style="transform-origin: 163.619px 212.085px;"></path>
                <path d="M168.65 191.67c1 4.86 2 9.84 3.07 14.72s2.18 9.78 3.47 14.51c.33 1.17.64 2.37 1 3.49l.27.86.13.43v-.05c-.07-.09-.15-.1-.09 0a3.35 3.35 0 001.52.95 17.84 17.84 0 002.91.81 77.79 77.79 0 0014.3.93l.95 5.44c-1.34.43-2.59.74-3.91 1.05s-2.62.57-3.95.77a42.73 42.73 0 01-8.33.56 22.61 22.61 0 01-4.6-.6 13.39 13.39 0 01-5.28-2.45 9.65 9.65 0 01-2.47-3c-.16-.3-.3-.64-.43-.93l-.18-.47-.37-1c-.51-1.27-.93-2.52-1.39-3.77-1.69-5-3.1-10.05-4.34-15.09s-2.31-10.07-3.2-15.24z" fill="#e4897b" class="empty_svg__animable" style="transform-origin: 176.955px 213.915px;"></path>
                <path d="M154.33 189.22c-2.07 6.71 6.32 26.72 6.32 26.72l16.71-4.2s-.64-10.4-4.45-18.65c-5.74-12.44-16.1-11.92-18.58-3.87z" fill="#263238" class="empty_svg__animable" style="transform-origin: 165.681px 199.68px;"></path>
                <path d="M195.09 228.32l8.32-.21-4 8.66s-3.39.45-6.17-4.12l-2.93-3.5 3.37-.67a7.52 7.52 0 011.41-.16z" fill="#e4897b" class="empty_svg__animable" style="transform-origin: 196.86px 232.446px;"></path>
                <path fill="#e4897b" d="M208.66 229.72l-4.76 7.18-4.49-.13 4-8.66 5.25 1.61z" class="empty_svg__animable" style="transform-origin: 204.035px 232.505px;"></path>
                <path fill="#ce6f64" d="M166.17 393.98l-.38 8.77h-7.35l.38-8.77h7.35z" class="empty_svg__animable" style="transform-origin: 162.305px 398.365px;"></path>
                <path fill="#ce6f64" d="M106.19 370.33l6.15 4.03-7 5.9-6.14-4.02 6.99-5.91z" class="empty_svg__animable" style="transform-origin: 105.77px 375.295px;"></path>
                <path d="M138.26 157.28c.44 7.27.33 11.56 4 15.29 5.52 5.63 14.51 2.3 16.25-5 1.57-6.54.59-17.34-6.53-20.24a10 10 0 00-13.72 9.95z" fill="#e4897b" class="empty_svg__animable" style="transform-origin: 148.696px 161.003px;"></path>
                <path d="M129.7 156c1.81 6.63 6.07 14.27 11.58 14.76 6.84.6 9.93-6.47 10.83-13.77 4.1-2.81 1.95-5.9 6.06-6.29 5.28-.5 3.59-10.16-3.36-11.71 0 0 2.33 4.35-2.56 2.15a28.22 28.22 0 00-14.94-2.59s6.24 3.12.14 4.51-7.92 5.15-5.11 7.42c0 .01-3.83 1.16-2.64 5.52z" fill="#263238" class="empty_svg__animable" style="transform-origin: 145.37px 154.602px;"></path>
                <path d="M147.94 158.49a8.22 8.22 0 002.07 4.87c1.6 1.77 3.27.67 3.55-1.48.26-1.93-.27-5.18-2.23-6.16s-3.52.59-3.39 2.77z" fill="#e4897b" class="empty_svg__animable" style="transform-origin: 150.777px 159.832px;"></path>
                <path d="M150.64 247.36s7.16 51.85 1.52 72.63c-8.94 32.9-43.12 60.67-43.12 60.67l-11.59-7.6s29.11-23.45 32.67-51c3.2-24.73-4.83-54.64-4.83-74.71z" fill="#407bff" class="empty_svg__animable" style="transform-origin: 125.888px 314.005px;"></path>
                <path d="M150.64 247.36s7.16 51.85 1.52 72.63c-8.94 32.9-43.12 60.67-43.12 60.67l-11.59-7.6s29.11-23.45 32.67-51c3.2-24.73-4.83-54.64-4.83-74.71z" opacity=".1" class="empty_svg__animable" style="transform-origin: 125.888px 314.005px;"></path>
                <path d="M153.6 277a48.4 48.4 0 00-6.27-6c1.22 16.83 2.22 41.76 1.11 59.47a76.41 76.41 0 003.72-10.47c2.75-10.15 2.46-27.68 1.44-43z" fill="#407bff" class="empty_svg__animable" style="transform-origin: 150.829px 300.735px;"></path>
                <path d="M153.6 277a48.4 48.4 0 00-6.27-6c1.22 16.83 2.22 41.76 1.11 59.47a76.41 76.41 0 003.72-10.47c2.75-10.15 2.46-27.68 1.44-43z" opacity=".3" class="empty_svg__animable" style="transform-origin: 150.829px 300.735px;"></path>
                <path d="M113.71 378.07c.05 0-4.49 3-4.49 3l-12.66-8.3 4-3.31z" fill="#407bff" class="empty_svg__animable" style="transform-origin: 105.135px 375.265px;"></path>
                <path d="M113.71 378.07c.05 0-4.49 3-4.49 3l-12.66-8.3 4-3.31z" opacity=".3" class="empty_svg__animable" style="transform-origin: 105.135px 375.265px;"></path>
                <path d="M164.58 247.36s11.06 46.9 11.84 69.31c.88 25.12-7.89 84.38-7.89 84.38h-12.45s-1.53-59.72-2.08-82.6c-.61-24.95-15.25-71.09-15.25-71.09z" fill="#407bff" class="empty_svg__animable" style="transform-origin: 157.616px 324.205px;"></path>
                <path d="M164.58 247.36s11.06 46.9 11.84 69.31c.88 25.12-7.89 84.38-7.89 84.38h-12.45s-1.53-59.72-2.08-82.6c-.61-24.95-15.25-71.09-15.25-71.09z" opacity=".1" class="empty_svg__animable" style="transform-origin: 157.616px 324.205px;"></path>
                <path d="M170.92 396.1c.06 0-.7 5.16-.7 5.16h-15.14l-.41-4.61z" fill="#407bff" class="empty_svg__animable" style="transform-origin: 162.797px 398.68px;"></path>
                <path d="M170.92 396.1c.06 0-.7 5.16-.7 5.16h-15.14l-.41-4.61z" opacity=".3" class="empty_svg__animable" style="transform-origin: 162.797px 398.68px;"></path>
            </g>
            <g data-name="Character" class="empty_svg__animable" style="transform-origin: 337.551px 287.938px;">
                <path d="M356 202.29c.85.8 1.52 1.48 2.22 2.24s1.36 1.5 2 2.27c1.3 1.53 2.52 3.14 3.7 4.76a76.27 76.27 0 016.27 10.26l.37.73a7.05 7.05 0 01.45 1.1 9.12 9.12 0 01.44 2.26 11 11 0 01-.55 4 20.16 20.16 0 01-3.21 5.92 42.68 42.68 0 01-8.8 8.46l-2.49-2.86c1.17-1.37 2.39-2.84 3.48-4.31a36.76 36.76 0 003-4.5 15.63 15.63 0 001.82-4.42 4.58 4.58 0 00.07-1.7 2.22 2.22 0 00-.18-.55 1.59 1.59 0 00-.13-.22l-.32-.54a105.06 105.06 0 00-6.27-9.11c-1.11-1.47-2.3-2.88-3.5-4.27-.59-.7-1.2-1.38-1.81-2.06s-1.27-1.36-1.8-1.89z" fill="#e4897b" class="empty_svg__animable" style="transform-origin: 361.111px 223.29px;"></path>
                <path d="M357.36 240.59l-7.47-1.22 3.91 6.54s4.81-.17 6.18-3z" fill="#e4897b" class="empty_svg__animable" style="transform-origin: 354.935px 242.64px;"></path>
                <path fill="#e4897b" d="M344.37 242.39l3.56 5.31 5.87-1.79-3.91-6.54-5.52 3.02z" class="empty_svg__animable" style="transform-origin: 349.085px 243.535px;"></path>
                <path d="M357 411.28a2.15 2.15 0 01-1.43-.39 1 1 0 01-.29-.94.59.59 0 01.35-.5c.87-.39 3.15 1.07 3.41 1.24a.16.16 0 01.07.18.16.16 0 01-.13.14 8.85 8.85 0 01-1.98.27zm-1-1.55a.72.72 0 00-.22 0 .26.26 0 00-.15.23.67.67 0 00.18.63c.38.34 1.36.39 2.67.13a6.59 6.59 0 00-2.48-.99z" fill="#407bff" class="empty_svg__animable" style="transform-origin: 357.187px 410.336px;"></path>
                <path d="M359 411h-.09c-.71-.41-2.08-2-1.91-2.87a.65.65 0 01.6-.5.9.9 0 01.75.24c.82.72.83 2.88.83 3a.19.19 0 01-.09.15zm-1.28-3h-.08c-.22 0-.27.12-.29.21-.1.51.75 1.73 1.46 2.3a4.09 4.09 0 00-.69-2.36.57.57 0 00-.45-.15z" fill="#407bff" class="empty_svg__animable" style="transform-origin: 358.083px 409.32px;"></path>
                <path d="M322.92 411.28a2.77 2.77 0 01-1.81-.46 1 1 0 01-.33-.86.58.58 0 01.3-.47c.93-.52 3.91 1 4.25 1.19a.2.2 0 01.09.19.17.17 0 01-.14.14 12.47 12.47 0 01-2.36.27zm-1.33-1.55a.62.62 0 00-.33.07.21.21 0 00-.12.19.65.65 0 00.2.57c.46.41 1.69.48 3.35.2a9.73 9.73 0 00-3.1-1.03z" fill="#407bff" class="empty_svg__animable" style="transform-origin: 323.097px 410.337px;"></path>
                <path d="M325.25 411h-.08c-.89-.4-2.66-2-2.52-2.87 0-.2.18-.45.67-.5a1.32 1.32 0 011 .31c.94.78 1.12 2.8 1.12 2.89a.17.17 0 01-.07.16.19.19 0 01-.12.01zm-1.79-3h-.11c-.32 0-.34.16-.35.2-.08.51 1.12 1.78 2 2.33a4.16 4.16 0 00-1-2.31.93.93 0 00-.54-.22z" fill="#407bff" class="empty_svg__animable" style="transform-origin: 324.042px 409.314px;"></path>
                <path d="M337.07 179.3c-.29 4.52-1.07 13.7 2.4 16.24 0 0-.63 4.63-8.82 5.71-9 1.17-4.89-3.91-4.89-3.91 4.77-1.82 4.16-5.45 2.86-8.77z" fill="#e4897b" class="empty_svg__animable" style="transform-origin: 332.147px 190.363px;"></path>
                <path d="M318.44 171.31a.34.34 0 01-.26-.12 2.83 2.83 0 00-2.35-1 .35.35 0 01-.41-.3.36.36 0 01.31-.4 3.51 3.51 0 013 1.26.36.36 0 01-.27.59z" fill="#263238" class="empty_svg__animable" style="transform-origin: 317.115px 170.409px;"></path>
                <path d="M316.88 175.74a16.28 16.28 0 01-1.63 4.1 2.58 2.58 0 002.19.12z" fill="#de5753" class="empty_svg__animable" style="transform-origin: 316.345px 177.944px;"></path>
                <path d="M317.28 174.64c.08.6-.17 1.12-.56 1.18s-.78-.4-.85-1 .17-1.12.56-1.17.78.35.85.99z" fill="#263238" class="empty_svg__animable" style="transform-origin: 316.576px 174.736px;"></path>
                <path d="M316.61 173.66l-1.49-.23s.88 1.03 1.49.23z" fill="#263238" class="empty_svg__animable" style="transform-origin: 315.865px 173.697px;"></path>
                <path fill="#e4897b" d="M333.49 410.84h-7.5l-.5-17.35h7.5l.5 17.35z" class="empty_svg__animable" style="transform-origin: 329.49px 402.165px;"></path>
                <path fill="#e4897b" d="M367.54 410.84h-7.5l-2.41-17.35h7.5l2.41 17.35z" class="empty_svg__animable" style="transform-origin: 362.585px 402.165px;"></path>
                <path d="M359.58 410H368a.59.59 0 01.59.51l1 6.67a1.2 1.2 0 01-1.2 1.33c-2.93-.05-4.35-.22-8.05-.22-2.28 0-5.61.23-8.75.23s-3.31-3.11-2-3.39c5.87-1.26 6.8-3 8.77-4.67a2 2 0 011.22-.46z" fill="#263238" class="empty_svg__animable" style="transform-origin: 359.208px 414.26px;"></path>
                <path d="M325.74 410h8.41a.6.6 0 01.6.51l1 6.67a1.2 1.2 0 01-1.2 1.33c-2.93-.05-4.35-.22-8.05-.22-2.28 0-7 .23-10.14.23s-3.31-3.11-2-3.39c5.87-1.26 8.18-3 10.16-4.67a2 2 0 011.22-.46z" fill="#263238" class="empty_svg__animable" style="transform-origin: 324.673px 414.26px;"></path>
                <path fill="#ce6f64" d="M325.49 393.49l.26 8.95h7.5l-.26-8.95h-7.5z" class="empty_svg__animable" style="transform-origin: 329.37px 397.965px;"></path>
                <path fill="#ce6f64" d="M365.13 393.49h-7.5l1.25 8.95h7.49l-1.24-8.95z" class="empty_svg__animable" style="transform-origin: 362px 397.965px;"></path>
                <path d="M337.17 169.94c.51 7.42.88 10.55-2.34 14.82-4.85 6.41-14.07 5.42-16.79-1.7-2.45-6.41-2.87-17.46 3.95-21.34a10.15 10.15 0 0115.18 8.22z" fill="#e4897b" class="empty_svg__animable" style="transform-origin: 326.957px 174.705px;"></path>
                <path d="M341.49 176.83c4.16 2.32 7.25-3.4 7.25-3.4s-7.46.81-6.79-3.63c.88-5.89-3.34-13.05-13.92-12.13-.59.05-1.15.12-1.7.21a5.44 5.44 0 00-6.58 1.52c-3 .25-7.05 3.83-4.3 8.56a4.35 4.35 0 01.88-1.47c.23 2.77 2.65 7.17 5.67 7.46.65 3.79-1.87 8.18-1 12.14 1.29 5.71 10.92 7 10.92 7a4.17 4.17 0 01.56-4.41c6.54 3 10.85.07 10.85.07-4.46-1.66-3.11-4.62-3.11-4.62a6.51 6.51 0 008.49-3.09 7.68 7.68 0 01-7.22-4.21z" fill="#263238" class="empty_svg__animable" style="transform-origin: 331.638px 175.223px;"></path>
                <path d="M324.61 175.09a5.4 5.4 0 01-1.5 3.87c-1.32 1.37-2.94.41-3.38-1.34-.39-1.58-.17-4.19 1.55-4.91a2.44 2.44 0 013.33 2.38z" fill="#e4897b" class="empty_svg__animable" style="transform-origin: 322.089px 176.076px;"></path>
                <path d="M330.84 244.22s1.9 49.36 6.42 78.34c3.64 23.42 19.81 78.14 19.81 78.14h10.22s-8.43-52.85-10.28-76c-4.68-58.59 7.47-71.17-4-83.37z" fill="#263238" class="empty_svg__animable" style="transform-origin: 349.065px 321.015px;"></path>
                <path d="M339.38 259.83s-4.62-.8-7.32 8c1 16.67 2.71 38.79 5.2 54.73.55 3.55 1.39 7.83 2.42 12.52-1.95-28.16-.3-75.25-.3-75.25z" fill="#161f33" class="empty_svg__animable" style="transform-origin: 335.87px 297.446px;"></path>
                <path d="M322.87 245.26s-8.42 54.61-7.93 77.46c.51 23.77 9.22 78 9.22 78h10.13s-1.6-52.82-.71-76.16c1-25.45 11.39-82.17 11.39-82.17z" fill="#263238" class="empty_svg__animable" style="transform-origin: 329.945px 321.555px;"></path>
                <path fill="#407bff" d="M368.77 401.18h-13.59l-1.06-4.56 14.55.1.1 4.46z" class="empty_svg__animable" style="transform-origin: 361.445px 398.9px;"></path>
                <path opacity=".2" d="M368.77 401.18h-13.59l-1.06-4.56 14.55.1.1 4.46z" class="empty_svg__animable" style="transform-origin: 361.445px 398.9px;"></path>
                <path d="M352.5 195.55c3.91.38 9.85 11.49 9.85 11.49l-9.87 7.57s-8.17-7.17-7.2-11.2c1.01-4.19 3.47-8.21 7.22-7.86z" fill="#407bff" class="empty_svg__animable" style="transform-origin: 353.775px 205.069px;"></path>
                <path d="M352.5 195.55c3.91.38 9.85 11.49 9.85 11.49l-9.87 7.57s-8.17-7.17-7.2-11.2c1.01-4.19 3.47-8.21 7.22-7.86z" opacity=".1" class="empty_svg__animable" style="transform-origin: 353.775px 205.069px;"></path>
                <path d="M349.55 200.33a10.13 10.13 0 00-3.06-.34 16.91 16.91 0 00-1.21 3.42c-1 4 7.2 11.2 7.2 11.2l.73-.56z" fill="#407bff" class="empty_svg__animable" style="transform-origin: 349.203px 207.296px;"></path>
                <path d="M349.55 200.33a10.13 10.13 0 00-3.06-.34 16.91 16.91 0 00-1.21 3.42c-1 4 7.2 11.2 7.2 11.2l.73-.56z" opacity=".3" class="empty_svg__animable" style="transform-origin: 349.203px 207.296px;"></path>
                <path d="M319.52 211c-2.85 7.21-5.85 14.54-8.24 21.77-.16.46-.29.9-.43 1.35l-.34 1.11a1.83 1.83 0 000 1 7.52 7.52 0 002.59 3.1 42.19 42.19 0 009.69 5.19l-.9 3.68a34.69 34.69 0 01-12.08-3.94 12.93 12.93 0 01-5.39-5.46 8.37 8.37 0 01-.69-4.76 5.58 5.58 0 01.1-.59l.1-.42.17-.76c.12-.51.24-1 .37-1.5 1-4 2.28-7.8 3.63-11.57s2.76-7.49 4.35-11.2z" fill="#e4897b" class="empty_svg__animable" style="transform-origin: 313.215px 228.1px;"></path>
                <path d="M313.45 200.88s-3.38 1.71 9.42 44.38l30.18-3.94c-2.12-12.22-3.12-19.79-.55-45.77a91 91 0 00-13 0 95.5 95.5 0 00-13.71 1.8c-5.79 1.29-12.34 3.53-12.34 3.53z" fill="#407bff" class="empty_svg__animable" style="transform-origin: 333.048px 220.289px;"></path>
                <path d="M313.45 200.88s-3.38 1.71 9.42 44.38l30.18-3.94c-2.12-12.22-3.12-19.79-.55-45.77a91 91 0 00-13 0 95.5 95.5 0 00-13.71 1.8c-5.79 1.29-12.34 3.53-12.34 3.53z" opacity=".1" class="empty_svg__animable" style="transform-origin: 333.048px 220.289px;"></path>
                <path d="M353.27 239.49L355 242c.13.2-.09.44-.43.49l-31.65 4.14c-.27 0-.52-.07-.56-.24l-.62-2.67c-.05-.18.17-.37.47-.41l30.56-4a.55.55 0 01.5.18z" fill="#407bff" class="empty_svg__animable" style="transform-origin: 338.385px 242.967px;"></path>
                <path d="M353.27 239.49L355 242c.13.2-.09.44-.43.49l-31.65 4.14c-.27 0-.52-.07-.56-.24l-.62-2.67c-.05-.18.17-.37.47-.41l30.56-4a.55.55 0 01.5.18z" opacity=".2" class="empty_svg__animable" style="transform-origin: 338.385px 242.967px;"></path>
                <path d="M349.61 243.44l.82-.11c.16 0 .27-.12.25-.22l-.84-3.46a.29.29 0 00-.34-.14l-.82.1c-.17 0-.28.12-.25.23l.84 3.45c.02.11.18.17.34.15z" fill="#263238" class="empty_svg__animable" style="transform-origin: 349.554px 241.471px;"></path>
                <path d="M329.77 246l.82-.11c.16 0 .28-.12.25-.22l-.84-3.46a.31.31 0 00-.34-.15l-.82.11c-.16 0-.28.12-.25.22l.84 3.46c.02.15.18.21.34.15z" fill="#263238" class="empty_svg__animable" style="transform-origin: 329.715px 244.038px;"></path>
                <path d="M314.86 215.36c.83 3.86 2 8.75 3.71 14.94l.37-15.69z" fill="#407bff" class="empty_svg__animable" style="transform-origin: 316.9px 222.455px;"></path>
                <path d="M314.86 215.36c.83 3.86 2 8.75 3.71 14.94l.37-15.69z" opacity=".3" class="empty_svg__animable" style="transform-origin: 316.9px 222.455px;"></path>
                <path d="M313.45 200.88c-3.75 1.51-7 14.34-7 14.34l12.9 6.28s6.23-15.69 3.44-18.75-5.02-3.6-9.34-1.87z" fill="#407bff" class="empty_svg__animable" style="transform-origin: 314.979px 210.702px;"></path>
                <path d="M313.45 200.88c-3.75 1.51-7 14.34-7 14.34l12.9 6.28s6.23-15.69 3.44-18.75-5.02-3.6-9.34-1.87z" opacity=".1" class="empty_svg__animable" style="transform-origin: 314.979px 210.702px;"></path>
                <path fill="#407bff" d="M336.02 401.18h-13.59l-1.06-4.56 15.13.1-.48 4.46z" class="empty_svg__animable" style="transform-origin: 328.935px 398.9px;"></path>
                <path opacity=".2" d="M336.02 401.18h-13.59l-1.06-4.56 15.13.1-.48 4.46z" class="empty_svg__animable" style="transform-origin: 328.935px 398.9px;"></path>
                <path d="M323 243.28l-1.09-.45a1.64 1.64 0 00-2.24 1.76l.79 5.21a1.78 1.78 0 002.36 1.42 4 4 0 001.1-.61 3 3 0 001.08-2.48l-.11-2.16a3 3 0 00-1.89-2.69z" fill="#e4897b" class="empty_svg__animable" style="transform-origin: 322.329px 247.016px;"></path>
            </g>
            <defs>
                <filter id="empty_svg__active" height="200%">
                    <feMorphology in="SourceAlpha" result="DILATED" operator="dilate" radius="2"></feMorphology>
                    <feFlood flood-color="#32DFEC" flood-opacity="1" result="PINK"></feFlood>
                    <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>
                    <feMerge>
                        <feMergeNode in="OUTLINE"></feMergeNode>
                        <feMergeNode in="SourceGraphic"></feMergeNode>
                    </feMerge>
                </filter>
                <filter id="empty_svg__hover" height="200%">
                    <feMorphology in="SourceAlpha" result="DILATED" operator="dilate" radius="2"></feMorphology>
                    <feFlood flood-color="red" flood-opacity=".5" result="PINK"></feFlood>
                    <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>
                    <feMerge>
                        <feMergeNode in="OUTLINE"></feMergeNode>
                        <feMergeNode in="SourceGraphic"></feMergeNode>
                    </feMerge>
                    <feColorMatrix values="0 0 0 0 0 0 1 0 0 0 0 0 0 0 0 0 0 0 1 0"></feColorMatrix>
                </filter>
            </defs>
        </svg>
        <h1>No exiten productos</h1>
    </div>
<?php
}
