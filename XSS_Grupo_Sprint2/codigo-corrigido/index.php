<?php include 'topo.php'; ?>

<h1>Bem-vindo à LojaExpress (versão corrigida)</h1>
<p>Esta é a <b>versão protegida</b>. Os mesmos três pontos de XSS da pasta
<code>codigo-vulneravel/</code> foram corrigidos, cada um com uma técnica diferente:</p>

<div class="comentario">
    <span class="autor">1. Reflected XSS</span> → corrigido com
    <code>htmlspecialchars()</code> (output encoding). Veja <a href="reflected.php?nome=visitante">Busca</a>.
</div>
<div class="comentario">
    <span class="autor">2. Stored XSS</span> → corrigido com
    <b>prepared statements</b> + <code>htmlspecialchars()</code> na exibição.
    Veja <a href="comentarios.php">Comentários</a>.
</div>
<div class="comentario">
    <span class="autor">3. DOM-based XSS</span> → corrigido trocando
    <code>innerHTML</code> por <code>textContent</code>. Veja <a href="dom.php?user=visitante">Saudação</a>.
</div>

<p class="aviso">✅ Defesas em camadas aplicadas a TODAS as páginas:
<b>Content-Security-Policy</b>, cookie de sessão com <b>HttpOnly</b> e
codificação de saída. Tente os mesmos payloads da versão vulnerável — eles
aparecem como texto, não executam.</p>

<?php include 'rodape.php'; ?>
