<?php //require_once "../config/Conexion.php"; 
?>
<div class="Modal-Ofertas">
    <div class="productos-container">
        <div class="opciones-vol-busc">
            <i class="bx bx-chevron-left bx-x" onclick="closeModalOfertas()"></i>
            <h3>Agregar ofertas a productos</h3>
        </div>
        <div class="cont_agg_oferta">
            <form method="POST" class="form-edit-da form-da mostra-opcion-form-da">
                <div class="cont-input-fechas cont-form-input">
                    <section class="cont-form-da-fechai cont-input-flex">
                        <p>Fecha de inicio</p>
                        <input type="date" placeholder="Fecha de inicio" class="form-input input-enviar-form" id="form-da-fechai" style="border-color: rgb(189, 199, 216);">
                    </section>
                    <section class="cont-form-da-fechaf cont-input-flex">
                        <p>Fecha de fin</p>
                        <input type="date" placeholder="Fecha de fin" class="form-input input-enviar-form" id="form-da-fechaf" style="border-color: rgb(189, 199, 216);">
                    </section>
                </div>
                <div class="cont-input-jornadas-usuario cont-form-input">
                    <section class="cont-form-da-jornada cont-input-flex">
                        <p>Ingrese el porcentaje de descuento</p>
                        <div class="cont_valordescuento">
                            <input type="number" name="valordescuento" class="valordescuento" min="1" max="100"> <span>%</span>
                        </div>
                    </section>
                </div>
                <div class="cont_btn_io cont-form-input">
                    <button class="inertar_ofertas" type="submit">Agregar oferta</button>
                </div>
            </form>
            <aside id="mostrar_produc_ofertas" style="display: flex;">
                <h4>Productos encontrados</h4>
                <dvi id="search">
                    <i class="bx bx-search" style="color:#c3bbbb"></i>
                    <input type="search" name="" id="searchBuscador" placeholder="Escribe palabras claves">
                    <section id="userContainer">
                        <?php
                        $stmt_prev = $conexion->prepare("SELECT * FROM medicamentos 
                                LEFT JOIN promocion ON promocion.id_medicamento = medicamentos.idmedicamento
                                INNER JOIN farmacias ON farmacias.IdFarmacia = medicamentos.idfarmacia
                                INNER JOIN inventario ON inventario.idmedicamento = medicamentos.idmedicamento
                                LIMIT 5");

                        $stmt_prev->execute();

                        $result_prev = $stmt_prev->get_result();

                        if ($result_prev->num_rows > 0) {
                            while ($fila_prev = $result_prev->fetch_assoc()) {
                                $precio = number_format($fila_prev["precio"], 0, ',', '.');
                        ?>
                                <div class="itemUser">
                                    <input type="checkbox" name="check_selec_medi">
                                    <img src="../uploads/imgProductos/<?php echo $fila_prev["imagenprincipal"] ?>" alt="<?php echo $fila_prev["nombre"] ?>">
                                    <span class="info">
                                        <p><?php echo $fila_prev["nombre"] ?></p>
                                        <p><?php echo $fila_prev["Nombre"] ?></p>
                                    </span>
                                    <span class="info status">
                                        <p><?php echo $fila_prev["codigo"] ?></p>
                                        <p><?php echo $precio ?></p>
                                    </span>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </section>
                      
        </div>
        </aside>
    </div>
</div>
</div>