<?php include 'topo.php'; ?>

<h1>Bem-vindo à LojaExpress</h1>
<p>Esta é a <b>versão intencionalmente vulnerável</b> usada no artefato da Sprint 2
(Segurança em Aplicações — IFB). Ela contém três pontos de Cross-Site Scripting (XSS):</p>

<div class="comentario">
    <span class="autor">1. Reflected XSS</span> — página de <a href="reflected.php?nome=visitante">Busca</a>.
    O parâmetro <code>nome</code> da URL é refletido direto no HTML.
</div>
<div class="comentario">
    <span class="autor">2. Stored XSS</span> — página de <a href="comentarios.php">Comentários</a>.
    O que você envia fica salvo no banco e é exibido a todos os visitantes.
</div>
<div class="comentario">
    <span class="autor">3. DOM-based XSS</span> (bônus) — página de <a href="dom.php?user=visitante">Saudação</a>.
    O JavaScript do cliente escreve o parâmetro da URL usando <code>innerHTML</code>.
</div>

<p class="aviso">⚠️ Nenhuma das páginas usa sanitização, escaping, Content Security Policy
ou cookies HttpOnly. É exatamente isso que será corrigido na pasta <code>codigo-corrigido/</code>.</p>

<?php include 'rodape.php'; ?>
