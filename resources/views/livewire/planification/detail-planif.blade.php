<div>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Create Weekly planning</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Weekly planning</a></li>
                                    <li class="breadcrumb-item active">Create Weekly planning</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    
                    <div class="col-xl-3 col-lg-4">
                        <div class="card">
                            <div class="card-body p-4">
                                <div>
                                    <p class="card-title">Jour planifier</p>

                                    <ul class="list-unstyled fw-medium">
                                        @foreach ($planifs as $planif)
                                            <li><a wire:click='confirmerJour({{ $planif->id }})' class="btn text-muted py-2 d-block"><i class="mdi mdi-chevron-right me-1"></i> {{($planif->date)->format("l d/m/Y") ?? 'vide'}}</a></li>
                                        @endforeach
                                    </ul>
                                    
                                    <div class="row mb-2">
                                        <div class="col-xxl-10 col-lg-6">
                                            <div class="search-box me-2 mb-2 d-inline-block">
                                                <div class="position-relative">
                                                    <button type="button" wire:click='AccepterPlanif' class="btn btn-success  waves-effect waves-light mb-2 me-2">Confirmer</button>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-xxl-2 col-lg-6">
                                            <div class="text-sm-end">
                                                <button type="button" wire:click="update" class="btn btn-danger  waves-effect waves-light mb-2 me-2"> Rejeter</button>
                                            </div>
                                        </div><!-- end col-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>

                    <div class="col-xl-9 col-lg-8">
                        <div class="card">
                            <!-- Tab panes -->
                            <div class="tab-content p-4">
                                <div class="tab-pane active" id="all-post" role="tabpanel">
                                     <div class="row justify-content-center">
                                            <div class="col-xl-8">
                                                <div>
                                                    
                                                    <div class=" mt-2">
                                                        
                                                        <h4 class="text-center card-title">PLANIFICATION HEBDOMADAIRE  DES ACTIVITES DE LA SEMAINE </h4>
                                                        <div class="row mt-4">
                                                            <div class="col-md-6">
                                                                <h6 class="text-center mb-4">Entreprise : {{$filiale->nom ?? 'VIDE'}}</h6>
                                                            </div>
                                                
                                                            <div class="col-md-6">
                                                                <h6 class="text-center mb-4">Departement : {{$departement->nom ?? 'VIDE'}}</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group mt-2">
                                                            <h5>Les tâches prevues :</h5>
                                                            <ul>
                                                                @php
                                                                $projectNameDisplayed = false;
                                                            @endphp
                                                            @foreach($PlantTache as $tache)
                                                                @if ($tache->tach->status !== 'Supprimer')
                                                                    @if (!$projectNameDisplayed)
                                                                        <h6>Projet: {{ $tache->tach->projet->nom ?? 'Cliquez sur un jour'}}</h6>
                                                                        @php
                                                                            $projectNameDisplayed = true;
                                                                        @endphp
                                                                    @endif
                                                                    <li>{{ $tache->tach->tache_prevues ?? 'Cliquez sur un jour'}} </li>
                                                                @endif
                                                            @endforeach
                                                            </ul>
                                                        </div>
                    
                                                        <div class="col-sm-6">
                                                            <div class="mt-3">
                                                                <h5 for="resultat">Resultats attendus</h5>
                                                                <p>{{$resultat  ?? 'Cliquez sur un jour '}}</p>
                                                            </div>
                                                        </div>
                                            
                                                        <div class="col-sm-6">
                                                            <div class="mt-3">
                                                                <h5 for="ressources">Ressources necessaires</h5>
                                                                <p>
                                                                    {{$ressources ?? 'Cliquez sur un jour '}}
                                                                </p>
                                                            </div>
                                                        </div>
                
                                                        <div class="col-sm-12">
                                                            <div class="mt-3">
                                                                <h5 for="observation">Observations/Recommandations :</h5>
                                                                <p>
                                                                    {{$Observation ?? 'Cliquez sur un jour '}}
                                                                </p>
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
                </div>
                <!-- end row -->
                
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        {{-- <div class="modal fade bs-example-modal-center" data-bs-backdrop="static"  id="hierachie" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Rejeter la Planification</h5>
                        <button type="button" class="btn-close"  aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            @if (session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            
                            <label for="object">Object du rejet de la planification</label>
                            <textarea class="form-control mb-2" id="object"  wire:model="object" rows="3"></textarea>
                            @error('object')
                                <span class="text-danger"> {{$message}} </span>
                            @enderror
                        </div>
                        <div class="form-check form-check-primary d-flex align-items-center">
                            <input wire:click="UpdatePlanification" class="form-check-input" type="checkbox" id="taches">
                            <label class="form-check-label ms-2">Voulez-vous apporter des modifications à cette planification ?</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="closeupdate" class="btn btn-success waves-effect" data-bs-dismiss="modal">Annuler</button>
                        <button type="button" wire:click="RejeterPlanif" class="btn btn-danger waves-effect waves-light">valider</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> --}}
        <div class="modal fade orderdetailsModal " id="hierachie" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="orderdetailsModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Rejeter la Planification</h5>
                        <button type="button" class="btn-close"  aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            @if (session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            
                            <label for="object">Object du rejet de la planification</label>
                            <textarea class="form-control mb-2" id="object"  wire:model="object" rows="3"></textarea>
                            @error('object')
                                <span class="text-danger"> {{$message}} </span>
                            @enderror
                        </div>
                        {{-- <div class="form-check form-check-primary d-flex align-items-center">
                            <input wire:click="UpdatePlanification" class="form-check-input" type="checkbox" id="taches">
                            <label class="form-check-label ms-2">Voulez-vous apporter des modifications à cette planification ?</label>
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="closeupdate" class="btn btn-success waves-effect" data-bs-dismiss="modal">Annuler</button>
                        <button type="button" wire:click="RejeterPlanif" class="btn btn-danger waves-effect waves-light">valider</button>
                    </div>
                    
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        
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
    
window.addEventListener("show_modal", event => {
    // alert('okay')
    $('#hierachie').modal('show');
})

window.addEventListener("closeupdate", event => {
    $("#hierachie").modal("hide")
})
    
window.addEventListener("Update_modal", event => {
    // alert('okay')
    $('#editModal').modal('show');
})

window.addEventListener("Update_close", event => {
    $("#editModal").modal("hide")
})
</script>
@include('sweetalert')