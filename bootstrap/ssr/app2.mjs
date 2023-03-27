$(document).ready(function() {
  $("#btn-login-animado").click(function() {
    $("#formulario").addClass("anima-login");
  });
  $("#rsenha-cadastro").blur(function() {
    let senha = $("#senha-cadastro").val();
    let conf = $("#rsenha-cadastro").val();
    if (senha != conf) {
      $("#rsenha-cadastro").val("");
      $("#rsenha-cadastro").attr("placeHolder", "Tente novamente");
      $("#rsenha-cadastro").addClass("erro");
    } else {
      $("#rsenha-cadastro").removeClass("erro");
    }
  });
  $("#form-cadastro").submit(function() {
    let senha = $("#senha-cadastro").val();
    let conf = $("#rsenha-cadastro").val();
    if (senha != conf) {
      $("#rsenha-cadastro").val("");
      $("#rsenha-cadastro").attr("placeHolder", "Tente novamente");
      $("#rsenha-cadastro").addClass("erro");
    } else {
      $("#rsenha-cadastro").removeClass("erro");
    }
  });
  $(".feedback").click(function() {
    $(".feedback").css("display", "none");
  });
  $(".menu-mobile").click(function() {
    $(".menu").toggleClass("controle-menu");
    $(".menu-mobile").toggleClass("menu-ativado");
    $(".menu-mobile").toggleClass("menu-desativado");
  });
});
