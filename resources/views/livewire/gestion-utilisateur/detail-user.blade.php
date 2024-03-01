<div>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Detail user</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Users Lists</a></li>
                                    <li class="breadcrumb-item active">Detail user</li>
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
                                    <div class="col-lg-5">
                                        @php
                                            $nomComplet = $user ? $user->name : 'Nom Utilisateur Vide';
                                            $initiale = strtoupper(substr($nomComplet, 0, 1));
                                        @endphp

                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                @if ($user->profile_photo_path)
                                                    <img src="{{ asset($user ? '/storage/' . $user->profile_photo_path : null) }}"
                                                        alt="" class="avatar-md rounded-circle img-thumbnail">
                                                @else
                                                    <div class="avatar-md">
                                                        <span
                                                            class="avatar-title rounded-circle bg-light text-info font-size-24">
                                                            {{ $initiale }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="flex-grow-1 align-self-center">
                                                <div class="text-muted">
                                                    <p class="mb-2">Welcome to Dashboard</p>
                                                    <h5 class="mb-1">{{ $nomComplet }}</h5>
                                                    <p class="mb-0">
                                                        @if ($user->filiale !== null)
                                                            {{ $user ? $user->filiale->nom : 'filiale Vide' }}/
                                                            {{ $user ? $user->departement->nom : 'service Vide' }}</p>
                                                        @else
                                                            {{ $user ? $user->service->nom : 'departement Vide' }}
                                                        @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 align-self-center">
                                        <div class="text-lg-center mt-4 mt-lg-0">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div>
                                                        @php
                                                            $userProjectsCount = $user->projets->count();
                                                            $userOngoingProjectsCount = $user->ongoingProjects->count();
                                                            $userPendingProjectsCount = $user->PendingProjects->count();
                                                        @endphp
                                                        <p class="text-muted mb-2">Total Projects</p>
                                                        <h5 class="mb-0">{{ $userProjectsCount }}</h5>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div>
                                                        <p class="text-muted mb-2">Current Projects</p>
                                                        <h5 class="mb-0">{{ $userOngoingProjectsCount }}</h5>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div>
                                                        <p class="text-muted mb-2">Pending Projects</p>
                                                        <h5 class="mb-0">{{ $userPendingProjectsCount }}</h5>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="col-lg-4 d-none d-lg-block">
                                        <div class="clearfix mt-4 mt-lg-0">
                                            <div class="dropdown float-end">
                                                <a href="#" class="btn btn-info">History des Taches</a>
                                            </div>
                                        </div>
                                    </div> --}}
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
                                {{-- <div class="clearfix">
                                    <div class="float-end">
                                        <div class="input-group input-group-sm">
                                            <select class="form-select form-select-sm">
                                                <option value="JA" selected>Jan</option>
                                                <option value="DE">Dec</option>
                                                <option value="NO">Nov</option>
                                                <option value="OC">Oct</option>
                                            </select>
                                            <label class="input-group-text">Month</label>
                                        </div>
                                    </div>
                                    <h4 class="card-title mb-4">Echeances</h4>
                                </div> --}}

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div id="lineChart" class="apex-charts" data-colors='["--bs-primary"]' dir="ltr"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Attached Files</h4>
                                <div class="table-responsive"  style="max-height: 309px; overflow-y: auto;">
                                    <table class="table table-nowrap align-middle table-hover mb-0">
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
                                                        <h5 class="font-size-14 mb-1"><a href="javascript: void(0);"
                                                                class="text-dark">{{ $fichier->nom_fichier ?? 'Document' }}.Zip</a>
                                                        </h5>
                                                        <small>Size :
                                                            {{ formatSizeUnits(filesize(storage_path('app/' . $fichier->links))) }}</small>
                                                    </td>
                                                    <td>
                                                        <div class="text-center">
                                                            <a wire:click="telecharger({{ $fichier->id }})"
                                                                class="text-dark"><i
                                                                    class="bx bx-download h3 m-0"></i></a>
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
                </div>
                <!-- end row -->

                <div class="row">
                    
                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Attached Files</h4>
                                
                                <div>
                                    <div id="coulumnchart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Rapport</h4>


                                <h5>Fichier rapport</h5>
                                <div class="mt-4">
                                    <div data-simplebar style="max-height: 309px; overflow-y: auto;">
                                        <div class="table-responsive">
                                            <table class="table table-nowrap align-middle table-hover mb-0">
                                                <tbody>
                                                    @php $dateAffichee = null; @endphp
                                                    @foreach ($user->rapportgenerals as $rapport)
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
                                                                <h5 class="font-size-14 mb-1"><a
                                                                        href="javascript: void(0);"
                                                                        class="text-dark">rapport du
                                                                        {{ $rapport->date->format('y-m-d') ?? 'vide' }}</a>
                                                                </h5>
                                                            </td>

                                                            <td>
                                                                <div class="text-center">
                                                                    <a href="{{ route('affiche-rapport-par-date', ['slug' => $rapport->id]) }}"
                                                                        class="text-dark btn"><i
                                                                            class="bx bx-download h3 m-0"></i></a>
                                                                </div>
                                                            </td>

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
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">Planification</h4>
                                <p class="card-title-desc">
                                <h4 class="card-title">Les activites du {{ $formatDateRange }}</h4>
                                </p>

                                <div class="row">
                                    <div class="col-xl-3 col-sm-3">

                                        @foreach ($planifications as $planif)
                                            @if ($planif->status == 'Approved')
                                                <div class="btn card bg-primary text-white">
                                                    <h6 class="text-white" wire:click='detail({{ $planif->id }})'>
                                                        {{ $planif->date->format('d M, y') ?? '' }}</h6>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-xl-9 col-sm-9">
                                        <div class="card border border-primary">
                                            <div class="card-body">
                                                <div class="p-4 text-xl-start">
                                                    <div class="col-12">
                                                        <div>
                                                            <h5><strong>Tâches de la planification :</strong></h5>
                                                            @php
                                                                $projectNameDisplayed = false;
                                                            @endphp
                                                            @foreach ($PlantTache as $tache)
                                                                <div class="table-responsive">
                                                                    <table
                                                                        class="table table-nowrap align-middle table-hover mb-0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    <h5
                                                                                        class="text-truncate font-size-14 mb-1">
                                                                                        <a href="javascript: void(0);"
                                                                                            class="text-dark">{{ $tache->tach->tache_prevues ?? '' }}</a>
                                                                                    </h5>
                                                                                    @if (!$projectNameDisplayed)
                                                                                        <p class="text-muted mb-0">
                                                                                            {{ $tache->tach->projet->nom ?? 'vide' }}
                                                                                        </p>
                                                                                        @php
                                                                                            $projectNameDisplayed = true;
                                                                                        @endphp
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    <div>
                                                                                        <ul
                                                                                            class="list-inline mb-0 font-size-18">
                                                                                            @if ($tache->tach->status == 'Terminer')
                                                                                                <li
                                                                                                    class="list-inline-item">
                                                                                                    <span
                                                                                                        class="badge rounded-1 badge-soft-success">Terminer</span>
                                                                                                </li>
                                                                                            @elseif($tache->tach->status == 'En Cour')
                                                                                                <li
                                                                                                    class="list-inline-item">
                                                                                                    <span
                                                                                                        class="badge rounded-1 badge-soft-info">En
                                                                                                        Cour</span>
                                                                                                </li>
                                                                                            @elseif($tache->tach->status == 'Attente')
                                                                                                <li
                                                                                                    class="list-inline-item">
                                                                                                    <span
                                                                                                        class="badge rounded-1 badge-soft-warning">En
                                                                                                        Attente</span>
                                                                                                </li>
                                                                                            @endif
                                                                                        </ul>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        @if ($resultat == null && $ressources == null && $Observation == null)
                                                            Aucune planification n'est actuellement affichée. Cliquez
                                                            sur le bouton correspondant a une date.
                                                        @else
                                                            <h5><strong>Resultat Attendus :</strong></h5>
                                                            <p> {{ $resultat }}</p>
                                                            <h5><strong>Ressources Necessaires :</strong></h5>
                                                            <p> {{ $ressources }}</p>
                                                            <h5><strong>Observation/Recommatation :</strong></h5>
                                                            <p> {{ $Observation }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Projects </h4>

                        <div class="row">
                            @foreach ($projets as $user)
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


                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-15"><a
                                                            href="javascript: void(0);"
                                                            class="text-dark">{{ $user->projet->nom }}</a></h5>
                                                    <p class="text-muted text-truncate mb-4">
                                                        {{ $user->projet->description }}</p>
                                                    <div class="avatar-group">
                                                        @foreach ($user->projet->membres_projets_relation as $item)
                                                            @php
                                                                $nomMembre = $item->name;
                                                                $initiale = strtoupper(substr($nomMembre, 0, 1));
                                                            @endphp
                                                            <div class="avatar-group-item">
                                                                @if ($item->profile_photo_path)
                                                                    <a href="javascript: void(0);"
                                                                        class="d-inline-block">
                                                                        <img src="{{ asset($item ? '/storage/' . $item->profile_photo_path : null) }}"
                                                                            alt=""
                                                                            class="rounded-circle avatar-xs">
                                                                    </a>
                                                                @else
                                                                    <a href="#" class="d-inline-block">
                                                                        <div class="avatar-xs">
                                                                            <span
                                                                                class="avatar-title rounded-circle bg-success text-white font-size-16"
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
                                            <ul class="list-inline mb-0">
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

                        <div class="row">
                            <div class="col-lg-12" wire:ignore>
                                <ul class="pagination pagination-rounded justify-content-center mt-2 mb-5">
                                    {{ $projets->links('pagination::bootstrap-5') }}
                                </ul>
                            </div>
                        </div>
                        <!-- end row -->
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
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © Skote.
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
    var seriesData = <?php echo json_encode($jours_travailles); ?>;
    var totale = <?php echo json_encode($mois); ?>;
    var options = {
          series: [{
            name: "Day",
            data: seriesData
        }],
          chart: {
          height: 350,
          type: 'line',
          zoom: {
            enabled: false
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'straight'
        },
        title: {
          text: 'Product Trends by Month',
          align: 'left'
        },
        grid: {
          row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
          },
        },
        xaxis: {
          categories: totale,
        }
        };

        var chart = new ApexCharts(document.querySelector("#lineChart"), options);
        chart.render();
</script>

<script>
    var data = <?php echo json_encode($data); ?>;
    var months = <?php echo json_encode($months); ?>;

    var options = {
          series: data,
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: months,
        },
        yaxis: {
          title: {
            text: '$ (thousands)'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "$ " + val + " thousands"
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#coulumnchart"), options);
        chart.render();
</script>
