<div class="card">
	<div class="card-header">
		Поиск
	</div>
	<div class="card-body">
		<form name="table_search" action="/cabinet/my_cabinet.php" method="get"
			<?php
			switch ($_SESSION['viewed_table']) {
				case 'students_of_my_activity':
				case 'all_students':
					echo 'id="student_search"';
					break;
				case 'activities':
					echo 'id="activity_search"';
					break;
				case 'my_apply_requests':
					echo 'id="request_search"';
					break;
				default:
					break;
			}
			?>
		>
			<div class="form-group">
				<?php
					switch ($_SESSION['viewed_table']) {
						case 'students_of_my_activity':
						case 'all_students':
							include_once($_SERVER['DOCUMENT_ROOT'].'/cabinet/search_table_interface_elements/student_field_select.php');
							break;
						case 'activities':
							include_once($_SERVER['DOCUMENT_ROOT'].'/cabinet/search_table_interface_elements/activity_field_select.php');
							break;
						default:
							echo "Поиск ещё не реализован для данного типа данных. Попробуйте позднее";
							break;
					}
				?>
				</div>
				<div class="col" style="text-align: center; padding-top: 30px;" >
					<button type="submit" class="btn btn-primary" value="true" name="search_submit" id="search_submit">Искать</button>
				</div>
			</div>
		</form>
	</div>
</div>