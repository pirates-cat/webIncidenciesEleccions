<?php
require('../inc/connecta.php');
$result = mysql_query("SELECT time(data) data,partit_afectat,provincia,poblacio,collegi_electoral,solucionada,causa,comentari FROM `incidenciesEleccions`.`incidencies` where borrada = '0' order by data DESC;", $link);
if (!$result) {
	$incidenciesFound = false;
}else{
	$incidenciesFound = true;
}
?>

<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8" />

  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width" />

  <title>Welcome to Foundation</title>
  
  <!-- Included CSS Files (Uncompressed) -->
  <!--
  <link rel="stylesheet" href="stylesheets/foundation.css">
  -->
  
  <!-- Included CSS Files (Compressed) -->
  <link rel="stylesheet" href="stylesheets/foundation.min.css">
  <link rel="stylesheet" href="stylesheets/app.css">

  <script src="javascripts/modernizr.foundation.js"></script>

  <!-- IE Fix for HTML5 Tags -->
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

</head>
<body>
  <div class="row">
    <div class="twelve columns">
      <h4>Incidencies reportades durant la jornada electoral del 25N</h4>
      <p>Pots enviar els teus informes mitjançant la app <a href="https://play.google.com/store/apps/details?id=cat.pirata.incidencieseleccions">"Incidencies eleccions" disponible al a Google play</a></p>
      <dl class="tabs">
        <dd class="active"><a href="#simple1">Incidencies</a></dd>
        <dd><a href="#simple2">Mapa</a></dd>
      </dl>

      <ul class="tabs-content">
        <li class="active" id="simple1Tab">
        	<div class="row">
        		<div class="twelve columns">
          			<!--div class="panel"-->
          			<table class="twelve columns">
          				<thead>
          				<tr>
          					<th>Hora</th><th>Ciutat</th><th>Lloc</th><th>Partit</th><th>Incidencia</th><th>Comentari</th>
          				</tr>
          				</thead>
          				<tbody>
          				<? if ($incidenciesFound){ 
          						$rows = 0;
          						// data,partit_afectat,provincia,poblacio,collegi_electoral,solucionada,causa,comentari
          						while ($row = mysql_fetch_assoc($result)) {
          							$rows++;
          						?>
          						<tr>
									<td><?= $row['data'] ?></td>
          							<td><?= $row['poblacio'] ?></td>
          							<td><?= $row['collegi_electoral'] ?></td>
          							<td><?= $row['partit_afectat'] ?></td>
          							<td><?= $row['causa'] ?></td>
          							<td><?= $row['comentari'] ?></td>
          						</tr>
          						
							<? }
							if ($rows == 0){ ?>
							<tr>
								<td colspan ="6">No hi han incidencies</td>
	  
							</tr>
							<? }
          					}else{ ?>
          				<tr>
          					<td>-</td>
          					<td>-</td>
          					<td>-</td>
          					<td>-</td>
          					<td>-</td>
          					<td>No hi han incidencies</td>
          				</tr>
          				<? } ?>
          				</tbody>
          				<tfoot>
          					<tr><td colspan="6"><!--p>No cal que refresquis aquesta pàgina, es refrescara automaticament cada minut.</p--></td></tr>
          				</tfoot>
          				
          			</table>
          			<!--/div-->
        		</div>
      		</div>
        
        </li>
        <li id="simple2Tab">Aqui anira un mapa... si dona temps</li>
      </ul>

      
    </div>

   
  </div>

  
  
  
  <!-- Included JS Files (Uncompressed) -->
  <!--
  
  <script src="javascripts/jquery.js"></script>
  
  <script src="javascripts/jquery.foundation.mediaQueryToggle.js"></script>
  
  <script src="javascripts/jquery.foundation.forms.js"></script>
  
  <script src="javascripts/jquery.foundation.reveal.js"></script>
  script src="javascripts/jquery.foundation.navigation.js"></script>
  <script src="javascripts/jquery.foundation.buttons.js"></script>
  
  <script src="javascripts/jquery.foundation.tabs.js"></script>
  
  <script src="javascripts/jquery.foundation.tooltips.js"></script>
  
  <script src="javascripts/jquery.foundation.accordion.js"></script>
  
  <script src="javascripts/jquery.placeholder.js"></script>
  
  <script src="javascripts/jquery.foundation.alerts.js"></script>
  
  <script src="javascripts/jquery.foundation.topbar.js"></script>
  
  <script src="javascripts/jquery.foundation.magellan.js"></script>
  
  -->
  
  <!-- Included JS Files (Compressed) -->
  <script src="javascripts/jquery.js"></script>
  <script src="javascripts/foundation.min.js"></script>
  
  <!-- Initialize JS Plugins -->
  <script src="javascripts/app.js"></script>
  
</body>
</html>
