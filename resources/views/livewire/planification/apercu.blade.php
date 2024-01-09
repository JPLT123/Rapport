<div>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row ">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Planification</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Report Management</a></li>
                                    <li class="breadcrumb-item active">Planification</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="tab-content p-4">
                        <div class="tab-pane active" id="all-post" role="tabpanel">
                             <div class="row justify-content-center">
                                <div class="text-center mb-2">
                                    <h4 class="card-title">PLANIFICATION HEBDOMADAIRE  DES ACTIVITES SEMAINE DU {{ $formatDateRange }}</h4>
                                    <div class="row m-4">
                                        <div class="col-sm-5">
                                            <h4 class="card-title">Entreprise : {{$filiale ? $filiale->nom : 'vide'}}</h4>
                                        </div>
                            
                                        <div class="col-sm-7">
                                            <h4 class="card-title">Departement : {{$departement ? $departement->nom : 'vide'}}</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-2 col-sm-3">
                                        
                                        @foreach ($planifications as $planif)
                                            @if ($planif->status == 'Approved')
                                                <div class="btn card bg-primary text-white">
                                                    <h6 class="m-2 text-white" wire:click='detail({{ $planif->id }})'><i class="mdi mdi-bullseye-arrow me-2"></i> {{$planif->date->format('d M, y') ?? ''}}</h6>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-xl-10 col-sm-9">
                                        <div class="card border border-primary">
                                            <div class="card-body">
                                                <div class="p-4 text-xl-start">
                                                    <div class="row">
                                                        {{-- <div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div>
                                                                <h5>Lundi : ...../...../ 2023</h5>
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                    <div class="col-12">
                                                        <div>
                                                            <h5><strong>Tâches de la planification :</strong></h5>
                                                            <ul>
                                                                @php
                                                                    $projectNameDisplayed = false;
                                                                @endphp
                                                                @foreach($PlantTache as $tache)
                                                                    @if (!$projectNameDisplayed)
                                                                            <h6>Projet: {{ $tache->tach->projet->nom ?? ''}}</h6>
                                                                        @php
                                                                            $projectNameDisplayed = true;
                                                                        @endphp
                                                                    @endif
                                                                    <li>{{ $tache->tach->tache_prevues ?? ''}} </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                        @if ($resultat== null && $ressources== null && $Observation== null )
                                                        Aucune planification n'est actuellement affichée. Cliquez sur le bouton correspondant a une date.
                                                        @else
                                                            <h5><strong>Resultat Attendus :</strong></h5> <p> {{$resultat}}</p>
                                                            <h5><strong>Ressources Necessaires :</strong></h5> <p> {{$ressources}}</p>
                                                            <h5><strong>Observation/Recommatation :</strong></h5> <p> {{$Observation}}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                

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
