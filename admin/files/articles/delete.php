<?php
require_once dirname(__DIR__, 2) . '/bootstrap.php';
require_once APP_ROOT . '/app/auth.php';
requireAdminLogin();
require_once dirname(__DIR__, 3) . '/includes/article-repository.php';

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$deleted = 0;

if ($id) {
    $deleted = lv_delete_article($id) ? 1 : 0;
}

header('Location: ' . file_url('articles/list.php') . '?deleted=' . $deleted);
exit();
