
$(function() {
	
	var chart_link = '';
	$.ajax({async: false,url:"http://test.sysfx.us/get-chart-link",dataType: 'json',success: function(data){chart_link = data.vlink;}});
	
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
	
	var x = (new Date()).getTime(); // current time
	
	// $.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename=aapl-c.json&callback=?', function(data) {
	$.getJSON(chart_link, function(json_data){
		// Create the chart
		window.chart = new Highcharts.StockChart({
			chart : {
				renderTo : 'container',
				events : {
					load : function() {
						
						var series = this.series[0];
						series.remove();
												
						setInterval(function() {
							$.getJSON(chart_link, function(json) {
								
								var prepared = {}, tuples = [];
								
								$.each(json, function(i,n){
									prepared[n.date] = n.ask;
								});

								for (var key in prepared) {
									tuples.push([parseInt(key), prepared[key]]);
								}
								
								tuples.sort(function(a, b) {
								    a = a[0];
								    b = b[0];
								
								    return a < b ? -1 : (a > b ? 1 : 0);
								});
								
								for (var i = 0; i < tuples.length; i++) {
								    var timestamp = tuples[i][0];
								    var ask = tuples[i][1];
									
									series.addPoint([parseInt(timestamp), ask], false, true);
								}
								//console.log(series.data.length);
																
								window.chart.redraw();
							});
						}, 2000);

					}
				},
				height: '395'
			},
			
			tooltip: {
	            formatter: function() {
	                var s = '<b>'+ Highcharts.dateFormat('%A, %b %e, %Y, %H:%M:%S', this.x) +'</b>';
					//console.log(this);
	
	                $.each(this.points, function(i, point) {
	                    s += '<br/>1 USD = '+ point.y +' EUR';
	                });
	            
	                return s;
	            }
	        },
	        
	        xAxis: {
                type: 'datetime',
                tickPixelInterval: 150
            },
            
            yAxis: {
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
	        
			rangeSelector: false,
						
			exporting: {
				enabled: false
			},
			
			series : [{
				name : 'USD/JPY',
				marker : {
					enabled : true,
					radius : 3
				},
				shadow : true,
				tooltip : {
					valueDecimals : 2
				},
				data : (function() {
					var prepared={}, data = [];
				
					$.each(json_data, function(i,n){
						prepared[n.date] = n.ask;
					});
					
					for ( var timestamp in prepared ){
						data.push([parseInt(timestamp), prepared[timestamp]]);
					}

					return data;
				})()
			}]
		});
	}); //getJSON

});

