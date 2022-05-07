<div class="panel">

                <div class="panel-title">Enrollees In glance</div>

                <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 p-0">

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

                                        label: 'Monthly Capitation (<?= date('Y');?>)',

                                        backgroundColor: 'rgb(255, 99, 132)',

                                        borderColor: 'rgb(255, 99, 132)',

                                        data:  [

                                            <?= $months[1]['nicare_cap'];?>, 

                                            <?= $months[2]['nicare_cap'];?>, 

                                            <?= $months[3]['nicare_cap'];?>, 

                                            <?= $months[4]['nicare_cap'];?>, 

                                            <?= $months[5]['nicare_cap'];?>, 

                                            <?= $months[6]['nicare_cap'];?>, 

                                            <?= $months[7]['nicare_cap'];?>, 

                                            <?= $months[8]['nicare_cap'];?>, 

                                            <?= $months[9]['nicare_cap'];?>, 

                                            <?= $months[10]['nicare_cap'];?>, 

                                            <?= $months[11]['nicare_cap'];?>, 

                                            <?= $months[12]['nicare_cap'];?>, 

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

            </div><?php /**PATH /home3/ngschdqn/eims.ngscha.ni.gov.ng/resources/views/nicare_dashboard_charts.blade.php ENDPATH**/ ?>