<?php
$document = JFactory::getDocument();
$textChooseSubject = JText::_('COM_EGECALCULATOR_CHOOSE_SUBJECTS');
$textLoading = JText::_('COM_EGECALCULATOR_LOADING');
$js = <<< JS
/**
* Преобразует массив значений в строку таблицы формата html
* @param values array
* @param isHeader boolean [false]
* @param colspan integer [0]
* @returns {string}
*/
function getRow(values, isHeader = false, colspan = 0) {
    const tag = isHeader ? 'th' : 'td';
    const colspanAttr = (colspan > 0) ? ' colspan="' + colspan + '"' : '';  
    let html = '<tr>';
    for (let i = 0; i < values.length; i++) {
        html += '<' + tag + colspanAttr + '>' + (values[i] !== '0' ? values[i] : '-') + '</' + tag + '>';
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
                        // сформировать таблицу
                        // формат:
                        // category 1
                        // direction 1 | col 1 | col 2 | ...
                        const categories = data.data.categories;
                        const directions = data.data.directions;
                        categories.forEach(function(category) {
                            const filteredDirections = directions.filter(direction => category.id === direction.catid);
                            if (filteredDirections.length !== 0) {
                                rows += '<tr><th colspan="4">' + category.title + '</th></tr>';
								filteredDirections.forEach(function(direction) {
								    rows += '<tr>';
								    rows += direction.link.length ?
								    	'<td><a href="' + direction.link + '" target="_blank">' + direction.title + '</a></td>' :
								    	'<td>' + direction.title + '</td>';
								    rows += '<td>' + direction.budget_places + '</td>';
								    rows += '<td>' + direction.paid_places + '</td>';
								    rows += '<td>' + direction.passing_grade + '</td>';
								    rows += '</tr>';
								});
                            }
                        });
                        // задать содержимое таблицы
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
		<?php
		$eges = array_filter($this->subjects, function($subject) {
			return $subject->type === "0";
		});
		$others = array_filter($this->subjects, function($subject) {
			return $subject->type !== "0";
		});
		?>
        <form id="egecalculator-form">
			<?php if (count($eges) > 0) { ?>
				<fieldset>
					<legend>ЕГЭ</legend>
					<?php
					foreach ($eges as $subject) {
						$html = "<label class=\"egecalculator-label\" for=\"subject-{$subject->id}\">";
						$html .= "<input type=\"checkbox\" id=\"subject-{$subject->id}\" value=\"{$subject->id}\"/>&nbsp;";
						$html .= "{$subject->title}</label><br>";
						echo $html;
					}
					?>
				</fieldset>
			<?php } ?>
			<?php if (count($others) > 0) { ?>
				<fieldset>
					<legend>Прочие испытания</legend>
					<?php
					foreach ($others as $subject) {
						$html = "<label class=\"egecalculator-label\" for=\"subject-{$subject->id}\">";
						$html .= "<input type=\"checkbox\" id=\"subject-{$subject->id}\" value=\"{$subject->id}\"/>&nbsp;";
						$html .= "{$subject->title}</label><br>";
						echo $html;
					}
					?>
				</fieldset>
			<?php } ?>
			<br>
            <button class="btn" type="submit"><?php echo JText::_('COM_EGECALCULATOR_FORM_SUBMIT') ?></button>
			<br>
			<br>
        </form>
        <div id="egecalculator-directions">
            <?php echo JText::_('COM_EGECALCULATOR_CHOOSE_SUBJECTS') ?>
        </div>
        <table style="display: none;" class="egecalculator-table" id="egecalculator-table">
            <thead>
            <tr>
                <th><?php echo JText::_('COM_EGECALCULATOR_TABLE_DIRECTIONS_HEADER') ?></th>
                <th><?php echo JText::_('COM_EGECALCULATOR_TABLE_BUDGET_PLACES') ?></th>
                <th><?php echo JText::_('COM_EGECALCULATOR_TABLE_PAID_PLACES') ?></th>
                <th><?php echo JText::_('COM_EGECALCULATOR_TABLE_PASSING_SCORE') ?></th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
