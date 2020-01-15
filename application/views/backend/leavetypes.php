<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<div class="page-wrapper">
    <!--<div class="message"></div>-->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-fighter-jet" style="color:#1976d2"></i> Tipo de Licença</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Início</a></li>
                <li class="breadcrumb-item active">Tipo de Licença</li>
            </ol>
        </div>
    </div>
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <div class="row m-b-10">
            <div class="col-12">
                <button type="button" class="btn btn-info"><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#leavemodel" data-whatever="@getbootstrap" class="text-white"><i class="" aria-hidden="true"></i> Adicionar Tipo de Licença</a></button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"> Tipos de Licença</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tipo de Licença</th>
                                        <th>Número de Dias</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                        <th>ID </th>
                                        <th>Tipo de Licença</th>
                                        <th>Número de Dias</th>
                                        <th>Ação</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach($leavetypes as $value): ?>
                                    <tr>
                                        <td><?php echo $value->type_id; ?></td>
                                        <td><?php echo $value->name ?></td>
                                        <td><?php echo $value->leave_day ?></td>
                                        <td class="jsgrid-align-center ">
                                            <a href="" title="Editar" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> hidden <?php } ?> class="btn btn-sm btn-info waves-effect waves-light leavetype" data-id="<?php echo $value->type_id; ?>"><i class="fa fa-pencil-square-o"></i></a>
											<a onclick="return confirm('Tem certeza de que deseja eliminar este tipo de licença?')" href="<?php echo base_url();?>leave/LeavetypeDelete/<?php echo $value->type_id;?>" title="Eliminar" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> hidden <?php } ?> class="btn btn-sm btn-info waves-effect waves-light"><i class="fa fa-trash-o"></i></a>
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
        <div class="modal fade" id="leavemodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Licença</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form method="post" action="Add_leaves_Type" id="leaveform" enctype="multipart/form-data">
                        <div class="modal-body">
                            
                            <div class="form-group">
                                <label class="control-label">Tipo</label>
                                <input type="text" name="leavename" class="form-control" id="recipient-name1" minlength="1" maxlength="35" value="" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Dias</label>
                                <input type="text" name="leaveday" class="form-control" id="recipient-name1" value="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Estado</label>
                                <select class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1" name="status" required>
                                    <option value="">Selecione o Estado</option>
                                    <option value="1">Ativo</option>
                                    <option value="0">Inativo</option>
                                </select>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" value="" class="form-control" id="recipient-name1">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Submeter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
        $(document).ready(function () {
        $(".leavetype").click(function (e) {
        e.preventDefault(e);
        // Get the record's ID via attribute
        var iid = $(this).attr('data-id');
        $('#leaveform').trigger("reset");
        $('#leavemodel').modal('show');
        $.ajax({
        url: 'LeaveTypebYID?id=' + iid,
        method: 'GET',
        data: '',
        dataType: 'json',
        }).done(function (response) {
        console.log(response);
        // Populate the form fields with the data returned from server
                                                            $('#leaveform').find('[name="id"]').val(response.leavetypevalue.type_id).end();
        $('#leaveform').find('[name="leavename"]').val(response.leavetypevalue.name).end();
        $('#leaveform').find('[name="leaveday"]').val(response.leavetypevalue.leave_day).end();
        $('#leaveform').find('[name="status"]').val(response.leavetypevalue.status).end();
                                                        });
        });
        });
        </script>
        <script type="text/javascript">
        $(document).ready(function () {
        $(".holidelet").click(function (e) {
        e.preventDefault(e);
        // Get the record's ID via attribute
        var iid = $(this).attr('data-id');
        $.ajax({
        url: 'HOLIvalueDelet?id=' + iid,
        method: 'GET',
        data: 'data',
        }).done(function (response) {
        console.log(response);
        $(".message").fadeIn('fast').delay(3000).fadeOut('fast').html(response);
        window.setTimeout(function(){location.reload()},2000)
        // Populate the form fields with the data returned from server
                                                        });
        });
        });
        </script>
        <?php $this->load->view('backend/footer'); ?>
