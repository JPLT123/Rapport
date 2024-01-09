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
    
                <div class="row">
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
                                                                <label for="tacheId">Tâches Prevues</label>
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
                                                                <label for="tachesRealisees">Tâches Réalisées</label>
                                                                <input type="tachesRealisees" wire:model="tachesRealisees" id="tachesRealisees" class="form-control" />
                                                                @error('tachesRealisees') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>

                                                            <div  class="mb-3 col-md-4">
                                                                <label for="tachesSuplementaire">Taches suplementaire</label>
                                                                <input type="tachesSuplementaire" wire:model="tachesSuplementaire" id="tachesSuplementaire" class="form-control" />
                                                                @error('tachesSuplementaire') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>

                                                            <div  class="mb-3 col-md-2">
                                                                <label for="debutHeure">Heure de Début</label>
                                                                <input type="time" wire:model="debutHeure" id="debutHeure" class="form-control" placeholder="start time" />
                                                                @error('debutHeure') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>

                                                            <div  class="mb-3 col-md-2">
                                                                <label for="finHeure">Fin heure</label>
                                                                <input type="time" wire:model="finHeure" id="finHeure" class="form-control" placeholder="End of Hour" />
                                                                @error('finHeure') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label for="lieu">Lieu</label>
                                                                    <input type="text" wire:model="lieu" class="form-control" id="lieu" >
                                                                    @error('lieu') <span class="text-danger">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label for="materielsUtilises">Materiels Utilises</label>
                                                                    <input wire:model="materielsUtilises" type="text" class="form-control" id="materielsUtilises"  >
                                                                    @error('materielsUtilises') <span class="text-danger">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="mb-3">
                                                                    <label for="observation">Observations</label>
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
                                                                        <label for="tache[{{ $index }}][tacheId]">Tâches Prevues</label>
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
                                                                        <label for="tache[{{ $index }}][tachesRealisees]">Tâches Réalisées</label>
                                                                        <input type="text" wire:model="addtaches.{{ $index }}.tachesRealisees" id="tache[{{ $index }}][tachesRealisees]" class="form-control" />
                                                                        @error('tachesRealisees') <span class="text-danger">{{ $message }}</span> @enderror

                                                                    </div>
    
                                                                    <div  class="mb-3 col-md-4">
                                                                        <label for="tache[{{ $index }}][tachesSuplementaire]">Taches suplementaire</label>
                                                                        <input type="text" wire:model="addtaches.{{ $index }}.tachesSuplementaire" id="tache[{{ $index }}][tachesSuplementaire]" class="form-control" />
                                                                        @error('tachesSuplementaire') <span class="text-danger">{{ $message }}</span> @enderror

                                                                    </div>
    
                                                                    <div  class="mb-3 col-md-2">
                                                                        <label for="tache[{{ $index }}][debutHeure]">Heure de Début</label>
                                                                        <input type="time" wire:model="addtaches.{{ $index }}.debutHeure" id="tache[{{ $index }}][debutHeure]" class="form-control" placeholder="start time" />
                                                                        @error('debutHeure') <span class="text-danger">{{ $message }}</span> @enderror

                                                                    </div>
    
                                                                    <div  class="mb-3 col-md-2">
                                                                        <label for="tache[{{ $index }}][finHeure]">Fin heure</label>
                                                                        <input type="time" wire:model="addtaches.{{ $index }}.finHeure" id="tache[{{ $index }}][finHeure]" class="form-control" placeholder="End of Hour" />
                                                                        @error('finHeure') <span class="text-danger">{{ $message }}</span> @enderror

                                                                    </div>
    
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label for="tache[{{ $index }}][lieu]">Lieu</label>
                                                                            <input type="text" wire:model="addtaches.{{ $index }}.lieu" class="form-control" id="tache[{{ $index }}][lieu]" >
                                                                             @error('lieu') <span class="text-danger">{{ $message }}</span> @enderror

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label for="tache[{{ $index }}][materielsUtilises]">Materiels Utilises</label>
                                                                            <input wire:model="addtaches.{{ $index }}.materielsUtilises" type="text" class="form-control" id="tache[{{ $index }}][materielsUtilises]"  >
                                                                            @error('materielsUtilises') <span class="text-danger">{{ $message }}</span> @enderror

                                                                        </div>
                                                                    </div>
                                                                </div>
                        
                                                                <div class="row">
                                                                    <div class="col-lg-10">
                                                                        <div class="mb-3">
                                                                            <label for="tache[{{ $index }}][observation]">Observations</label>
                                                                            <textarea wire:model="addtaches.{{ $index }}.observation" id="tache[{{ $index }}][observation]" class="form-control" rows="2" ></textarea>
                                                                            @error('observation') <span class="text-danger">{{ $message }}</span> @enderror
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2 align-self-center">
                                                                        <div class="d-grid">
                                                                            <input data-repeater-delete type="button" wire:click.prevent="removetaches({{ $index }})" class="btn btn-primary" value="Delete"/>
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
                                                            <label for="Depense[{{ $index }}][designationDepenses]">Designation Dépenses:</label>
                                                            <input wire:model="Depenses.{{ $index }}.designationDepenses" type="text" class="form-control"  id="Depense[{{ $index }}][designationDepenses]">
                                                            @error('designationDepenses') <span class="text-danger">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="Depense[{{ $index }}][coutsReels]">Couts Reels</label>
                                                            <input type="text" wire:model="Depenses.{{ $index }}.coutsReels" class="form-control" id="Depense[{{ $index }}][coutsReels]" placeholder="Enter Couts Reels">
                                                            @error('coutsReels') <span class="text-danger">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="Depense[{{ $index }}][coutsPrevionnels]">Couts previonnels</label>
                                                            <input type="text" wire:model="Depenses.{{ $index }}.coutsPrevionnels" class="form-control" id="Depense[{{ $index }}][coutsPrevionnels]" placeholder="Enter Couts previonnels">
                                                            @error('coutsPrevionnels') <span class="text-danger">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-10">
                                                        <div class="mb-3">
                                                            <label for="Depense[{{ $index }}][observationDepenses]">Observation</label>
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
                                                                <label for="tachesProchain[tachesDemain]">Taches prevues :</label>
                                                                <input type="text" wire:model="tachesDemain"  class="form-control" id="tachesProchain[]" placeholder="Enter your Name...">
                                                                @error('tachesDemain') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 col-5">
                                                            <div class="mb-3">
                                                                <label for="duree">Duree(en H) :</label>
                                                                <input type="time" wire:model="duree" class="form-control" id="tachesProchain[]" placeholder="Duree...">
                                                                @error('duree') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 col-6">
                                                            <div class="mb-3">
                                                                <label for="designationprochain">Designation :</label>
                                                                <input type="text" wire:model="designationprochain" class="form-control" id="tachesProchain[]" placeholder="Enter your Name...">
                                                                 @error('designationprochain') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-6">
                                                            <div class="mb-3">
                                                                <label for="valeur">Valeur :</label>
                                                                <input type="text" wire:model="valeur" class="form-control" id="tachesProchain[]" placeholder="Enter your Name...">
                                                                 @error('valeur') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                        
                                                    </div>

                                                    <div class="inner-repeater mb-4">
                                                        <div data-repeater-list="inner-group" class="inner mb-3">
                                                            <label for="tachesProchain[risques]">Risques et atténuations :</label>
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
                                                                        <label for="demain[{{ $index }}][tachesDemain]">Taches prevues :</label>
                                                                        <input type="text" wire:model="tachesProchain.{{ $index }}.tachesDemain"  class="form-control" id="demain[{{ $index }}][tachesDemain]" placeholder="Enter your Name...">
                                                                        @error('tachesDemain') <span class="text-danger">{{ $message }}</span> @enderror

                                                                    </div>
                                                                </div>
    
                                                                <div class="col-md-4 col-5">
                                                                    <div class="mb-3">
                                                                        <label for="demain[{{ $index }}][duree]">Duree(en H) :</label>
                                                                        <input type="time" wire:model="tachesProchain.{{ $index }}.duree" class="form-control" id="demain[{{ $index }}][duree]" placeholder="Duree...">
                                                                        @error('duree') <span class="text-danger">{{ $message }}</span> @enderror

                                                                    </div>
                                                                </div>
    
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6 col-6">
                                                                    <div class="mb-3">
                                                                        <label for="demain[{{ $index }}][designationprochain]">Designation :</label>
                                                                        <input type="text" wire:model="tachesProchain.{{ $index }}.designationprochain" class="form-control" id="demain[{{ $index }}][designationprochain]" placeholder="Enter your Name...">
                                                                        @error('designationprochain') <span class="text-danger">{{ $message }}</span> @enderror

                                                                    </div>
                                                                </div>
    
                                                                <div class="col-md-6 col-6">
                                                                    <div class="mb-3">
                                                                        <label for="demain[{{ $index }}][valeur]">Valeur :</label>
                                                                        <input type="text" wire:model="tachesProchain.{{ $index }}.valeur" class="form-control" id="demain[{{ $index }}][valeur]" placeholder="Enter your Name...">
                                                                        @error('valeur') <span class="text-danger">{{ $message }}</span> @enderror

                                                                    </div>
                                                                </div>
    
                                                            </div>
    
                                                            <div class="inner-repeater mb-4">
                                                                <div data-repeater-list="inner-group" class="inner mb-3">
                                                                    <label for="demain[{{ $index }}][risques]">Resques et attenuations :</label>
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
                                            <label for="observationglobal">Observations de la journée :</label>
                                            <textarea id="observationglobal" class="form-control" wire:model="observationglobal" rows="3" placeholder="(imprevus, indicateurs, references, defis, propositions de solution etc.)"></textarea>
                                            @error('observationglobal') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="d-flex flex-wrap gap-2 m-4">
                                            <button type="submit" class="btn btn-success waves-effect waves-light">Enregistrer</button>
                                            <button type="reset" class="btn btn-danger waves-effect waves-light">Cancel</button>
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


