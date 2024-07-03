$("#registrar").on("click", function() {
    $("#login").hide();
    $("#criar-conta").show();
  });

  $("#voltar").on("click", function() {
    $("#criar-conta").hide();
    $("#login").show();
  });
  
  $('#registerForm').submit(function(event) {
    let senha = $('#nova-senha').val();
    let confirmarSenha = $('#confirmar-senha').val();
    if (senha !== confirmarSenha) {
      alert("As senhas não coincidem.");
    }
  });