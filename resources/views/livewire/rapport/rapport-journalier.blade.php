<div>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
    
                <!-- Page Title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Daily Report</h4>
    
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                    <li class="breadcrumb-item active">Daily Report</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Page Title -->
    
                {{-- <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-center  mb-4">Rapport d'avancement quotidien</h4>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-4">
                                            <h4 class="text-center ">Entreprise : {{$filiale->nom}}</h4>
                                        </div>
                                    </div>
                        
                                    <div class="col-sm-6">
                                        <div class="mb-4">
                                            <h4 class="">Departement : {{$departement->nom}}</h4>
                                        </div>
                                    </div>
                                </div>

                                <div id="vertical-example" class="vertical-wizard">
                                    <!-- Seller Details -->
                                    
                                    @php
                                    $num = 1;
                                    $Tnum = 1;
                                    $Dnum = 1;
                                @endphp
                                    <form  wire:submit.prevent="submitForm" >
                                        <h5 class="mb-4">{{$num++}}- Activités de la journée</h5>
                                        <section>
                                            <div class="row">
                                                <div class="mb-3 col-12">
                                                    <div data-repeater-list="group-a">
                                                        <div data-repeater-item class="row">
                                                            <div  class="mb-3 col-md-4">
                                                                <label for="tacheId">Tâches Prevues <span class="text-danger">*</span></label>
                                                                <select class="form-control" type="tacheId" wire:model="tacheId" id="tacheId">
                                                                    <option value="">Selectionner...</option>
                                                                    @foreach ($planif as $tache)
                                                                            @foreach ($tache->plant_taches as $item)
                                                                                @if ($item->tach->status == 'En Cour')
                                                                                    <option value="{{$item->tach->id}}">{{$item->tach->tache_prevues}}</option>
                                                                                @endif
                                                                            @endforeach
                                                                    @endforeach
                                                                </select>
                                                                @error('tacheId')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div  class="mb-3 col-md-4">
                                                                <label for="tachesRealisees">Tâches Réalisées <span class="text-danger">*</span></label>
                                                                <input type="tachesRealisees" wire:model="tachesRealisees" id="tachesRealisees" class="form-control" />
                                                                @error('tachesRealisees') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>

                                                            <div  class="mb-3 col-md-4">
                                                                <label for="tachesSuplementaire">Taches suplementaire</label>
                                                                <input type="tachesSuplementaire" wire:model="tachesSuplementaire" id="tachesSuplementaire" class="form-control" />
                                                                @error('tachesSuplementaire') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>

                                                            <div  class="mb-3 col-md-2">
                                                                <label for="debutHeure">Heure de Début <span class="text-danger">*</span></label>
                                                                <input type="time" wire:model="debutHeure" id="debutHeure" class="form-control" placeholder="start time" />
                                                                @error('debutHeure') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>

                                                            <div  class="mb-3 col-md-2">
                                                                <label for="finHeure">Fin heure <span class="text-danger">*</span></label>
                                                                <input type="time" wire:model="finHeure" id="finHeure" class="form-control" placeholder="End of Hour" />
                                                                @error('finHeure') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label for="lieu">Lieu <span class="text-danger">*</span></label>
                                                                    <input type="text" wire:model="lieu" class="form-control" id="lieu" >
                                                                    @error('lieu') <span class="text-danger">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label for="materielsUtilises">Materiels Utilises <span class="text-danger">*</span></label>
                                                                    <input wire:model="materielsUtilises" type="text" class="form-control" id="materielsUtilises"  >
                                                                    @error('materielsUtilises') <span class="text-danger">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="mb-3">
                                                                    <label for="observation">Observations <span class="text-danger">*</span></label>
                                                                    <textarea wire:model="observation" id="observation" class="form-control" rows="2" ></textarea>
                                                                    @error('observation') <span class="text-danger">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="form-check form-check-inline">
                                                            <button class="btn btn-outline-primary waves-effect waves-light" wire:click.prevent="addDepenses" type="button" ></button>
                                                            <label >Aviez vous effectuer des depenses lier a l'activite ?</label>
                                                        </div>                                                         
                                                    </div>
                                                    @foreach ($addtaches as $index => $tache)
                                                        <h5 class="mb-4">{{$num++}}- Activités de la journée </h5>
                                                        <section>
                                                            <div data-repeater-list="group-a">
                                                                <div data-repeater-item class="row">
    
                                                                    <div  class="mb-3 col-md-4">
                                                                        <label for="tache[{{ $index }}][tacheId]">Tâches Prevues <span class="text-danger">*</span></label>
                                                                        <select class="form-control" type="text" wire:model="addtaches.{{ $index }}.tacheId" id="tache[{{ $index }}][tacheId]">
                                                                            <option value="">Selectionner...</option>
                                                                            @foreach ($planif as $tache)
                                                                                @foreach ($tache->plant_taches as $item)
                                                                                <option value="{{$item->tach->id}}">{{$item->tach->tache_prevues}}</option>
                                                                                @endforeach
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
    
                                                                    <div  class="mb-3 col-md-4">
                                                                        <label for="tache[{{ $index }}][tachesRealisees]">Tâches Réalisées <span class="text-danger">*</span></label>
                                                                        <input type="text" wire:model="addtaches.{{ $index }}.tachesRealisees" id="tache[{{ $index }}][tachesRealisees]" class="form-control" />
                                                                        @error('tachesRealisees') <span class="text-danger">{{ $message }}</span> @enderror

                                                                    </div>
    
                                                                    <div  class="mb-3 col-md-4">
                                                                        <label for="tache[{{ $index }}][tachesSuplementaire]">Taches suplementaire</label>
                                                                        <input type="text" wire:model="addtaches.{{ $index }}.tachesSuplementaire" id="tache[{{ $index }}][tachesSuplementaire]" class="form-control" />
                                                                        @error('tachesSuplementaire') <span class="text-danger">{{ $message }}</span> @enderror

                                                                    </div>
    
                                                                    <div  class="mb-3 col-md-2">
                                                                        <label for="tache[{{ $index }}][debutHeure]">Heure de Début <span class="text-danger">*</span></label>
                                                                        <input type="time" wire:model="addtaches.{{ $index }}.debutHeure" id="tache[{{ $index }}][debutHeure]" class="form-control" placeholder="start time" />
                                                                        @error('debutHeure') <span class="text-danger">{{ $message }}</span> @enderror

                                                                    </div>
    
                                                                    <div  class="mb-3 col-md-2">
                                                                        <label for="tache[{{ $index }}][finHeure]">Fin heure <span class="text-danger">*</span></label>
                                                                        <input type="time" wire:model="addtaches.{{ $index }}.finHeure" id="tache[{{ $index }}][finHeure]" class="form-control" placeholder="End of Hour" />
                                                                        @error('finHeure') <span class="text-danger">{{ $message }}</span> @enderror

                                                                    </div>
    
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label for="tache[{{ $index }}][lieu]">Lieu <span class="text-danger">*</span></label>
                                                                            <input type="text" wire:model="addtaches.{{ $index }}.lieu" class="form-control" id="tache[{{ $index }}][lieu]" >
                                                                             @error('lieu') <span class="text-danger">{{ $message }}</span> @enderror

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label for="tache[{{ $index }}][materielsUtilises]">Materiels Utilises <span class="text-danger">*</span></label>
                                                                            <input wire:model="addtaches.{{ $index }}.materielsUtilises" type="text" class="form-control" id="tache[{{ $index }}][materielsUtilises]"  >
                                                                            @error('materielsUtilises') <span class="text-danger">{{ $message }}</span> @enderror

                                                                        </div>
                                                                    </div>
                                                                </div>
                        
                                                                <div class="row">
                                                                    <div class="col-lg-10">
                                                                        <div class="mb-3">
                                                                            <label for="tache[{{ $index }}][observation]">Observations <span class="text-danger">*</span></label>
                                                                            <textarea wire:model="addtaches.{{ $index }}.observation" id="tache[{{ $index }}][observation]" class="form-control" rows="2" ></textarea>
                                                                            @error('observation') <span class="text-danger">{{ $message }}</span> @enderror
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2 align-self-center">
                                                                        <div class="d-grid">
                                                                            <input data-repeater-delete type="button" wire:click.prevent="removetaches({{ $index }})" class="btn btn-danger" value="Delete"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="form-check form-check-inline">
                                                                    <button class="form-check-input" wire:click.prevent="addDepenses" type="button" ></button>
                                                                    <label >Aviez vous effectuer des depenses lier a l'activite ?</label>
                                                                </div>                                                         
                                                            </div>
                                                        </section>
                                                    @endforeach
                                                    <input data-repeater-create type="button" wire:click.prevent="Ajoutaches" class="btn btn-primary mt-3 mt-lg-0" value="Add Task"/>
                                                </div>
                                            </div>
                                        </section>

                                        @foreach ($Depenses as $index => $Depense)
                                            <h5>{{$Dnum++}}- Depenses de l'activites</h5>
                                            <section>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="Depense[{{ $index }}][designationDepenses]">Designation Dépenses <span class="text-danger">*</span>:</label>
                                                            <input wire:model="Depenses.{{ $index }}.designationDepenses" type="text" class="form-control"  id="Depense[{{ $index }}][designationDepenses]">
                                                            @error('designationDepenses') <span class="text-danger">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="Depense[{{ $index }}][coutsReels]">Couts Reels <span class="text-danger">*</span></label>
                                                            <input type="text" wire:model="Depenses.{{ $index }}.coutsReels" class="form-control" id="Depense[{{ $index }}][coutsReels]" placeholder="Enter Couts Reels">
                                                            @error('coutsReels') <span class="text-danger">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="Depense[{{ $index }}][coutsPrevionnels]">Couts previonnels <span class="text-danger">*</span></label>
                                                            <input type="text" wire:model="Depenses.{{ $index }}.coutsPrevionnels" class="form-control" id="Depense[{{ $index }}][coutsPrevionnels]" placeholder="Enter Couts previonnels">
                                                            @error('coutsPrevionnels') <span class="text-danger">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-10">
                                                        <div class="mb-3">
                                                            <label for="Depense[{{ $index }}][observationDepenses]">Observation<span class="text-danger">*</span></label>
                                                            <textarea wire:model="Depenses.{{ $index }}.observationDepenses" id="Depense[{{ $index }}][observationDepenses]" class="form-control" cols="500" rows="2" ></textarea>
                                                            @error('observationDepenses') <span class="text-danger">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2 align-self-center">
                                                        <div class="d-grid">
                                                            <input data-repeater-delete type="button" wire:click.prevent="removeDepenses({{ $index }})" class="btn btn-danger" value="Delete"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        @endforeach
                                        
                                        <h6>Drop files here or click to upload.</h6>
                                        <div class="fallback mb-4">
                                            <input class="form-control" name="file"  type="file" wire:model="files" multiple="multiple">
                                        </div>

                                        <h5>{{$Tnum++}}- Taches prevues pour demain</h5>
                                        <section>
                                            <div data-repeater-list="outer-group" class="outer">
                                                <div data-repeater-item class="outer">
                                                    <div class="row">
                                                        <div class="col-md-8 col-7">
                                                            <div class="mb-3">
                                                                <label for="tachesProchain[tachesDemain]">Taches prevues <span class="text-danger">*</span>:</label>
                                                                <input type="text" wire:model="tachesDemain"  class="form-control" id="tachesProchain[]" placeholder="Enter your Name...">
                                                                @error('tachesDemain') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 col-5">
                                                            <div class="mb-3">
                                                                <label for="duree">Duree(en H) <span class="text-danger">*</span>:</label>
                                                                <input type="time" wire:model="duree" class="form-control" id="tachesProchain[]" placeholder="Duree...">
                                                                @error('duree') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 col-6">
                                                            <div class="mb-3">
                                                                <label for="designationprochain">Designation <span class="text-danger">*</span>:</label>
                                                                <input type="text" wire:model="designationprochain" class="form-control" id="tachesProchain[]" placeholder="Enter your Name...">
                                                                 @error('designationprochain') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-6">
                                                            <div class="mb-3">
                                                                <label for="valeur">Valeur <span class="text-danger">*</span>:</label>
                                                                <input type="text" wire:model="valeur" class="form-control" id="tachesProchain[]" placeholder="Enter your Name...">
                                                                 @error('valeur') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                        
                                                    </div>

                                                    <div class="inner-repeater mb-4">
                                                        <div data-repeater-list="inner-group" class="inner mb-3">
                                                            <label for="tachesProchain[risques]">Risques et atténuations <span class="text-danger">*</span>:</label>
                                                            <div data-repeater-item class="inner mb-3 row">
                                                                <div class="col-md-12 col-8">
                                                                    <textarea wire:model="risques" id="tachesProchain[]" class="form-control" rows="3" placeholder="Enter Your Message"></textarea>
                                                                    @error('risques') <span class="text-danger">{{ $message }}</span> @enderror
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @foreach ($tachesProchain as $index => $demain)
                                                <h5>{{$Tnum++}}- Taches prevues pour demain</h5>
                                                <section>
                                                    <div data-repeater-list="outer-group" class="outer">
                                                        <div data-repeater-item class="outer">
                                                            <div class="row">
                                                                <div class="col-md-8 col-7">
                                                                    <div class="mb-3">
                                                                        <label for="demain[{{ $index }}][tachesDemain]">Taches prevues <span class="text-danger">*</span> :</label>
                                                                        <input type="text" wire:model="tachesProchain.{{ $index }}.tachesDemain"  class="form-control" id="demain[{{ $index }}][tachesDemain]" placeholder="Enter your Name...">
                                                                        @error('tachesDemain') <span class="text-danger">{{ $message }}</span> @enderror

                                                                    </div>
                                                                </div>
    
                                                                <div class="col-md-4 col-5">
                                                                    <div class="mb-3">
                                                                        <label for="demain[{{ $index }}][duree]">Duree(en H) <span class="text-danger">*</span>:</label>
                                                                        <input type="time" wire:model="tachesProchain.{{ $index }}.duree" class="form-control" id="demain[{{ $index }}][duree]" placeholder="Duree...">
                                                                        @error('duree') <span class="text-danger">{{ $message }}</span> @enderror

                                                                    </div>
                                                                </div>
    
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6 col-6">
                                                                    <div class="mb-3">
                                                                        <label for="demain[{{ $index }}][designationprochain]">Designation <span class="text-danger">*</span>:</label>
                                                                        <input type="text" wire:model="tachesProchain.{{ $index }}.designationprochain" class="form-control" id="demain[{{ $index }}][designationprochain]" placeholder="Enter your Name...">
                                                                        @error('designationprochain') <span class="text-danger">{{ $message }}</span> @enderror

                                                                    </div>
                                                                </div>
    
                                                                <div class="col-md-6 col-6">
                                                                    <div class="mb-3">
                                                                        <label for="demain[{{ $index }}][valeur]">Valeur <span class="text-danger">*</span>:</label>
                                                                        <input type="text" wire:model="tachesProchain.{{ $index }}.valeur" class="form-control" id="demain[{{ $index }}][valeur]" placeholder="Enter your Name...">
                                                                        @error('valeur') <span class="text-danger">{{ $message }}</span> @enderror

                                                                    </div>
                                                                </div>
    
                                                            </div>
    
                                                            <div class="inner-repeater mb-4">
                                                                <div data-repeater-list="inner-group" class="inner mb-3">
                                                                    <label for="demain[{{ $index }}][risques]">Resques et attenuations <span class="text-danger">*</span>:</label>
                                                                    <div data-repeater-item class="inner mb-3 row">
                                                                        <div class="col-md-10 col-8">
                                                                            <textarea wire:model="tachesProchain.{{ $index }}.risques" id="demain[{{ $index }}][risques]" class="form-control" rows="3" placeholder="Enter Your Message"></textarea>
                                                                            @error('risques') <span class="text-danger">{{ $message }}</span> @enderror

                                                                        </div>
                                                                        <div class="col-md-2 col-4">
                                                                            <div class="d-grid">
                                                                                <input data-repeater-delete wire:click.prevent="removetachesProchain({{ $index }})" type="button" class="btn btn-danger inner" value="Delete"/>
                                                                            </div>
                                                                        </div>
    
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                            @endforeach
                                            <input data-repeater-create wire:click.prevent="addtachesProchain" type="button" class="btn btn-primary inner" value="Add Task"/>

                                        </section>

                                        <div class="mt-4">
                                            <label for="observationglobal">Observations de la journée <span class="text-danger">*</span>:</label>
                                            <textarea id="observationglobal" class="form-control" wire:model="observationglobal" rows="3" placeholder="(imprevus, indicateurs, references, defis, propositions de solution etc.)"></textarea>
                                            @error('observationglobal') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="d-flex flex-wrap gap-2 m-4">
                                            <button type="submit" class="btn btn-success waves-effect waves-light">Enregistrer</button>
                                            <button type="reset" class="btn btn-secondary waves-effect waves-light">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div> --}}

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-center  mb-4">Rapport d'avancement quotidien</h4>

                                @if ($filiale)
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-4">
                                            <h4 class="text-center ">Entreprise : {{$filiale->nom}}</h4>
                                        </div>
                                    </div>
                        
                                    <div class="col-sm-6">
                                        <div class="mb-4">
                                            <h4 class="">Service : {{$departement->nom}}</h4>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-4">
                                            <h4 class="text-center ">Entreprise : Elceto Holding</h4>
                                        </div>
                                    </div>
                        
                                    <div class="col-sm-6">
                                        <div class="mb-4">
                                            <h4 class="">Departement : {{$service->nom}}</h4>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div id="vertical-example" class="vertical-wizard">
                                    <!-- Seller Details -->
                                    <form >
                                        <h5 class="mb-4"> Activités de la journée</h5>
                                        <section>
                                            <div class="row">
                                                <div class="mb-3 col-12">
                                                    <div data-repeater-list="group-a">
                                                        <div data-repeater-item class="row">
                                                            @foreach ($planifs as $planif)
                                                                @foreach ($planif->plant_taches_relation as $tache)
                                                                    @if ($tache->status !== "Terminer")
                                                                        <div class="mb-3 col-md-6">
                                                                            <label for="tacheId">Tâches à réaliser <span class="text-danger">*</span></label>
                                                                            <div class="form-check form-check-primary mb-2 d-flex align-items-center">
                                                                                <input wire:model="taches.{{ $tache->id }}.isChecked" class="form-check-input" type="checkbox" id="taches-{{ $tache->id }}" value="{{ $tache->id }}">
                                                                                <label class="form-check-label ms-2">{{ $tache->tache_prevues }}</label>
                                                                                @error('taches.*.isChecked') <span class="text-danger">{{ $message }}</span> @enderror
                                                                            </div>
                                                                        </div>

                                                                        <div class="mb-3 col-md-2">
                                                                            <label for="debutHeure">Heure de Début <span class="text-danger">*</span></label>
                                                                            <input type="time" wire:model="taches.{{ $tache->id }}.debutHeure" class="form-control" placeholder="start time" />
                                                                            @error('taches.*.debutHeure') <span class="text-danger">{{ $message }}</span> @enderror
                                                                        </div>

                                                                        <div class="mb-3 col-md-2">
                                                                            <label for="finHeure">Heure de Fin <span class="text-danger">*</span></label>
                                                                            <input type="time" wire:model="taches.{{ $tache->id }}.finHeure" class="form-control" placeholder="end time" />
                                                                            @error('taches.*.finHeure') <span class="text-danger">{{ $message }}</span> @enderror
                                                                        </div>

                                                                        <div class="mb-3 col-md-2">
                                                                            <label for="lieu">Lieu <span class="text-danger">*</span></label>
                                                                            <input type="text" wire:model="taches.{{ $tache->id }}.lieu" class="form-control" placeholder="Lieu" />
                                                                            @error('taches.*.lieu') <span class="text-danger">{{ $message }}</span> @enderror
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            @endforeach

                                                        </div>
                
                                                        
                                                        @foreach ($addtaches as $index => $tache)
                                                            <section>
                                                                <div data-repeater-list="group-a">
                                                                    <div data-repeater-item class="row mt-3">

                                                                        @if ($permission == 'Employer')
                                                                            <div class="mb-3 col-md-4">
                                                                                <select wire:model="addtaches.{{ $index }}.projet" class="inner form-control" name="projet" id="projet">
                                                                                    <option value="">Selectionner le projet...</option>
                                                                                    @foreach ($Auth_user->membres_projets as $user)
                                                                                        <option value="{{$user->projet->id}}">{{$user->projet->nom}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                                @error('addtaches.{{ $index }}.projet')
                                                                                    <span class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                            
                                                                            <div  class="mb-3 col-md-4">
                                                                                <label for="tache[{{ $index }}][tachesSuplementaire]">Taches </label>
                                                                                <input type="text" wire:model="addtaches.{{ $index }}.tachesSuplementaire" id="tache[{{ $index }}][tachesSuplementaire]" class="form-control" />
                                                                                @error('tachesSuplementaire') <span class="text-danger">{{ $message }}</span> @enderror

                                                                            </div>

                                                                            
                                                                            <div class="col-md-4">
                                                                                <div class="mb-3">
                                                                                    <label for="tache[{{ $index }}][lieu]">Lieu <span class="text-danger">*</span></label>
                                                                                    <input type="text" wire:model="addtaches.{{ $index }}.lieu" class="form-control" id="tache[{{ $index }}][lieu]" >
                                                                                    @error('lieu') <span class="text-danger">{{ $message }}</span> @enderror

                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                             
                                                                            <div  class="mb-3 col-md-4">
                                                                                <label for="tache[{{ $index }}][tachesSuplementaire]">Taches suplementaire</label>
                                                                                <input type="text" wire:model="addtaches.{{ $index }}.tachesSuplementaire" id="tache[{{ $index }}][tachesSuplementaire]" class="form-control" />
                                                                                @error('tachesSuplementaire') <span class="text-danger">{{ $message }}</span> @enderror

                                                                            </div>
                                                                            
                                                                            <div class="col-md-2">
                                                                                <div class="mb-3">
                                                                                    <label for="tache[{{ $index }}][lieu]">Lieu <span class="text-danger">*</span></label>
                                                                                    <input type="text" wire:model="addtaches.{{ $index }}.lieu" class="form-control" id="tache[{{ $index }}][lieu]" >
                                                                                    @error('lieu') <span class="text-danger">{{ $message }}</span> @enderror

                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                        <div  class="mb-3 col-md-2">
                                                                            <label for="tache[{{ $index }}][debutHeure]">Heure de Début <span class="text-danger">*</span></label>
                                                                            <input type="time" wire:model="addtaches.{{ $index }}.debutHeure" id="tache[{{ $index }}][debutHeure]" class="form-control" placeholder="start time" />
                                                                            @error('debutHeure') <span class="text-danger">{{ $message }}</span> @enderror

                                                                        </div>

                                                                        <div  class="mb-3 col-md-2">
                                                                            <label for="tache[{{ $index }}][finHeure]">Fin heure <span class="text-danger">*</span></label>
                                                                            <input type="time" wire:model="addtaches.{{ $index }}.finHeure" id="tache[{{ $index }}][finHeure]" class="form-control" placeholder="End of Hour" />
                                                                            @error('finHeure') <span class="text-danger">{{ $message }}</span> @enderror

                                                                        </div>

                                                                        
                                                                    <div class="col-md-2 mt-4">
                                                                        <div class="d-grid">
                                                                            <input data-repeater-delete type="button" wire:click.prevent="removetaches({{ $index }})" class="btn btn-danger" value="Delete"/>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                        @endforeach
                                                        @if ($permission == 'Employer')
                                                            <input data-repeater-create type="button" wire:click.prevent="Ajoutaches" class="btn btn-primary mb-4 mt-3" value="Ajoutez les tâches"/>
                                                        @else
                                                            <input data-repeater-create type="button" wire:click.prevent="Ajoutaches" class="btn btn-primary mb-4 mt-3" value="Tâches supplémentaires"/>
                                                        @endif

                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label for="materielsUtilises">Materiels Utilises <span class="text-danger">*</span></label>
                                                                    <textarea wire:model="materielsUtilises" id="materielsUtilises" class="form-control" rows="2" ></textarea>
                                                                    @error('materielsUtilises') <span class="text-danger">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <div class="mb-3">
                                                                    <label for="observation">Observations <span class="text-danger">*</span></label>
                                                                    <textarea wire:model="observation" id="observation" class="form-control" rows="2" ></textarea>
                                                                    @error('observation') <span class="text-danger">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 mt-3">
                                                        <div class="form-check form-check-inline">
                                                            {{-- <button class="btn btn-outline-primary waves-effect waves-light" wire:click.prevent="addDepenses" type="button" ></button> --}}
                                                            <input class="form-check-input" type="radio" wire:click="showFormForOption1">
                                                            <label class="text-primary" >Aviez-vous effectué des dépenses liées à l'activité ?</label>
                                                            
                                                        </div>                                                         
                                                    </div>
                                                </div>
                                            </div>
                                        </section>

                                        @if ($showFormOption1)
                                            @if ($permission == 'Employer')
                                                @foreach ($Depenses as $index => $Depense)
                                                    <h5> Depenses de l'activites</h5>
                                                    <section>
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <div class="mb-3">
                                                                    <label for="Depense[{{ $index }}][designationDepenses]">Designation Dépenses <span class="text-danger">*</span>:</label>
                                                                    <input wire:model="Depenses.{{ $index }}.designationDepenses" type="text" class="form-control"  id="Depense[{{ $index }}][designationDepenses]">
                                                                    @error('designationDepenses') <span class="text-danger">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-2">
                                                                <div class="mb-3">
                                                                    <label for="Depense[{{ $index }}][coutsReels]">Couts Reels <span class="text-danger">*</span></label>
                                                                    <input type="text" wire:model="Depenses.{{ $index }}.coutsReels" class="form-control" id="Depense[{{ $index }}][coutsReels]" placeholder="Enter Couts Reels">
                                                                    @error('coutsReels') <span class="text-danger">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div class="mb-3">
                                                                    <label for="Depense[{{ $index }}][coutsPrevionnels]">Couts previonnels <span class="text-danger">*</span></label>
                                                                    <input type="text" wire:model="Depenses.{{ $index }}.coutsPrevionnels" class="form-control" id="Depense[{{ $index }}][coutsPrevionnels]" placeholder="Enter Couts previonnels">
                                                                    @error('coutsPrevionnels') <span class="text-danger">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-10">
                                                                <div class="mb-3">
                                                                    <label for="Depense[{{ $index }}][observationDepenses]">Observation<span class="text-danger">*</span></label>
                                                                    <textarea wire:model="Depenses.{{ $index }}.observationDepenses" id="Depense[{{ $index }}][observationDepenses]" class="form-control" cols="500" rows="2" ></textarea>
                                                                    @error('observationDepenses') <span class="text-danger">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-2 align-self-center">
                                                                <div class="d-grid">
                                                                    <input data-repeater-delete type="button" wire:click.prevent="removeDepenses({{ $index }})" class="btn btn-danger" value="Delete"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                @endforeach
                                            @else
                                                @foreach ($Depenses as $index => $Depense)
                                                    <h5> Depenses de l'activites</h5>
                                                    <section>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-4">
                                                                <label for="Depenses[{{ $index }}][tacheId]"> Tâches Prévues <span class="text-danger">*</span> </label>
                                                                <!-- Assurez-vous que tacheId est correctement défini dans votre tableau $Depenses -->
                                                                <select class="form-control" type="text" wire:model="Depenses.{{ $index }}.tacheId" id="Depenses[{{ $index }}][tacheId]">
                                                                    <option value=""> Sélectionner... </option>
                                                                    @foreach ($planifs as $tache)
                                                                        @foreach ($tache->plant_taches as $item)
                                                                            <option value="{{ $item->tach->id }}"> {{ $item->tach->tache_prevues }} </option>
                                                                        @endforeach
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div class="mb-3">
                                                                    <label for="Depense[{{ $index }}][designationDepenses]">Designation Dépenses <span class="text-danger">*</span>:</label>
                                                                    <input wire:model="Depenses.{{ $index }}.designationDepenses" type="text" class="form-control"  id="Depense[{{ $index }}][designationDepenses]">
                                                                    @error('designationDepenses') <span class="text-danger">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-2">
                                                                <div class="mb-3">
                                                                    <label for="Depense[{{ $index }}][coutsReels]">Couts Reels <span class="text-danger">*</span></label>
                                                                    <input type="text" wire:model="Depenses.{{ $index }}.coutsReels" class="form-control" id="Depense[{{ $index }}][coutsReels]" placeholder="Enter Couts Reels">
                                                                    @error('coutsReels') <span class="text-danger">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div class="mb-3">
                                                                    <label for="Depense[{{ $index }}][coutsPrevionnels]">Couts previonnels <span class="text-danger">*</span></label>
                                                                    <input type="text" wire:model="Depenses.{{ $index }}.coutsPrevionnels" class="form-control" id="Depense[{{ $index }}][coutsPrevionnels]" placeholder="Enter Couts previonnels">
                                                                    @error('coutsPrevionnels') <span class="text-danger">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-10">
                                                                <div class="mb-3">
                                                                    <label for="Depense[{{ $index }}][observationDepenses]">Observation<span class="text-danger">*</span></label>
                                                                    <textarea wire:model="Depenses.{{ $index }}.observationDepenses" id="Depense[{{ $index }}][observationDepenses]" class="form-control" cols="500" rows="2" ></textarea>
                                                                    @error('observationDepenses') <span class="text-danger">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-2 align-self-center">
                                                                <div class="d-grid">
                                                                    <input data-repeater-delete type="button" wire:click.prevent="removeDepenses({{ $index }})" class="btn btn-danger" value="Delete"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                @endforeach
                                            @endif
                                            <button class="btn btn-primary mt-3 mb-3" wire:click.prevent="addDepenses" type="button" >Ajout Depense</button>
                                        @endif
                                        
                                        <h6>click to upload.</h6>
                                        <div class="fallback mb-4">
                                            <input class="form-control" name="file"  type="file" wire:model="files" multiple="multiple">
                                        </div>

                                        <h5>Tâches prévues pour demain</h5>
                                        <section>
                                            <div data-repeater-list="outer-group" class="outer">
                                                <div data-repeater-item class="outer">
                                                @if ($permission == 'Employer')
                                                
                                                    @foreach ($tachesDemain as $index => $tache)
                                                        <section>
                                                            <div data-repeater-list="group-a">
                                                                <div data-repeater-item class="row mt-3">

                                                                    <div  class="mb-3 col-md-4">
                                                                        <label for="tache[{{ $index }}][tachesSuplementaire]">Taches Pour demain</label>
                                                                        <input type="text" wire:model="tachesDemain.{{ $index }}.taches" id="tache[{{ $index }}][taches]" class="form-control" />
                                                                        @error('tachesDemain.{{ $index }}.taches') <span class="text-danger">{{ $message }}</span> @enderror

                                                                    </div>

                                                                    <div  class="mb-3 col-md-2">
                                                                        <label for="tache[{{ $index }}][duree]">Durée <span class="text-danger">*</span></label>
                                                                        <input type="time" wire:model="tachesDemain.{{ $index }}.duree" id="tache[{{ $index }}][duree]" class="form-control" placeholder="start time" />
                                                                        @error('tachesDemain.{{ $index }}.duree') <span class="text-danger">{{ $message }}</span> @enderror

                                                                    </div>
                                                                    
                                                                    <div  class="mb-3 col-md-2">
                                                                        <label for="tache[{{ $index }}][designation]">Dedignation</label>
                                                                        <input type="text" wire:model="tachesDemain.{{ $index }}.designation" id="tache[{{ $index }}][designation]" class="form-control" />
                                                                        @error('tachesDemain.{{ $index }}.designation') <span class="text-danger">{{ $message }}</span> @enderror

                                                                    </div>
                                                                    
                                                                    <div  class="mb-3 col-md-2">
                                                                        <label for="tache[{{ $index }}][valeur]">Valeur</label>
                                                                        <input type="text" wire:model="tachesDemain.{{ $index }}.valeur" id="tache[{{ $index }}][valeur]" class="form-control" />
                                                                        @error('tachesDemain.{{ $index }}.valeur') <span class="text-danger">{{ $message }}</span> @enderror

                                                                    </div>

                                                                <div class="col-md-2 mt-4">
                                                                    <div class="d-grid">
                                                                        <input data-repeater-delete type="button" wire:click.prevent="removetachesplus({{ $index }})" class="btn btn-danger" value="Delete"/>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    @endforeach
                                                    <input data-repeater-create type="button" wire:click.prevent="tachesplus" class="btn btn-primary mb-4 mt-3" value="Ajoutez les tâches pour demain"/>
                                                
                                                @else
                                                    
                                                    @foreach ($planification as $planif)
                                                        @foreach ($planif->plant_taches_relation as $tache)
                                                            @if ($tache->status == 'En Cour')
                                                                <div data-repeater-item class="row">
                                                                    <div class="mt-3 col-md-9">
                                                                        <div class="form-check form-check-primary mt-2 d-flex align-items-center">
                                                                            <input wire:model="tachesProchain.{{ $tache->id }}.isChecked" class="form-check-input" type="checkbox" id="tachesProchain-{{ $tache->id }}" value="{{ $tache->id }}">
                                                                            <label class="form-check-label ms-2">{{ $tache->tache_prevues }}</label>
                                                                            @error('tachesProchain.*.isChecked') <span class="text-danger">{{ $message }}</span> @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 mb-3">
                                                                        <label>Durée (en H) <span class="text-danger">*</span>:</label>
                                                                        <input type="time" wire:model="tachesProchain.{{ $tache->id }}.duree" class="form-control" placeholder="Heure de début" />                                                                   
                                                                        @error('tachesProchain.*.duree') <span class="text-danger">{{ $message }}</span> @enderror
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                
                                                    <div class="mb-3">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" wire:click="showFormForOption2">
                                                            <label class="text-primary">Avez-vous prévu des dépenses ?</label>
                                                        </div>
                                                    </div>
                                                    @if ($showFormOption2)
                                                        <div class="row">
                                                            <div class="col-md-6 col-6">
                                                                <div class="mb-3">
                                                                    <label>Designation <span class="text-danger">*</span>:</label>
                                                                    <input type="text" wire:model="designationprochain" class="form-control" placeholder="Entrer la désignation...">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-6">
                                                                <div class="mb-3">
                                                                    <label for="valeur">Valeur <span class="text-danger">*</span>:</label>
                                                                    <input type="text" wire:model="valeur" class="form-control" id="tachesProchain[]" placeholder="Entrer la valeur...">
                                                                    @error('valeur') <span class="text-danger">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                                    <div class="inner-repeater mb-4">
                                                        <div data-repeater-list="inner-group" class="inner mb-3">
                                                            <label for="tachesProchain[risques]">Risques et atténuations <span class="text-danger">*</span>:</label>
                                                            <div data-repeater-item class="inner mb-3 row">
                                                                <div class="col-md-12 col-12">
                                                                    <textarea wire:model="risques" id="tachesProchain[]" class="form-control" rows="3" placeholder="Entrez votre message"></textarea>
                                                                    @error('risques') <span class="text-danger">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <div class="mt-4">
                                            <label for="observationglobal">Observations de la journée <span class="text-danger">*</span>:</label>
                                            <textarea id="observationglobal" class="form-control" wire:model="observationglobal" rows="3" placeholder="(imprevus, indicateurs, references, defis, propositions de solution etc.)"></textarea>
                                            @error('observationglobal') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="d-flex flex-wrap gap-2 m-4">
                                            <button type="button" wire:click="save" class="btn btn-success waves-effect waves-light">Enregistrer</button>
                                            <button type="reset" class="btn btn-secondary waves-effect waves-light">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- Footer -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- ... Votre code pour le pied de page ... -->
                            </div>
                            <div class="col-sm-6">
                                <!-- ... Votre code pour le pied de page ... -->
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- End Footer -->
    
            </div> <!-- End Container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
</div>
@include('sweetalert')


