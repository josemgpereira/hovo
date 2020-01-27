<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<div class="page-wrapper">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-history" style="color:#1976d2"> </i> Histórico de Requerimentos</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Início</a></li>
                <li class="breadcrumb-item active">Histórico de Requerimentos</li>
            </ol>
        </div>
    </div>
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white">Histórico</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Nome do Funcionário</th>
                                        <th>Data de Requerimento</th>
                                        <th>Data Inicial</th>
                                        <th>Data Final</th>
                                        <th>Duração</th>
                                        <th>Estado</th>
                                        <th>Motivo de Rejeição</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nome do Funcionário</th>
                                        <th>Data de Requerimento</th>
                                        <th>Data Inicial</th>
                                        <th>Data Final</th>
                                        <th>Duração</th>
                                        <th>Estado</th>
                                        <th>Motivo de Rejeição</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach($application as $value): ?>
                                    <tr style="vertical-align:top">
                                        <td><span><?php echo $value->first_name.' '.$value->last_name ?></span></td>
                                        <td><?php echo date('d-m-Y',strtotime($value->apply_date)); ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($value->start_date)); ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($value->end_date)); ?></td>
                                        <td>
                                            
                                            <!-- Duration filtering -->
                                            <?php
                                                if($value->leave_duration > 8) {
                                                    $originalDays = $value->leave_duration;
                                                    $days = $originalDays / 8;
                                                    $hour = 0;
                                                    // 120 / 8 = 15 // 15 day
                                                    // 13 - (1*8) = 5 hour

                                                    if(is_float($days)) {
                                                        
                                                        $days = floor($days); // 1
                                                        $hour = $value->leave_duration - ($days * 8); // 5
                                                    }
                                                } else {
                                                    $days = 0;
                                                    $hour = $value->leave_duration;
                                                }
                                                

                                                $daysDenom = ($days == 1) ? " dia" : " dias";
                                                $hourDenom = ($hour == 1) ? " hora" : " horas";

                                                if($days > 0) {
                                                    echo $days . $daysDenom;
                                                } else {
                                                    echo $hour . $hourDenom;
                                                }
                                            ?>

                                        </td>
										<td><?php if($value->leave_status=='Approve') echo 'Aprovado'; elseif($value->leave_status=='Rejected') echo 'Rejeitado'; else echo 'Não Aprovado'; ?></td>
										<td><?php echo $value->reject_reason; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>

<?php $this->load->view('backend/footer'); ?>
