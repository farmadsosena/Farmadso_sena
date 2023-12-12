    <div class="Modal-Ofertas">
        <div class="productos-container">
            <div class="opciones-vol-busc">
                <i class="bx bx-chevron-left bx-x" onclick="closeModalOfertas()"></i>
                <h3>Agregar ofertas a productos</h3>
            </div>
            <div class="cont_agg_oferta">
            <div class="form-edit-da form-da mostra-opcion-form-da">
                                        <div class="cont-input-select_Tocu cont-form-input">
                                            <section class="cont-form-da-Tocu cont-input-flex">
                                                <p>Tipo de asignación</p>
                                                <select id="form-da-Tocu" class="form-input">
                                                    <option value="reunion-corta">Reunion corta</option>
                                                    <option value="formacion">Formación</option>
                                                </select>
                                            </section>
                                        </div>
                                        <div class="cont-input-nomF-numF cont-form-input oculta-cont-input-form">
                                            <section class="cont-form-da-numF cont-input-flex">
                                                <input type="number" class="form-input input-enviar-form" id="form-da-numF" placeholder="Numero de ficha">
                                                <div class="cont-pro-ra-da">
                                                </div>
                                            </section>
                                            <section class="cont-form-da-nomF cont-input-flex">
                                                <input type="text" class="form-input input-enviar-form" id="form-da-nomF" placeholder="Nombre de formación">
                                            </section>
                                        </div>
                                        <div class="cont-input-motivo cont-form-input">
                                            <section class="cont-form-da-motivo cont-input-flex">
                                                <p>Ingresa un motivo corto</p>
                                                <textarea id="form-da-motivo" class="form-input input-enviar-form" placeholder="Motivo de asignación"></textarea>
                                            </section>
                                        </div>
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
                                                <p>Selecciona el horario para tu reserva</p>
                                                <select id="form-da-jornada" class="form-input input-enviar-form" style="border-color: rgb(189, 199, 216);">
                                                    <option value="1">Mañana</option>
                                                    <option value="2">Tarde</option>
                                                    <option value="3">Noche</option>
                                                    <option value="otra_jorna">Otro horario</option>
                                                </select>
                                            </section>
                                            <section class="cont-form-da-usua cont-input-flex">
                                                <p>Selecciona el usuario a que le quieres dar la reserva</p>
                                                <select id="form-da-usua" class="form-input input-enviar-form"><option class="admin_usua-formDa" value="2">Boris muñoz  // Admin</option></select>
                                            </section>
                                        </div>
                                        <div class="cont-input-horas cont-form-input">
                                            <section class="cont-form-da-horai cont-input-flex">
                                                <p>Hora de inicio</p>
                                                <input type="time" class="form-input input-enviar-form" placeholder="Hora a iniciar" id="form-da-horai" style="border-color: rgb(189, 199, 216);">
                                            </section>
                                            <section class="cont-form-da-horaf cont-input-flex">
                                                <p>Hora de fin</p>
                                                <input type="time" class="form-input input-enviar-form" placeholder="Hora a finalizar" id="form-da-horaf" style="border-color: rgb(189, 199, 216);">
                                            </section>
                                        </div>
                                    </div>
            <aside id="mostrar_produc_ofertas" style="display: flex;">
                <h4>Productos encontrados</h4>
                <dvi id="search">
                    <i class="bx bx-search" style="color:#c3bbbb"></i>
                    <input type="search" name="" id="searchBuscador" placeholder="Escribe palabras claves">
                    <section id="userContainer">
                        <div class="itemUser">
                            <img src="img/blanco.png" alt="">
                            <span class="info">
                                <p>LEIDY DAYANA TRUJILLO CUCHUMBE</p>
                                <a href="mailto:leydidayana2020@gmail.com">leydidayana2020@gmail.com</a>
                            </span>
                            <span class="info status">
                                <p>MAÑANA</p>
                                <p>EN FORMACION</p>
                            </span>
                        </div>
                    </section>
                </div>
            </aside>
            </div>
        </div>
    </div>