

function comprar()
{
	location.href='http://localhost/Boutique/comprar';
}





/*Descarga el archivo*/

function descargarArchivo(contenidoEnBlob, nombreArchivo) {
    var reader = new FileReader();
    reader.onload = function (event) {
        var save = document.createElement('a');
        save.href = event.target.result;
        save.target = '_blank';
        save.download = nombreArchivo || 'archivo.dat';
        var clicEvent = new MouseEvent('click', {
            'view': window,
                'bubbles': true,
                'cancelable': true
        });
        save.dispatchEvent(clicEvent);
        (window.URL || window.webkitURL).revokeObjectURL(save.href);
    };
    reader.readAsDataURL(contenidoEnBlob);
};


function obtenerDatos() {
    return {
    	nombrefile: document.getElementById('nombre').value,

	 id_producto: document.getElementById('id_producto').value,

	 tipo: document.getElementById('Tipo').value,

	 cantidad: document.getElementById('cantidad').value, 

	 totaldepago: document.getElementById('totalpagar').value,

	 numtarjeta: document.getElementById('numtarjeta').value,

	 cvc: document.getElementById('cvc').value,

	 fecha: (new Date()).toLocaleDateString()
    };
};

function escaparXML(cadena) {
    if (typeof cadena !== 'string') {
        return '';
    };
    cadena = cadena.replace('&', '&amp;')
        .replace('<', '&lt;')
        .replace('>', '&gt;')
        .replace('"', '&quot;');
    return cadena;
};

function generarTexto(datos) {
    var texto = [];
    texto.push('Boutique Mon Stile:\n');
    texto.push('Nombre usuario: ');
    texto.push(datos.nombrefile);
    texto.push('\n');
    texto.push('Fecha: ');
    texto.push(datos.fecha);
    texto.push('\n');
    texto.push(datos.numtarjeta);
    texto.push('\n');
    texto.push('gracias por tu compra');
    texto.push('\n');
    
    texto.push('totaldepago: ');
    texto.push(datos.totaldepago);
    texto.push('\n');


   
    //El contructor de Blob requiere un Array en el primer parámetro
    //así que no es necesario usar toString. el segundo parámetro
    //es el tipo MIME del archivo
    return new Blob(texto, {
        type: 'text/plain'
    });
};

//Genera un objeto Blob con los datos en un archivo XML
function generarXml(datos) {
    var texto = [];
    texto.push('<?xml version="1.0" encoding="UTF-8" ?>\n');
    texto.push('<datos>\n');
    texto.push('\t<nombre>');
    texto.push(escaparXML(datos.nombre));
    texto.push('</nombre>\n');
    texto.push('\t<telefono>');
    texto.push(escaparXML(datos.telefono));
    texto.push('</telefono>\n');
    texto.push('\t<fecha>');
    texto.push(escaparXML(datos.fecha));
    texto.push('</fecha>\n');
    texto.push('</datos>');
    //No olvidemos especificar el tipo MIME correcto :)
    return new Blob(texto, {
        type: 'application/xml'
    });
};

function archivo(){
	 var datos = obtenerDatos();
    descargarArchivo(generarTexto(datos), 'archivo.txt');
}

