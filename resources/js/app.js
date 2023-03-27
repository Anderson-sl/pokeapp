
const logoUrl = new URL(`../img/logo-crud-3.png`, import.meta.url).href;
const activeMenuUrl = new URL(`../img/menu-mobile.png`, import.meta.url).href;
const inactiveMenuUrl = new URL(`../img/menu-mobile-hover.png`, import.meta.url).href;
const pokeUrl = new URL(`../img/pokemon.png`, import.meta.url).href;
$(document).ready(function(){
	$('.container-logo').ready(function() {
		$('.container-logo').css('background-image', `url('${logoUrl}')`);
	});
	$('.menu-ativado').ready(function() {
		$('.menu-ativado').css('background-image', `url('${activeMenuUrl}')`);
	});
	$('.menu-desativado').ready(function() {
		$('.menu-desativado').css('background-image', `url('${inactiveMenuUrl}')`);
	});
	$('.container-principal').ready(function() {
		$('.container-principal').css('background-image', `url('${pokeUrl}')`);
	});
	$("#btn-login-animado").click(function(){
		$("#formulario").addClass("anima-login");
	});

	
	/*validação de senha no formulario de cadastro*/
	$("#rsenha-cadastro").blur(function(){
		let senha = $("#senha-cadastro").val();
		let conf = $("#rsenha-cadastro").val();
		if(senha != conf){
			$("#rsenha-cadastro").val("");
			$("#rsenha-cadastro").attr("placeHolder","Tente novamente");
			$("#rsenha-cadastro").addClass("erro");
		}else{
			$("#rsenha-cadastro").removeClass("erro");
		}
	});

	$("#form-cadastro").submit(function(){
		let senha = $("#senha-cadastro").val();
		let conf = $("#rsenha-cadastro").val();
		if(senha != conf){
			$("#rsenha-cadastro").val("");
			$("#rsenha-cadastro").attr("placeHolder","Tente novamente");
			$("#rsenha-cadastro").addClass("erro");
		}else{
			$("#rsenha-cadastro").removeClass("erro");
		}

	});

	/*Feedback*/

	$('.feedback').click(function(){
		$('.feedback').css('display','none');
	});

	/*Controle menu*/
	/********************************************************/
	/*Ação do botão menu mobile */
	$(".menu-mobile").click(function(){
		$(".menu").toggleClass("controle-menu");
		$(".menu-mobile").toggleClass("menu-ativado");
		$(".menu-mobile").toggleClass("menu-desativado");
	});

});
