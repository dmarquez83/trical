/**
 * Created by dmarquez on 19/09/16.
 */
$(document).ready(function(){
//alert('Documento listo');
    $('.btn-delete').click(function(){
        var row = $(this).parents('tr');
        var id = row.data('id');
        var form = $('#form-delete');
        var url = form.attr('action').replace(':USER_ID',id);
        //serializamos el formulario
        var data = form.serialize();

        row.fadeOut(); //desaparecer la fila antes de enivar la peticion ajax

        $.post(url, data, function (result) {
            alert(result.message);
        }).fail(function(){
            alert('El usuario no fue Eliminado');
            row.show();
        });

    });
});