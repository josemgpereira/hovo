<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<div class="page-wrapper">
	<!-- ============================================================== -->
	<!-- Bread crumb and right sidebar toggle -->
	<!-- ============================================================== -->
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor"><i class="fa fa-university" aria-hidden="true"></i> Funcionário</h3>
		</div>
		<div class="col-md-7 align-self-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:void(0)">Início</a></li>
				<li class="breadcrumb-item active">Funcionário</li>
			</ol>
		</div>
	</div>
	<div class="message"></div>
	<?php //$degvalue = $this->employee_model->getdesignation(); ?>
	<?php //$depvalue = $this->employee_model->getdepartment(); ?>
	<?php
		$adminEmEmail = $this->session->userdata('email');
		$company_email = ($this->employee_model->getEmpCompanyEmail($adminEmEmail))->company_email;
		$depvalue = $this->organization_model->depselectByCompanyEmail($company_email);
		$degvalue = $this->organization_model->desselectByCompanyEmail($company_email);
	?>
	<div class="container-fluid">

		<div class="row">
			<div class="col-12">
				<div class="card card-outline-info">
					<div class="card-header">
						<h4 class="m-b-0 text-white"><i class="fa fa-user-o" aria-hidden="true"></i> Adicionar Funcionário<span class="pull-right "></span></h4>
					</div>
					<?php echo validation_errors(); ?>
					<?php echo $this->upload->display_errors(); ?>
					<?php $array_data = $this->session->flashdata('post'); ?>
					<?php //echo $this->session->flashdata('formdata'); ?>
					<?php //echo $this->session->flashdata('feedback'); ?>
					<div class="card-body">

						<form class="row" method="post" action="Save" enctype="multipart/form-data">
							<div class="form-group col-md-3 m-t-20">
								<label>Nome Próprio</label>
								<input type="text" name="fname" class="form-control form-control-line" placeholder="" minlength="3" required value="<?php echo $array_data['fname'] ?>">
							</div>
							<div class="form-group col-md-3 m-t-20">
								<label>Apelido</label>
								<input type="text" id="" name="lname" class="form-control form-control-line" placeholder="" minlength="3" required value="<?php echo $array_data['lname'] ?>">
							</div>
							<div class="form-group col-md-3 m-t-20">
								<label>Código de Funcionário</label>
								<input type="text" name="eid" class="form-control form-control-line" placeholder="" value="<?php echo $array_data['eid'] ?>">
							</div>
							<div class="form-group col-md-3 m-t-20">
								<label>Departamento</label>
								<select name="dept" class="form-control custom-select" required value="<?php echo $array_data['dept'] ?>">
									<?Php foreach ($depvalue as $value): ?>
										<option value="<?php echo $value->id ?>" <?php if($value->id==$array_data['dept']){echo 'selected';}?>><?php echo $value->dep_name ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group col-md-3 m-t-20">
								<label>Designação</label>
								<select name="deg" class="form-control custom-select" required value="<?php echo $array_data['deg'] ?>">
									<?Php foreach ($degvalue as $value): ?>
										<option value="<?php echo $value->id ?>" <?php if($value->id==$array_data['deg']){echo 'selected';}?>><?php echo $value->des_name ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group col-md-3 m-t-20">
								<label>Função</label>
								<select name="role" class="form-control custom-select" required value="<?php echo $array_data['role'] ?>">
									<option value="ADMIN" <?php if('ADMIN'==$array_data['role']){echo 'selected';}?>>Administrador</option>
									<option value="EMPLOYEE" <?php if('EMPLOYEE'==$array_data['role']){echo 'selected';}?>>Funcionário</option>
								</select>
							</div>
							<div class="form-group col-md-3 m-t-20">
								<label>Gênero</label>
								<select name="gender" class="form-control custom-select" required value="<?php echo $array_data['gender'] ?>">
									<option value="MALE" <?php if('MALE'==$array_data['gender']){echo 'selected';}?>>Masculino</option>
									<option value="FEMALE" <?php if('FEMALE'==$array_data['gender']){echo 'selected';}?>>Feminino</option>
								</select>
							</div>
							<div class="form-group col-md-3 m-t-20">
								<label>Grupo Sanguíneo</label>
								<select name="blood" class="form-control custom-select" value="<?php echo $array_data['blood'] ?>">
									<option value="O+" <?php if('O+'==$array_data['blood']){echo 'selected';}?>>O+</option>
									<option value="O-" <?php if('O-'==$array_data['blood']){echo 'selected';}?>>O-</option>
									<option value="A+" <?php if('A+'==$array_data['blood']){echo 'selected';}?>>A+</option>
									<option value="A-" <?php if('A-'==$array_data['blood']){echo 'selected';}?>>A-</option>
									<option value="B+" <?php if('B+'==$array_data['blood']){echo 'selected';}?>>B+</option>
									<option value="B-" <?php if('B-'==$array_data['blood']){echo 'selected';}?>>B-</option>
									<option value="AB+" <?php if('AB+'==$array_data['blood']){echo 'selected';}?>>AB+</option>
								</select>
							</div>
							<div class="form-group col-md-3 m-t-20">
								<label>NIC</label>
								<input type="text" name="nid" class="form-control" placeholder="" minlength="8" required value="<?php echo $array_data['nid'] ?>">
							</div>
							<div class="form-group col-md-3 m-t-20">
								<label>Telefone</label>
								<input type="text" name="contact" class="form-control" placeholder="" minlength="9" maxlength="15" required value="<?php echo $array_data['contact'] ?>">
							</div>
							<div class="form-group col-md-3 m-t-20">
								<label>Data de Nascimento</label>
								<input type="date" name="dob" class="form-control" placeholder="" required value="<?php echo $array_data['dob'] ?>">
							</div>
							<div class="form-group col-md-3 m-t-20">
								<label>Data de Entrada</label>
								<input type="date" name="joindate" class="form-control" placeholder="" value="<?php echo $array_data['joindate'] ?>">
							</div>
							<div class="form-group col-md-3 m-t-20">
								<label>Data de Saída</label>
								<input type="date" name="leavedate" class="form-control" placeholder="" value="<?php echo $array_data['leavedate'] ?>">
							</div>
							<div class="form-group col-md-3 m-t-20">
								<label>Nome de Utilizador</label>
								<input type="text" name="username" class="form-control form-control-line" placeholder="" value="<?php echo $array_data['username'] ?>">
							</div>
							<div class="form-group col-md-3 m-t-20">
								<label>Email</label>
								<input type="email" name="email" class="form-control" placeholder="" minlength="7" required value="<?php echo $array_data['email'] ?>">
							</div><!--
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Password </label>
                                        <input type="text" name="password" class="form-control" value="" placeholder="**********"> 
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Confirm Password </label>
                                        <input type="text" name="confirm" class="form-control" value="" placeholder="**********"> 
                                    </div>-->
							<div class="form-group col-md-3 m-t-20">
								<label>Imagem</label>
								<input type="file" name="image_url" class="form-control" value="">
							</div>
							<div class="form-actions col-md-12">
								<button type="submit" class="btn btn-info"><i class="fa fa-check"></i> Salvar</button>
								<button type="button" class="btn btn-info" onclick="window.location='<?php echo base_url(); ?>employee/Employees';return false;">Cancelar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view('backend/footer'); ?>
