function com()
{
alert("Para comprar nsesita ingresar seccion");
}

function myadd(id,precio) {

if (id != null && precio != null) 
	{
     var ajax_url="Index/addAjax";
     var params = {"id" : id, "precio" : precio};
    
    console.log(params);

    ajax_url+='/'+id+'/'+precio;

     var ajax_request = new XMLHttpRequest();

     ajax_request.onreadystatechange = function(){

        if(ajax_request.readyState == 4){

            var response =JSON.parse( ajax_request.responseText );

             console.log(response.mensaje);
                
            if( response.status == '!ok')
            {

               
               alert('Sea agragado correctamente a tu lista de compras');
               document.getElementById("reponse-container").innerHTML = response.mensaje;
            }else
            {
                alert('ocurrio un erro vuelva intentar');
            }
            
        }

     }
      ajax_request.open("Get",ajax_url,true);
      ajax_request.send();

	}
	else
		{
			console.log('te falto el id');
		}

}

function myblus(id,precio) {

if (id != null && precio != null) 
    {
     var ajax_url="Catalogoblusa/addblusAjax";
     var params = {"id" : id, "precio" : precio};
    
    console.log(params);

    ajax_url+='/'+id+'/'+precio;

     var ajax_request = new XMLHttpRequest();

     ajax_request.onreadystatechange = function(){

        if(ajax_request.readyState == 4){

            var response =JSON.parse( ajax_request.responseText );

             console.log(response.mensaje);
                
            if( response.status == '!ok')
            {

               
               alert('Sea agragado correctamente a tu lista de compras');
               //document.getElementById("reponse-container").innerHTML = response.mensaje;
            }else
            {
                alert('ocurrio un erro vuelva intentar');
            }
            
        }

     }
      ajax_request.open("Get",ajax_url,true);
      ajax_request.send();

    }
    else
        {
            console.log('te falto el id');
        }

}


function myfalda(id,precio) {

if (id != null && precio != null) 
    {
     var ajax_url="CatalogoFalda/addfaldaAjax";
     var params = {"id" : id, "precio" : precio};
    
    console.log(params);

    ajax_url+='/'+id+'/'+precio;

     var ajax_request = new XMLHttpRequest();

     ajax_request.onreadystatechange = function(){

        if(ajax_request.readyState == 4){

            var response =JSON.parse( ajax_request.responseText );

             console.log(response.mensaje);
                
            if( response.status == '!ok')
            {

               
               alert('Sea agragado correctamente a tu lista de compras');
               //document.getElementById("reponse-container").innerHTML = response.mensaje;
            }else
            {
                alert('ocurrio un erro vuelva intentar');
            }
            
        }

     }
      ajax_request.open("Get",ajax_url,true);
      ajax_request.send();

    }
    else
        {
            console.log('te falto el id');
        }

}