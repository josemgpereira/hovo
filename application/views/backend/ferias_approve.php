<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<div class="page-wrapper">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-clone" style="color:#1976d2"> </i> Requerimento de Licença</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Início</a></li>
                <li class="breadcrumb-item active">Requerimento de Licença</li>
            </ol>
        </div>
    </div>
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <div class="row m-b-10">
            <?php // if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> 
                <div class="col-12">
                    <button type="button" class="btn btn-info"><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#appmodel" data-whatever="@getbootstrap" class="text-white"><i class="" aria-hidden="true"></i> Adicionar Requerimento</a></button>
                </div>
            <?php // } ?> 
        </div> 
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"> Requerimentos</h4>
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
                                        <th>Ação</th>
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
                                        <th>Ação</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach($application as $value): ?>
                                    <tr style="vertical-align:top">
                                        <td><span><?php echo $value->first_name.' '.$value->last_name ?></span></td>
                                        <td><?php echo date('jS \of F Y',strtotime($value->apply_date)); ?></td>
                                        <td><?php echo $value->start_date; ?></td>
                                        <td><?php echo $value->end_date; ?></td>
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
                                        <td><?php echo $value->leave_status; ?></td>
                                        <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> 
                                        
                                         <?php } else { ?> 
                                        <td class="jsgrid-align-center">
                                            
                                           <?php if($value->leave_status =='Approve'){ ?>
                                           
                                             <?php } elseif($value->leave_status =='Not Approve'){ ?>
                                            <a href="" title="Aprovar" class="btn btn-sm btn-info waves-effect waves-light Status" data-employeeId=<?php echo $value->em_id; ?>  data-id="<?php echo $value->id; ?>" data-value="Approve" data-duration="<?php echo $value->leave_duration; ?>" data-type="<?php echo $value->typeid; ?>" data-depid="<?php echo $value->dep_id; ?>" data-startdate="<?php echo $value->start_date; ?>" data-enddate="<?php echo $value->end_date; ?>">Aprovar</a>
                                            <!--<a href="" title="Rejeitar" class="btn btn-sm btn-info waves-effect waves-light  Status" data-id = "<?php echo $value->id; ?>" data-value="Rejected" >Rejeitar</a>-->
											<a href="" title="Rejeitar" class="btn btn-sm btn-info waves-effect waves-light open-AddRejectReason" data-id = "<?php echo $value->id; ?>" data-value="Rejected" data-toggle="modal" data-target="#rejectreasonmodel" data-whatever="@getbootstrap">Rejeitar</a>
											<br>

                                            <?php } elseif($value->leave_status =='Rejected'){ ?>
                                            <?php } ?>
                                            <a href="" title="Editar" class="btn btn-sm btn-info waves-effect waves-light leaveapp" data-id="<?php echo $value->id; ?>" ><i class="fa fa-pencil-square-o"></i></a>
                                            
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

		<div class="modal fade" id="appmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content ">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel1">Requerimento de Licença</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <form method="post" action="Add_Applications" id="leaveapply" enctype="multipart/form-data">
                            <div class="modal-body">
                                    
                                <div class="form-group">
                                    <label>Funcionário</label>
                                    <select class=" form-control custom-select selectedEmployeeID"  tabindex="1" name="emid" required>
										<?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
											<option value="<?php echo $employee->em_id ?>"><?php echo $employee->first_name ?></option>
										<?php } else {
											foreach ($employee as $value): ?>
											<?php if($value->em_role=='EMPLOYEE'){ ?>
												<option
													value="<?php echo $value->em_id ?>"><?php echo $value->first_name . ' ' . $value->last_name ?>
												</option>
											<?php } ?>
											<?php endforeach;
										}?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <span style="color:red" id="total"></span>
                                    <div class="span pull-right">
                                        <button class="btn btn-info fetchLeaveTotal">Número de Dias</button>
                                    </div>
                                    <br>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Duração</label><br>
                                    <input name="type" type="radio" id="radio_1" data-value="Half" class="duration" value="Half Day" checked="">
                                    <label for="radio_1">Por Hora</label>
                                    <input name="type" type="radio" id="radio_2" data-value="Full" class="type" value="Full Day">
                                    <label for="radio_2">Dia Inteiro</label>
                                    <input name="type" type="radio" class="with-gap duration" id="radio_3" data-value="More" value="More than One day">
                                    <label for="radio_3">Acima de um Dia</label>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" id="hourlyFix">Data</label>
                                    <input type="text" name="startdate" class="form-control mydatetimepickerFull" id="startdate" required>
                                </div>
                                <div class="form-group" id="enddate" style="display:none">
                                    <label class="control-label">Data Final</label>
                                    <input type="text" name="enddate" class="form-control mydatetimepickerFull" id="enddateinput">
                                </div>

                                <div class="form-group" id="hourAmount">
                                    <label>Horas</label>
                                    <select  id="hourAmountVal" class=" form-control custom-select"  tabindex="1" name="hourAmount" required>
                                        <option value="">Selecione a Hora</option>
                                        <option value="1">Uma Hora</option>
                                        <option value="2">Duas Horas</option>
                                        <option value="3">Três Horas</option>
                                        <option value="4">Quatro Houras</option>
                                        <option value="5">Cinco Horas</option>
                                        <option value="6">Seis Horas</option>
                                        <option value="7">Sete Horas</option>
                                        <option value="8">Oito Horas</option>
                                    </select>
                                </div>

                               <!--  <div class="form-group" >
                                    <label class="control-label">Duration</label>
                                    <input type="number" name="duration" class="form-control" id="leaveDuration">
                                </div> --> 
                                <div class="form-group">
                                    <label class="control-label">Razão</label>
                                    <textarea class="form-control" name="reason" id="message-text1"></textarea>                                                
                                </div>
                                                                               
                            </div>
                            <script>
                                $(document).ready(function () {
                                    $('#leaveapply input').on('change', function(e) {
                                        e.preventDefault(e);

                                        // Get the record's ID via attribute  
                                        var duration = $('input[name=type]:checked', '#leaveapply').attr('data-value');
                                        console.log(duration);

                                        if(duration =='Half'){
                                            $('#enddate').hide();
                                            $('#hourlyFix').text('Data');
                                            $('#hourAmount').show();
                                        }
                                        else if(duration =='Full'){
                                            $('#enddate').hide();  
                                            $('#hourAmount').hide();  
                                            $('#hourlyFix').text('Data');
                                        }
                                        else if(duration =='More'){
											$('#hourlyFix').text('Data Inicial');
                                            $('#enddate').show();
                                            $('#hourAmount').hide();
                                        }
                                    });
                                    $('#appmodel').on('hidden.bs.modal', function () {
                                        location.reload();
                                    });
                                });
								$('#startdate').change(function() {
									var startdate = $("#startdate").val();
									$('#enddateinput').val(startdate);
								});
                            </script>
                            <div class="modal-footer">
                                <input type="hidden" name="id" class="form-control" id="recipient-name1" required> 
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary">Submeter</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

		<div class="modal fade" id="rejectreasonmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
			<div class="modal-dialog" role="document">
				<div class="modal-content ">
					<div class="modal-header">
						<h4 class="modal-title" id="exampleModalLabel1">Motivo de Rejeição</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<form method="post" action="approveLeaveStatus" id="leaveapply" enctype="multipart/form-data">
						<div class="modal-body">
							<div class="form-group">
								<label class="control-label">Motivo</label>
								<textarea class="form-control" name="rejectreason" id="message-text1" required></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<input type="hidden" id="lid" name="lid" value="">
							<input type="hidden" id="lvalue" name="lvalue" value="">
							<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
							<button type="submit" class="btn btn-primary">Submeter</button>
						</div>
					</form>
				</div>
			</div>
		</div>



