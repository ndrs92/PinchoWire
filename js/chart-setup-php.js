var chart = AmCharts.makeChart( "chartdiv", {
			"type": "pie",
			"theme": "light",
			"dataProvider": [ {
				"campo": "<?= $l["statistics_user"] ?>",
				"cantidad": <?= $concurso->getNumberOfUsers() ?>
			}, {
				"campo": "<?= $l["statistics_pincho"] ?>",
				"cantidad": <?= $concurso->getNumberOfPinchos() ?>
			}, {
				"campo": "<?= $l["statistics_establishment"] ?>",
				"cantidad": <?= $concurso->getNumberOfEstablecimientos() ?>
			}, {
				"campo": "<?= $l["statistics_popularVote"] ?>",
				"cantidad": <?= $concurso->getNumberOfVotosPopulares() ?>
			}, {
				"campo": "<?= $l["statistics_comment"] ?>",
				"cantidad": <?= $concurso->getNumberOfComments() ?>
			} ],
			"valueField": "cantidad",
			"titleField": "campo",
			"labelsEnabled": false,
			"hideLabelsPercent": 100,
			"balloon":{
				"fixedPosition":false
			},
			"export": {
				"enabled": false
			}
		});