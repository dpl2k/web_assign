<head>
   <title>Dashboard</title>
   <link href="ysb-admin-2.min.css" rel="stylesheet">
</head>
<!-- Begin Page Content -->
<div class="container-fluid">

   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
   </div>

   <!-- Content Row -->
   <div class="row">

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
         <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
               <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                     <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Earnings (Monthly)</div>
                     <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                  </div>
                  <div class="col-auto">
                     <i class="fas fa-calendar fa-2x text-gray-300"></i>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
         <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
               <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                     <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Earnings (Annual)</div>
                     <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                  </div>
                  <div class="col-auto">
                     <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
         <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
               <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                     <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                     </div>
                     <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                           <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                        </div>
                        <div class="col">
                           <div class="progress progress-sm mr-2">
                              <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-auto">
                     <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <!-- Pending Requests Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
         <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
               <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                     <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Pending Requests</div>
                     <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                  </div>
                  <div class="col-auto">
                     <i class="fas fa-comments fa-2x text-gray-300"></i>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Content Row -->

   <div class="row">
      <!-- Pie Chart -->
      <div class="col-xl-4 col-lg-12">
         <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
               <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
               <div class="dropdown no-arrow">
                  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  </a>
                  <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                     <div class="dropdown-header">Dropdown Header:</div>
                     <a class="dropdown-item" href="#">Action</a>
                     <a class="dropdown-item" href="#">Another action</a>
                     <div class="dropdown-divider"></div>
                     <a class="dropdown-item" href="#">Something else here</a>
                  </div>
               </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
               <div class="row">
                  <div class="col-md-12">
                     <div id="donutchart" style="width: 900px; height: 200px;"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Content Row -->
   <div class="row">

      <!-- Content Column -->
      <div class="col-lg-6 mb-4">

         <!-- Project Card Example -->
         <div class="card shadow mb-4">
            <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
            </div>
            <div class="card-body">
               <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>
               <div class="progress mb-4">
                  <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
               </div>
               <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>
               <div class="progress mb-4">
                  <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
               </div>
               <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4>
               <div class="progress mb-4">
                  <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
               </div>
               <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>
               <div class="progress mb-4">
                  <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
               </div>
               <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4>
               <div class="progress">
                  <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-6 mb-4">
         <!-- Line chart -->
         <div class="container-fluid d-flex justify-content-center">
            <div class="card shadow mb-4">
               <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Line chart</h6>
               </div>
               <div class="card-body">
                  <div class="chartjs-size-monitor">
                     <div class="chartjs-size-monitor-expand">
                        <div></div>
                     </div>
                     <div class="chartjs-size-monitor-shrink">
                        <div></div>
                     </div>
                  </div>
                  <div class=" ct-chart ct-square chartjs-render-monitor" style="display: block; width: 300px; height: 260px;"></div>
               </div>
            </div>
         </div>
      </div>
   </div>

</div>
<!-- /.container-fluid -->
<script>
   $(document).ready(function() {

      google.charts.load("current", {
         packages: ["corechart"]
      });
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
         var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Work', 11],
            ['Eat', 2],
            ['Commute', 2],
            ['Watch TV', 2],
            ['Sleep', 7]
         ]);

         var options = {
            title: 'My Daily Activities',
            pieHole: 0.4,
         };

         var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
         chart.draw(data, options);
      }
      // line chart
      data = {
         'labels': [01, 02, 03, 04],
         'series': [
            [0, 2, 5, 6]
         ]
      };
      new Chartist.Line('.ct-chart', data, {
         showPoint: true,
      });
   });
</script>