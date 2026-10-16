<?php
/**
 * Garante que apenas usuários autenticados acessem as páginas internas.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

/** Escapa texto para exibição segura em HTML. */
function e($valor)
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}
