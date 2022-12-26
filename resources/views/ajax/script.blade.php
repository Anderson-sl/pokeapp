
<script type="text/javascript">
$(document).ready(function(){

/*Validação de login*/
	$("#formulario").submit(function(){
		event.preventDefault();
		let login = $('input[type=text]#usuario-cadastro').val();
		let senha = $('input[type=password]#senha-cadastro').val();
		if(login.length > 0 && senha.length > 0){
			$.ajax({
				'url':"{{ route('user.store') }}",
				'dataType':'text',
				'data':$('#form-cadastro').serialize(),
				'type':'post',
				'error':function(e){
					
				},
				'success':function(e){
					let feedback =  JSON.parse(e);
					if(feedback.status)
					{
						window.location.href = "{{route('user.index',['feedback'=>"+feedback.message+"])}}";
					}else{
						$("#usuario-cadastro").val("");
						$("#usuario-cadastro").attr("placeHolder",user+" já existe");
						$("#usuario-cadastro").addClass("erro");
						$("#senha-cadastro").attr("disabled",true);
						$("#rsenha-cadastro").attr("disabled",true);
					}
					/*if(e.indexOf("retorno: true") == -1){
						alert("Usuario ou senha inválida!");
					}else{
						$(location).attr('href', 'view/home.php');
					}*/
				}
			});
		}else{
			alert("Os campos LOGIN e SENHA são obrigatórios!");
		}	
	});
	/*Validação de login no formulario de cadastro*/
	$("#usuario-cadastro").blur(function(){
		let user = $(this).val();
		if(user.length == 0){
				$("#usuario-cadastro").val("");
				$("#usuario-cadastro").attr("placeHolder","Informe um usuario");
				$("#usuario-cadastro").addClass("erro");
				$("#senha-cadastro").attr("disabled",true);
				$("#rsenha-cadastro").attr("disabled",true);
				return;
		}

		$.ajax({
			'url':"{{ route('user.valida.login') }}",
			'type':'post',
			'dateType':'json',
			'data':$('#form-cadastro').serialize(),
			'success':function(e){
				alert(`Success:`);
				console.log(e);
				let feedback =  JSON.parse(e);
				if(feedback.status){
					$("#usuario-cadastro").removeClass("erro");
					$("#senha-cadastro").attr("disabled",false);
					$("#rsenha-cadastro").attr("disabled",false);
				}else{
					$("#usuario-cadastro").val("");
					$("#usuario-cadastro").attr("placeHolder",user+" já existe");
					$('.feedback p').html(user+ ' já existe');
					$('.feedback').css('display','inline-block');
					$('.feedback').addClass('erro');
					$("#usuario-cadastro").addClass("erro");
					$("#senha-cadastro").attr("disabled",true);
					$("#rsenha-cadastro").attr("disabled",true);
				}
			},
			'error':function(e){
				alert(`Error:`);
				console.log(e);
			}
		});
		
	});

	$('.btn-capturar label').click(function(){
		let element = $(this.parentElement).serialize();
		$.ajax({
			'url':"{{ route('poke.store') }}",
			'type':'post',
			'dataType':'json',
			'data':element,
			'success' : function(e){
				if(e.status){
					$('#feedback p').html(e.message);
					$('#feedback').addClass('ativo sucesso').delay(10000).queue(function(){
							$(this).removeClass('ativo sucesso')
					});				
				}else{
					$('#feedback p').html(e.message);
					$('#feedback').addClass('ativo erro').delay(10000).queue(function(){
							$('#feedback').removeClass('ativo erro')
					});				
				}
			},
			'error' : function(e){
				$('.feedback').html('<p>Erro ao tentar capturar o pokemon</p>');
				$('.feedback').addClass('ativo erro').delay(10000).queue(function(){
						$('.feedback').removeClass('ativo erro')
				});				
				console.log(e.responseJSON.message);
			}
		});
	});

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

	$('.feedback').show().delay(10000).queue(function(){
		$('.feedback').removeClass('ativo sucesso')
	});

	$('.feedback').click(function(){
		$(this).children('p').html('');
		$(this).removeClass('ativo sucesso');
	});
	
});
</script>