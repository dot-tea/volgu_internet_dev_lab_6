<div class="row">
	<?php 
		if ('director' === $permission && 'all_students' === $_SESSION['viewed_table']) {
			$table_select = '<div class="col"><label for="search_activity_select">Искать в кружке:</label><select class="form-control" id="search_activity_select" name="search_activity_select">';
			$table_select .= '<option value="0">Все кружки</option>';
			include_once($_SERVER['DOCUMENT_ROOT'].'/cabinet/activity_data_db_operations.php');
			$activity_ids = get_ids_from('activities');
			foreach ($activity_ids as $id) {
				$table_select .= '<option value="'.$id.'">'.get_activity_name($id).'</option>';
			}
			$table_select .= '</select></div>';
			echo $table_select;
		}
	?>
</div>
<div class="row">
	<div class="col">
		<label for="date_search_from">Искать с: &nbsp;</label>
		<input type="date" name="date_search_from" id="date_search_from" class="form-control">
	</div>
	<div class="col">
		<label for="date_search_to">по: &nbsp;</label>
		<input type="date" name="date_search_to" id="date_search_to" class="form-control">
	</div>
</div>
<div class="row">
	<div class="col">
		<label for="student_name">Число посещённых занятий от:</label>
		<input type="number" min="0" name="attended_lessons_from" class="form-control">
	</div>
	<div class="col">
			<label for="student_name">до:</label>
			<input type="number" min="0" name="attended_lessons_to" class="form-control">
	</div>
</div>
<small class="form-text text-muted">
	Если вы хотите найти ученика без эл. почты или номера телефона, поставьте знак - в соответствующее поле
</small>
<div class="row">
	<div class="col">
			<label for="student_name">ФИО ученика</label>
			<input type="text" name="student_name" class="form-control">
	</div>
	<div class="col">
		<label for="email">Эл. почта</label>
		<input type="text" name="email" class="form-control">
	</div>
	<div class="col">
		<label for="phone_number">Номер телефона</label>
		<input type="text" name="phone_number" class="form-control">
	</div>
</div>