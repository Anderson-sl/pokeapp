<!DOCTYPE html>
<html>
<head>
	<title>{{SIS_NAME}} POKEMONS</title>
    <meta charset="utf-8">
    <meta name="keyword" content="">
    <meta name="description" content="">
    <meta name="author" content="Anderson dos Santos">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0">
    <link rel="stylesheet" href="{{ url(mix('css/app.css')) }}">
    <script type="text/javascript" src="{{ url(mix('js/jquery-3.5.1.min.js')) }}"></script>
    <script type="text/javascript" src="{{ url(mix('js/app.js')) }}"></script>
</head>
<body>
@include('templates.header_full')
@include('templates.menu')
<section class="section-listaPoke section-padrao">
    <div class="container">
        <p class="rotulo_informativo">A quantidade máxima de pokemons que um treinador pode capturar é 5, mesmo sendo pokemons repetidos!</p><!-- Rotulo com animação -->
        <div class="section-buscar-pokemon">
            <p>Caçar</p>
            <p> Pokemon</p>
            <form method="POST" id="form-cacar-pokemon" action="{{ route('poke.find.name') }}">
                @csrf
                <input type="text" name="pokemon" id="input-cacar-pokemon" placeholder="Qual Pokemon?">
                <input type="submit" name="buscar" id="buscar-pokemon" value="Caçar">
            </form><!-- Form de busca de pokémons -->
            <div class="clear"></div>
        </div><!-- Container com form de busca de pokémon -->
        <div id='feedback' class="feedback"><p></p></div><!-- Container de mensagens retornadas das ações executadas no sistemas -->
        <div class="section-pokemon" id="section-pokemon">
            @if($pokemons != false)
                @foreach($pokemons as $pokemon)
                <div class='container-pokemon'>

                    <div class='img-pokemon' id='img-pokemon'>

                        <img src='{{$pokemon->pkm_image}}' title='{{$pokemon->pkm_name}}'>
                    </div>
                    <div class='name-pokemon'>
                        <p>{{$pokemon->pkm_name}}</p>
                    </div>
                    <div class='atributos-pokemon'>
                        <div class='container-organiza'>
                            <p>Experiencia: </p>
                            <b>{{$pokemon->pkm_base_experience}}
                            </b>
                        </div>
                        <div class='container-organiza'>
                            <p>Tipo: </p>
                            <b>
                                @foreach($pokemon->types as $type)
                                    [ {{$type->pkm_typ_name}} ]
                                @endforeach
                            </b>
                        </div>
                        <div class='container-organiza'>
                            <p>Habilidades: </p>
                            <b>
                                @foreach($pokemon->abilities as $ability)
                                 [ {{$ability->abt_name}} ]
                                @endforeach
                            </b>
                        </div>
                        <div class='container-organiza'>
                            <p>Peso: </p>
                            <b>
                                {{$pokemon->weight}}
                            </b>
                        </div>
                    </div>
                    <!-- <div class='clear'></div> -->
                    <div class='btn-capturar'>
                        <form method="POST">
                            @csrf
                            <input type="hidden" name="id_pokemon" value="{{$pokemon->id}},{{$pokemon->name}}">
                            <label for="capturar_{{$pokemon->id}}">Capturar</label>
                            <input type="button" value='{{$pokemon->name}}' id="capturar_{{$pokemon->id}}" name="capturar" hidden>
                        </form>
                    </div>
                
                </div>

                @endforeach
                @else
                <p>-- Não foi localizado nenhum Pokemon --</p>
                @endif
            <div class='clear'></div>
        </div><!-- Container de include de html gerado com a lista de pokémons -->
    </div><!-- Container -->
</section><!-- Section principal -->
@include('ajax.script')
@include('templates.footer')
</body>
</html>