        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                        <?php 
                        $id = $this->session->userdata('user_login_id');
                        $basicinfo = $this->employee_model->GetBasic($id); 
                        ?>                
                <div class="user-profile">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="<?php echo base_url(); ?>assets/images/users/<?php echo $basicinfo->em_image ?>" alt="user" />
                        <!-- this is blinking heartbit-->
                        <div class="notify setpos"> <span class="heartbit"></span> <span class="point"></span> </div>
                    </div>

                    <!-- User profile text-->
                    <div class="profile-text">
                        <h5><?php echo $basicinfo->first_name.' '.$basicinfo->last_name; ?></h5>
						<a href="<?php echo base_url(); ?>login/logout" class="" data-toggle="tooltip" title="Terminar Sessão"><i class="mdi mdi-power"></i></a>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li> <a href="<?php echo base_url(); ?>" ><i class="mdi mdi-gauge"></i><span class="hide-menu">Painel</span></a></li>
                        <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
						<li><a href="<?php echo base_url(); ?>employee/view?I=<?php echo base64_encode($basicinfo->em_id); ?>" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Funcionário</span></a></li>
						<li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-rocket"></i><span class="hide-menu">Licença</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <!--<li><a href="<?php echo base_url(); ?>leave/Holidays">Feriado</a></li>-->
                                <!--<li><a href="<?php echo base_url(); ?>leave/EmApplication">Requerimento de Licença</a></li>-->
								<li><a href="<?php echo base_url(); ?>ferias/EmApplication">Requerimento de Licença</a></li>
                            </ul>
                        </li>
                        <?php } else { ?>
                        <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-building-o"></i><span class="hide-menu">Organização</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url();?>organization/Department">Departamento</a></li>
                                <li><a href="<?php echo base_url();?>organization/Designation">Designação</a></li>
                            </ul>
                        </li>
						<li><a href="<?php echo base_url(); ?>employee/Employees" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Funcionários</span></a></li>
						<li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-rocket"></i><span class="hide-menu">Licença</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <!--<li><a href="<?php echo base_url(); ?>leave/Holidays">Feriado</a></li>-->
                                <!--<li><a href="<?php echo base_url(); ?>leave/leavetypes">Tipo de Licença</a></li>-->
                                <!--<li><a href="<?php echo base_url(); ?>leave/Application">Requerimento de Licença</a></li>-->
								<li><a href="<?php echo base_url(); ?>ferias/Application">Requerimento de Licença</a></li>
                                <li><a href="<?php echo base_url(); ?>leave/Leave_report">Relatório</a></li>
                            </ul>
                        </li>
                        <?php } ?>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
