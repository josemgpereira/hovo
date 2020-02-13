<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<div class="page-wrapper">
	<div class="message"></div>
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor"><i class="fa fa-user-secret"
										   style="color:#1976d2"></i> <?php echo $basic->first_name . ' ' . $basic->last_name; ?>
			</h3>
		</div>
		<div class="col-md-7 align-self-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:void(0)">Início</a></li>
				<li class="breadcrumb-item active">Perfil</li>
			</ol>
		</div>
	</div>
	<?php $degvalue = $this->employee_model->getdesignation(); ?>
	<?php $depvalue = $this->employee_model->getdepartment(); ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-xlg-12 col-md-12">
				<div class="card">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs profile-tab" role="tablist">
						<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home" role="tab"
												style="font-size: 14px;">Informação Pessoal</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile" role="tab"
												style="font-size: 14px;">Endereço</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#social" role="tab"
												style="font-size: 14px;">Redes Sociais</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#leave" role="tab"
												style="font-size: 14px;">Férias</a></li>
						<?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?>
							<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#password" role="tab"
													style="font-size: 14px;">Alterar Senha</a></li>
						<?php } else { ?>
							<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#password1" role="tab"
													style="font-size: 14px;">Alterar Senha</a></li>
						<?php } ?>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#emailnotif" role="tab"
												style="font-size: 14px;">Notificações por E-mail</a></li>
					</ul>
					<!-- Tab panes -->

					<div class="tab-content">
						<div class="tab-pane active" id="home" role="tabpanel">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-md-4">
											<div class="card">
												<div class="card-body">
													<center class="m-t-30">
														<?php if (!empty($basic->em_image)) { ?>
															<img
																src="<?php echo base_url(); ?>assets/images/users/<?php echo $basic->em_image; ?>"
																class="img-circle" width="150"/>
														<?php } else { ?>
															<img
																src="<?php echo base_url(); ?>assets/images/users/user.png"
																class="img-circle" width="150"
																alt="<?php echo $basic->first_name ?>"
																title="<?php echo $basic->first_name ?>"/>
														<?php } ?>
														<h4 class="card-title m-t-10"><?php echo $basic->first_name . ' ' . $basic->last_name; ?></h4>
														<h6 class="card-subtitle"><?php echo $basic->des_name; ?></h6>
													</center>
												</div>
												<div>
													<hr>
												</div>
												<div class="card-body"><small class="text-muted">Email</small>
													<h6><?php echo $basic->em_email; ?></h6> <small
														class="text-muted p-t-30 db">Telefone</small>
													<h6><?php echo $basic->em_phone; ?></h6>
													<small class="text-muted p-t-30 db">Perfil Social</small>
													<br/>
													<a class="btn btn-circle btn-secondary"
													   href="<?php if (!empty($socialmedia->facebook)) echo '//' . $socialmedia->facebook ?>"
													   target="_blank"><i class="fa fa-facebook"></i></a>
													<a class="btn btn-circle btn-secondary"
													   href="<?php if (!empty($socialmedia->twitter)) echo '//' . $socialmedia->twitter ?>"
													   target="_blank"><i class="fa fa-twitter"></i></a>
													<a class="btn btn-circle btn-secondary"
													   href="<?php if (!empty($socialmedia->skype_id)) echo '//' . $socialmedia->skype_id ?>"
													   target="_blank"><i class="fa fa-skype"></i></a>
													<a class="btn btn-circle btn-secondary"
													   href="<?php if (!empty($socialmedia->google_plus)) echo '//' . $socialmedia->google_plus ?>"
													   target="_blank"><i class="fa fa-google"></i></a>
												</div>
											</div>
										</div>
										<div class="col-md-8">
											<form class="row" action="Update" method="post"
												  enctype="multipart/form-data">

												<div class="form-group col-md-4 m-t-10">
													<label>Código de Funcionário</label>
													<input
														type="text" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> readonly <?php } ?>
														class="form-control form-control-line" placeholder=""
														name="eid" value="<?php echo $basic->em_code; ?>">
												</div>
												<div class="form-group col-md-4 m-t-10">
													<label>Nome Próprio</label>
													<input type="text" class="form-control form-control-line"
														   placeholder="" name="fname"
														   value="<?php echo $basic->first_name; ?>" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> readonly <?php } ?>
														   minlength="3" required>
												</div>
												<div class="form-group col-md-4 m-t-10">
													<label>Apelido</label>
													<input type="text" id="" name="lname"
														   class="form-control form-control-line"
														   value="<?php echo $basic->last_name; ?>"
														   placeholder="" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> readonly <?php } ?>
														   minlength="3" required>
												</div>
												<div class="form-group col-md-4 m-t-10">
													<label>Grupo Sanguíneo</label>
													<select
														name="blood" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> readonly <?php } ?>
														value="<?php echo $basic->em_blood_group; ?>"
														class="form-control custom-select">
														<option value="O+" <?php if ($basic->em_blood_group == "O+") {
															echo 'selected';
														} ?>>O+
														</option>
														<option value="O-" <?php if ($basic->em_blood_group == "O-") {
															echo 'selected';
														} ?>>O-
														</option>
														<option value="A+" <?php if ($basic->em_blood_group == "A+") {
															echo 'selected';
														} ?>>A+
														</option>
														<option value="A-" <?php if ($basic->em_blood_group == "A-") {
															echo 'selected';
														} ?>>A-
														</option>
														<option value="B+" <?php if ($basic->em_blood_group == "B+") {
															echo 'selected';
														} ?>>B+
														</option>
														<option value="B-" <?php if ($basic->em_blood_group == "B-") {
															echo 'selected';
														} ?>>B-
														</option>
														<option value="AB+" <?php if ($basic->em_blood_group == "AB+") {
															echo 'selected';
														} ?>>AB+
														</option>
													</select>
												</div>
												<div class="form-group col-md-4 m-t-10">
													<label>Gênero</label>
													<select
														name="gender" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> readonly <?php } ?>
														class="form-control custom-select" required>
														<option value="MALE" <?php if ($basic->em_gender == "Male") {
															echo 'selected';
														} ?>>Masculino
														</option>
														<option
															value="FEMALE" <?php if ($basic->em_gender == "Female") {
															echo 'selected';
														} ?>>Feminino
														</option>
													</select>
												</div>
												<?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?><?php } else { ?>
													<div class="form-group col-md-4 m-t-10">
														<label>Função</label>
														<select name="role" class="form-control custom-select"
																required <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> readonly <?php } ?>>
															<option
																value="ADMIN" <?php if ($basic->em_role == "ADMIN") {
																echo 'selected';
															} ?>>Administrador
															</option>
															<option
																value="EMPLOYEE" <?php if ($basic->em_role == "EMPLOYEE") {
																echo 'selected';
															} ?>>Funcionário
															</option>
														</select>
													</div>
												<?php } ?>
												<?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?><?php } else { ?>
													<div class="form-group col-md-4 m-t-10">
														<label>Estado</label>
														<select
															name="status" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> readonly <?php } ?>
															class="form-control custom-select" required>
															<option
																value="ACTIVE" <?php if ($basic->status == "ACTIVE") {
																echo 'selected';
															} ?>>Ativo
															</option>
															<option
																value="INACTIVE" <?php if ($basic->status == "INACTIVE") {
																echo 'selected';
															} ?>>Inativo
															</option>
														</select>
													</div>
												<?php } ?>
												<div class="form-group col-md-4 m-t-10">
													<label>Data de Nascimento</label>
													<input type="date" id="example-email2" name="dob"
														   class="form-control" placeholder=""
														   value="<?php echo $basic->em_birthday; ?>"
														   required <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> readonly <?php } ?>>
												</div>
												<div class="form-group col-md-4 m-t-10">
													<label>NIC</label>
													<input
														type="text" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> readonly <?php } ?>
														class="form-control" placeholder="" name="nid"
														value="<?php echo $basic->em_nid; ?>" minlength="8" required>
												</div>
												<div class="form-group col-md-4 m-t-10">
													<label>Telefone</label>
													<input type="text" class="form-control" placeholder=""
														   name="contact" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> readonly <?php } ?>
														   value="<?php echo $basic->em_phone; ?>" minlength="9"
														   maxlength="15" required>
												</div>
												<?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?><?php } else { ?>
													<div class="form-group col-md-4 m-t-10">
														<label>Departamento</label>
														<select
															name="dept" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> readonly <?php } ?>
															class="form-control custom-select" required>
															<?Php foreach ($depvalue as $value): ?>
																<option
																	value="<?php echo $value->id ?>" <?php if ($basic->dep_name == $value->dep_name) {
																	echo 'selected';
																} ?>><?php echo $value->dep_name ?></option>
															<?php endforeach; ?>
														</select>
													</div>
												<?php } ?>
												<?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?><?php } else { ?>
													<div class="form-group col-md-4 m-t-10">
														<label>Designação</label>
														<select
															name="deg" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> readonly <?php } ?>
															class="form-control custom-select" required>
															<?Php foreach ($degvalue as $value): ?>
																<option
																	value="<?php echo $value->id ?>" <?php if ($basic->des_name == $value->des_name) {
																	echo 'selected';
																} ?>><?php echo $value->des_name ?></option>
															<?php endforeach; ?>
														</select>
													</div>
												<?php } ?>
												<div class="form-group col-md-4 m-t-10">
													<label>Data de Entrada</label>
													<input
														type="date" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> readonly <?php } ?>
														id="example-email2" name="joindate" class="form-control"
														value="<?php echo $basic->em_joining_date; ?>" placeholder="">
												</div>
												<div class="form-group col-md-4 m-t-10">
													<label>Data de Saída</label>
													<input type="date" id="example-email2" name="leavedate"
														   class="form-control" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> readonly <?php } ?>
														   value="<?php echo $basic->em_contact_end; ?>" placeholder="">
												</div>
												<div class="form-group col-md-4 m-t-10">
													<label>Email</label>
													<input type="email" id="example-email2" name="email"
														   class="form-control" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> readonly <?php } ?>
														   value="<?php echo $basic->em_email; ?>"
														   placeholder="" minlength="7" required>
												</div>
												<div class="form-group col-md-12 m-t-10">
													<?php if (!empty($basic->em_image)) { ?>
														<img
															src="<?php echo base_url(); ?>assets/images/users/<?php echo $basic->em_image; ?>"
															class="img-circle" width="150"/>
													<?php } else { ?>
														<img src="<?php echo base_url(); ?>assets/images/users/user.png"
															 class="img-circle" width="150"
															 alt="<?php echo $basic->first_name ?>"
															 title="<?php echo $basic->first_name ?>"/>
													<?php } ?>
													<label>Imagem</label>
													<br><br>
													<input
														type="file" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> readonly <?php } ?>
														name="image_url" class="form-control" value="">
												</div>
												<?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?>
												<?php } else { ?>
													<div class="form-actions col-md-12">
														<input type="hidden" name="emid"
															   value="<?php echo $basic->em_id; ?>">
														<button type="submit" class="btn btn-info"><i
																class="fa fa-check"></i> Salvar
														</button>
													</div>
												<?php } ?>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--second tab-->
						<div class="tab-pane" id="profile" role="tabpanel">
							<div class="card">
								<div class="card-body">
									<h3 class="card-title">Contacto</h3>
									<form class="row" action="Parmanent_Address" method="post"
										  enctype="multipart/form-data">
										<div class="form-group col-md-12 m-t-5">
											<label>Endereço</label>
											<textarea name="paraddress"
													  value="<?php if (!empty($permanent->address)) echo $permanent->address ?>" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> readonly <?php } ?> class="form-control"
													  rows="3" minlength="7"
													  required><?php if (!empty($permanent->address)) echo $permanent->address ?></textarea>
										</div>
										<div class="form-group col-md-6 m-t-5">
											<label>Cidade</label>
											<input type="text" name="parcity" class="form-control form-control-line"
												   placeholder="" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> readonly <?php } ?>
												   value="<?php if (!empty($permanent->city)) echo $permanent->city ?>"
												   minlength="2" required>
										</div>
										<div class="form-group col-md-6 m-t-5">
											<label>País</label>
											<input type="text" name="parcountry" class="form-control form-control-line"
												   placeholder="" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> readonly <?php } ?>
												   value="<?php if (!empty($permanent->country)) echo $permanent->country ?>"
												   minlength="2" required>
										</div>
										<?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?>
										<?php } else { ?>
											<div class="form-actions col-md-12">
												<input type="hidden" name="emid" value="<?php echo $basic->em_id ?>">
												<input type="hidden" name="id"
													   value="<?php if (!empty($permanent->id)) echo $permanent->id ?>">
												<button type="submit" class="btn btn-info"><i class="fa fa-check"></i>
													Salvar
												</button>
											</div>
										<?php } ?>
									</form>
								</div>
							</div>
						</div>


						<div class="tab-pane" id="leave" role="tabpanel">
							<div class="card">
								<div class="card-body">
									<h3 class="card-title">Férias</h3>
									<form class="row" action="Leaves_days" method="post"
										  enctype="multipart/form-data">

										<div class="form-group col-md-6 m-t-5">
											<label>Número de Dias</label>
											<input type="text" name="noday" class="form-control form-control-line"
												   placeholder="" <?php if (($this->session->userdata('user_type') == 'EMPLOYEE') or ($basic->em_role == 'ADMIN')) { ?> readonly <?php } ?>
												   value="<?php if (!empty($leaves->days)) echo $leaves->days ?>" required>
										</div>

										<?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?>
										<?php } else { ?>
											<div class="form-actions col-md-12">
												<input type="hidden" name="em_id" value="<?php echo $basic->em_id ?>">
												<button type="submit" class="btn btn-info"><i class="fa fa-check"></i>
													Salvar
												</button>
											</div>
										<?php } ?>
									</form>
								</div>
							</div>
						</div>


						<div class="tab-pane" id="password1" role="tabpanel">
							<div class="card-body">
								<form class="row" action="Reset_Password_Hr" method="post"
									  enctype="multipart/form-data">
									<div class="form-group col-md-6 m-t-20">
										<label>Nova Senha</label>
										<input type="text" class="form-control" name="new1" value="" required
											   minlength="6">
									</div>
									<div class="form-group col-md-6 m-t-20">
										<label>Confirmar Nova Senha</label>
										<input type="text" id="" name="new2" class="form-control " required
											   minlength="6">
									</div>
									<?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?>
									<?php } else { ?>
										<div class="form-actions col-md-12">
											<input type="hidden" name="emid" value="<?php echo $basic->em_id; ?>">
											<button type="submit" class="btn btn-info"><i
													class="fa fa-check"></i> Salvar
											</button>
										</div>
									<?php } ?>
								</form>
							</div>
						</div>
						<div class="tab-pane" id="social" role="tabpanel">
							<div class="card-body">
								<form class="row" action="Save_Social" method="post" enctype="multipart/form-data">
									<div class="form-group col-md-6 m-t-20">
										<label>Facebook</label>
										<input type="text"
											   class="form-control" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> readonly <?php } ?>
											   name="facebook"
											   value="<?php if (!empty($socialmedia->facebook)) echo $socialmedia->facebook ?>"
											   placeholder="">
									</div>
									<div class="form-group col-md-6 m-t-20">
										<label>Twitter</label>
										<input type="text"
											   class="form-control" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> readonly <?php } ?>
											   name="twitter"
											   value="<?php if (!empty($socialmedia->twitter)) echo $socialmedia->twitter ?>">
									</div>
									<div class="form-group col-md-6 m-t-20">
										<label>Google +</label>
										<input type="text" id=""
											   name="google" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> readonly <?php } ?>
											   class="form-control "
											   value="<?php if (!empty($socialmedia->google_plus)) echo $socialmedia->google_plus ?>">
									</div>
									<div class="form-group col-md-6 m-t-20">
										<label>Skype</label>
										<input type="text" id=""
											   name="skype" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> readonly <?php } ?>
											   class="form-control "
											   value="<?php if (!empty($socialmedia->skype_id)) echo $socialmedia->skype_id ?>">
									</div>
									<?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?>
									<?php } else { ?>
										<div class="form-actions col-md-12">
											<input type="hidden" name="emid" value="<?php echo $basic->em_id; ?>">
											<input type="hidden" name="id"
												   value="<?php if (!empty($socialmedia->id)) echo $socialmedia->id ?>">
											<button type="submit" class="btn btn-info"><i
													class="fa fa-check"></i> Salvar
											</button>
										</div>
									<?php } ?>
								</form>
							</div>
						</div>
						<div class="tab-pane" id="password" role="tabpanel">
							<div class="card-body">
								<form class="row" action="Reset_Password" method="post" enctype="multipart/form-data">
									<div class="form-group col-md-6 m-t-20">
										<label>Senha Antiga</label>
										<input type="text" class="form-control" name="old" value=""
											   placeholder="" required minlength="6">
									</div>
									<div class="form-group col-md-6 m-t-20">
										<label>Nova Senha</label>
										<input type="text" class="form-control" name="new1" value="" required
											   minlength="6">
									</div>
									<div class="form-group col-md-6 m-t-20">
										<label>Confirmar Nova Senha</label>
										<input type="text" id="" name="new2" class="form-control " required
											   minlength="6">
									</div>
									<div class="form-actions col-md-12">
										<input type="hidden" name="emid" value="<?php echo $basic->em_id; ?>">
										<button type="submit" class="btn btn-info"><i
												class="fa fa-check"></i> Salvar
										</button>
									</div>
								</form>
							</div>
						</div>
						<div class="tab-pane" id="emailnotif" role="tabpanel">
							<div class="card-body">
								<form class="row" action="updateEmailNotifications" method="post" enctype="multipart/form-data">
									<div class="form-group col-md-6 m-t-20">
										<?php
										$email_notif = ($this->employee_model->getEmpEmailNotif($basic->em_id))->email_notif;
										?>
										<!--<label>Notificações por E-mail</label>-->
										<div class="form-check">
											<input type="checkbox" class="form-check-input" name="emailNotifications" id="emailNotifications" <?=($email_notif == 1) ? "checked" : "" ?>>
											<label class="form-check-label" for="emailNotifications">Notificações por E-mail</label>
										</div>
									</div>
									<div class="form-actions col-md-12">
										<input type="hidden" name="emid" value="<?php echo $basic->em_id; ?>">
										<button type="submit" class="btn btn-info"><i
												class="fa fa-check"></i> Salvar
										</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Column -->
		</div>
		<script type="text/javascript">
			$('.total').on('input', function () {
				var amount = parseInt($('.total').val());
				$('.basic').val((amount * .50 ? amount * .50 : 0).toFixed(2));
				$('.houserent').val((amount * .40 ? amount * .40 : 0).toFixed(2));
				$('.medical').val((amount * .05 ? amount * .05 : 0).toFixed(2));
				$('.conveyance').val((amount * .05 ? amount * .05 : 0).toFixed(2));
			});
		</script>
		<?php $this->load->view('backend/em_modal'); ?>
		<script type="text/javascript">
			$(document).ready(function () {
				$(".education").click(function (e) {
					e.preventDefault(e);
					// Get the record's ID via attribute
					var iid = $(this).attr('data-id');
					$('#educationmodal').trigger("reset");
					$('#EduModal').modal('show');
					$.ajax({
						url: 'educationbyib?id=' + iid,
						method: 'GET',
						data: '',
						dataType: 'json',
					}).done(function (response) {
						console.log(response);
						// Populate the form fields with the data returned from server
						$('#educationmodal').find('[name="id"]').val(response.educationvalue.id).end();
						$('#educationmodal').find('[name="name"]').val(response.educationvalue.edu_type).end();
						$('#educationmodal').find('[name="institute"]').val(response.educationvalue.institute).end();
						$('#educationmodal').find('[name="result"]').val(response.educationvalue.result).end();
						$('#educationmodal').find('[name="year"]').val(response.educationvalue.year).end();
						$('#educationmodal').find('[name="emid"]').val(response.educationvalue.emp_id).end();
					});
				});
			});
		</script>
		<script type="text/javascript">
			$(document).ready(function () {
				$(".experience").click(function (e) {
					e.preventDefault(e);
					// Get the record's ID via attribute
					var iid = $(this).attr('data-id');
					$('#experiencemodal').trigger("reset");
					$('#ExpModal').modal('show');
					$.ajax({
						url: 'experiencebyib?id=' + iid,
						method: 'GET',
						data: '',
						dataType: 'json',
					}).done(function (response) {
						console.log(response);
						// Populate the form fields with the data returned from server
						$('#experiencemodal').find('[name="id"]').val(response.expvalue.id).end();
						$('#experiencemodal').find('[name="company_name"]').val(response.expvalue.exp_company).end();
						$('#experiencemodal').find('[name="position_name"]').val(response.expvalue.exp_com_position).end();
						$('#experiencemodal').find('[name="address"]').val(response.expvalue.exp_com_address).end();
						$('#experiencemodal').find('[name="work_duration"]').val(response.expvalue.exp_workduration).end();
						$('#experiencemodal').find('[name="emid"]').val(response.expvalue.emp_id).end();
					});
				});
			});
		</script>
		<script type="text/javascript">
			$(document).ready(function () {
				$(".deletexp").click(function (e) {
					e.preventDefault(e);
					// Get the record's ID via attribute
					var iid = $(this).attr('data-id');
					$.ajax({
						url: 'EXPvalueDelet?id=' + iid,
						method: 'GET',
						data: 'data',
					}).done(function (response) {
						console.log(response);
						$(".message").fadeIn('fast').delay(3000).fadeOut('fast').html(response);
						window.setTimeout(function () {
							location.reload()
						}, 2000)
						// Populate the form fields with the data returned from server
					});
				});
			});
		</script>
		<script type="text/javascript">
			$(document).ready(function () {
				$(".edudelet").click(function (e) {
					e.preventDefault(e);
					// Get the record's ID via attribute
					var iid = $(this).attr('data-id');
					$.ajax({
						url: 'EduvalueDelet?id=' + iid,
						method: 'GET',
						data: 'data',
					}).done(function (response) {
						console.log(response);
						$(".message").fadeIn('fast').delay(3000).fadeOut('fast').html(response);
						window.setTimeout(function () {
							location.reload()
						}, 2000)
						// Populate the form fields with the data returned from server
					});
				});
			});
		</script>

		<?php $this->load->view('backend/footer'); ?>
