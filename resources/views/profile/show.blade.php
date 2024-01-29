<div>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Profile</h4>

                            <div class="page-title-right">
                                <ol class="m-0 breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                    <li class="breadcrumb-item active">Profile</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="assets/images/users/avatar-1.jpg" alt=""
                                                    class="avatar-md rounded-circle img-thumbnail">
                                            </div>
                                            <div class="flex-grow-1 align-self-center">
                                                <div class="text-muted">
                                                    <p class="mb-2">Welcome to Dashboard</p>
                                                    <h5 class="mb-1">{{ Auth::user()->name }}</h5>
                                                    <p class="mb-0">{{ Auth::user()->filiale->nom }} /
                                                        {{ Auth::user()->departement->nom }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 align-self-center">
                                        <div class="mt-4 text-lg-center mt-lg-0">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div>
                                                        @php
                                                            $userProjectsCount = Auth::user()->projets->count();
                                                            $userOngoingProjectsCount = Auth::user()->ongoingProjects->count();
                                                            $userPendingProjectsCount = Auth::user()->PendingProjects->count();
                                                        @endphp
                                                        <p class="mb-2 text-muted text-truncate">Total Projects</p>
                                                        <h5 class="mb-0">{{ $userProjectsCount }}</h5>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div>
                                                        <p class="mb-2 text-muted text-truncate">Current Projects</p>
                                                        <h5 class="mb-0">{{ $userOngoingProjectsCount }}</h5>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div>
                                                        <p class="mb-2 text-muted text-truncate">Pending Projects</p>
                                                        <h5 class="mb-0">{{ $userPendingProjectsCount }}</h5>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 d-none d-lg-block">
                                        <div class="clearfix mt-4 mt-lg-0">
                                            <div class="dropdown float-end">
                                                <a href="{{ route('reglage') }}" class="btn btn-primary"><i
                                                        class="align-middle bx bxs-cog me-1"></i> Setting</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-7">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-4 card-title">Evolutions des Projects</h4>
                                <div id="chart_" class="apex-charts" dir="ltr"></div>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-4 card-title">Radial Chart</h4>

                                <div id="chart"
                                    data-colors='["--bs-primary","--bs-success", "--bs-danger", "--bs-warning"]'
                                    class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->

                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-4 card-title">Attached Files</h4>
                                <div class="table-responsive">
                                    <table class="table mb-0 align-middle table-nowrap table-hover">
                                        <tbody>
                                            @foreach ($user->importfiles as $fichier)
                                                <tr>
                                                    <td style="width: 45px;">
                                                        <div class="avatar-sm">
                                                            <span
                                                                class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-24">
                                                                <i class="bx bxs-file-doc"></i>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <h5 class="mb-1 font-size-14"><a href="#"
                                                                class="text-dark">{{ $fichier->nom_fichier ?? 'Document' }}.Zip</a>
                                                        </h5>
                                                        <small>Size :
                                                            {{ formatSizeUnits(filesize(storage_path('app/' . $fichier->links))) }}</small>
                                                    </td>
                                                    <td>
                                                        <div class="text-center">
                                                            <a wire:click="telecharger({{ $fichier->id }})"
                                                                class="text-dark"><i
                                                                    class="m-0 bx bx-download h3"></i></a>
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
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-4 card-title">Tasks</h4>
                                <h6>taches de la semaine</h6>
                                <div class="mt-4">
                                    <div data-simplebar style="max-height: 250px;">

                                        <div class="table-responsive">
                                            <table class="table mb-0 align-middle table-nowrap table-hover">
                                                <tbody>
                                                    @foreach ($user->planif_hebdomadaires as $item)
                                                        @foreach ($item->plant_taches_relation as $tache)
                                                            <tr>
                                                                <td>
                                                                    <h5 class="mb-1 text-truncate font-size-14"><a
                                                                            href="javascript: void(0);"
                                                                            class="text-dark">{{ $tache->tache_prevues }}</a>
                                                                    </h5>
                                                                    <p class="mb-0 text-muted">{{ $item->projet->nom }}
                                                                    </p>
                                                                </td>
                                                                <td style="width: 90px;">
                                                                    <div>
                                                                        @if ($tache->status == 'Attente')
                                                                <td><button
                                                                        class="btn btn-soft-warning btn-sm btn-rounded">En
                                                                        attente</button></td>
                                                            @elseif ($tache->status == 'Terminer')
                                                                <td><button
                                                                        class="btn btn-soft-success btn-sm btn-rounded">Terminer</button>
                                                                </td>
                                                            @elseif ($tache->status == 'En Cour')
                                                                <td><button
                                                                        class="btn btn-soft-primary btn-sm btn-rounded">En
                                                                        Cour</button></td>
                                                        @endif
                                        </div>
                                        </td>
                                        </tr>
                                        @endforeach
                                        @endforeach
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-4 card-title">Rapport</h4>
                            <h6>Fichier rapport</h6>
                            <div class="mt-4">
                                <div data-simplebar style="max-height: 250px;">
                                    <div class="table-responsive">
                                        <table class="table mb-0 align-middle table-nowrap table-hover">
                                            <tbody>
                                                @php $dateAffichee = null; @endphp
                                                @foreach ($user->rapports as $rapport)
                                                    <tr>

                                                        @if ($rapport->date != $dateAffichee)
                                                            <td style="width: 45px;">
                                                                <div class="avatar-sm">
                                                                    <span
                                                                        class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-24">
                                                                        <i class="bx bxs-file-doc"></i>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <h5 class="mb-1 font-size-14"><a
                                                                        href="javascript: void(0);"
                                                                        class="text-dark">rapport du
                                                                        {{ $rapport->date->format('y-m-d') ?? 'vide' }}</a>
                                                                </h5>
                                                            </td>

                                                            <td>
                                                                <div class="text-center">
                                                                    <a href="{{ route('affiche-rapport-par-date', ['slug' => $rapport->id]) }}"
                                                                        class="text-dark btn"><i
                                                                            class="m-0 bx bx-download h3"></i></a>
                                                                </div>
                                                            </td>
                                                            @php $dateAffichee = $rapport->date; @endphp
                                                        @endif

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-lg-12">
                    <h4 class="mb-3 card-title">Projects </h4>

                    <div class="row">
                        @foreach ($Userprojet as $user)
                            <div class="col-xl-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-4">
                                                @php
                                                    $nomComplet = $user->projet->nom; // Remplacez ceci par le nom réel
                                                    $initiale = strtoupper(substr($nomComplet, 0, 1));
                                                @endphp

                                                <div class="avatar-md">
                                                    <span
                                                        class="avatar-title rounded-circle bg-light text-info font-size-24">
                                                        {{ $initiale }}
                                                    </span>
                                                </div>
                                            </div>


                                            <div class="overflow-hidden flex-grow-1">
                                                <h5 class="text-truncate font-size-15"><a href="javascript: void(0);"
                                                        class="text-dark">{{ $user->projet->nom }}</a></h5>
                                                <p class="mb-4 text-muted text-truncate">
                                                    {{ $user->projet->description }}</p>
                                                <div class="avatar-group">
                                                    @foreach ($user->projet->membres_projets_relation as $item)
                                                        @php
                                                            $nomMembre = $item->name;
                                                            $initiale = strtoupper(substr($nomMembre, 0, 1));
                                                        @endphp
                                                        <div class="avatar-group-item">
                                                            @if ($item->profile_photo_path)
                                                                <a href="javascript: void(0);" class="d-inline-block">
                                                                    <img src="{{ asset($item->profile_photo_path ? '/storage/' . $item->profile_photo_path : 'images') }}"
                                                                        alt=""
                                                                        class="rounded-circle avatar-xs">
                                                                </a>
                                                            @else
                                                                <a href="#" class="d-inline-block">
                                                                    <div class="avatar-xs">
                                                                        <span
                                                                            class="text-white avatar-title rounded-circle bg-success font-size-16"
                                                                            _msttexthash="19175"
                                                                            _msthash="264">{{ $initiale }}</span>
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-4 py-3 border-top">
                                        <ul class="mb-0 list-inline">
                                            <li class="list-inline-item me-3">
                                                <span class="badge bg-warning">{{ $user->projet->status }}</span>
                                            </li>
                                            <li class="list-inline-item me-2">
                                                <i class= "bx bx-calendar me-1"></i>
                                                {{ $user->projet->findate->format('d M, y') }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- end row -->

                    {{-- <div class="row">
                            <div class="col-lg-12">
                                <ul class="mt-2 mb-5 pagination pagination-rounded justify-content-center">
                                    {{$projet->links('pagination::bootstrap-5')}}
                                </ul>
                            </div>
                        </div> --}}
                    <!-- end row -->
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

</div>

<!-- end main content-->
<script>
    // Récupérez le tableau de séries en PHP
    var seriesData = <?php echo json_encode($TotalTaches); ?>;
    var totale = <?php echo json_encode($totale); ?>;

    var options = {
        series: seriesData.map(function(projet) {
            var totalTaches = projet.taches_count;
            var tachesEnCours = projet.taches_en_cours;

            var pourcentageEnCours = (tachesEnCours / totalTaches) * 100;

            return parseFloat(pourcentageEnCours).toFixed(2);
        }),
        chart: {
            height: 350,
            type: 'radialBar',
        },
        plotOptions: {
            radialBar: {
                dataLabels: {
                    name: {
                        fontSize: '22px',
                    },
                    value: {
                        fontSize: '16px',
                    },
                    total: {
                        show: true,
                        label: 'Total',
                        formatter: function(w) {
                            return totale; // Exemple de format personnalisé
                        }
                    }
                }
            }
        },
        labels: <?php echo json_encode($TotalTaches->pluck('nom')->toArray()); ?>,
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();

    var projectData = <?php echo json_encode($projet); ?>;
    var percentageData = <?php echo json_encode($percentage); ?>;

    var projectNames = projectData.map(function(project) {
        return project.nom;
    });

    var percentages = Object.values(percentageData).map(function(percentage) {
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
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function(val) {
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
                formatter: function(val) {
                    return val + "%";
                }
            }

        },
        title: {
            text: 'Monthly Inflation in Argentina, 2002',
            floating: true,
            offsetY: 330,
            align: 'center',
            style: {
                color: '#444'
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart_"), options);
    chart.render();
</script>
</div>
