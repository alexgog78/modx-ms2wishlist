<div class="ms2wishlist_link {$total_count > 0 ? 'full' : ''}">
    <div class="empty">
        {'ms2wishlist' | lexicon}: <strong>{'ms2wishlist_is_empty' | lexicon}</strong>
    </div>
    <div class="not_empty">
        <a href="{$link}">{'ms2wishlist' | lexicon}: <strong class="ms2wishlist_count">{$total_count}</strong></a>
    </div>
</div>
