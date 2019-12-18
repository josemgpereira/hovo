<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<?php
	$id = $this->session->userdata('user_login_id');
	$basicinfo = $this->employee_model->GetBasic($id);
?>
      <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-braille" style="color:#1976d2"></i>&nbsp Painel</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Início</a></li>
                        <li class="breadcrumb-item active">Painel</li>
                    </ol>
                </div>
            </div>
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-success"><i class="ti-wallet"></i></div>
                                    <div class="m-l-10 align-self-center">
										<?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
											<a href="<?php echo base_url(); ?>employee/view?I=<?php echo base64_encode($basicinfo->em_id); ?>">Ver Funcionário</a>
										<?php } else { ?>
                                        	<a href="<?php echo base_url(); ?>employee/Employees" class="text-muted m-b-0">Ver Funcionários</a>
										<?php } ?>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-info"><i class="ti-user"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <a href="<?php echo base_url(); ?>leave/Application" class="text-muted m-b-0">Ver Licença</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
				<!-- ============================================================== -->
            </div> 
            <div class="container-fluid">
                <?php $notice = $this->notice_model->GetNoticelimit(); 
                $running = $this->dashboard_model->GetRunningProject(); 
                $userid = $this->session->userdata('user_login_id');
                $todolist = $this->dashboard_model->GettodoInfo($userid);                 
                $holiday = $this->dashboard_model->GetHolidayInfo();                 
                ?>

<script>
  $(".to-do").on("click", function(){
      //console.log($(this).attr('data-value'));
      $.ajax({
          url: "Update_Todo",
          type:"POST",
          data:
          {
          'toid': $(this).attr('data-id'),         
          'tovalue': $(this).attr('data-value'),
          },
          success: function(response) {
              location.reload();
          },
          error: function(response) {
            console.error();
          }
      });
  });			
</script>                                               
<?php $this->load->view('backend/footer'); ?>
