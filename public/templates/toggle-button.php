<?php
$id = $data->id;
$title_add = property_exists($data, 'title_add') ? $data->title_add : __('Add to compare', 'lb-cc');
$title_remove = property_exists($data, 'title_remove') ? $data->title_remove : __('Remove from compare', 'lb-cc');
?>

<button data-id="<?= $id ?>" class="lb-cc-toggle-btn lb-cc-toggle-btn--inline lb-cc-toggle-btn--add lb-cc-toggle-btn--active">
    <i class="fas fa-exchange-alt"></i>
    <span><?= $title_add ?></span>
</button>
<button data-id="<?= $id ?>" class="lb-cc-toggle-btn lb-cc-toggle-btn--inline lb-cc-toggle-btn--remove">
    <i class="far fa-times-circle"></i>
    <span><?= $title_remove ?></span>
</button>