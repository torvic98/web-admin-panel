<?php
	require("include/header.php");

	echo("<!--- Content begin -->");
?>
			<h1>Dashboard</h1>
			<p>Here you can control the main settings.</p>

			<div id="box">
				<div class="box-top">Box</div>
				<div class="box-panel">
					This is some simple text container.
				</div>
			</div>

			<div id="box" class="spoiler">
				<div class="box-top">Spoiler
					<i id="spoiler-drop-down" class="material-icons">arrow_drop_down</i>
				</div>
				<div class="box-panel">
					Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam ultrices vitae enim tristique mollis. Nulla faucibus porttitor nisl, vel imperdiet mi luctus eget. Curabitur vitae urna ac quam tincidunt varius. Curabitur auctor risus in laoreet elementum. Donec et nibh tellus. Vestibulum ac turpis tincidunt, aliquet turpis id, molestie tortor. Aliquam lacinia lacus ut felis rutrum commodo. Proin lacinia tempus leo, a posuere justo rutrum non. Phasellus eu nibh lorem. Nam erat ante, varius sit amet tortor scelerisque, ultrices finibus massa. Nam eu lectus eu nunc condimentum fermentum.
				</div>
			</div>

			<div id="box" class="chart coloured">
				<div class="box-top">Chart</div>
				<div class="box-panel">
					<div id="table">
						<div class="column c4">
							<div class="row header">First column</div>
							<div class="row">Curabitur nunc nunc, imperdiet et vulputate et, rutrum eget nisl. Suspendisse vitae neque vel purus efficitur feugiat. Integer id dapibus sapien. Nulla sit amet ipsum velit. Sed elit ipsum, viverra nec enim et, finibus sollicitudin tellus. Aliquam egestas sapien ex, sed iaculis urna iaculis et.</div>
							<div class="row">Maecenas lacinia, neque quis posuere sagittis, eros lorem sagittis dolor, non luctus justo nulla vitae nisl. Aliquam nibh lacus, placerat vel est at, ultrices tempus mauris. Cras pretium eu turpis ut sodales. Phasellus euismod eu nibh in semper. Nulla facilisi. Integer bibendum felis et odio posuere mollis.</div>
						</div>
						<div class="column c4">
							<div class="row header">Second column</div>
							<div class="row">Nunc consectetur purus vestibulum nisi faucibus, ac fringilla erat ullamcorper. Vestibulum ultrices ipsum eget quam placerat, convallis suscipit dui pellentesque. Sed pellentesque orci ligula, eget laoreet lectus tincidunt at.</div>
							<div class="row">Maecenas lacinia, neque quis posuere sagittis, eros lorem sagittis dolor, non luctus justo nulla vitae nisl. Aliquam nibh lacus, placerat vel est at, ultrices tempus mauris. Cras pretium eu turpis ut sodales. Phasellus euismod eu nibh in semper. Nulla facilisi. Integer bibendum felis et odio posuere mollis.</div>
						</div>
						<div class="column c4">
							<div class="row header">Third column</div>
							<div class="row">Maecenas lacinia, neque quis posuere sagittis, eros lorem sagittis dolor, non luctus justo nulla vitae nisl. Aliquam nibh lacus, placerat vel est at, ultrices tempus mauris. Cras pretium eu turpis ut sodales. Phasellus euismod eu nibh in semper. Nulla facilisi. Integer bibendum felis et odio posuere mollis.</div>
							<div class="row">Maecenas lacinia, neque quis posuere sagittis, eros lorem sagittis dolor, non luctus justo nulla vitae nisl. Aliquam nibh lacus, placerat vel est at, ultrices tempus mauris. Cras pretium eu turpis ut sodales. Phasellus euismod eu nibh in semper. Nulla facilisi. Integer bibendum felis et odio posuere mollis.</div>
						</div>
					</div>
				</div>
			</div>

			<div id="box" class="chart">
				<div class="box-top">Form</div>
				<div class="box-panel">
					<form action="" method="post">
					<div id="table">
						<div class="row header">
							<div class="column c12">Sing up</div>					
						</div>
						<div class="row">
							<div class="column c3">Nombre de pila:</div>
							<div class="column c9"><input name="fname" type="text" class="fill" placeholder="First name"></div>
						</div>
						<div class="row">
							<div class="column c3">Apellidos:</div>
							<div class="column c9"><input name="lname" type="text" class="fill" placeholder="Last name"></div>
						</div>
						<div class="row">
							<div class="column c3">Grupos:</div>
							<div class="column c9">
								<select name="group" class="fill" multiple>
									<option value="admins">Administradores</option>
									<option value="users">Usuarios</option>
									<option value="others">Otros</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="column c3">Sexo:</div>
							<div class="column c9">
								<select name="gender" class="fill">
									<option value="male">Masculino</option>
									<option value="female">Femenino</option>
									<option value="other">Otro</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="column c3">Fecha de nacimiento:</div>
							<div class="column c9">
								<input type="date" name="bday">
							</div>
						</div>
						<div class="row">
							<div class="column c3">Dirección:</div>
							<div class="column c9"><textarea name="address" class="fill" rows="3" cols="30"></textarea></div>
						</div>
						<div class="row">
							<div class="column c3">Acepta las condicones:</div>
							<div class="column c3 align-center"><input type="radio" name="accept" value="yes">Si</div>
							<div class="column c3 align-center"><input type="radio" name="accept" value="no">No</div>
							<div class="column c3 align-center"><input type="radio" name="accept" value="n/a" checked>NS/NC</div>
						</div>
						<div class="row">
							<div class="column c12 align-center"><input type="checkbox" name="newsletter" value="yes">Quiero recibir información por correo electrónico.</div>
						</div>

						<div class="row footer">
							<div class="column c12"><input type="reset" class="right" value="Restaurar"><input type="submit" class="default right" value="Guardar"></div>
						</div>

					</div>
					</form>
				</div>
			</div>
<?php
	echo("<!--- Content end -->");

	require("include/footer.php");
?>