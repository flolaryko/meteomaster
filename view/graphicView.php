<?php
require_once('Models/MesureModel.php'); 
require_once("Models/LieuModel.php");
require_once("Controllers/LieuController.php");
require_once("Controllers/MesureController.php");


if(isset($_POST['lieu'],$_POST['date'])): //controle des champ vide
$data = $uneMesure -> Une_Mesure($_POST['lieu'],$_POST['date']);?>
<script>var dataRecu = <?php echo json_encode($data)?> </script>
<?php endif?>


<?php $title = 'Détail graphique'; ?>
<?php ob_start(); ?>
<?php require_once('navBarView.php')?>

<form method="post" action="index.php?page=graphicView" style="margin: 0 auto; width: 300px;">

    <h1 class="h3 mb-3 fw-normal" style="text-align: center;">Rechercher</h1>
    <label for="floatingInput">Choisir un lieu </label>
<div class="form-floating">
    <select name="lieu" class="form-control">
       <?php foreach ($lieux as $lieu):  ?>  
          <option value="<?php echo $lieu['libelle_lieu']?>"><?php echo $lieu['libelle_lieu']?></option>
       <?php endforeach ?>
    </select>
</div>

    <div class="form-floating">
      <input class="form-control" type="date" name="date" value="2022-01-26">
    </div>
   <br>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Rechercher</button>
</form>



<div id="chartdiv"></div>

<script type="text/javascript">


 am5.ready(function() {

  // Create root element
  // https://www.amcharts.com/docs/v5/getting-started/#Root_element
 var root = am5.Root.new("chartdiv");
  
  
   // Set themes
  // https://www.amcharts.com/docs/v5/concepts/themes/
  root.setThemes([
    am5themes_Animated.new(root)
  ]);
  
  
//   // Create chart
//   // https://www.amcharts.com/docs/v5/charts/xy-chart/
   var chart = root.container.children.push(am5xy.XYChart.new(root, {
    panX: false,
    panY: false,
    wheelX: "panX",
    wheelY: "zoomX",
     layout: root.verticalLayout
 }));
  
     // Add legend
   // https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
   var legend = chart.children.push(am5.Legend.new(root, {
    centerX: am5.p50,
    x: am5.p50
  }))
  
  
 
  var data = [{
    mesure: "Température (°C)",
     mesureVal: parseFloat(dataRecu['temperature'])
       }, {
    mesure: "Température ressenti (°C)",
    mesureVal: parseFloat(dataRecu['temperature_res']),
   
  }, {
    mesure: "Humidité (%)",
    mesureVal: parseFloat(dataRecu['humidite']),
    
   }, {
    mesure: "Vitesse du vent (Km/h)",
    mesureVal: parseFloat(dataRecu['vitesse_vent'])*3.6,
    
  }, {
    mesure: "Rafale de vent (Km/h)",
    mesureVal: parseFloat(dataRecu['rafale_vent'])*3.6,
    
  }, {
    mesure: "Pluie (mm/h)",
    mesureVal: parseFloat(dataRecu['pluie_h']),
   
   }];
  
  
   // Create axes
  // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
  var yAxis = chart.yAxes.push(am5xy.CategoryAxis.new(root, {
    categoryField: "mesure",
    renderer: am5xy.AxisRendererY.new(root, {
       inversed: true,
     cellStartLocation: 0.1,
     cellEndLocation: 0.9
    })
  }));
    yAxis.data.setAll(data);
  
   var xAxis = chart.xAxes.push(am5xy.ValueAxis.new(root, {
     renderer: am5xy.AxisRendererX.new(root, {}),
     min: 0
  }));
  
  
   // Add series
   // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
   function createSeries(field, name) {
     var series = chart.series.push(am5xy.ColumnSeries.new(root, {
       name: name,
       xAxis: xAxis,
       yAxis: yAxis,
       valueXField: field,
       categoryYField: "mesure",
       sequencedInterpolation: true,
       tooltip: am5.Tooltip.new(root, {
         pointerOrientation: "horizontal",
         labelText: "[bold]{name}[/]\n{categoryY}: {valueX}"
       })
     }));
  
     series.columns.template.setAll({
       height: am5.p100
     });
  
  
     series.bullets.push(function() {
       return am5.Bullet.new(root, {
         locationX: 1,
         locationY: 0.5,
         sprite: am5.Label.new(root, {
           centerY: am5.p50,
           text: "{valueX}",
           populateText: true
         })
       });
     });
  
     series.bullets.push(function() {
       return am5.Bullet.new(root, {
         locationX: 1,
         locationY: 0.5,
         sprite: am5.Label.new(root, {
           centerX: am5.p100,
           centerY: am5.p50,
           text: "{name}",
           fill: am5.color(0xffffff),
           populateText: true
         })
       });
     });
  
     series.data.setAll(data);
     series.appear();
  
     return series;
   }
  
   createSeries("mesureVal", "Résultat mesure");
   // createSeries("expenses", "Expenses");
  
  
//   // Add legend
//   // https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
   var legend = chart.children.push(am5.Legend.new(root, {
     centerX: am5.p50,
     x: am5.p50
   }));
  
   legend.data.setAll(chart.series.values);
  
  
//   // Add cursor
//   // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
   var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
     behavior: "zoomY"
   }));
   cursor.lineY.set("forceHidden", true);
   cursor.lineX.set("forceHidden", true);
  
  
//   // Make stuff animate on load
//   // https://www.amcharts.com/docs/v5/concepts/animations/
   chart.appear(1000, 100);
  
   }); 

</script>
<?php // #8ed1fc bleu graph ?>
<div class="container py-4">
    <div class="p-5 mb-4 bg-light rounded-3" >
      <div class="container-fluid py-5" style="color: white;">
        <h1 class="display-5 fw-bold">Informations supplémentaires </h1>
        <p class="col-md-8 fs-4" color:white>Nébulosité (octa) : <?php echo $data['nebulosite'] = isset($data['nebulosite']) ? $data['nebulosite'] : 'Aucune donnée';?>
          <br> Pression (hPa) : <?php echo $data['pression'] = isset($data['pression']) ? $data['pression'] : 'Aucune donnée' ;?>
          <br> Visibilité (m) : <?php echo $data['visibilite'] = isset($data['visibilite']) ? $data['visibilite'] : 'Aucune donnée';?>
          <br> Lever du soleil : <?php echo $data['leve_soleil'] = isset($data['leve_soleil']) ? $data['leve_soleil'] : 'Aucune donnée';?>
          <br> Coucher du soleil : <?php echo $data['couche_soleil'] = isset($data['couche_soleil']) ? $data['couche_soleil'] : 'Aucune donnée';?>
        </p>
        
      </div>
    </div>
</div>


<?php require_once('footerView.php');?>

<?php $content = ob_get_clean(); ?> 

<?php require_once('template.php'); ?>