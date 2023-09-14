<?
$id = property_exists($data, 'id') ? $data->id : null;
?>
<div class="lb-cc-preview-item" data-id="<?= $id ?>">
    <button class="lb-cc-button-remove lb-cc-preview-item__remove" title="<?= __('remove item', 'lb-cc')?>">
        <i class="fas fa-times"></i>
    </button>
    <? if ($id) { ?>
    <?= get_the_post_thumbnail($id, [85, 0], [
        'class' => "lb-cc-preview-item__thumb",
    ]) ?>
    <? } else { ?>
        <img width="85" height="85" class="lb-cc-preview-item__thumb" src="<?= plugin_dir_url(  dirname(__FILE__) ) . '/images/square_gray.svg' ?>">
    <? } ?>
    <div class="lb-cc-preview-item__title"><?= $id ? get_the_title($id) : '' ?></div>
</div>