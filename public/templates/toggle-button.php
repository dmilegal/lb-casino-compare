<?php
$id = $data->id;
$title_add = property_exists($data, 'title_add') ? $data->title_add : __('Add to compare', 'lb-cc');
$title_remove = property_exists($data, 'title_remove') ? $data->title_remove : __('Remove from compare', 'lb-cc');
$cc_ids = LB_CC_State::get_compare_ids();
?>

<button data-id="<?= $id ?>" data-title="<?= esc_attr(get_the_title($id)) ?>" data-src="<?= esc_attr(get_the_post_thumbnail_url($id, [85, 0])) ?>" class="lb-cc-toggle-btn lb-cc-toggle-btn--inline lb-cc-toggle-btn--add<?= !in_array($id, $cc_ids) ? ' lb-cc-toggle-btn--active' : '' ?>">
    <img width="15" height="15" loading="lazy" src="<?= plugin_dir_url( dirname(__FILE__) ) . '/images/compare_arrows.svg' ?>">
    <span><?= $title_add ?></span>
</button>
<button data-id="<?= $id ?>" class="lb-cc-toggle-btn lb-cc-toggle-btn--inline lb-cc-toggle-btn--remove<?= in_array($id, $cc_ids) ? ' lb-cc-toggle-btn--active' : '' ?>">
    <img width="15" height="15" loading="lazy" src="<?= plugin_dir_url(  dirname(__FILE__) ) . '/images/close.svg' ?>">
    <span><?= $title_remove ?></span>
</button>