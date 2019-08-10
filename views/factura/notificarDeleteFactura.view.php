<div id="notificarDeleteFactura" class="modal">
    <form id="frmDeleteF" action="">
        <div class="modal-header red darken-1 white-text">
            <h5 class="mt-none mb-none">Peticion para eliminar Factura</h5>
            <i class="material-icons modal-close">close</i>
        </div>
        <div class="modal-content">
            <div class="row">
                <input type="hidden" id="numeFactDeleNoti" name="numeQuedDeleNoti">
                <input type="hidden" id="deleteFactura" name="deleteFactura" value="x">
                <p>¿Desea enviar una notificacion a su administrador para que elimine el siguiente registro?</p>
                <p><b>Nota: </b>Las acciones de eliminar solo las puede realizar el administrador encargado del sitio de cada casa, por lo que se le enviara una notificacion(al administrador) donde se le pedira que se elimine el quedan, una vez eliminado se le notificara que el registro ha sido eliminado</p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="modal-close waves-effect btn-flat">Cancelar</button>
            <button type="button" class="waves-effect waves-green btn red darken-1" onclick="notificarDeleteFactura();">Eliminar</button>
        </div>
    </form>
</div>