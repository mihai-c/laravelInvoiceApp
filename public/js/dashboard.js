jQuery(function ($) {

            var chart3 = $('#geoChart').chartinator({
                tableSel: '.geoChart',

                columns: [{role: 'tooltip', type: 'string'}],
         
                colIndexes: [2],
             
                rows: [
                    ['China - 2015'],
                    ['Colombia - 2015'],
                    ['France - 2015'],
                    ['Italy - 2015'],
                    ['Japan - 2015'],
                    ['Kazakhstan - 2015'],
                    ['Mexico - 2015'],
                    ['Poland - 2015'],
                    ['Russia - 2015'],
                    ['Spain - 2015'],
                    ['Tanzania - 2015'],
                    ['Turkey - 2015']],
              
                ignoreCol: [2],
              
                chartType: 'GeoChart',
              
                chartAspectRatio: 1.5,
             
                chartZoom: 1.75,
             
                chartOffset: [-12,0],
             
                chartOptions: {
                  
                    width: null,
                 
                    backgroundColor: '#fff',
                 
                    datalessRegionColor: '#F5F5F5',
               
                    region: 'world',
                  
                    resolution: 'countries',
                 
                    legend: 'none',

                    colorAxis: {
                       
                        colors: ['#679CCA', '#337AB7']
                    },
                    tooltip: {
                     
                        trigger: 'focus',

                        isHtml: true
                    }
                }

               
            });
	 var barChartData = {
                            labels : ["Jan","Feb","Mar","Apr","May","Jun","jul"],
                            datasets : [
                                {
                                    fillColor : "#FC8213",
                                    data : [65,59,90,81,56,55,40]
                                },
                                {
                                    fillColor : "#337AB7",
                                    data : [28,48,40,19,96,27,100]
                                }
                            ]

                        };
                            new Chart(document.getElementById("bar").getContext("2d")).Bar(barChartData);
	
	var radarChartData = {
								labels : ["","","","","","",""],
								datasets : [
									{
										fillColor : "rgba(104, 174, 0, 0.83)",
										strokeColor : "#68ae00",
										pointColor : "#68ae00",
										pointStrokeColor : "#fff",
										data : [65,59,90,81,56,55,40]
									},
									{
										fillColor : "rgba(236, 133, 38, 0.82)",
										strokeColor : "#ec8526",
										pointColor : "#ec8526",
										pointStrokeColor : "#fff",
										data : [28,48,40,19,96,27,100]
									}
								]
								
							};
							new Chart(document.getElementById("radar").getContext("2d")).Radar(radarChartData);
	
	function bar_group(){group_ident=1,$(".bar_group").each(function(){$(this).addClass("group_ident-"+group_ident),$(this).data("gid",group_ident),group_ident++})}function get_max(){$(".bar_group").each(function(){var t=[];$(this).children().each(function(){t.push($(this).attr("value"))}),max_arr["group_ident-"+$(this).data("gid")]=t,void 0!==$(this).attr("max")?$(this).data("bg_max",$(this).attr("max")):$(this).data("bg_max",Math.max.apply(null,t))})}function data_labels(){$(".bar_group__bar").each(function(){void 0!==$(this).attr("label")&&$('<p class="b_label">'+$(this).attr("label")+"</p>").insertBefore($(this))})}function show_values(){$(".bar_group__bar").each(function(){"true"==$(this).attr("show_values")&&($(this).css("margin-bottom","40px"),void 0!==$(this).attr("unit")?($(this).append('<p class="bar_label_min">0 '+$(this).attr("unit")+"</p>"),$(this).append('<p class="bar_label_max">'+$(this).parent().data("bg_max")+" "+$(this).attr("unit")+"</p>")):($(this).append('<p class="bar_label_min">0</p>'),$(this).append('<p class="bar_label_max">'+$(this).parent().data("bg_max")+"</p>")))})}function show_tooltips(){$(".bar_group__bar").each(function(){"true"==$(this).attr("tooltip")&&($(this).css("margin-bottom","40px"),$(this).append('<div class="b_tooltip"><span>'+$(this).attr("value")+'</span><div class="b_tooltip--tri"></div></div>'))})}function in_view(t){var a=$(t),i=$(window),s=i.scrollTop(),r=s+i.height(),n=a.offset().top,o=n+a.height();r>o-45&&a.css("width",a.attr("value")/a.parent().data("bg_max")*100+"%")}function bars(){bar_group(),get_max(),data_labels(),show_tooltips(),show_values()}max_arr={},$(".bar_group__bar").each(function(){in_view($(this))}),$(window).scroll(function(){$(".bar_group__bar").each(function(){in_view($(this))})}),bars();
	
	
	var icons = new Skycons({"color": "#fff"}),
								  list  = [
									"clear-night", "partly-cloudy-day",
									"partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
									"fog"
								  ],
								  i;

							  for(i = list.length; i--; )
								icons.set(list[i], list[i]);

							  icons.play();
	
	var icons = new Skycons({"color": "#fff"}),
									  list  = [
										"clear-night", "clear-day",
										"partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
										"fog"
									  ],
									  i;
	
								  for(i = list.length; i--; )
									icons.set(list[i], list[i]);
	
								  icons.play();
	
	 var icons = new Skycons({"color": "#fff"}),
								  list  = [
									"clear-night", "cloudy",
									"partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
									"fog"
								  ],
								  i;

							  for(i = list.length; i--; )
								icons.set(list[i], list[i]);

							  icons.play();
	
	 var icons = new Skycons({"color": "#fff"}),
								  list  = [
									"clear-night", "clear-day",
									"partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
									"fog"
								  ],
								  i;

							  for(i = list.length; i--; )
								icons.set(list[i], list[i]);

							  icons.play();
	
	
        });