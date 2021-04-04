<!DOCTYPE html>
<html>
<head>
	<title>{{ SIS_NAME }}CADASTRO DE USUÁRIO</title>
    <meta charset="utf-8">
    <meta name="keyword" content="">
    <meta name="description" content="">
    <meta name="author" content="Anderson dos Santos">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0">
    <link rel="stylesheet" href="{{MAIN_PATH}}resources/css/app.css">
    <script type="text/javascript" src="{{MAIN_PATH}}resources/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="{{MAIN_PATH}}resources/js/app.js"></script>
</head>
<body>
@include('templates.header')
    <section class="cadastro" id="login">
        <div class="pokebola-superio">
            <div class="circulo-grande"></div>
            <div class="circulo-pequeno"></div>
        </div>
        <div class="pokebola-inferior">

        </div>
        <h2>Faça seu cadastro e aproveite as vantagens da nossa Arena Pokemon</h2>
       
        <div class="feedback">
            <p></p>
                <button>X</button>
        </div>
       
        <div id="formulario" class="anima-login">
            <form id="form-cadastro">
            @csrf

            <input type="text" id="nome-cadastro" name="name" placeholder="Nome*" size="15" required>

            <input type="text" id="usuario-cadastro" name="login" placeholder="Login*" size="15" required>

            <input type="password" id="senha-cadastro" name="password" placeholder="Senha*" size="15" required disabled>

            <input type="password" id="rsenha-cadastro" name="rpass" placeholder="Confirmar Senha*" size="15" required disabled>

            <label for="cadastrar">Cadastrar</label>
            <input type="submit" id="cadastrar" name="save" value="Cadastrar">
        </form><!-- Form de cadastro -->
    </div><!-- Container do form de cadastro -->
    <div class="clear"></div>
</section><!-- Session principal -->
@include('ajax.script')
@include('templates.footer')
</body>
</html>