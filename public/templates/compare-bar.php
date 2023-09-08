<?php
$ids = LB_CC_State::get_compare_ids();
?>
<div class="lb-cc-bar-container"<?= count($ids) ? '' : ' style="display: none"' ?>>
    <div class="lb-cc-bar">
        <div class="lb-cc-bar__title"><?= __('Select casinos to compare', 'lb-cc') ?></div>
        <div class="lb-cc-bar__subtitle"><?= sprintf(__('Maximum number of casinos for comparison %d', 'lb-cc'), LB_CC_COMPARE_LIMIT) ?></div>
        <div class="lb-cc-list">
            <? foreach ($ids as $id) { ?>
               <? LB_CC_Template_Loader::load()->set_template_data(['id' => $id])->get_template_part( "compare-preview-item" ); ?>
            <? } ?>
        </div>
        <button class="lb-cc-bar__show-compare"<?= count($ids) ? '' : ' style="display: none"' ?>><?= __('Go to Compare', 'lb-cc') ?></button>
    </div>
    <button class="lb-cc-bar__show-bar"<?= count($ids) > 1 ? '' : ' style="display: none"' ?>></button>
</div>