<div class="panel">
                <div class="panel-title">
                   Enrollees In glance
                </div>
                <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 p-0">
                     <canvas id="barchart_values"></canvas>
                        <script>
                            var ctx = document.getElementById('barchart_values').getContext('2d');
                            var chart = new Chart(ctx, {
                                // The type of chart we want to create
                                type: 'horizontalBar',

                                // The data for our dataset
                                data: {
                                    labels: ['Total Enrollees', 'Formal',' Informal','Huwe'],
                                    datasets: [{
                                        label: 'Enrollees summary record',
                                        backgroundColor: ["#08c", "orange", "rgb(255, 99, 132)", "#08c",],
                                        data: [<?= $all_enrollees;?>, <?= $formal_enrollees;?>, <?= $informal_enrollees;?>,<?= $huwe_enrollees;?>]
        
                                    }
                                    ]
                                },

                                // Configuration options go here
                                options: {}
                            });

                            </script>
						<hr/>
						<hr/>
                        <div style="margin-top:30px;text-align:center"> <canvas id="piechart_"></canvas></div>

                  
                        <script>
                            var ctx = document.getElementById('piechart_').getContext('2d');
                            var chart = new Chart(ctx, {
                                // The type of chart we want to create
                                type: 'pie',

                                // The data for our dataset
                                data: {
                                    labels: ['NiCare Enrollees', 'Huwe Enrollees'],
                                    datasets: [{
                                        label: 'NiCare | Huwe Enrolleess',
                                        backgroundColor: ["rgb(255, 99, 132)", "#08c",],
                                        data: [<?= $nicare_enrollees;?> , <?= $huwe_enrollees;?>]
                                      
        
                                    } ]
                                },

                                // Configuration options go here
                                options: {}
                            });

                            </script>
                    </div>
                    <div class="col-md-6 p-0">
                    <canvas id="myChart"></canvas>

                  
                        <script>
                            var ctx = document.getElementById('myChart').getContext('2d');
                            var chart = new Chart(ctx, {
                                // The type of chart we want to create
                                type: 'line',

                                // The data for our dataset
                                data: {
                                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul','Aug','Sep','Oct','Nov','Dec'],
                                    datasets: [{
                                        label: 'Monthly Capitaions (<?= date('Y');?>)',
                                        backgroundColor: 'rgb(255, 99, 132)',
                                        borderColor: 'rgb(255, 99, 132)',
                                        data: [
                                            <?= $months[1]['cap'];?>, 
                                            <?= $months[2]['cap'];?>, 
                                            <?= $months[3]['cap'];?>, 
                                            <?= $months[4]['cap'];?>, 
                                            <?= $months[5]['cap'];?>, 
                                            <?= $months[6]['cap'];?>, 
                                            <?= $months[7]['cap'];?>, 
                                            <?= $months[8]['cap'];?>, 
                                            <?= $months[9]['cap'];?>, 
                                            <?= $months[10]['cap'];?>, 
                                            <?= $months[11]['cap'];?>, 
                                            <?= $months[12]['cap'];?>, 
                                            ]
                                    }]
                                },

                                // Configuration options go here
                                options: {}
                            });

                            </script>
                         
						 <hr/>
						 
                    </div>
                </div>
                
                
                </div>
            </div><?php /**PATH C:\Users\AshlabTech\Desktop\projects\nicare-eims\resources\views/nicare_dashboard_charts.blade.php ENDPATH**/ ?>