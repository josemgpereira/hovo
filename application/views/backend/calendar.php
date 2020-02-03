<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<div class="page-wrapper">
	<!--<div class="message"></div>-->
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor"><i class="fa fa-calendar" style="color:#1976d2"> </i> Calendário</h3>
		</div>
		<div class="col-md-7 align-self-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:void(0)">Início</a></li>
				<li class="breadcrumb-item active">Calendário</li>
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
						<h4 class="m-b-0 text-white"> Calendário</h4>
					</div>
					<div class="card-body">
						<div id="calendar"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		var events = <?php echo json_encode($data) ?>;
		var date = new Date()
		var d    = date.getDate(),
			m    = date.getMonth(),
			y    = date.getFullYear()

		$('#calendar').fullCalendar({
            googleCalendarApiKey: 'AIzaSyC_63S4l8AFTfmACOCzE-qIsMhlgam5Dr4',
			header    : {
				left  : 'prev,next today',
				center: 'title',
				//right : 'month,agendaWeek,agendaDay'
			},
			/*
			buttonText: {
				today: 'today',
				month: 'month',
				week : 'week',
				day  : 'day'
			},
			 */
			weekends: false,
			//events    : events
            eventSources : [{googleCalendarId: 'pt.portuguese#holiday@group.v.calendar.google.com'},{events}]
		})
	</script>

		<?php $this->load->view('backend/footer'); ?>