<script>
    $(document).ready(function () {

        $('.fetchLeaveTotal').on('click', function (e) {
            e.preventDefault();
            var selectedEmployeeID = $('.selectedEmployeeID').val();
            //console.log(selectedEmployeeID, leaveTypeID);
            $.ajax({
				url: 'LeaveAssign?employeeID=' + selectedEmployeeID,
				method: 'GET',
                data: '',
            }).done(function (response) {
                //console.log(response);
                $("#total").html(response);
            });
        });
    });
</script>
        <script>
        /*DATETIME PICKER*/
          $("#bbbSubmit").on("click", function(event){
              event.preventDefault();
              var typeid = $('.typeid').val();
              var datetime = $('.mydatetimepicker').val();
              var emid = $('.emid').val();
              //console.log(datetime);
              $.ajax({
                  url: "GetemployeeGmLeave?year="+datetime+"&typeid="+typeid+"&emid="+emid,
                  type:"GET",
                  dataType:'',
                  data:'data',          
                  success: function(response) {
                      // console.log(response);
                      $('.leaveval').html(response);             
                  },
                  error: function(response) {
                    // console.log(response);
                  }
              });
          });			
        </script>  


        <script type="text/javascript">
        /*PARSE DURATION DATA*/
        $('.duration').on('input',function() {
            var day = parseInt($('.duration').val());
            var hour = 8;
            $('.totalhour').val((day * hour ? day * hour : 0).toFixed(2));
        });
        </script>
