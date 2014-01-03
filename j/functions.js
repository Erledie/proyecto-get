// JavaScript Document
$(document).on("ready", inicio);
function inicio(){
    $('#redes').on('click', abrirredes);
    $('#bton1 li').mouseover(botonOn).mouseout(botonOff);
    $('#mision').on('click', mostrarEmpresarial);
    $('#vision').on('click', mostrarEmpresarial);
    $('#objetivos').on('click', mostrarEmpresarial);
    $('#outsorcing').draggable();
    $('#left-Carrusel').on('click', function(){
    	$("#carru").animate({"left":"+=150px"},2000,'',function(){
    		console.log('prueba');
    	})
    });
}
function abrirredes(){
	var tamRedes = $('#redes').innerWidth();
	if(tamRedes == 25){
		$('#redes').css('width',200);
	}else{
		$('#redes').css('width',25);
	}
}
function botonOn(datos){
	var botoncito = datos.currentTarget.id;
	$('#imagen-'+botoncito).attr('src', 'img/'+botoncito+'-on.png');
}
function botonOff(datos){
	var botoncito = datos.currentTarget.id;
	$('#imagen-'+botoncito).attr('src', 'img/'+botoncito+'-off.png');
}
function mostrarEmpresarial(datos){
	var tipo = datos.currentTarget.id;
	var variable=0;
	switch(tipo){
		case 'mision':
			variable = 1;
			break;
		case 'vision':
			variable = 2;
			break;
		case 'objetivos':
			variable = 3;
			break;
		default:
			break;
	}
	var s_pagina ='j/infoEmpresarial.php?n_tipo='+variable;
	if($('#infoEmpresarial').is(':visible')){
		$('#infoEmpresarial').css('height','0px');
		setTimeout(function(){
			$('#infoEmpresarial').remove();
			pedirInfoEmpresarial(s_pagina);
			console.log('prueba');
		},600);
	}else{
		pedirInfoEmpresarial(s_pagina);
	}
}
function pedirInfoEmpresarial(s_pag){
	$('body').append("<div id='infoEmpresarial'></div>");
	$('#cerrar').on('click', function(){
		console.log('cierra');
		$('#infoEmpresarial').css('height','0px');
		$('#infoEmpresarial').remove();
	});
	$('#infoEmpresarial').load(s_pag, function( response, status, xhr ) {
		if ( status == "error" ) {
	    	alert('Ocurrio un error al consultar!!');
	  	}else{
	  		$('#infoEmpresarial').css('height','350px');
	  	}
	});	
}