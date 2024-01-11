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
                    <div class="col-lg-12">
                        
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">Create New Planification</h4>
                                <div class="form-group row mb-4">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <h4 class="card-title">Entreprise : {{$filiale ? $filiale->nom : 'vide'}}</h4>
                                        </div>
                                    </div>
                        
                                    <div class="col-sm-6">
                                        <div class="mb-4">
                                            <h4 class="card-title">Departement : {{$departement ? $departement->nom : 'vide'}}</h4>
                                        </div>
                                    </div>
                                    @if(session()->has('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <form class="outer-repeater" wire:submit.prevent="submitForm">
                                            @csrf
                                        <div class="row">
                                            <div class="col-md-6 col-6">
                                                <label>La date d'activites <span class="text-danger">*</span></label>
                                                <input type="date" wire:model='date' class="form-control" placeholder="Start Date" name="date" />
                                                @error('date')
                                                    <span class="text-danger"> {{$message}} </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-6">
                                                <label>Le projet <span class="text-danger">*</span></label>
                                                <select wire:model="projet" name="projet" id="projet" class="form-control select2">
                                                    <option for="projet">Selectionner le projet... </option>
                                                    @foreach ($chef as $item)
                                                        @if ($item->is_chef == true)
                                                                <option value="{{$item->projet->id}}">{{$item->projet->nom}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error('projet')
                                                    <span class="text-danger"> {{$message}} </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div data-repeater-list="outer-group" class="outer">
                                        <div data-repeater-item class="outer">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    @foreach ($taches as $index => $tache)
                                                        <label for="tache[{{ $index }}][tache_prevues]">Taches prevues <span class="text-danger">*</span></label>
                                                        <div data-repeater-list="inner-group" class="inner form-group">
                                                            <div data-repeater-item class="inner ms-md-auto">
                                                                <div class="mb-3 row align-items-center">
                                                                    <div class="col-md-8">
                                                                        <input wire:model="taches.{{ $index }}.tache_prevues" type="text" name="tache[{{ $index }}][tache_prevues]" class="form-control" required>
                                                                        @error('taches.*.tache_prevues')
                                                                            <span class="text-danger"> {{$message}} </span>
                                                                        @enderror
                                                                    </div>
                                                                    
                                                                    <div class="col-md-3">
                                                                        <div class="mt-2 mt-md-0 d-grid">
                                                                            <input data-repeater-delete wire:click.prevent="removeTache({{ $index }})" type="button" class="btn btn-danger inner" value="Delete" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div class="row mb-3 justify-content-end">
                                                        <div class="col-lg-12">
                                                            <input data-repeater-create wire:click.prevent="addTache" type="button" class="btn btn-primary inner" value="Add Taches" />
                                                        </div>
                                                    </div>
                                                </div>
                                    
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="resultat">Resultats attendus <span class="text-danger">*</span></label>
                                                        <input id="resultat" name="resultat" type="text" wire:model="resultat" class="form-control" placeholder="Résultats attendus">
                                                        @error('resultat')
                                                        <span class="text-danger"> {{$message}} </span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="ressources">Ressources necessaires <span class="text-danger">*</span></label>
                                                        <input id="ressources" name="ressources" type="text" wire:model="ressources" class="form-control" placeholder="Ressources necessaires">
                                                        @error('ressources')
                                                            <span class="text-danger"> {{$message}} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                    
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="observation">Observations/Recommandations <span class="text-danger">*</span></label>
                                                        <textarea class="form-control" id="observation"  wire:model="observation" rows="5" placeholder="(Noter les risques,identifies,mesures d'attenuation, defis, recommandations etc.)"></textarea>
                                                        @error('observation')
                                                            <span class="text-danger"> {{$message}} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap gap-2 m-4">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Enregistrer</button>
                                        <button type="reset" class="btn btn-secondary waves-effect waves-light">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
       <!-- add-user-form.blade.php -->

       @include('sweetalert')
</div>
