<div>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Project Overview</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Project</a></li>
                                    <li class="breadcrumb-item active">Project Overview</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                @php
                                    $nomComplet = $projets ? $projets->filiale->nom : 'le filiale vide';
                                    $initiale = strtoupper(substr($nomComplet, 0, 1));
                                @endphp
                                <div class="d-flex">
                                    @if ($projets->filiale->logo)
                                        <div class="flex-shrink-0 me-4">
                                            <img src="{{asset($projets ? '/storage/'.$projets->filiale->logo :null)}}" alt="" class="avatar-sm">
                                        </div>
                                    @else
                                    <div class="avatar-md">
                                        <span class="avatar-title rounded-circle bg-light text-info font-size-24">
                                            {{ $initiale }}
                                        </span>
                                    </div>
                                    @endif

                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-truncate font-size-18">{{$projets ? $projets->nom : 'nom du projet vide'}}</h5>
                                        <p class="text-muted"> {{$nomComplet}}</p>
                                    </div>
                                </div>

                                <h5 class="font-size-15 mt-4">Project Description :</h5>

                                <p class="text-muted ">
                                    {{$projets ? $projets->description : 'le champ description du projet est vide'}}
                                </p>

                                <div class="text-muted mt-4">
                                    <p><i class="mdi mdi-chevron-right text-primary me-1"></i> Dépenses Effectuées : {{$projets ? $sommeCout : '0'}}$</p>
                                </div>
                                
                                <div class="row task-dates">
                                    <div class="col-sm-4 col-6">
                                        <div class="mt-4">
                                            <h5 class="font-size-14"><i class="bx bx-calendar me-1 text-primary"></i> Start Date</h5>
                                            <p class="text-muted mb-0">{{($projets->debutdate)->format('d M, y')}}</p>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-6">
                                        <div class="mt-4">
                                            <h5 class="font-size-14"><i class="bx bx-calendar-check me-1 text-primary"></i> Due Date</h5>
                                            <p class="text-muted mb-0">{{($projets->findate)->format('d M, y')}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Team Members</h4>

                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap">
                                        <tbody>
                                            @foreach ($projets->membres_projets as $item)
                                                @php
                                                    $nomComplet = $item ? $item->user->name : 'Nom Utilisateur Vide';
                                                    $initiale = strtoupper(substr($nomComplet, 0, 1));
                                                @endphp
                                                @if ($item->status == 'activer')
                                                    <tr>
                                                        @if ($item->user->profile_photo_path)
                                                            <td style="width: 50px;"><img src="{{asset('/storage/'.$item->user->profile_photo_path)}}" class="rounded-circle avatar-xs" alt=""></td>
                                                        @else
                                                            <td>
                                                                <a href="#" class="d-inline-block">
                                                                    <div class="avatar-xs">
                                                                        <span class="avatar-title rounded-circle bg-primary text-white font-size-16" _msttexthash="19175" _msthash="264">{{ $initiale }}</span>
                                                                    </div>
                                                                </a>
                                                            </td>
                                                        @endif
                                                        <td><h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">{{$item->user->name}}</a></h5></td>
                                                        <td>
                                                            <div>
                                                                @if ($item->is_chef == false)
                                                                    <a href="javascript: void(0);" class="badge bg-primary bg-soft text-primary font-size-11">Members</a>
                                                                @else
                                                                    <a href="javascript: void(0);" class="badge bg-primary bg-soft text-primary font-size-11">Team Leader</a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Overview</h4>

                                <div id="chart" class="apex-charts" dir="ltr"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Attached Files</h4>
                                <div class="table-responsive">
                                    <table class="table table-nowrap align-middle table-hover mb-0">
                                        <tbody>
                                            @foreach ($fichiersJoints as $fichier)
                                                <tr>
                                                    <td style="width: 45px;">
                                                        <div class="avatar-sm">
                                                            <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-24">
                                                                <i class="bx bxs-file-doc"></i>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <h5 class="font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">{{ $fichier->nom_fichier ?? 'Document'}}.Zip</a></h5>
                                                        <small>Size : {{ formatSizeUnits(filesize(storage_path('app/' . $fichier->links))) }}</small>
                                                    </td>
                                                    <td>
                                                        <div class="text-center">
                                                            <a wire:click="telecharger({{$fichier->id}})" class="text-dark"><i class="bx bx-download h3 m-0"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            
                                            @php
                                            // Fonction pour formater la taille du fichier
                                            function formatSizeUnits($size)
                                            {
                                                $units = [' B', ' KB', ' MB', ' GB', ' TB'];
                                                for ($i = 0; $size >= 1024 && $i < count($units) - 1; $i++) {
                                                    $size /= 1024;
                                                }
                                                return round($size, 2) . $units[$i];
                                            }
                                            @endphp
                                            

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    {{-- <div class="col-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Observations</h4>

                                @foreach ($Obsevations as $item)
                                    <div class="d-flex mb-4">
                                        <div class="flex-shrink-0 me-3">
                                            <img class="d-flex-object rounded-circle avatar-xs" alt="" src="assets/images/users/avatar-2.jpg">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="font-size-13 mb-1">{{$item->user->name}}</h5>
                                            <p class="text-muted mb-1">
                                                {{ $item->observationglobal ? $item->observationglobal : "pas d'observation"}}
                                            </p>
                                        </div>
                                        <div class="ms-3">
                                            <a href="javascript: void(0);" class="text-primary">Reply</a>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="text-center mt-4 pt-2">
                                    <a href="javascript: void(0);" class="btn btn-primary btn-sm">View more</a>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- end col -->

                    <div class="col-xl-7">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Tasks</h4>
                                <!-- Nav tabs -->
                                <ul class="nav nav-pills bg-light rounded" role="tablist">
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#home-1" role="tab">
                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                            <span class="d-none d-sm-block">In Process</span> 
                                        </a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" data-bs-toggle="tab" href="#profile-1" role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                            <span class="d-none d-sm-block">Upcoming</span> 
                                        </a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" data-bs-toggle="tab" href="#messages-1" role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                            <span class="d-none d-sm-block">Complet</span>   
                                        </a>
                                    </li>
                                </ul>
    
                                <!-- Tab panes -->
                                <div class="tab-content p-3 text-muted">
                                    <div class="tab-pane active" id="home-1" role="tabpanel">
                                        <div class="mt-4">
                                            <div data-simplebar style="max-height: 250px;">
                                            
                                                <div class="table-responsive">
                                                    <table class="table table-nowrap align-middle table-hover mb-0">
                                                        <tbody>
                                                            @foreach ($projets->taches as $item)
                                                                @if ($item->status == 'Terminer')
                                                                    <tr>
                                                                        <td>
                                                                            <h5 class="text-truncate font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">{{$item->tache_prevues}}</a></h5>
                                                                            {{-- <p class="text-muted mb-0">Assigned to {{$item->membres_projets_relation->name}}</p> --}}
                                                                        </td>
                                                                        <td style="width: 90px;">
                                                                            <div>
                                                                                <ul class="list-inline mb-0 font-size-16">
                                                                                    <li class="list-inline-item">
                                                                                        <a href="javascript: void(0);" class="text-success p-1"><i class="bx bxs-edit-alt"></i></a>
                                                                                    </li>
                                                                                    <li class="list-inline-item">
                                                                                        <a href="javascript: void(0);" class="text-danger p-1"><i class="bx bxs-trash"></i></a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="tab-pane" id="profile-1" role="tabpanel">
                                        <div class="mt-4">
                                            <div data-simplebar style="max-height: 250px;">
                                            
                                                <div class="table-responsive">
                                                    <table class="table table-nowrap align-middle table-hover mb-0">
                                                        <tbody>
                                                            @foreach ($projets->taches as $item)
                                                                @if ($item->status == 'Attente')
                                                                    <tr>
                                                                        <td>
                                                                            <h5 class="text-truncate font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">{{$item->tache_prevues}}</a></h5>
                                                                            {{-- <p class="text-muted mb-0">Assigned to {{$item->membres_projets_relation->name}}</p> --}}
                                                                        </td>
                                                                        <td style="width: 90px;">
                                                                            <div>
                                                                                <ul class="list-inline mb-0 font-size-16">
                                                                                    <li class="list-inline-item">
                                                                                        <a href="javascript: void(0);" class="text-success p-1"><i class="bx bxs-edit-alt"></i></a>
                                                                                    </li>
                                                                                    <li class="list-inline-item">
                                                                                        <a href="javascript: void(0);" class="text-danger p-1"><i class="bx bxs-trash"></i></a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="messages-1" role="tabpanel">
                                        <div class="mt-4">
                                            <div data-simplebar style="max-height: 250px;">
                                            
                                                <div class="table-responsive">
                                                    <table class="table table-nowrap align-middle table-hover mb-0">
                                                        <tbody>
                                                            @foreach ($projets->taches as $item)
                                                                @if ($item->status == 'Terminer')
                                                                    <tr>
                                                                        <td>
                                                                            <h5 class="text-truncate font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">{{$item->tache_prevues}}</a></h5>
                                                                            {{-- <p class="text-muted mb-0">Assigned to {{$item->membres_projets_relation->name}}</p> --}}
                                                                        </td>
                                                                        <td style="width: 90px;">
                                                                            <div>
                                                                                <ul class="list-inline mb-0 font-size-16">
                                                                                    <li class="list-inline-item">
                                                                                        <a href="javascript: void(0);" class="text-success p-1"><i class="bx bxs-edit-alt"></i></a>
                                                                                    </li>
                                                                                    <li class="list-inline-item">
                                                                                        <a href="javascript: void(0);" class="text-danger p-1"><i class="bx bxs-trash"></i></a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                
                                <div class="card-footer bg-transparent border-top">
                                    <div class="text-center">
                                        <a href="javascript: void(0);" class="btn btn-primary waves-effect waves-light"> Add new Task</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>document.write(new Date().getFullYear())</script> © Skote.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Design & Develop by Themesbrand
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script>
    var series = <?php echo json_encode($Serie); ?>;
    var options = {
        series: series.map(function(serie) {
            return {
                name: serie.name,
                data: [{
                    x: serie.data.x,
                    y: serie.data.y
                }]
            };
        }),
        chart: {
            height: 350,
            type: 'scatter',
            zoom: {
                enabled: true,
                type: 'xy'
            }
        },
        xaxis: {
            tickAmount: 10,
            labels: {
                formatter: function(val) {
                    return parseFloat(val).toFixed(1);
                }
            }
        },
        yaxis: {
            tickAmount: 7
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>
// {{-- <script>
//      var options = {
//           series: [{
//             name: "Session Duration",
//             data: [45, 52, 38, 24, 33, 26, 21, 20, 6, 8, 15, 10]
//           },
//           {
//             name: "Page Views",
//             data: [35, 41, 62, 42, 13, 18, 29, 37, 36, 51, 32, 35]
//           },
//           {
//             name: 'Total Visits',
//             data: [87, 57, 74, 99, 75, 38, 62, 47, 82, 56, 45, 47]
//           }
//         ],
//           chart: {
//           height: 350,
//           type: 'line',
//           zoom: {
//             enabled: false
//           },
//         },
//         dataLabels: {
//           enabled: false
//         },
//         stroke: {
//           width: [5, 7, 5],
//           curve: 'straight',
//           dashArray: [0, 8, 5]
//         },
//         title: {
//           text: 'Page Statistics',
//           align: 'left'
//         },
//         legend: {
//           tooltipHoverFormatter: function(val, opts) {
//             return val + ' - ' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + ''
//           }
//         },
//         markers: {
//           size: 0,
//           hover: {
//             sizeOffset: 6
//           }
//         },
//         xaxis: {
//           categories: ['01 Jan', '02 Jan', '03 Jan', '04 Jan', '05 Jan', '06 Jan', '07 Jan', '08 Jan', '09 Jan',
//             '10 Jan', '11 Jan', '12 Jan'
//           ],
//         },
//         tooltip: {
//           y: [
//             {
//               title: {
//                 formatter: function (val) {
//                   return val + " (mins)"
//                 }
//               }
//             },
//             {
//               title: {
//                 formatter: function (val) {
//                   return val + " per session"
//                 }
//               }
//             },
//             {
//               title: {
//                 formatter: function (val) {
//                   return val;
//                 }
//               }
//             }
//           ]
//         },
//         grid: {
//           borderColor: '#f1f1f1',
//         }
//         };

//         var chart = new ApexCharts(document.querySelector("#chart"), options);
//         chart.render();
      
// </script> --}}