	<div id="content">
		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> Conversaciones <span>> Historial</span></h1>
			</div>
		</div>
		<section id="widget-grid" class="">			
			<div class="row">
				<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1" data-widget-editbutton="false">
						<header>
							<span class="widget-icon"> <i class="fa fa-table"></i> </span>
							<h2>Tweets</h2>		
						</header>
						<div>							
							<div class="jarviswidget-editbox">								
							</div>
							<div class="widget-body no-padding">							
								  <div class="alert alert-danger fade">
								      <button type="button" class="close" data-dismiss="alert">×</button>
								      <strong>¡Verifique!</strong> La fecha de finalización debe ser posrterior a la fecha de inicio.
								    </div>
								<br>
								<br>
								<center>
									<form id="form-filter">
				                    <div class="input-group input-group-sm postform" id"datetimepickerContainer1">
				                    	<span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    <strong> Desde:</strong></span>
				                        <input type="text" class="form-control" placeholder="Seleccione fecha inicial" name="startDate"maxlength="20" value="" id="datetimepicker1" required>                                                  
				                    </div>
				                    <script type="text/javascript">							            
							        </script>
				                    <br>				                    
				                    <div class="input-group input-group-sm postform" id"datetimepickerContainer2">
				                        <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    <strong> Hasta:</strong></span>
				                        <input type="text" class="form-control" placeholder="Seleccione fecha final" name="enDate" maxlength="20"  value="" id="datetimepicker2" required="true">
				                    </div>
				                    <br>							        
							         <button data-toggle="tooltip" data-placement="left" title="Generar" type="button" class="btn btn-primary generate" name="btn-filter" id="btn-filter"><i class="fa fa-fw fa fa-filter"></i> Filtrar</button>
							         <button type="button" id="btn-reset" class="btn btn-default">Restaurar</button>
						        </form></center>					
						        <br>
								<table id="datatable_fixed_column" style="cursor:pointer" class="table table-striped table-bordered hover" width="100%">
							        <thead>										
							            <tr>
						                    <th data-class="expand">#</th>
						                    <th data-class="expand" style="width:15%">Fecha y hora</th>
						                    <th data-hide="phone">Código de conversación</th>
						                    <th data-hide="phone">Canal</th>
						                    <th data-hide="phone,tablet"># Conversación</th>						
						                    <th data-hide="phone,tablet">Acciones</th>						
							            </tr>
							        </thead>		
							        
							        <tbody>
							        </tbody>
							
								</table>
		
							</div>		
						</div>		
					</div>
				</article>
			</div>
		</section>

	</div>		
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel">Detalle de conversación</h4>
			</div>			
			<div class="modal-body custom-scroll">									        		
        	</div>
				<div class="modal-footer">					
					<button type="button" class="btn btn-primary" data-dismiss="modal">
						<i class="fa fa-check"></i> Cerrar
					</button>										
			</div>
		</div>
	</div>
</div>