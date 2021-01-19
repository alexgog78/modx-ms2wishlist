<form method="post" class="ms2wishlist_form {$active ? 'active' : ''}">
    <input type="hidden" name="record_id" value="{$id}">
    <button type="submit" name="ms2wishlist_action" value="add">{'ms2wishlist_add' | lexicon}</button>
    <button type="submit" name="ms2wishlist_action" value="remove">{'ms2wishlist_remove' | lexicon}</button>
</form>
