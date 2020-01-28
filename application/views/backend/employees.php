<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
         <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-user-secret" aria-hidden="true"></i> Funcionários</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Início</a></li>
                        <li class="breadcrumb-item active">Funcionários</li>
                    </ol>
                </div>
            </div>
            <div class="message"></div>
            <div class="container-fluid">
                <div class="row m-b-10"> 
                    <div class="col-12">
                        <button type="button" class="btn btn-info"><i class="fa fa-plus"></i><a href="<?php echo base_url(); ?>employee/Add_employee" class="text-white"><i class="" aria-hidden="true"></i> Adicionar Funcionário</a></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white"><i class="fa fa-user-o" aria-hidden="true"></i> Funcionários</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="employees123" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Nome do Funcionário</th>
                                                <th>Email</th>
                                                <th>Telefone</th>
                                                <th>Tipo</th>
												<th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                               <tr>
                                                <th>Nome do Funcionário</th>
                                                <th>Email</th>
                                                <th>Telefone</th>
                                                <th>Tipo</th>
                                                <th>Ação</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                           <?php foreach($employee as $value): ?>
                                            <tr>
                                                <td title="<?php echo $value->first_name .' '.$value->last_name; ?>"><?php echo $value->first_name .' '.$value->last_name; ?></td>
                                                <td><?php echo $value->em_email; ?></td>
                                                <td><?php echo $value->em_phone; ?></td>
												<td><?php if($value->em_role=='ADMIN') echo 'Administrador'; else echo 'Funcionário'; ?></td>
                                                <td class="jsgrid-align-center ">
                                                    <a href="<?php echo base_url(); ?>employee/view?I=<?php echo base64_encode($value->em_id); ?>" title="Editar" class="btn btn-sm btn-info waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a>
													<a onclick="return confirm('Tem certeza de que deseja eliminar este funcionário?')" href="<?php echo base_url();?>employee/delete_employee/<?php echo $value->em_id;?>" title="Eliminar" class="btn btn-sm btn-info waves-effect waves-light"><i class="fa fa-trash-o"></i></a>
												</td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php $this->load->view('backend/footer'); ?>
<script>
    $('#employees123').DataTable({
        "aaSorting": [[0,'asc']],
        dom: 'Bfrtp',
        buttons: [
            'excel', 'pdf'
        ]
    });
</script>
