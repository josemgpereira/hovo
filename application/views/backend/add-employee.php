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
    <?php $degvalue = $this->employee_model->getdesignation(); ?>
    <?php $depvalue = $this->employee_model->getdepartment(); ?>
            <div class="container-fluid">

               <div class="row">
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white"><i class="fa fa-user-o" aria-hidden="true"></i> Adicionar Funcionário<span class="pull-right " ></span></h4>
                            </div>
                            <?php echo validation_errors(); ?>
                               <?php echo $this->upload->display_errors(); ?>
                               
                               <?php echo $this->session->flashdata('formdata'); ?>
                               <?php echo $this->session->flashdata('feedback'); ?>
                            <div class="card-body">

                                <form class="row" method="post" action="Save" enctype="multipart/form-data">
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Nome Próprio</label>
                                        <input type="text" name="fname" class="form-control form-control-line" placeholder="" minlength="2" required >
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Apelido</label>
                                        <input type="text" id="" name="lname" class="form-control form-control-line" value="" placeholder="" minlength="2" required>
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Código de Funcionário</label>
                                        <input type="text" name="eid" class="form-control form-control-line" placeholder="">
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Departamento</label>
                                        <select name="dept" value="" class="form-control custom-select" required>
                                            <option>Selecione o Departamento</option>
                                            <?Php foreach($depvalue as $value): ?>
                                             <option value="<?php echo $value->id ?>"><?php echo $value->dep_name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Designação</label>
                                        <select name="deg" class="form-control custom-select" required>
                                            <option>Selecione a Designação</option>
                                            <?Php foreach($degvalue as $value): ?>
                                            <option value="<?php echo $value->id ?>"><?php echo $value->des_name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Função</label>
                                        <select name="role" class="form-control custom-select" required>
                                            <option>Selecione a Função</option>
                                            <option value="ADMIN">Administrador</option>
                                            <option value="EMPLOYEE">Funcionário</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Gênero</label>
                                        <select name="gender" class="form-control custom-select" required>
                                            <option>Selecione o Gênero</option>
                                            <option value="MALE">Masculino</option>
                                            <option value="FEMALE">Feminino</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Grupo Sanguíneo</label>
                                        <select name="blood" class="form-control custom-select">
                                            <option>Selecione o Grupo</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="AB+">AB+</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>NIC</label>
                                        <input type="text" name="nid" class="form-control" value="" placeholder="" minlength="8" required>
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Telefone</label>
                                        <input type="text" name="contact" class="form-control" value="" placeholder="" minlength="9" maxlength="15" required>
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Data de Nascimento</label>
                                        <input type="date" name="dob" id="example-email2" name="example-email" class="form-control" placeholder="" required> 
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Data de Enrada</label>
                                        <input type="date" name="joindate" id="example-email2" name="example-email" class="form-control" placeholder=""> 
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Data de Saída</label>
                                        <input type="date" name="leavedate" id="example-email2" name="example-email" class="form-control" placeholder=""> 
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Nome de Utilizador</label>
                                        <input type="text" name="username" class="form-control form-control-line" value="" placeholder="">
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Email</label>
                                        <input type="email" id="example-email2" name="email" class="form-control" placeholder="" minlength="7" required >
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
                                        <button type="submit" class="btn btn-info"> <i class="fa fa-check"></i> Salvar</button>
                                        <button type="button" class="btn btn-info">Cancelar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
<?php $this->load->view('backend/footer'); ?>
