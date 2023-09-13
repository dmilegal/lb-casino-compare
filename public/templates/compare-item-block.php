<?
$block = property_exists($data, 'block') ? $data->block : null;
$block_ind = property_exists($data, 'block_ind') ? $data->block_ind : 1;
$block_item_offset = property_exists($data, 'block_item_offset') ? $data->block_item_offset : 0;

if ($block) {
    $title = isset($block['title']) ? $block['title'] : '';
    $list = isset($block['list']) ? $block['list'] : [];
?>
<div class="lb-cc-block"<?= $block_ind ? ' style="--lb-cc--block--ind: ' . $block_ind . '"' : '' ?>>
    <div class="lb-cc-block__row lb-cc-block__title" style="--lb-cc--block--item--ind: <?= $block_item_offset ?>"><?= $title ?></div>
    <? foreach ($list as $ind => $item) { ?>
        <div class="lb-cc-block__row lb-cc-block-item" style="--lb-cc--block--item--ind: <?= $block_item_offset + $ind + 1 ?>">
            <? if (isset($item['title'])) { ?>
                <span class="lb-cc-block-item__title"><?= $item['title'] ?></span>
            <? } ?>
            <? if (isset($item['data'])) { ?>
                <span class="lb-cc-block-item__value">
                    <? if (isset($item['data']['contains'])) { ?>
                        <i title="<?= $item['data']['contains'] ? __('has', 'lb-cc') : __("hasn't", 'lb-cc') ?>" class="fas <?= $item['data']['contains'] ? 'fa-check-circle' : 'fa-times-circle' ?>"></i>
                    <? } ?>
                    <?= __($item['data']['value'], 'lb-cc') ?: __('N/A', 'lb-cc') ?>
                </span>
            <? } ?>
        </div>
    <? } ?>
</div>
<? } ?>