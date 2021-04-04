$(document).ready(function(){
	$('#container-usuario').ready(function(){
			$.ajax({
				url:"../controle/Controller.php",
				dataType:'json',
				beforeSend: function(){
					$('#container-usuario').toggleClass('fundo');
					$('#container-usuario').html(progressoHtml);
				},
				success: function(e){
					$('#container-usuario').toggleClass('fundo');
					$('#container-usuario').html(e['html']);
					dadosUsuario();
					acaoEditarExcluir();
				},
				error: function(e,status,errorThrown){
					console.log(e.responseText);
					$('#container-usuario').html('Ocorreu um erro na comunicação com servidor. Entre em contato com o Administrador!');
					$('#container-usuario').append('<br>Teste: '+errorThrown);
				}
			});

				/*Fim Controle*/

	function progressoHtml(){
		return "<div class='box-progresso'><div id='progresso'><div class='progresso-wraper'><div class='progresso-conteudo'><p>carregando</p><div class='progresso-animacao'></div></div></div></div><div class='clear'></div></div>";
	}

	function dadosUsuario(){
		/*Ação do botão editar*/
		$("#btn-editar-conta").click(function(){
			$(".editar-perfil").toggleClass("hide");
			$(".excluir-perfil").addClass("hide");
		});

	
	/*Ação do botão excluir*/
	$("#btn-excluir-conta").click(function(){
		if(confirm("Essa ação irá excluir sua conta e seus dados já salvos! Deseja realmente excluir sua conta?")){
			$(".excluir-perfil").removeClass("hide");
			$(".editar-perfil").addClass("hide");
		}else{
			$(".excluir-perfil").addClass("hide");
		}
	});
	

	
	
	/*Ação do botão descartar pokémon*/
	$(".btn-descartar button").click(function(){
		let botao = $(this).val().split(",");
		if(confirm("Você realmente deseja descartar o Pokemon "+botao[1].toUpperCase()+"?")){
			$.ajax({
				url:"../controle/Controller.php",
				dataType: "json",
				data: {"pokemon_excluir":botao[0]},
				type: "post",
				error:function(e){

				},
				success:function(e){
					feedBack(e.html,e.status);
					$(location).attr("href","dadosUsuario.php");
				}
			});
		}else{
				
		}
	});


}

function acaoEditarExcluir(){

		/*Ação ao submeter formulario de edição de perfil*/
			$("#form-editar-perfil").submit(function(){
				event.preventDefault();
				let id = $("#editar").val();
				let nome = $("#nome_editar").val();
				let senha = $("#senha_editar").val();
				let login = $("#login_editar").val();
				let editar = {'id':id,'nome':nome,'login':login,'senha':senha};
				$.ajax({
					url:'../controle/Controller.php',
					dataType:'json',
					data:{'usuario_editar':editar},
					type:'post',
					error:function(e){
						feedBack(e.html,e.status);
					},
					success:function(e){
						if(e.status == 0){
							feedBack(e.html,e.status);
						}else{
							$(location).attr("href","dadosUsuario.php");
						}
					},

				});
			});


			/*Ação ao submeter formulario de exclusão da conta*/
			$("#form-excluir-perfil").submit(function(){
				event.preventDefault();
				let id = $("#excluir").val();
				let senha = $("#senha_excluir").val();
				let excluir = {'id':id,'senha':senha};
				$.ajax({
					url:'../controle/Controller.php',
					dataType:'json',
					error:function(e){
						feedBack(e.html,e.status);
					},
					success:function(e){
					if(e.status == 1){
						alert(e.html);
						$(location).attr("href","../index.php");
					}else{
						feedBack(e.html,e.status);
						$(".excluir-perfil").toggleClass("hide");
					}
					},
					type:'post',
					data:{'usuario_excluir': excluir}
				});
			});
	}

});

	/*Função que renderiza mensagem na div feedback*/
	function feedBack(msg,cod){
		resetMsg();
		if(cod == 1){
			$("#feedback").fadeIn(500,function(){
				$("#feedback").addClass("feedback sucesso");
				$("#feedback").html("<p>"+msg+"</p>");
			});
		}else{
			$("#feedback").fadeIn(500,function(){
				$("#feedback").addClass("feedback erro");
				$("#feedback").html("<p>"+msg+"</p>");
			});
		}
		$("html,body").animate({scrollTop:0},"fast");
	}
	/*Reseta mensagem da div feedback*/
	function resetMsg(){
		$("#feedback").fadeOut(500,function(){
			$("#feedback").html("");
			$("#feedback").removeClass("feedback sucesso erro");
		});
	}
});