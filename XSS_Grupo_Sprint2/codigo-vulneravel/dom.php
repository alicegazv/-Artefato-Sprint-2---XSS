<?php include 'topo.php'; ?>

<h1>Saudação personalizada</h1>
<p>Esta página monta a saudação <b>no navegador</b> (JavaScript), lendo o
parâmetro <code>user</code> da URL. O servidor nem vê o valor — por isso é
um XSS <b>DOM-based</b>.</p>

<div id="saudacao"></div>

<form onsubmit="return false;">
    <label>Seu nome:</label>
    <input type="text" id="campo" placeholder="ex: Ana">
    <button onclick="atualizar()">Atualizar saudação</button>
</form>

<p class="aviso">💉 <b>Payload de teste (na URL):</b><br>
<code>dom.php?user=&lt;img src=x onerror=alert('DOM XSS')&gt;</code></p>

<script>
// ===============================================================
//  DOM-based XSS  (bônus: terceiro tipo = +3 pontos)
//  O valor da URL é escrito na página com innerHTML, que
//  INTERPRETA HTML. Um <img onerror> executa o script.
// ===============================================================
function atualizar() {
    var valor = document.getElementById('campo').value;
    // VULNERÁVEL: innerHTML interpreta tags e eventos
    document.getElementById('saudacao').innerHTML =
        '<h2>Olá, ' + valor + '! 👋</h2>';
}

// Lê ?user= da URL e exibe automaticamente (também vulnerável)
var params = new URLSearchParams(window.location.search);
var user = params.get('user');
if (user) {
    document.getElementById('saudacao').innerHTML =
        '<h2>Olá, ' + user + '! 👋</h2>';
}
</script>

<?php include 'rodape.php'; ?>
