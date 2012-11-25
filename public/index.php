<?php
require('../inc/connecta.php');
$result = mysql_query("SELECT DATE_FORMAT(data,'%d/%m</br>%H:%ih') hora,partit_afectat,provincia,poblacio,collegi_electoral,solucionada,causa,comentari FROM `incidenciesEleccions`.`incidencies` where borrada = '0' order by data DESC;", $link);
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

  <title>Incidencies reportades durant la jornada electoral del 25N</title>
  
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
<div id="fb-root"></div>

<script>
var currentLocalTime = <?=round(microtime(true)); ?>;
function updateTable(){
	$.getJSON('json.php?since='+currentLocalTime, function(data) {
		$.each(data['results'], function(key, val) {
			$('#resultsTable tr:first').after(
				'<tr>'+
				'<td>' + val['hora'] + '</td>' +
				'<td>' + val['poblacio'] + '</td>'+
				 '<td>' + val['collegi_electoral'] + '</td>' +
				 '<td>' + val['partit_afectat'] + '</td>' +
				 '<td>' + val['causa'] + '</td>' +
				  '<td>' + val['comentari'] + '</td>' +
				'</tr>');
	  	});
	  	currentLocalTime = data['curdate'];
	});
}
setInterval(function(){updateTable()},60000);
</script>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ca_ES/all.js#xfbml=1&appId=298459083606110";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-1802235-4']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>

  <div class="row">
    <div class="twelve columns">

      <h4>Incidencies reportades durant la jornada electoral del 25N</h4>
          	<!-- AddThis Button BEGIN -->
		<div class="addthis_toolbox addthis_default_style ">
		<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
		<a class="addthis_button_tweet"></a>
		<a class="addthis_button_pinterest_pinit"></a>
		<a class="addthis_counter addthis_pill_style"></a>
		</div>
		
		<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
		<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50b130f3428512fc"></script>
		<br/>
		<!-- AddThis Button END -->
      <p>Pots enviar els teus informes mitjançant la app <a href="https://play.google.com/store/apps/details?id=cat.pirata.incidencieseleccions">"Incidencies eleccions 2012" disponible a Google play</a></p>
      	
      <dl class="tabs">
        <dd class="active"><a href="#simple1">Incidencies</a></dd>
        <!--dd><a href="#simple2">Mapa</a></dd-->
        <dd><a href="#simple3">Quant a</a></dd>
      </dl>
      <ul class="tabs-content">
        <li class="active" id="simple1Tab">
        	<div class="row">
        		<div class="twelve columns">
          			<!--div class="panel"-->
          			<table class="twelve columns">
          				<tbody id="resultsTable">
          				<tr>
          					<th>Hora</th>
          					<th>Població</th>
          					<th>Lloc</th>
          					<th>Partit</th>
          					<th>Incidencia</th>
          					<th>Comentari</th>
          				</tr>
          				
          				
          				<? if ($incidenciesFound){ 
          						$rows = 0;
          						// data,partit_afectat,provincia,poblacio,collegi_electoral,solucionada,causa,comentari
          						while ($row = mysql_fetch_assoc($result)) {
          							$row['provincia']= ucfirst(strtolower($row['provincia']));
									$row['poblacio']= ucfirst(strtolower($row['poblacio']));
									$row['collegi_electoral']= ucfirst(strtolower($row['collegi_electoral']));
									
									if ($row['solucionada'] == "1"){
										$row['comentari'] = $row['comentari'] . "<br/>[Solucionada!]"; 
									}else{
										$row['comentari'] = $row['comentari'] . "<br/>[NO&nbsp;solucionada!]"; 
									}
          							$rows++;
          						?>
          						<tr>
									<td><?= $row['hora'] ?></td>
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
          					<tr><td colspan="6"><p>No es necessari refrescar la pàgina, aquesta s'actualitzarà automàticament cada minut.</p></td></tr>
          				</tfoot>
          			</table>
          			<!--/div-->
        		</div>
      		</div>
        
        </li>
        <!--li id="simple2Tab">Aqui anira un mapa... si dona temps</li-->
        <li id="simple3Tab">
        
        	<div class="row">
    <div class="two columns">
		<img src="images/logo_partit_pirata.png" height="100" width="100"/>
  	</div>
  	<div class="ten columns">
		Plana web gentilesa de <a target="_blank" href="http://pirata.cat">Pirates de Catalunya (PIRATA.CAT)</a><br/>
		Codi font disponible a: <a target="_blank" href="https://github.com/pirata-cat/webIncidenciesEleccions/tree/master/public">GitHub</a><br/>
		Desenvolupador: <a target="_blank" href="https://twitter.com/ignasiartigas">Ignasi Artigas Cucurella</a>
  	</div>
  </div>
        	
        </li>
      </ul> 
    </div>
  </div>
 <div class="row">
    <div class="twelve columns">

		<div class="fb-comments" data-href="https://xifrat.pirata.cat/incidencies25N/" data-num-posts="10" data-width="470" data-colorscheme="dark"></div>
  	
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
