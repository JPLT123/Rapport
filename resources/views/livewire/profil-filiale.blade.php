<div>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">subsidiary company detail</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">subsidiary company</a></li>
                                    <li class="breadcrumb-item active">subsidiary company detail</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    
                    <div class="col-xl-4">
                        <div class="card bg-info bg-soft">
                            <div class="card-body">
                                <div class="text-center mb-4">
                                    <img src="{{asset($filiales->logo ? '/storage/'.$filiales->logo :'assets/images/users/avatar-6.jpg')}}" alt="" class="avatar-lg rounded-circle mx-auto d-block" />
                                    <h5 class="mt-3 mb-1">{{$filiales->nom}}</h5>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Personal Information</h4>

                                <p class="text-muted mb-4">{{$filiales->description}}</p>
                                <div class="table-responsive">
                                    <table class="table table-nowrap mb-0">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Mobile :</th>
                                                <td>{{$filiales->telephone}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">E-mail :</th>
                                                <td>{{$filiales->email}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Location :</th>
                                                <td>{{$filiales->adresse}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Departements :</th>
                                                <td>
                                                    <ul>
                                                        @foreach ($filiales->departements as $departemnet)
                                                        <li>{{$departemnet->nom}}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->

                    </div>         
                    
                    <div class="col-xl-8">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            @php
                                                $ProjectsCount = $filiale->projets->count();
                                                $Terminer = $filiale->TerminerProjects->count();
                                                $PendingProjectsCount = $filiale->PendingProjects->count();
                                            @endphp
                                            <div class="flex-grow-1">
                                                <p class="text-muted fw-medium mb-2">Completed Projects</p>
                                                <h4 class="mb-0">{{$Terminer}}</h4>
                                            </div>

                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                    <span class="avatar-title">
                                                        <i class="bx bx-check-circle font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-muted fw-medium mb-2">Pending Projects</p>
                                                <h4 class="mb-0">{{$PendingProjectsCount}}</h4>
                                            </div>

                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="avatar-sm mini-stat-icon rounded-circle bg-primary">
                                                    <span class="avatar-title">
                                                        <i class="bx bx-hourglass font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-muted fw-medium mb-2">Total Projects</p>
                                                <h4 class="mb-0">{{$ProjectsCount}}</h4>
                                            </div>

                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="avatar-sm mini-stat-icon rounded-circle bg-primary">
                                                    <span class="avatar-title">
                                                        <i class="bx bx-package font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Evolutions des Projects</h4>
                                <div id="chart" class="apex-charts" dir="ltr"></div>
                                
                            </div>
                        </div>
                        
                    </div>
                    {{-- <div class="row">
                        <div class="col-lg-12">
                            <h5 class="mb-3">Projects</h5>
                        </div>
                        @foreach ($projects as $projet)
                            <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-4">
                                                <div class="avatar-md">
                                                    <span class="avatar-title rounded-circle bg-light text-danger font-size-8">
                                                        <img src="{{asset('/storage/'.$filiales->logo ?? 'assets/images/companies/img-1.png')}}" alt="" height="30">
                                                    </span>
                                                </div>
                                            </div>
                        
                        
                                            <div class="flex-grow-1 overflow-hidden">
                                                <h5 class="text-truncate font-size-15"><a href="javascript: void(0);" class="text-dark">{{$projet->nom}}</a></h5>
                                                <p class="text-truncate text-muted mb-4">{{$projet->description}}</p>
                                                <div class="avatar-group">
                                                   @foreach ($projet->membres_projets as $item)
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-inline-block">
                                                                <img src="{{asset($item->user->profile_photo_path ? '/storage/'.$item->user->profile_photo_path : 'assets\user.png')}}" alt="" class="rounded-circle avatar-xs">
                                                            </a>
                                                        </div>
                                                   @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-4 py-3 border-top">
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item me-3">
                                                @if ($projet->status == 'attente')
                                                    <td><span class="badge bg-warning">En attente</span></td>
                                                @elseif ($projet->status == 'Terminer')
                                                <td><span class="badge bg-success">Terminer</span></td>
                                                @elseif ($projet->status == 'Retard')
                                                    <td><span class="badge bg-danger">En Retard</span></td>
                                                @elseif ($projet->status == 'Avance')
                                                    <td><span class="badge bg-info">Avancer</span></td>
                                                @elseif ($projet->status == 'Suspendu')
                                                    <td><span class="badge bg-dark">Suspendu</span></td>
                                                @endif
                                            </li>
                                            <li class="list-inline-item me-3">
                                                <i class="bx bx-calendar me-1"></i> {{($projet->findate)->format('j F Y')}}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div><!--end row-->
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Votre contenu de page ici -->
                    
                            <!-- Affichage de la pagination générée -->
                            {!! $paginations !!}
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="mb-3">Projects</h5>
                        </div>
                        @foreach ($projects as $projet)
                            <div class="col-xl-4">
                                <div class="card">
                                    <a href="{{ route('Apercu-projet', ['slug' => $projet->code]) }}">
                                    <div class="card-body">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-4">
                                                    <div class="avatar-md">
                                                        <span class="avatar-title rounded-circle bg-light text-danger font-size-8">
                                                            <img src="{{asset('/storage/'.$filiales->logo ?? 'assets/images/companies/img-1.png')}}" alt="" height="30">
                                                        </span>
                                                    </div>
                                                </div>
                            
                            
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-15"><a href="javascript: void(0);" class="text-dark">{{$projet->nom}}</a></h5>
                                                    <p class="text-truncate text-muted mb-4">{{$projet->description}}</p>
                                                    <div class="avatar-group">
                                                       @foreach ($projet->membres_projets as $item)
                                                            <div class="avatar-group-item">
                                                                <a href="javascript: void(0);" class="d-inline-block">
                                                                    <img src="{{asset($item->user->profile_photo_path ? '/storage/'.$item->user->profile_photo_path : 'assets\user.png')}}" alt="" class="rounded-circle avatar-xs">
                                                                </a>
                                                            </div>
                                                       @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="px-4 py-3 border-top">
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item me-3">
                                                    @if ($projet->status == 'attente' && $projet->status !== 'supprimer')
                                                        <td><span class="badge bg-warning">En attente</span></td>
                                                    @elseif ($projet->status == 'Terminer')
                                                    <td><span class="badge bg-success">Terminer</span></td>
                                                    @elseif ($projet->status == 'Retard')
                                                        <td><span class="badge bg-danger">En Retard</span></td>
                                                    @elseif ($projet->status == 'Avance')
                                                        <td><span class="badge bg-info">Avancer</span></td>
                                                    @elseif ($projet->status == 'Suspendu')
                                                        <td><span class="badge bg-dark">Suspendu</span></td>
                                                    @elseif ($projet->status == 'activer')
                                                        <td><span class="badge bg-primary">En Cour</span></td>
                                                    @endif
                                                </li>
                                                <li class="list-inline-item me-3">
                                                    <i class="bx bx-calendar me-1"></i> {{($projet->findate)->format('j F Y')}}
                                                </li>
                                            </ul>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div><!--end row-->
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="pagination pagination-rounded justify-content-center mt-2 mb-5">
                                <?php
                                $page = $projets->currentPage();
                                $totalPages = $projets->lastPage();
                    
                                // Lien vers la page précédente
                                if ($page > 1) {
                                    echo '<li class="page-item"><a href="?page=' . ($page - 1) . '" class="page-link"><i class="mdi mdi-chevron-left"></i></a></li>';
                                } else {
                                    echo '<li class="page-item disabled"><a href="javascript:void(0);" class="page-link"><i class="mdi mdi-chevron-left"></i></a></li>';
                                }
                    
                                // Liens vers les pages
                                for ($i = 1; $i <= $totalPages; $i++) {
                                    echo '<li' . ($i == $page ? ' class="page-item active"' : ' class="page-item"') . '><a href="?page=' . $i . '" class="page-link">' . $i . '</a></li>';
                                }
                    
                                // Lien vers la page suivante
                                if ($page < $totalPages) {
                                    echo '<li class="page-item"><a href="?page=' . ($page + 1) . '" class="page-link"><i class="mdi mdi-chevron-right"></i></a></li>';
                                } else {
                                    echo '<li class="page-item disabled"><a href="javascript:void(0);" class="page-link"><i class="mdi mdi-chevron-right"></i></a></li>';
                                }
                                ?>
                            </ul>
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
    <script>
        var projectData = <?php echo json_encode($projects); ?>;
        var percentageData = <?php echo json_encode($percentage); ?>;

        var projectNames = projectData.map(function (project) {
            return project.nom;
        });

        var percentages = Object.values(percentageData).map(function (percentage) {
            return percentage > 0 ? parseFloat(percentage).toFixed(2) : 0;
        });

        var options = {
            series: [{
                name: 'Pourcentage d\'évolution',
                data: percentages
            }],
                    chart: {
                        height: 350,
                        type: 'bar',
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 10,
                            dataLabels: {
                                position: 'top', // top, center, bottom
                            },
                        },
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: function (val) {
                            return val + "%";
                        },
                        offsetY: -20,
                        style: {
                            fontSize: '12px',
                            colors: ["#304758"]
                        }
                    },
                    xaxis: {
                        categories: projectNames,
                        position: 'top',
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        },
                        crosshairs: {
                            fill: {
                                type: 'gradient',
                                gradient: {
                                    colorFrom: '#D8E3F0',
                                    colorTo: '#BED1E6',
                                    stops: [0, 100],
                                    opacityFrom: 0.4,
                                    opacityTo: 0.5,
                                }
                            }
                        },
                        tooltip: {
                            enabled: true,
                        }
                    },
                    yaxis: {
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false,
                        },
                        labels: {
                            show: false,
                            formatter: function (val) {
                                return val + "%";
                            }
                        }

                    },
                    title: {
                        text: 'Évolution mensuelle du pourcentage d\'évolution par projet',
                        floating: true,
                        offsetY: 330,
                        align: 'center',
                        style: {
                            color: '#444'
                        }
                    }
                };
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
</div>
