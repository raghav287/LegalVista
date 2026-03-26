<?php
require_once __DIR__ . '/article-repository.php';
require_once __DIR__ . '/article-template.php';

/**
 * If an article with the given slug exists and is published, render it and stop further execution.
 */
function lv_render_article_if_exists(string $slug): bool
{
    $article = lv_get_article_by_slug($slug, false);
    if ($article === null) {
        return false;
    }

    lv_render_article_page($article);
    return true;
}
