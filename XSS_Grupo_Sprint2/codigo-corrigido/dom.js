// ===============================================================
//  DOM-based XSS — CORRIGIDO
//  Técnica: usar textContent em vez de innerHTML.
//  textContent trata o valor como TEXTO PURO — o navegador nunca
//  interpreta tags ou eventos, então <img onerror> vira texto.
//
//  Obs.: este código está em arquivo EXTERNO (dom.js) de propósito.
//  A Content-Security-Policy (script-src 'self') bloqueia scripts
//  inline, então movemos o JS para um arquivo próprio — essa é a
//  defesa em camada extra funcionando na prática.
// ===============================================================

function montarSaudacao(valor) {
    var alvo = document.getElementById('saudacao');
    alvo.textContent = '';                 // limpa
    var h2 = document.createElement('h2');
    h2.textContent = 'Olá, ' + valor + '! 👋';  // SEGURO: texto puro
    alvo.appendChild(h2);
}

// Botão
document.getElementById('btn').addEventListener('click', function () {
    var valor = document.getElementById('campo').value;
    montarSaudacao(valor);
});

// Lê ?user= da URL
var params = new URLSearchParams(window.location.search);
var user = params.get('user');
if (user) {
    montarSaudacao(user);
}
