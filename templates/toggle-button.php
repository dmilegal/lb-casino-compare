<?php
$id =  $data->$id;
$title_add = $data->$title_add ?: __('Add to compare', 'lb-cc');
$title_remove = $data->title_remove ?: __('Remove from compare', 'lb-cc');
$cc_ids = LB_CC_State::get_compare_ids();
?>

<button data-id="<?= $id ?>" class="lb-cc-toggle-btn lb-cc-toggle-btn--inline lb-cc-toggle-btn--add<?= !in_array($id, $cc_ids) ? ' lb-cc-toggle-btn--active' : '' ?>"><?= $title_add ?></button>
<button data-id="<?= $id ?>" class="lb-cc-toggle-btn lb-cc-toggle-btn--inline lb-cc-toggle-btn--remove<?= in_array($id, $cc_ids) ? ' lb-cc-toggle-btn--active' : '' ?>"><?= $title_remove ?></button>