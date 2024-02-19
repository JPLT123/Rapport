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
                        <div class="row justify-content-center">
                            <div class="col-lg-10">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-center mt-4">
                                            <h4 class="card-title">PLANIFICATION HEBDOMADAIRE  DES ACTIVITES SEMAINE DU {{$formatDateRange}}</h4>
                                            <div class="row mt-4">
                                                <div class="col-sm-5">
                                                    <h4 class="card-title ">Entreprise : {{$filiale ? $filiale->nom : 'vide'}}</h4>
                                                </div>
                                    
                                                <div class="col-sm-7">
                                                    <h4 class="card-title ">Departement : {{$departement ? $departement->nom : 'vide'}}</h4>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="container">
                                            @if (session()->has('success'))
                                                <div class="alert alert-success">
                                                    {{ session('success') }}
                                                </div>
                                            @elseif (session()->has('error'))
                                                <div class="alert alert-danger">
                                                    {{ session('error') }}
                                                </div>
                                            @endif
                                            <form class="outer-repeater" wire:submit.prevent="submitForm">
                                                
                                                <div class="row">
                                                    <div class="col-md-6 col-12 mt-3">
                                                        <label>Le projet <span class="text-danger">*</span></label>
                                                        <select for="projet" wire:model.live="projet" name="projet" id="projet" class="form-control select2">
                                                            <option for="projet">Selectionner le projet... </option>
                                                            @foreach ($Auth_user->membres_projets as $user)
                                                                <option value="{{$user->projet->id}}">{{$user->projet->nom}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('projet')
                                                            <span class="text-danger"> {{$message}} </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6 col-12 ">
                                                        <label  class="mt-3" for="date">Date d' activités <span class="text-danger">*</span></label>
                                                        <input type="date" wire:model="date" class="form-control" placeholder="Date de début" id="date" name="date" />
                                                        @error('date')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    @if (in_array(7, $userRoles))
                                                    <div class=" mt-4 mb-4">
                                                        <input class="form-control mt-4 mb-4" name="file"  type="file" wire:model="file">

                                                        @error('file')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    @else
                                                        <div class="form-group m-4">
                                                            <label for="taches" class="col-form-label">Les tâches prévues pour la semaine<span class="text-danger">*</span></label>
                                                            <ul class="list-unstyled user-list validate m-2" id="taskassignee">
                                                                @foreach ($Alltaches as $item)
                                                                    <li>
                                                                        <div class="form-check form-check-primary mb-2 d-flex align-items-center">
                                                                            <input wire:model="taches" class="form-check-input" name="taches[]" type="checkbox" id="taches-{{ $item->id }}" value="{{ $item->id }}">
                                                                            <label class="form-check-label ms-2" for="taches-{{ $item->id }}">{{ $item->tache_prevues }}</label>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                            @error('taches')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="col-sm-12">
                                                            @foreach ($createtaches as $index => $tache)
                                                                <label for="tache[{{ $index }}][tache_prevues]">Taches prevues <span class="text-danger">*</span></label>
                                                                <div data-repeater-list="inner-group" class="inner form-group">
                                                                    <div data-repeater-item class="inner ms-md-auto">
                                                                        <div class="mb-3 row align-items-center">
                                                                            <div class="col-md-8">
                                                                                <input wire:model="createtaches.{{ $index }}.tache_prevues" type="text" name="tache[{{ $index }}][tache_prevues]" class="form-control" required>
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
                                                                    <input data-repeater-create wire:click.prevent="addTache" type="button" class="btn btn-success inner" value="Add Taches" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

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
                                                

                                                <div class="d-flex flex-wrap gap-2 m-4">
                                                    <button type="submit" class="btn btn-success waves-effect waves-light">Ajouter une planification</button>
                                                    @if (!in_array(7, $userRoles))
                                                         <a href="{{route('planification.verifier', ['slug' => $Auth_user->slug])}}" class="btn btn-primary waves-effect waves-light">Visualiser</a>
                                                    @endif
                                                    {{-- <button type="button" wire:click="add" class="btn btn-primary waves-effect waves-light">Enregistrer</button> --}}
                                                    <button type="reset" class="btn btn-secondary waves-effect waves-light">Annuler</button>
                                                </div>
                                            </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
       <!-- add-user-form.blade.php -->
       <script>
        window.addEventListener("show_Projet_modal", event => {
            // alert('okay')
            $('#editModal').modal('show');
        })
        
        window.addEventListener("closeModal", event => {
            $("#editModal").modal("hide")
        })

        </script>
@include('sweetalert')
</div>
