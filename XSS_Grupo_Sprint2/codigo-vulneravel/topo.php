<?php
// Cabeçalho + menu compartilhado entre as páginas (versão VULNERÁVEL)
// ATENÇÃO: nenhuma proteção aqui — sem CSP, sem cookie HttpOnly.

// VULNERÁVEL: cookie de "sessão" criado SEM a flag HttpOnly.
// Por isso o JavaScript consegue ler document.cookie e um
// payload XSS pode roubá-lo. (A correção usa HttpOnly.)
if (!isset($_COOKIE['sessao'])) {
    setcookie('sessao', 'abc123-token-de-sessao-secreto', 0, '/'); // HttpOnly = false
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LojaExpress — DEMO (VULNERÁVEL)</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: Arial, Helvetica, sans-serif; margin: 0; background:#f4f5f7; color:#222; }
        header { background:#b00020; color:#fff; padding:14px 24px; }
        header b { font-size:20px; }
        .tag { background:#000; color:#ffd400; font-size:11px; padding:2px 6px; border-radius:4px; margin-left:8px; }
        nav { background:#222; padding:0 24px; }
        nav a { color:#fff; display:inline-block; padding:12px 16px; text-decoration:none; font-size:14px; }
        nav a:hover { background:#444; }
        main { max-width:760px; margin:24px auto; background:#fff; padding:24px; border-radius:8px; box-shadow:0 1px 4px rgba(0,0,0,.1); }
        h1 { margin-top:0; }
        input[type=text], textarea { width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; font-size:14px; margin:6px 0 12px; }
        button { background:#b00020; color:#fff; border:0; padding:10px 18px; border-radius:6px; font-size:14px; cursor:pointer; }
        .comentario { border:1px solid #eee; border-radius:6px; padding:12px; margin:10px 0; background:#fafafa; }
        .comentario .autor { font-weight:bold; color:#b00020; }
        .aviso { background:#fff3cd; border:1px solid #ffe69c; padding:10px 14px; border-radius:6px; font-size:13px; }
    </style>
</head>
<body>
<header><b>🛒 LojaExpress</b><span class="tag">DEMO VULNERÁVEL — não usar em produção</span></header>
<nav>
    <a href="index.php">Início</a>
    <a href="reflected.php?nome=visitante">Busca (Reflected)</a>
    <a href="comentarios.php">Comentários (Stored)</a>
    <a href="dom.php?user=visitante">Saudação (DOM)</a>
</nav>
<main>
