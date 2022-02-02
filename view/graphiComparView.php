<?php
require_once('Models/MesureModel.php'); 
require_once("Models/LieuModel.php");
require_once("Controllers/LieuController.php");
require_once("Controllers/MesureController.php");


if(isset($_POST['lieu'],$_POST['dateFin'],$_POST['dateDebut'],$_POST['mesure'])): //controle des champ vide
 $comp=UneMesureComp($_POST['lieu'],$_POST['dateDebut'],$_POST['dateFin'],$_POST['mesure']);?>
 <script>var dataComp = <?php echo json_encode($comp)?> </script>
<?php endif?>


<?php $title = 'Comparaison graphique'; ?>
<?php ob_start(); ?>
<?php require_once('navBarView.php')?>

<form method="post" action="index.php?page=graphiComparView" style="margin: 0 auto; width: 300px;">

    <h1 class="h3 mb-3 fw-normal" style="text-align: center;">Rechercher</h1>
    <label for="floatingInput">Choisir un lieu </label>
<div class="form-floating">
    <select name="lieu" class="form-control">
       <?php foreach ($lieux as $lieu):  ?>  
          <option value="<?php echo $lieu['libelle_lieu']?>"><?php echo $lieu['libelle_lieu']?></option>
       <?php endforeach ?>
    </select>
</div>



<label for="floatingInput">Choisir un mesure à comparer </label>
    <select name="mesure" class="form-control">
       <?php foreach ($allM as $allMe):  ?>  
          <option value="<?php echo $allMe['Field']?>"><?php echo $allMe['Field']?></option>
       <?php endforeach ?>
    </select> 

  <label for="floatingInput">Date de début  </label>
    <div class="form-floating">
      <input class="form-control" type="date" name="dateDebut" value="2022-01-26" >
    </div>

    <label for="floatingInput">Date de fin  </label>
    <div class="form-floating">
      <input class="form-control" type="date" name="dateFin" value="2022-01-27" >
    </div>
   <br>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Rechercher</button>
</form>



<div id="GraphComp"></div>

<script type="text/javascript">

am5.ready(function() {

// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("GraphComp");

// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);

root.dateFormatter.setAll({
  dateFormat: "yyyy",
  dateFields: ["valueX"]
});


var data = [];
dataComp.forEach(function(item){

    var temp = parseFloat(item["mesure"]); // conversion pour float 

    data.push({    
        date: item["date_mesure"],
        value: temp
    });
});



// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(
  am5xy.XYChart.new(root, {
    focusable: true,
    panX: true,
    panY: true,
    wheelX: "panX",
    wheelY: "zoomX"
  })
);

var easing = am5.ease.linear;

// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var xAxis = chart.xAxes.push(
  am5xy.DateAxis.new(root, {
    maxDeviation: 0.5,
    groupData: false,
    baseInterval: {
      timeUnit: "day",
      count: 1
    },
    renderer: am5xy.AxisRendererX.new(root, {
      pan:"zoom",
      minGridDistance: 50
    }),
    tooltip: am5.Tooltip.new(root, {})
  })
);

var yAxis = chart.yAxes.push(
  am5xy.ValueAxis.new(root, {
    maxDeviation: 1,
    renderer: am5xy.AxisRendererY.new(root, {pan:"zoom"})
  })
);

// Add series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
var series = chart.series.push(
  am5xy.LineSeries.new(root, {
    minBulletDistance: 10,
    xAxis: xAxis,
    yAxis: yAxis,
    valueYField: "value",
    valueXField: "date",
    tooltip: am5.Tooltip.new(root, {
      pointerOrientation: "horizontal",
      labelText: "{valueY}"
    })
  })
);

// Set up data processor to parse string dates
// https://www.amcharts.com/docs/v5/concepts/data/#Pre_processing_data
series.data.processor = am5.DataProcessor.new(root, {
  dateFormat: "yyyy-MM-dd",
  dateFields: ["date"]
});

series.data.setAll(data);

series.bullets.push(function() {
  var circle = am5.Circle.new(root, {
    radius: 4,
    fill: series.get("fill"),
    stroke: root.interfaceColors.get("background"),
    strokeWidth: 2
  });

  return am5.Bullet.new(root, {
    sprite: circle
  });
});

/*createTrendLine(
  [
    { date: "2012-01-02", value: 10 },
    { date: "2012-01-11", value: 19 }
  ],
  root.interfaceColors.get("positive")
);

createTrendLine(
  [
    { date: "2012-01-17", value: 16 },
    { date: "2012-01-22", value: 10 }
  ],
  root.interfaceColors.get("negative")
);*/

function createTrendLine(data, color) {
  var series = chart.series.push(
    am5xy.LineSeries.new(root, {
      xAxis: xAxis,
      yAxis: yAxis,
      valueXField: "date",
      stroke: color,
      valueYField: "value"
    })
  );

  series.data.processor = am5.DataProcessor.new(root, {
    dateFormat: "yyyy-MM-dd",
    dateFields: ["date"]
  });

  series.data.setAll(data);
  series.appear(1000, 100);
}

// Add cursor
// https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
  xAxis: xAxis
}));
cursor.lineY.set("visible", false);

// add scrollbar
chart.set("scrollbarX", am5.Scrollbar.new(root, {
  orientation: "horizontal"
}));

// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
series.appear(1000, 100);
chart.appear(1000, 100);

}); // end am5.ready()
</script>



<?php require_once('footerView.php');?>

<?php $content = ob_get_clean(); ?> 

<?php require_once('template.php'); ?>