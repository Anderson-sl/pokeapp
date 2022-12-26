/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************!*\
  !*** ./resources/js/script-cacar.js ***!
  \**************************************/
$(document).ready(function () {
  $('.btn-capturar button').click(function () {
    console.log($(this).val().split(','));
  });

  function buscarPokemon(val) {
    var pokemon = val;
    $.ajax({
      url: '../controle/Controller.php',
      dataType: 'json',
      data: {
        'busca_pokemon': pokemon
      },
      type: 'post',
      beforeSend: function beforeSend() {
        $('#section-pokemon').toggleClass('fundo');
        $('#section-pokemon').html(progressoHtml);
      },
      error: function error(e) {
        console.log(e.responseText);
      },
      success: function success(e) {
        $('#section-pokemon').toggleClass('fundo');
        $('#section-pokemon').html(e['html']);
        montarPokemons();
      }
    });
  }

  function progressoHtml() {
    return "<div class='box-progresso'><div id='progresso'><div class='progresso-wraper'><div class='progresso-conteudo'><p>carregando</p><div class='progresso-animacao'></div></div></div></div><div class='clear'></div></div>";
  }

  function feedBack(msg, cod) {
    resetMsg();

    if (cod == 1) {
      $("#feedback").fadeIn(500, function () {
        $("#feedback").addClass("feedback sucesso");
        $("#feedback").html("<p>" + msg + "</p>");
      });
    } else {
      $("#feedback").fadeIn(500, function () {
        $("#feedback").addClass("feedback erro");
        $("#feedback").html("<p>" + msg + "</p>");
      });
    }

    $("html,body").animate({
      scrollTop: 0
    }, "fast");
  }
  /*Reseta mensagem da div feedback*/


  function resetMsg() {
    $("#feedback").fadeOut(500, function () {
      $("#feedback").html("");
      $("#feedback").removeClass("feedback sucesso erro");
    });
  }
});
/******/ })()
;