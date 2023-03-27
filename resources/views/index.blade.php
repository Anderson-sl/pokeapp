<!DOCTYPE html>
<html>
<head>
	<title>{{SIS_NAME}}SEJA BEM VINDO!</title>
    <meta charset="utf-8">
    <meta name="keyword" content="">
    <meta name="description" content="">
    <meta name="author" content="Anderson dos Santos">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0">
    <script type="text/javascript" src="{{ Illuminate\Support\Facades\Vite::asset('resources/js/jquery-3.5.1.min.js') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

@include('templates.header')

<section class="login">
    <div class="pokebola-superio">
        <div class="circulo-grande"></div>
        <div class="circulo-pequeno"></div>
    </div>
    <div class="pokebola-inferior">

    </div>
    <h2>Seja bem vindo ao nosso centro Pokemon</h2>
    <h2>Faça seu login e começe a sua jornada como um treinador</h2>
    @if(!is_null(session('feedback')))
    <div class="feedback ativo erro">
        <p>{{ session('feedback') }}</p>
        <button>X</button>
    </div>
    @endif
    
    <div id="formulario">
        <button id="btn-login-animado">Login</button>
        <form method="post" action="{{ route('user.login') }}" id="form-login">
            @csrf
            <input type="text" id="email" name="email" placeholder="Email" required>

            <input type="password" id="senha" name="password" placeholder="Senha" required>
            <label for="logar">Logar</label>
            <input type="submit" name="logar" id="logar" value="Logar">
        </form><!-- Formulario de login -->
        <a href="{{ route('user.create') }}">Cadastre-se aqui!</a><!-- Link para tela de cadastro -->
    </div>
</section><!-- Section principal onde fica o formulario de login -->

@include('templates.footer')

</body>
</html>