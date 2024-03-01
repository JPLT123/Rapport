<div>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="pt-3">
            
                                    <div class="row">
                                        <div class="col-sm-3">
                                        </div>
                                        
                                        <div class="col-sm-9">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('assets/images/logo_elceto.png') }}" style="width: 15%; margin-right 100px" alt="">
                                                <span class="btn btn-rounded waves-effect waves-light" style="background-color:#0055a4;
                                                    color:white; width: 350px; height: 55px; font-size: 24px; border-color: black;">
                                                    Elceto Holding SAS
                                                </span>                                                
                                            </div>
                                        </div>
        
                                    </div>
                                    
                                    <div class="row justify-content-center mt-4">
                                        <div class="col-xl-8">
                                            <div>
                                                <div class="text-center">
                                                    <h4>Demande de Tâche Supplémentaire</h4>
                                                    <p class="text-muted mb-4"><i class="mdi mdi-calendar me-1"></i> {{ \Carbon\Carbon::parse($tachesupls->date)->format("d M, Y") }}</p>
                                                </div>
                                                <hr>
                                                <div class="text-center">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div>
                                                                <p class="text-muted mb-2">Entreprise</p>
                                                                <h5 class="font-size-15">{{$tachesupls->user->filiale->nom}}</h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mt-4 mt-sm-0">
                                                                <p class="text-muted mb-2">Date </p>
        
                                                                <h5 class="font-size-15">{{ \Carbon\Carbon::parse($tachesupls->date)->format("d M, Y") }}</h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mt-4 mt-sm-0">
                                                                <p class="text-muted mb-2">Departement</p>
                                                                <h5 class="font-size-15">{{$tachesupls->user->departement->nom}}</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
            
                                                <div class="m-4">
                                                    <div class="text-muted font-size-14">
                                                        
                                                        <h5 class="mb-3">Tâches prevues</h5>
                                                        <ul>
                                                            @foreach ($tachesupls->tache as $item)
                                                                <li>{{$item->tache_prevues}}</li>
                                                            @endforeach
                                                        </ul>
                                                        
                                                        <h5 >Description de la tâche supplémentaire:</h5>
                                                        <p class="mb-3">{{$tachesupls->description}}</p>
                                                    
                                                        <h5 class="mb-3">Justification de la demande:</h5>
                                                        <p>{{$tachesupls->justification}}</p>
            
                                                        <h5 class="mb-3">Impact sur les tâches actuelles:</h5>
                                                        <p>{{$tachesupls->impact}}</p>
        
                                                        <br>
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                
                                                            <strong>Nom du demandeur:</strong> {{$tachesupls->user->name}}
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <br>
                                                        
                                                        <div class="d-flex flex-wrap gap-2 m-4">
                                                               
                                                            <a wire:click="Reponse" class="btn btn-primary waves-effect waves-light">Approuver</a>
                                                            
                                                            {{-- <button type="button" wire:click="add" class="btn btn-primary waves-effect waves-light">Enregistrer</button> --}}
                                                            <button wire:click="Rejeter" type="button" class="btn btn-secondary waves-effect waves-light">Rejeter</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
            </div>
        </div>
    </div>
</div>

