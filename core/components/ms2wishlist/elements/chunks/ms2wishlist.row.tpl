<div class="ms2wishlist_resource_{$id}">
    <a href="{$id | url}">{$pagetitle}</a>
    {$_modx->runSnippet('!ms2wishlistAdd', [
        'id' => $id,
    ])}
</div>
