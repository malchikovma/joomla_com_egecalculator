<?php
$document = JFactory::getDocument();
$textChooseSubject = JText::_('COM_EGECALCULATOR_CHOOSE_SUBJECTS');
$textLoading = JText::_('COM_EGECALCULATOR_LOADING');
$js = <<< JS
/**
* Преобразует массив значений в строку таблицы формата html
* @param values array
* @returns {string}
*/
function getRow(values) {
    let html = '<tr>';
    for (let i = 0; i < values.length; i++) {
        html += '<td>' + values[i] + '</td>';
    }
    html += '</td>';
    return html;
}

jQuery(function($){
    const form = $('#egecalculator-form');
    const result = $('#egecalculator-directions');
    const table = $('#egecalculator-table');
    form.on('submit', function(event) {
        event.preventDefault();
        table.hide();
        // выбранные значения в массив
        const selectedSubjects = form.find('input:checkbox:checked').map(function() {
            return $(this).val();
        }).get().join();
        if (selectedSubjects.length < 3) {
            result.text('$textChooseSubject');
        } else {
            result.text('$textLoading');
            // https://api.jquery.com/jQuery.get/
            $.get('/index.php', {
                   'option': 'com_egecalculator',
                   'view': 'directions',
                   'format': 'json',
                   'subjects': selectedSubjects
               }, function(data, textStatus, jqXHR) {
                    if (data.success) {
                        let rows = '';
                        console.log(data.data);
                        data.data.forEach(function(direction) {
                            rows += getRow(Object.values(direction));
                        });
                        table.find('tbody').html(rows);
                        table.show();
                        result.text('')
                    } else {
                        result.text(data.message)
                    }
               }, 'json');
        }
    });
});
JS;
$document->addScriptDeclaration($js);
$css = <<< CSS
.egecalculator-table {
    border: solid 1px;
}
.egecalculator-table td, .egecalculator-table th{
    border: solid 1px;
    padding: 5px;
}
CSS;
$document->addStyleDeclaration($css)
?>
<div itemscope itemtype="https://schema.org/Article">
    <div class="page-header">
        <h2 itemprop="headline">
            <?php echo JText::_('COM_EGECALCULATOR_TITLE') ?>
        </h2>
        <form id="egecalculator-form">
            <?php
                foreach ($this->subjects as $subject) {
                    $html = "<label class=\"egecalculator-label\" for=\"subject-{$subject->id}\">";
                    $html .= "<input type=\"checkbox\" id=\"subject-{$subject->id}\" value=\"{$subject->id}\"/>&nbsp;";
                    $html .= "{$subject->title}</label><br>";
                    echo $html;
                }
            ?>
            <button class="btn" type="submit"><?php echo JText::_('COM_EGECALCULATOR_FORM_SUBMIT') ?></button>
        </form>
        <div id="egecalculator-directions">
            <?php echo JText::_('COM_EGECALCULATOR_CHOOSE_SUBJECTS') ?>
        </div>
        <table style="display: none;" class="egecalculator-table" id="egecalculator-table">
            <thead>
            <tr>
                <th rowspan="2"><?php echo JText::_('COM_EGECALCULATOR_TABLE_DIRECTIONS_HEADER') ?></th>
                <th colspan="2"><?php echo JText::_('COM_EGECALCULATOR_TABLE_FULLTIME_HEADER') ?></th>
                <th colspan="2"><?php echo JText::_('COM_EGECALCULATOR_TABLE_DISTANT_HEADER') ?></th>
            </tr>
            <tr>
                <th><?php echo JText::_('COM_EGECALCULATOR_TABLE_PLACES_HEADER') ?></th>
                <th><?php echo JText::_('COM_EGECALCULATOR_TABLE_SCORE_HEADER') ?></th>
                <th><?php echo JText::_('COM_EGECALCULATOR_TABLE_PLACES_HEADER') ?></th>
                <th><?php echo JText::_('COM_EGECALCULATOR_TABLE_SCORE_HEADER') ?></th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
