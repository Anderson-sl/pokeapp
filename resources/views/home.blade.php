<!DOCTYPE html>
<html>
<head>
	<title>{{ SIS_NAME }}HOME</title>
    <meta charset="utf-8">
    <meta name="keyword" content="">
    <meta name="description" content="">
    <meta name="author" content="Anderson dos Santos">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0">
    <script type="text/javascript" src="{{ Illuminate\Support\Facades\Vite::asset('resources/js/jquery-3.5.1.min.js') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
@include('templates.header_full')
@include('templates.menu')
    <!-- Section com animação na tela principal  //Animação feita somente com CSS//-->
    <section class="section-padrao section-home">
        <div class="container-principal">
            <div class="slide">
                <div class="part1"></div><!-- Efeito degrade do cinza para transparente -->
                <div class="part2"></div><!-- Efeito degrade do cinza para transparente -->
                <div class="clear"></div><!-- limpa a flutuação -->
            </div><!-- Div deslisante -->
        </div><!-- Container Principal da animação, onde contem a imagem -->
    </section>
    <!-- Fim section -->
@include('ajax.script')
@include('templates.footer')
</body>
</html>