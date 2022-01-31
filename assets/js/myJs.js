
// // graph recherche
// am5.ready(function() {

//   // Create root element
//   // https://www.amcharts.com/docs/v5/getting-started/#Root_element
//   var root = am5.Root.new("chartdiv");
  
  
//   // Set themes
//   // https://www.amcharts.com/docs/v5/concepts/themes/
//   root.setThemes([
//     am5themes_Animated.new(root)
//   ]);
  
  
//   // Create chart
//   // https://www.amcharts.com/docs/v5/charts/xy-chart/
//   var chart = root.container.children.push(am5xy.XYChart.new(root, {
//     panX: false,
//     panY: false,
//     wheelX: "panX",
//     wheelY: "zoomX",
//     layout: root.verticalLayout
//   }));
  
  
//   // Add legend
//   // https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
//   var legend = chart.children.push(am5.Legend.new(root, {
//     centerX: am5.p50,
//     x: am5.p50
//   }))
  
  
//   // Data
//   var data = [{
//     mesure: "Température (°C)",
//     mesureVal: parseFloat(dataRecu['temperature'])
    
//   }, {
//     mesure: "Température ressenti (°C)",
//     mesureVal: parseFloat(dataRecu['temperature_res']),
   
//   }, {
//     mesure: "Humidité (%)",
//     mesureVal: parseFloat(dataRecu['humidite']),
    
//   }, {
//     mesure: "Vitesse du vent (Km/h)",
//     mesureVal: parseFloat(dataRecu['vitesse_vent'])*3.6,
    
//   }, {
//     mesure: "Rafale de vent (Km/h)",
//     mesureVal: parseFloat(dataRecu['rafale_vent'])*3.6,
    
//   }, {
//     mesure: "Pluie (mm/h)",
//     mesureVal: parseFloat(dataRecu['pluie_h']),
   
//   }];
  
  
//   // Create axes
//   // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
//   var yAxis = chart.yAxes.push(am5xy.CategoryAxis.new(root, {
//     categoryField: "mesure",
//     renderer: am5xy.AxisRendererY.new(root, {
//       inversed: true,
//       cellStartLocation: 0.1,
//       cellEndLocation: 0.9
//     })
//   }));
  
//   yAxis.data.setAll(data);
  
//   var xAxis = chart.xAxes.push(am5xy.ValueAxis.new(root, {
//     renderer: am5xy.AxisRendererX.new(root, {}),
//     min: 0
//   }));
  
  
//   // Add series
//   // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
//   function createSeries(field, name) {
//     var series = chart.series.push(am5xy.ColumnSeries.new(root, {
//       name: name,
//       xAxis: xAxis,
//       yAxis: yAxis,
//       valueXField: field,
//       categoryYField: "mesure",
//       sequencedInterpolation: true,
//       tooltip: am5.Tooltip.new(root, {
//         pointerOrientation: "horizontal",
//         labelText: "[bold]{name}[/]\n{categoryY}: {valueX}"
//       })
//     }));
  
//     series.columns.template.setAll({
//       height: am5.p100
//     });
  
  
//     series.bullets.push(function() {
//       return am5.Bullet.new(root, {
//         locationX: 1,
//         locationY: 0.5,
//         sprite: am5.Label.new(root, {
//           centerY: am5.p50,
//           text: "{valueX}",
//           populateText: true
//         })
//       });
//     });
  
//     series.bullets.push(function() {
//       return am5.Bullet.new(root, {
//         locationX: 1,
//         locationY: 0.5,
//         sprite: am5.Label.new(root, {
//           centerX: am5.p100,
//           centerY: am5.p50,
//           text: "{name}",
//           fill: am5.color(0xffffff),
//           populateText: true
//         })
//       });
//     });
  
//     series.data.setAll(data);
//     series.appear();
  
//     return series;
//   }
  
//   createSeries("mesureVal", "Résultat mesure");
//   // createSeries("expenses", "Expenses");
  
  
//   // Add legend
//   // https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
//   var legend = chart.children.push(am5.Legend.new(root, {
//     centerX: am5.p50,
//     x: am5.p50
//   }));
  
//   legend.data.setAll(chart.series.values);
  
  
//   // Add cursor
//   // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
//   var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
//     behavior: "zoomY"
//   }));
//   cursor.lineY.set("forceHidden", true);
//   cursor.lineX.set("forceHidden", true);
  
  
//   // Make stuff animate on load
//   // https://www.amcharts.com/docs/v5/concepts/animations/
//   chart.appear(1000, 100);
  
//   }); // end am5.ready()












