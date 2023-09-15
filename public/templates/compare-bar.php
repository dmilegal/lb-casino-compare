<?php 
$btn_position = get_field('lb_cc_open_bar_button_positions', 'option');
?>

<div class="lb-cc-bar" style="display: none">
    <button class="lb-cc-bar__close" title="<?= __('Close', 'lb-cc') ?>">
        <i class="fas fa-times"></i>
    </button>
    <div class="lb-cc-bar__title"><?= __('Selected casinos for comparison', 'lb-cc') ?></div>
    <div class="lb-cc-bar__subtitle"><?= sprintf(__('Maximum number of casinos for comparison %d', 'lb-cc'), LB_CC_COMPARE_LIMIT) ?></div>
    <div class="lb-cc-bar__list"></div>
    <div class="lb-cc-bar__loading">
        <img width="45" height="45" src="<?= plugin_dir_url(  dirname(__FILE__) ) . '/images/loading.svg' ?>">
    </div>
    <div class="lb-cc-bar__actions">
        <button class="lb-cc-button lb-cc-bar__show-compare" style="display: none"><?= __('Go to Compare', 'lb-cc') ?></button>
    </div>
</div>

<button class="lb-cc-bar-show lb-cc-bar-show--<?= $btn_position && isset($btn_position['position']) ? $btn_position['position'] : 'bottom-right' ?>" 
    style="display: none;<?= $btn_position && isset($btn_position['x_offset']) && $btn_position['x_offset'] ? '--lb-cc--bar-button--offset--x:' . $btn_position['x_offset'] . 'px;' : '' ?><?= $btn_position && isset($btn_position['y_offset']) && $btn_position['y_offset'] ? '--lb-cc--bar-button--offset--y:' . $btn_position['y_offset'] . 'px;' : '' ?>;">
    <i class="fas fa-balance-scale"></i>
</button>