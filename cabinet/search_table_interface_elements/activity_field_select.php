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
		<label for="activity_name">Название кружка</label>
		<input type="text" name="activity_name" id="activity_name" class="form-control">
	</div>
	<div class="col">
		<label for="teacher_name">Имя учителя</label>
		<input type="text" name="teacher_name" id="teacher_name" class="form-control">
	</div>
</div>
Наличие учебного плана
<div class="row">
	<div class="col">
		<label for="not_necessary">Необязательно</label>
		<input type="radio" name="has_plan" id="not_necessary" value="" checked>
	</div>
	<div class="col">
		<label for="it_has_plan">Есть план</label>
		<input type="radio" name="has_plan" id="it_has_plan" value="true">
	</div>
	<div class="col">
		<label for="does_not_have_plan">Нет плана</label>
		<input type="radio" name="has_plan" id="does_not_have_plan" value="false">
	</div>
</div>