<nav class="menu">
    <ul id="menu">
        <li><a id="dados" href="{{ route('user.show',['user'=>Session::get('user')->id]) }}">Meus Dados</a></li><!-- Link para Meus dados -->
        <li><a id="listagemPoke" href="{{ route('user.show.pokemons') }}">Capturar Pokémon</a></li><!-- Link para capturar Pokémon -->
    </ul>
    <ul id="botao_sair">
        <li><a id="sair" href="{{ route('user.exit') }}">sair</a></li><!-- Link para sair -->
    </ul>
    <div class="clear"></div>
</nav><!-- Nav com as opções de Meus dados, Capturar Pokemons e sair -->