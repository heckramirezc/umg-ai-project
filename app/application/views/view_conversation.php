<!DOCTYPE html>
<html lang="esp">
    <head>   
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
    </head>    
    <body>	
		<div class="chat_window">						
					<ul class="messages">
						<?php
							foreach ($detalle_conversacion as $row)
							{
						?>
							<li class="message <?php if(strcasecmp('API.AI', $row->source)==0){echo 'right';} else {echo 'left';}?> appeared">								
								<div class="avatar"></div>
								<div class="text_wrapper" title="Identificador de mensaje: <?php echo $row->id_message;?>">
									<div class="text"><?php echo $row->resolvedQuery; ?></div>							
									<div class="hour"><span style="font-weight:bold"><?php echo $row->timestamp.'</span> ['.$row->intentName.']'; ?></div>
								</div>
							</li>
						<?php
							}
						?>
					</ul>						
				</div>				
	</body>
</html>