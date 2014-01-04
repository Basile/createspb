<style type="text/css">
.stats {
	margin:20px 0 30px;
	padding:0 20px;
}
</style>
<?php
	$app = Yii::app();
	$app->clientScript->registerCoreScript('jquery');
	$app->clientScript->registerCoreScript('jquery.ui');
	$app->clientScript->registerScriptFile($app->baseUrl . '/js/highcharts.js');
	$app->clientScript->registerCssFile($app->clientScript->coreScriptUrl . '/jui/css/base/jquery-ui.css');
?>
<h4>Кол-во пользователей в системе</h4>
<div class="stats">
	<?php echo $usersNumber ?>
</div>

<h4>Половое распределение пользователей</h4>
<div class="stats">
	<div id="sexChart"></div>
</div>

<h4>Список доменных зон первого уровня, которые использованы в email пользователей системы</h4>
<div class="stats">
	[<?php echo implode(', ', $domainsList) ?>]
</div>

<h4>Гистограмма доменных зон первого уровня, которые использованы в email пользователей системы</h4>
<div class="stats">
	<div id="domainChart"></div>
</div>

<h4>Поиск пользователей</h4>
<div class="stats">
	<input type="text" id="userSearch" />
</div>

<script type="text/javascript">
$(function() {
	var sexData = <?php echo json_encode($sexData) ?>;
	var domains = <?php echo json_encode($domains) ?>;
	var searchUrl = '<?php echo $this->createUrl('user/search') ?>';

	// sex chart
	$('#sexChart').highcharts({
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false
		},
		title: {
			text: null
		},
		series: [{
			type: 'pie',
			name: 'Количество пользователей',
			data: sexData
		}]
	});

	// domain chart
	var domainsList = [];
	var domainsData = [];
	for (var i in domains) {
		domainsList.push(i);
		domainsData.push(domains[i]);
	}
	$('#domainChart').highcharts({
		chart: {
			type: 'column'
		},
		title: {
			text: null
		},
		xAxis: {
			categories: domainsList
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Количество пользователей'
			}
		},
		/*
		*/
		series: [{
			name: 'Домены первого уровня',
			data: domainsData
		}]
	});

	// user search
	$('#userSearch').autocomplete({
		source: searchUrl,
		minLength: 2,
		select: function(event, ui ) {
			event.preventDefault();
			window.location = ui.item.value;
		},
		focus: function(event, ui) {
			event.preventDefault();
			$('#userSearch').val(ui.item.label);
		}
	});
});
</script>