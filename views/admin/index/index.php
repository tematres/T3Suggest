<?php echo head(array('title' => 'Tematres Suggest')); ?>
<script type="text/javascript" charset="utf-8">
//<![CDATA[
jQuery(document).ready(function() {
    jQuery('#element-id').change(function() {
        jQuery.post(
            <?php echo js_escape(url('t3-suggest/index/suggest-endpoint')); ?>,
            {element_id: jQuery('#element-id').val()},
            function(data) {
                jQuery('#suggest-endpoint').val(data);
            }
        );
    });
});
//]]>
</script>
<?php echo flash(); ?>
<form method="post" action="<?php echo url('t3-suggest/index/edit-element-suggest'); ?>">
<section class="seven columns alpha">
    <div class="field">
        <div id="element-id-label" class="two columns alpha">
            <label for="element-id"><?php echo __('Element'); ?></label>
        </div>
        <div class="inputs five columns omega">
            <p class="explanation"><?php echo __('Select an element to assign it '
            . 'a Tematres authority/vocabulary. Elements already assigned '
            . 'an authority/vocabulary are marked with an asterisk (*).'); ?></p>
            <?php echo $this->formSelect('element_id', null, array('id' => 'element-id'), $this->form_element_options) ?>
        </div>
    </div>
    <div class="field">
        <div id="suggest-endpoint-label" class="two columns alpha">
            <label for="suggest-endpoint"><?php echo __('Authority/Vocabulary'); ?></label>
        </div>
        <div class="inputs five columns omega">
            <p class="explanation"><?php echo __('Select from the list the authority/vocabulary to enable the autosuggest feature for the above element. <br/> To disable the feature, just deselect the option<br/>.For more information about the authorities and vocabularies available int Tematres, see  '
            . '%shttps://vocabularyserver.com/vocabularies/%s', '<a href="https://vocabularyserver.com/vocabularies/" target="_blank" title="Tematres vocabularies">', '</a>'); ?></p>
            <?php echo $this->formSelect('suggest_endpoint', null, array('id' => 'suggest-endpoint'), $this->form_suggest_options); ?>
        </div>
    </div>
</section>
<section class="three columns omega">
    <div id="edit" class="panel">
        <?php echo $this->formSubmit('edit-element-suggest', __('Save Changes'), array('class' => 'submit big green button')); ?>
    </div>
</section>
</form>
<section class="seven columns alpha">
    <h2><?php echo __('Current Assignments'); ?></h2>
    <?php if ($this->assignments): ?>
    <div class="table-responsive">
    <table>
        <thead>
        <tr>
            <th><?php echo __('Element Set'); ?></th>
            <th><?php echo __('Element'); ?></th>
            <th><?php echo __('Authority/Vocabulary'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($this->assignments as $assignment): ?>
        <tr>
            <td><?php echo $assignment['element_set_name']; ?></td>
            <td><?php echo $assignment['element_name']; ?></td>
            <td><?php echo $assignment['authority_vocabulary']; ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <?php else: ?>
    <p><?php echo __('There are no suggest assignments.'); ?></p>
    <?php endif; ?>
</section>
<?php echo foot(); ?>
