<?php defined('_JEXEC') or die(); ?>
<form action="index.php?option=com_egecalculator&layout=edit&id=<?php echo (int) $this->item->id ?>" method="post" name="adminForm" id="adminForm">
    <div class="form-horizontal">
        <fieldset class="adminform">
            <div class="row-fluid">
                <div class="span6">
                    <?php
                        foreach ($this->form->getFieldset() as $field) {
                            echo $field->renderField();
                        }
                    ?>
                </div>
            </div>
        </fieldset>
    </div>
    <input type="hidden" name="task" value="direction.edit">
    <?php echo JHtml::_('form.token'); ?>
</form>
