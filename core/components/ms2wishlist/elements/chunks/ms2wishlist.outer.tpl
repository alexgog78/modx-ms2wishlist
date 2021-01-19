<div class="ms2wishlist_resources">
    <form method="post" class="ms2wishlist_form">
        <h5>{'ms2wishlist_count' | lexicon}: <span class="ms2wishlist_count">{$_modx->getPlaceholder('ms2wishlist_count')}</span></h5>
        <button class="btn btn-warning" type="submit" name="ms2wishlist_action" value="clear">{'ms2wishlist_clear' | lexicon}</button>
    </form>
    <br>
    <br>
    {$output}
</div>
