<?
$id = property_exists($data, 'id') ? $data->id : null;
$item_ind = property_exists($data, 'item_ind') ? $data->item_ind : 1;
?>
<div class="lb-cc-item" data-id="<?= $id ?>"<?= $item_ind ? ' style="--lb-cc--item--ind: ' . $item_ind . '"' : '' ?>>
    <div class="lb-cc-item__header">
        <button class="lb-cc-button-remove lb-cc-item__remove" title="<?= __('remove item', 'lb-cc')?>">
            <i class="fas fa-times"></i>
        </button>
        <?= get_the_post_thumbnail($id, [100, 0], [
                    'class' => "lb-cc-item__thumb",
            ]) ?>
        <div class="lb-cc-item__title"><?= get_the_title($id) ?></div>
        <a class="lb-cc-button lb-cc-item__review" href="<?= get_the_permalink($id) ?>"><?= __('Review', 'lb-cc') ?></a>
    </div>
</div>