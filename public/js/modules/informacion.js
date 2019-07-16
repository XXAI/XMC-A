function enviarFormulario(){
    var parametros = $("#form-info").serialize();
    limpiarErroresFormulario();
    
    if(!$('#id').val()){
        $.post('info', parametros, function(data){
            console.log(data);
            if(data.validacion){
                $('#id').val(data.datos.id);
                $('#btn-guardar').html('<i class="fas fa-save"></i> Actualizar');
                $('#btn-continuar').show();
            }else{
                for(var i in data.errores){
                    var errores = data.errores[i].join('<br>');
                    $('#'+i).addClass('is-invalid');
                    $('#error_'+i).text(errores);
                }
            }
        });
    }else{
        $.put('info/'+$('#id').val(),parametros, function(data){
            console.log(data);
            if(data.validacion){
                //
            }else{
                for(var i in data.errores){
                    var errores = data.errores[i].join('<br>');
                    $('#'+i).addClass('is-invalid');
                    $('#error_'+i).text(errores);
                }
            }
        });
    }
}

function limpiarErroresFormulario(){
    $('#form-info .is-invalid').removeClass('is-invalid');
    $('#form-info .invalid-feedback').text('');
}

function limpiarFormulario(){
    $('#form-info').trigger('reset');
    limpiarErroresFormulario();
}

window.onload = function () { 
    if($('#id').val()){
        $('#btn-guardar').html('<i class="fas fa-save"></i> Actualizar');
        $('#btn-continuar').show();
    }else{
        $('#btn-continuar').hide();
    }
}

//Agregamos shortcuts para put y delete en las llamadas ajax de jquery
jQuery.each( [ "put", "delete" ], function( i, method ) {
    jQuery[ method ] = function( url, data, callback, type ) {
      if ( jQuery.isFunction( data ) ) {
        type = type || callback;
        callback = data;
        data = undefined;
      }
   
      return jQuery.ajax({
        url: url,
        type: method,
        dataType: type,
        data: data,
        success: callback
      });
    };
});