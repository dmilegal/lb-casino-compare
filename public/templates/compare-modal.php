<div class="lb-cc-modal-scroll">
    <button class="lb-cc-modal__close" title="<?= __('close modal', 'lb-cc')?>">
        <i class="fas fa-times"></i>
    </button>
    <div class="lb-cc-modal">
        <div class="lb-cc-modal__inner">
            <div class="lb-cc-modal__title"><?= __('Results of comparison', 'lb-cc') ?></div>
            <div class="lb-cc-table"></div>
            <div class="lb-cc-modal__loading">
                <img width="45" height="45" src="<?= plugin_dir_url(  dirname(__FILE__) ) . '/images/loading.svg' ?>">
            </div>
        </div>
    </div>
</div>