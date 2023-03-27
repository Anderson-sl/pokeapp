<!DOCTYPE html>
<html>
<head>
	<title>{{SIS_NAME}} {{strtoupper((Session::get('user'))->name)}}</title>
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

    <section class="section-info-usuario section-padrao">
        <div id="container-usuario" class="fundo">
            <!-- Conteudo gerado dinamico e pelo servidor e retornado via ajax Jquery, onde é renderizado na tela --> 
            <table id='lista'><tr class='desc'><td>Nome</td><td>Email</td><td>Pokemons</td></tr><tr><td>{{ Session::get('user')->name }}</td><td>{{ Session::get('user')->email }}</td><td>{{ $pokemons != false ? count($pokemons) : 0 }} capturado(s)</td></tr><tr><td colspan='3'><label for='btn-editar-conta'>Editar Perfil</label><button id='btn-editar-conta' class='btn-editar-conta'></button><label for='btn-excluir-conta'>Excluir Conta</label><button id='btn-excluir-conta' class='btn-excluir-conta' value="{{ Session::get('user')->id }}"></button><div class='editar-perfil hide'><form method='POST' action="{{ route('user.update',['user'=>Session::get('user')->id]) }}" id='form-editar-perfil'>
                @csrf
                @method('PUT')
                <input type='text' id='nome_editar' placeholder='Nome*' name='name' value="{{ Session::get('user')->name }}" required><input type='text' id='login_editar' placeholder='Login*' name='login' value="{{ Session::get('user')->login }}" required><input type='password' id='senha_editar' placeholder='Senha de confirmação' name='password' required><label for='editar'>Salvar Alteração</label><button id='editar' value="{{ Session::get('user')->id }}"></button></form></div><div class='excluir-perfil hide'><form method='POST' action="{{ route('user.destroy',['user'=>(Session::get('user'))->id]) }}" id='form-excluir-perfil'>
                    @csrf
                    @method('DELETE')
                    <input type='password' id='senha_excluir' name="password" placeholder='Senha de confirmação' required><label for='excluir'>Confirmar</label><button id='excluir' value="confirm"></button></form></div></td></tr><tr class='desc'><td colspan='3'>-- DADOS DO USUARIO CADASTRADO --</td></tr></table>
            <!-- Fim da tabela de informações do ususario -->
            <!-- Inicio do container com os Pokemons retornados pela API -->
            <!-- DIV feedback é um container de retorno de mensagens das ações executadas -->
                <div id='container-pokemon-usuario'>
            @if(!is_null(session('feedback')))
                    <div id='feedback' class="feedback ativo sucesso">
                        <p>
                        {{session('feedback')}}
                        </p>
                    </div>
            @endif
            @if(!is_null(session('error')))
                    <div id='feedback' class="feedback ativo erro">
                        <p>
                        {{session('error')}}
                        </p>
                    </div>
            @endif
<!-- /**********************************************************************/ -->
            @if($pokemons != false)
            @foreach($pokemons as $pokemon)
                <div class='container-pokemon'>
                    <div class='img-pokemon' id='img-pokemon'>
                        <img src="{{$pokemon->pkm_image}}" title=''>
                    </div>
                    <div class='name-pokemon'>
                        <p>{{ $pokemon->pkm_name }}</p>
                    </div>
                    <div class='atributos-pokemon'>
                        <div class='container-organiza'>
                            <p>Experiencia: </p>
                            <b>{{ $pokemon->pkm_base_experience }}</b>
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
                                {{$pokemon->pkm_weight}}
                            </b>
                        </div>
                    </div>
                    <div class='clear'></div>
                    <div class='btn-descartar'>
                        <form method="post" action="{{ route('poke.destroy',['poke'=>$pokemon->pkm_id]) }}">
                            @csrf
                            @method('DELETE')
                            <button value="{{$pokemon->pkm_id}},{{$pokemon->pkm_name}}">Descartar</button>
                        </form>
                    </div>
                </div>

                @endforeach
                @else
                        <p>-- Você não tem nenhum Pokemon --</p>
                @endif
        <div class="clear"></div>
        </div><!-- Container de informação do usuario e delimitador das dimensões -->
    </section><!-- Section com informações do usuario -->
@include('ajax.script')
@include('templates.footer')
</body>
</html>