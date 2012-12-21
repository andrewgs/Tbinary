
$(function() {

	Highcharts.theme = {
	   colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
	   chart: {
	      backgroundColor: {
	         linearGradient: [0, 0, 500, 500],
	         stops: [
	            [0, 'rgb(255, 255, 255)'],
	            [1, 'rgb(240, 240, 255)']
	         ]
	      },
	      borderWidth: 1,
	      plotBackgroundColor: 'rgba(255, 255, 255, .9)',
	      plotShadow: true,
	      plotBorderWidth: 1,
	      borderColor: '#ccc',
		  borderRadius: 2
	   },
	   credits: {
	   	enabled: false
	   },
	   title: {
	      style: {
	         color: '#000',
	         font: 'bold 16px "Trebuchet MS", Verdana, sans-serif'
	      }
	   },
	   subtitle: {
	      style: {
	         color: '#666666',
	         font: 'bold 12px "Trebuchet MS", Verdana, sans-serif'
	      }
	   },
	   xAxis: {
	      gridLineWidth: 1,
	      lineColor: '#000',
	      tickColor: '#000',
	      labels: {
	         style: {
	            color: '#000',
	            font: '11px Trebuchet MS, Verdana, sans-serif'
	         }
	      },
	      title: {
	         style: {
	            color: '#333',
	            fontWeight: 'bold',
	            fontSize: '12px',
	            fontFamily: 'Trebuchet MS, Verdana, sans-serif'
	
	         }
	      }
	   },
	   yAxis: {
	      minorTickInterval: 'auto',
	      lineColor: '#000',
	      lineWidth: 1,
	      tickWidth: 1,
	      tickColor: '#000',
	      labels: {
	         style: {
	            color: '#000',
	            font: '11px Trebuchet MS, Verdana, sans-serif'
	         }
	      },
	      title: {
	         style: {
	            color: '#333',
	            fontWeight: 'bold',
	            fontSize: '12px',
	            fontFamily: 'Trebuchet MS, Verdana, sans-serif'
	         }
	      }
	   },
	   legend: {
	      itemStyle: {
	         font: '9pt Trebuchet MS, Verdana, sans-serif',
	         color: 'black'
	
	      },
	      itemHoverStyle: {
	         color: '#039'
	      },
	      itemHiddenStyle: {
	         color: 'gray'
	      }
	   },
	   labels: {
	      style: {
	         color: '#99b'
	      }
	   }
	};

	// Apply the theme
	var highchartsOptions = Highcharts.setOptions(Highcharts.theme);

	
	Highcharts.setOptions({
		global : {
			useUTC : false
		}
	});
	
	$.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename=aapl-c.json&callback=?', function(data) {
	// $.getJSON('http://vl608.sysfx.com:9902/advertisements_real_rates/content/test.5/rates/requests/dispatcher?cc1=EUR&cc2=USD&callback=?', function(data) {
		
		// Create the chart
		window.chart = new Highcharts.StockChart({
			chart : {
				renderTo : 'container',
				events : {
					load : function() {
	
						// set up the updating of the chart each second
						var series = this.series[0];
						setInterval(function() {
							var x = (new Date()).getTime(), // current time
							y = Math.round(Math.random() * 100);
							series.addPoint([x, y], true, true);
						}, 1000);
					}
				},
				height: '395'
			},
			
			rangeSelector: {
				buttons: [{
					count: 1,
					type: 'minute',
					text: '1M'
				}, {
					count: 5,
					type: 'minute',
					text: '5M'
				}, {
					type: 'all',
					text: 'All'
				}],
				inputEnabled: true,
				selected: 0
			},
			
			//title : {
			//	text : 'USD/JPY'
			//},
			
			exporting: {
				enabled: false
			},
			
			//navigator : {
			//	enabled : false
			//},
			
			series : [{
				name : 'USD/JPY',
				//marker : {
				//	enabled : true,
				//	radius : 3
				//},
				// type: 'spline',
				step: true,
				shadow : true,
				data : (function() {
					// generate an array of random data
					var data = [], time = (new Date()).getTime(), i;
	
					for( i = -999; i <= 0; i++) {
						data.push([
							time + i * 1000,
							Math.round(Math.random() * 100)
						]);
					}
					return data;
				})()
			}]
		});
	}); //getJSON

});

/*
?({
	"rates" : [{
		"date" : "2012-12-19 22:07:45",
		"ask" : 1.80512,
		"bid" : 1.80498
	}, {
		"date" : "2012-12-19 22:07:46",
		"ask" : 1.80511,
		"bid" : 1.80497
	}, {
		"date" : "2012-12-19 22:37:57",
		"ask" : 1.80391,
		"bid" : 1.80377
	}],
	"cc1" : "EUR",
	"cc2" : "USD"
});

?([
	{
		"date" : "2012-12-19 22:07:45",
		"ask" : 1.80512,
		"bid" : 1.80498
	}, {
		"date" : "2012-12-19 22:07:46",
		"ask" : 1.80511,
		"bid" : 1.80497
	}, {
		"date" : "2012-12-19 22:37:57",
		"ask" : 1.80391,
		"bid" : 1.80377
	}
]);
*/