<script>
  $(".Status").on("click", function(event){
      event.preventDefault();
      // console.log($(this).attr('data-value'));
      $.ajax({
          url: "approveLeaveStatus",
          type:"POST",
          data:
          {
              'employeeId': $(this).attr('data-employeeId'),
              'lid': $(this).attr('data-id'),
              'lvalue': $(this).attr('data-value'),
              'duration': $(this).attr('data-duration'),
              'type': $(this).attr('data-type'),
			  'depid': $(this).attr('data-depid'),
			  'startdate': $(this).attr('data-startdate'),
			  'enddate': $(this).attr('data-enddate')
          },
          success: function(response) {
            // console.log(response);
            $(".message").fadeIn('fast').delay(1000).fadeOut('fast').html(response);
            window.setTimeout(function(){location.reload()}, 1000);
          },
          error: function(response) {
            //console.error();
          }
      });
  });           
</script>

<script>
	$(document).on("click", ".open-AddRejectReason", function () {
		var emId = $(this).data('id');
		var emValue = $(this).data('value');
		$(".modal-footer #lid").val(emId);
		$(".modal-footer #lvalue").val(emValue);
	});
</script>

<script type="text/javascript">
            $(document).ready(function() {
                $(".leaveapp").click(function(e) {
                    e.preventDefault(e);
                    // Get the record's ID via attribute
                    var iid = $(this).attr('data-id');
                    $('#leaveapply').trigger("reset");
                    $('#appmodel').modal('show');
                    $.ajax({
                        url: 'LeaveAppbyid?id=' + iid,
                        method: 'GET',
                        data: '',
                        dataType: 'json',
                    }).done(function(response) {
                        // console.log(response);
                        // Populate the form fields with the data returned from server
                        $('#leaveapply').find('[name="id"]').val(response.leaveapplyvalue.id).end();
                        $('#leaveapply').find('[name="emid"]').val(response.leaveapplyvalue.em_id).end();
                        $('#leaveapply').find('[name="applydate"]').val(response.leaveapplyvalue.apply_date).end();
                        $('#leaveapply').find('[name="typeid"]').val(response.leaveapplyvalue.typeid).end();
                        $('#leaveapply').find('[name="startdate"]').val(response.leaveapplyvalue.start_date).end();
                        $('#leaveapply').find('[name="enddate"]').val(response.leaveapplyvalue.end_date).end();
                        $('#leaveapply').find('[name="reason"]').val(response.leaveapplyvalue.reason).end();
                        $('#leaveapply').find('[name="status"]').val(response.leaveapplyvalue.leave_status).end();

                        if(response.leaveapplyvalue.leave_type == 'Half day') {
                            $('#appmodel').find(':radio[name=type][value="Half Day"]').prop('checked', true).end();
                            $('#hourAmount').show().end();
                            $('#enddate').hide().end();
                        } else if(response.leaveapplyvalue.leave_type == 'Full Day') {
                            $('#appmodel').find(':radio[name=type][value="Full Day"]').prop('checked', true).end();
                            $('#hourAmount').hide().end();
                        } else if(response.leaveapplyvalue.leave_type == 'More than One day'){
                            $('#appmodel').find(':radio[name=type][value="More than One day"]').prop('checked', true).end();
                            $('#hourAmount').hide().end();
                            $('#enddate').show().end();
                        }

                        $('#hourAmountVal').val(response.leaveapplyvalue.leave_duration).show().end();
                    });
                });
            });
        </script>                     
<?php $this->load->view('backend/footer'); ?>
