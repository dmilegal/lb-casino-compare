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
    
<? 
 $block_item_offset = 1;   
foreach (LB_CC_Collector::collect_all($id) as $ind => $block) {
    LB_CC_Template_Loader::load()->set_template_data(['block' => $block, 'block_ind' => $ind + 1, 'block_item_offset' => $block_item_offset])->get_template_part("compare-item-block" );
    $block_item_offset += count($block['list']);
} ?>
</div>