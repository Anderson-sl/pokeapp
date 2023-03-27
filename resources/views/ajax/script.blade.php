<script type="text/javascript">
$(document).ready(function(){
	/*Validação de login*/
	$("#formulario").submit(function(){
		event.preventDefault();
		let email = $('input[type=text]#email-cadastro').val();
		let senha = $('input[type=password]#senha-cadastro').val();
		if(email.length > 0 && senha.length > 0){
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
						$("#email-cadastro").val("");
						$("#email-cadastro").attr("placeHolder",email+" já existe");
						$("#email-cadastro").addClass("erro");
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
			alert("Os campos 'email' e 'senha' são obrigatórios!");
		}	
	});
	/*Regex validação de email*/
	function validadorDeEmail(email){
		return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email);
	}
	/*Validação de login no formulario de cadastro*/
	$("#email-cadastro").blur(function(){
		let email = $(this).val();
		if(email.length == 0 || !validadorDeEmail(email)){
			$("#email-cadastro").val("");
			$("#email-cadastro").attr("placeHolder","Informe um email válido");
			$("#email-cadastro").addClass("erro");
			$("#senha-cadastro").attr("disabled",true);
			$("#rsenha-cadastro").attr("disabled",true);
			return;
		}

		$.ajax({
			'url':"{{ route('user.valida.email') }}",
			'type':'post',
			'dateType':'json',
			'data':$('#form-cadastro').serialize(),
			'success':function(e){
				let feedback =  JSON.parse(e);
				if(feedback.status){
					$("#email-cadastro").removeClass("erro");
					$("#senha-cadastro").attr("disabled",false);
					$("#rsenha-cadastro").attr("disabled",false);
				}else{
					$("#email-cadastro").val("");
					$("#email-cadastro").attr("placeHolder",email+" já existe");
					$("#email-cadastro").addClass("erro");
					$("#senha-cadastro").attr("disabled",true);
					$("#rsenha-cadastro").attr("disabled",true);
				}
			},
			'error':function(e){
				console.log(e);
			}
		});
		
	});

	$('.btn-capturar label').click(function(){
		let element = $(this.parentElement).serialize();
		console.log(element);
		$.ajax({
			'url':"{{ route('poke.store') }}",
			'type':'post',
			'dataType':'json',
			'data':element,
			'success' : function(e){
				if(e.status){
					$('#feedback p').html(e?.message);
					$('#feedback').addClass('ativo sucesso').delay(10000).queue(function(){
						$('#feedback').removeClass('ativo erro');
					});				
				}else{
					$('#feedback p').html(e?.message);
					$('#feedback').addClass('ativo erro').delay(10000).queue(function(){
							$('#feedback').removeClass('ativo erro');
					});				
				}
			},
			'error' : function(e){
				console.log(e.responseJSON.message);
				callError('<p>Erro ao tentar capturar o pokemon</p>');
			}
		});
	});

	function callError(message) {
		$('#feedback').html(`${message}`);
		$('#feedback').addClass('ativo erro').delay(10000).queue(function(){
			$('#feedback').removeClass('ativo erro').finish();
		});
	}

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

	$('#feedback').click(function(){
		$(this).children('p').html('');
		$(this).removeClass('ativo sucesso erro');
	});
	
});
</script>