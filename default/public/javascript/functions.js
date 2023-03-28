
var editando = false;

function transformarEnEditable(nodo) {
//El nodo recibido es SPAN
    if (editando == false) {
        var nodoTd = nodo.parentNode; //Nodo TD
        var nodoTr = nodoTd.parentNode; //Nodo TR
        var nodoContenedorForm = document.getElementById('contenedorForm'); //Nodo DIV
        var nodosEnTr = nodoTr.getElementsByTagName('td');

        var nombre = nodosEnTr[0].textContent;
        var apellido = nodosEnTr[1].textContent;
        var notaFinal = nodosEnTr[13].textContent;
        var idNota = nodosEnTr[2].textContent;

        // Variables a modificar
        var faltas = nodosEnTr[3].textContent;
        var taller = nodosEnTr[4].textContent;
        var prueba_escrita = nodosEnTr[5].textContent;
        var laboratorios = nodosEnTr[6].textContent;
        var evaluacion_oral = nodosEnTr[7].textContent;
        var evaluacion_escrita = nodosEnTr[8].textContent;
        var puntualidad = nodosEnTr[9].textContent;
        var presentacion_personal = nodosEnTr[10].textContent;
        var comportamiento = nodosEnTr[11].textContent;
        var interes_participacion = nodosEnTr[12].textContent;


        // en el siguiente código se manda como hidden idNota TO DO

        var nuevoCodigoHtml = ' <td>' + nombre + '</td>' + '<td>' + apellido + '</td>' + '<td><input type="hidden" name="idNota" id="idNota" value="' + idNota + '" size="3"></td>' +
                '<td><input type="text" name="faltas" id="faltas" value="' + faltas + '" size="3"></td>' +
                '<td><input type="text" name="taller" id="taller" value="' + taller + '" size="3"</td>' +
                '<td><input type="text" name="prueba_escrita" id="prueba_escrita" value="' + prueba_escrita + '" size="3"</td>' +
                '<td><input type="text" name="laboratorios" id="laboratorios" value="' + laboratorios + '" size="3"</td>' +
                '<td><input type="text" name="evaluacion_oral" id="evaluacion_oral" value="' + evaluacion_oral + '" size="3"</td>' +
                '<td><input type="text" name="evaluacion_escrita" id="evaluacion_escrita" value="' + evaluacion_escrita + '" size="3"</td>' +
                '<td><input type="text" name="puntualidad" id="puntualidad" value="' + puntualidad + '" size="3"</td>' +
                '<td><input type="text" name="presentacion_personal" id="presentacion_personal" value="' + presentacion_personal + '" size="3"</td>' +
                '<td><input type="text" name="comportamiento" id="comportamiento" value="' + comportamiento + '" size="3"</td>' +
                '<td><input type="text" name="interes_participacion" id="interes_participacion" value="' + interes_participacion + '" size="3"</td> ' + '<td>' + notaFinal + '</td>' + '<td>Editando Nota...</td>';

        nodoTr.innerHTML = nuevoCodigoHtml;

        nodoContenedorForm.innerHTML = 'Pulse Aceptar para guardar los cambios o cancelar para anularlos' +
                '<form name = "formulario" action="receive.php" method="get" onsubmit="capturarEnvio()" onreset="anular()">' +
                '<input class="boton" type = "submit" value="Aceptar"> <input class="boton" type="reset" value="Cancelar">';
        editando = "true";
    } else {
        alert('Solo se puede editar una línea. Recargue la página para poder editar otra');
    }
}

function capturarEnvio() {
    var nodoContenedorForm = document.getElementById('contenedorForm'); //Nodo DIV
    nodoContenedorForm.innerHTML = 'Pulse Aceptar para guardar los cambios o cancelar para anularlos' +
            '<form name = "formulario" action="receive.php" method="get" onsubmit="capturarEnvio()" onreset="anular()">' +
            '<input type="hidden" name="idNota" value="' + document.querySelector('#idNota').value + '">' +
            '<input type="hidden" name="faltas" value="' + document.querySelector('#faltas').value + '">' +
            '<input type="hidden" name="taller" value="' + document.querySelector('#taller').value + '">' +
            '<input type="hidden" name="prueba_escrita" value="' + document.querySelector('#prueba_escrita').value + '">' +
            '<input type="hidden" name="laboratorios" value="' + document.querySelector('#laboratorios').value + '">' +
            '<input type="hidden" name="evaluacion_oral" value="' + document.querySelector('#evaluacion_oral').value + '">' +
            '<input type="hidden" name="evaluacion_escrita" value="' + document.querySelector('#evaluacion_escrita').value + '">' +
            '<input type="hidden" name="puntualidad" value="' + document.querySelector('#puntualidad').value + '">' +
            '<input type="hidden" name="presentacion_personal" value="' + document.querySelector('#presentacion_personal').value + '">' +
            '<input type="hidden" name="comportamiento" value="' + document.querySelector('#comportamiento').value + '">' +
            '<input type="hidden" name="interes_participacion" value="' + document.querySelector('#interes_participacion').value + '">' +
            '<input class="boton" type = "submit" value="Aceptar"> <input class="boton" type="reset" value="Cancelar">';
    document.formulario.submit();
}

function anular() {
    window.location.reload();
}


function actualizarNotas(){
    
    
}