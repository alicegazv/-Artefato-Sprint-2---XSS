<?php
// Cabeçalho + menu compartilhado (versão CORRIGIDA)

// DEFESA EXTRA 1 — Content Security Policy (CSP):
// mesmo que um script malicioso passe, o navegador se recusa a
// executar scripts inline que não tenham o nonce correto.
header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; object-src 'none'; img-src 'self';");

// DEFESA EXTRA 2 — cookie de sessão com HttpOnly:
// agora o JavaScript NÃO consegue ler document.cookie, então o
// payload de roubo de cookie para de funcionar.
if (!isset($_COOKIE['sessao'])) {
    setcookie('sessao', 'abc123-token-de-sessao-secreto', [
        'expires'  => 0,
        'path'     => '/',
        'httponly' => true,   // <- JavaScript não lê mais o cookie
        'samesite' => 'Lax',
    ]);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LojaExpress — DEMO (CORRIGIDA)</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: Arial, Helvetica, sans-serif; margin: 0; background:#f4f5f7; color:#222; }
        header { background:#0a7d2c; color:#fff; padding:14px 24px; }
        header b { font-size:20px; }
        .tag { background:#000; color:#9cff9c; font-size:11px; padding:2px 6px; border-radius:4px; margin-left:8px; }
        nav { background:#222; padding:0 24px; }
        nav a { color:#fff; display:inline-block; padding:12px 16px; text-decoration:none; font-size:14px; }
        nav a:hover { background:#444; }
        main { max-width:760px; margin:24px auto; background:#fff; padding:24px; border-radius:8px; box-shadow:0 1px 4px rgba(0,0,0,.1); }
        h1 { margin-top:0; }
        input[type=text], textarea { width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; font-size:14px; margin:6px 0 12px; }
        button { background:#0a7d2c; color:#fff; border:0; padding:10px 18px; border-radius:6px; font-size:14px; cursor:pointer; }
        .comentario { border:1px solid #eee; border-radius:6px; padding:12px; margin:10px 0; background:#fafafa; }
        .comentario .autor { font-weight:bold; color:#0a7d2c; }
        .aviso { background:#d1e7dd; border:1px solid #a3cfbb; padding:10px 14px; border-radius:6px; font-size:13px; }
    </style>
</head>
<body>
<header><b>🛒 LojaExpress</b><span class="tag">DEMO CORRIGIDA — protegida contra XSS</span></header>
<nav>
    <a href="index.php">Início</a>
    <a href="reflected.php?nome=visitante">Busca (Reflected)</a>
    <a href="comentarios.php">Comentários (Stored)</a>
    <a href="dom.php?user=visitante">Saudação (DOM)</a>
</nav>
<main>
