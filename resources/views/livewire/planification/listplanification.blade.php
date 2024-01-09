<div>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Update Weekly planning</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Weekly planning</a></li>
                                    <li class="breadcrumb-item active">Update Weekly planning</li>
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
                                            <li><a wire:click='UpdateJour({{ $planif->id }})' class="btn text-muted py-2 d-block"><i class="mdi mdi-chevron-right me-1"></i> {{($planif->date)->format("l d/m/Y") ?? 'vide'}}</a></li>
                                        @endforeach
                                    </ul>
                                    
                                    <div class="row mb-2">
                                        <div class="col-sm-12">
                                            <button type="button" wire:click="envoie" class="btn btn-primary waves-effect waves-light">Envoier a l'hierachie</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>

                    <div class="col-xl-9 col-lg-8">
                        <div class="card">
                            <div class="tab-content p-4">
                                <div class="tab-pane active" id="all-post" role="tabpanel">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-8">
                                            <div>
                                                <div class="row">
                                                    <!-- Afficher le formulaire pour la mise à jour de la planification -->
                                                    <form wire:submit.prevent="Updateplanif">
                                                        <!-- Champs pour la mise à jour de la planification -->
                                                        <label for="projet">Projet:</label>
                                                        <select for="projet" wire:model.live="projet" name="projet" id="projet" class="form-control select2">
                                                            @if ($user !== null)
                                                                @foreach ($user->membres_projets as $user)
                                                                    <option value="{{$user->projet->id}}">{{$user->projet->nom}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        
                                                        <!-- Pour les tâches existantes -->
                                                        @foreach ($taches as $tacheId)
                                                            @if ($tacheId)
                                                                @php
                                                                    $tache = App\Models\Tach::find($tacheId);
                                                                @endphp
                                                                <div class="form-check form-check-primary mb-2 d-flex align-items-center">
                                                                    <input wire:model="Newtaches" class="form-check-input" type="checkbox" id="Newtaches-{{ $tache->id }}" name="Newtaches[]" value="{{ $tache->id }}" checked>
                                                                    <label class="form-check-label ms-2" for="Newtaches-{{ $tache->id }}">{{ $tache->tache_prevues }}</label>
                                                                    <span class="badge m-2 rounded-1 badge-soft-secondary">tâche existante</span>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                                
                                                        <!-- Pour les nouvelles tâches -->
                                                        @foreach ($Alltaches as $item)
                                                            <div class="form-check form-check-primary mb-2 d-flex align-items-center">
                                                                <input wire:model="Newtaches" class="form-check-input" type="checkbox" id="Newtaches-{{ $item->id }}" name="Newtaches[]" value="{{ $item->id }}">
                                                                <label class="form-check-label ms-2" for="Newtaches-{{ $item->id }}">{{ $item->tache_prevues }}</label>
                                                                <span class="badge m-2 rounded-1 badge-soft-success">nouvelle tâche</span>
                                                            </div>
                                                        @endforeach

                                                        <div class="col-sm-12">
                                                            @foreach ($createtaches as $index => $tache)
                                                                <label for="createtaches[{{ $index }}][tache_prevues]">Tâche prévue:</label>
                                                                <div class="mb-3 row align-items-center">
                                                                    <div class="col-md-9">
                                                                        <input wire:model="createtaches.{{ $index }}.tache_prevues" type="text" name="tache[{{ $index }}][tache_prevues]" class="form-control" required>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="mt-2 mt-md-0 d-grid">
                                                                            <input data-repeater-delete wire:click.prevent="removeTache({{ $index }})" type="button" class="btn btn-primary inner" value="Delete" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                            <div class="row mt-3 justify-content-end">
                                                                <div class="col-lg-12">
                                                                    <input data-repeater-create wire:click.prevent="addTache" type="button" class="btn btn-success inner" value="Add Taches" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="mt-3">
                                                                    <label for="resultat">Résultats attendus</label>
                                                                    <textarea class="form-control" id="resultat"  wire:model="resultat" rows="3"></textarea>
                                                                    @error('resultat')
                                                                        <span class="text-danger"> {{$message}} </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="mt-3">
                                                                    <label for="ressources">Ressources nécessaires</label>
                                                                    <textarea class="form-control" id="ressources"  wire:model="ressources" rows="3"></textarea>
                                                                    @error('ressources')
                                                                        <span class="text-danger"> {{$message}} </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="mt-3">
                                                                    <label for="Observation">Observations/Recommandations :</label>
                                                                    <textarea class="form-control" id="Observation"  wire:model="Observation" rows="3"></textarea>
                                                                    @error('Observation')
                                                                        <span class="text-danger"> {{$message}} </span>
                                                                    @enderror
                                                                </div>
                                                            </div> 
                                                        </div>
                                            
                                                        <div class="row mt-3">
                                                            <div class="col-xxl-10 col-lg-8">
                                                                <div class="search-box me-2 mb-2 d-inline-block">
                                                                    <div class="position-relative">
                                                                        <button type="submit" class="btn btn-success  waves-effect waves-light mb-2 me-2">Mettre à jour la planification</button>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                            <div class="col-xxl-2 col-lg-4">
                                                                <div class="text-sm-end">
                                                                    <button type="reset" class="btn btn-danger  waves-effect waves-light mb-2 me-2"> Rejeter</button>
                                                                </div>
                                                            </div><!-- end col-->
                                                        </div>
                                                        <!-- Bouton de soumission -->
                                                        
                                                    </form>
                                            
                                                    <!-- Afficher les messages flash -->
                                                    @if (session()->has('error'))
                                                        <div>
                                                            <p>{{ session('error') }}</p>
                                                        </div>
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
@include('sweetalert')