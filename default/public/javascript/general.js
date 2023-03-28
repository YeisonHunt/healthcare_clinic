

var personas = (function (personas, undefined) {

    var _disabled = true;


 personas.llenarModalEditar = function () {

        $(".btn-editar").on("click", function (e) {  

            e.preventDefault();

            var idPersona=this.id;   

          
            $.ajax({

                type: "POST",
                url: 'bodies/tabla.php',

                data: { idPer: idPersona },

                success: function (data) {   

                    var oDato = JSON.parse(data);   

                    
                    $('#idNota').val(oDato[0].idNota);
                    $('#faltasNota').val(oDato[0].faltas);
                    $('#tallerNota').val(oDato[0].taller);
                    $('#pEscritaNota').val(oDato[0].pruebaEscrita);
                    $('#labsNota').val(oDato[0].laboratorios);
                    $('#eOralNota').val(oDato[0].evaluacionOral);
                   
                    $('#eEscritaNota').val(oDato[0].evaluacionEscrita);
                    $('#punNota').val(oDato[0].puntualidad);
                    $('#pPersonalNota').val(oDato[0].presentacionPersonal);
                    $('#compNota').val(oDato[0].comportamiento);
                     $('#ipNota').val(oDato[0].interesParticipacion);

                  
                },

            });
        });

    },

  //----------------ENVIO POR METODO GET SIN AJAX------------------------ /////

  personas.eliminarPersona = function () {

        $(".btn-eliminar").on("click", function (e) { //SE ACTIVA CUANDO SE HACE CLIC EN EL BOTON CON CLASE (btn-eliminar)

            e.preventDefault();

            var id=this.id; // CON EL (this.id) PODEMOS SACAR EL CONTENIDO DE LA ID  DEL BOTON CON LA CLASE (btn-eliminar) AL CUAL DIMOS CLIC  


            p = confirm("¿Estas seguro que desea eliminar?");

            if(p){ 

                 window.location="controlers/eliminar_persona.php?pedrito="+id;    //ENVIAMOS POR GET EL ID PARA LUEGO RECIBIRLO EN eliminar_persona.php
             }
         });
    };


    return personas;

})(personas || {});

$(function () {

    personas.eliminarPersona();
    personas.llenarModalEditar();

});


