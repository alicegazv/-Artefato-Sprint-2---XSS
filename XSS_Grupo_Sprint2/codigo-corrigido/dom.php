<?php include 'topo.php'; ?>

<h1>Saudação personalizada</h1>
<p>Mesma página da versão vulnerável, mas agora o JavaScript usa
<code>textContent</code> em vez de <code>innerHTML</code>.</p>

<div id="saudacao"></div>

<form onsubmit="return false;">
    <label>Seu nome:</label>
    <input type="text" id="campo" placeholder="ex: Ana">
    <button id="btn">Atualizar saudação</button>
</form>

<p class="aviso">✅ Teste <code>dom.php?user=&lt;img src=x onerror=alert('XSS')&gt;</code>:
o texto aparece literal, sem executar nada.</p>

<script src="dom.js"></script>

<?php include 'rodape.php'; ?>
