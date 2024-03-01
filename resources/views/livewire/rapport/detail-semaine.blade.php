<div>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Details of this week's report</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Report</a></li>
                                    <li class="breadcrumb-item active">Details of this week's report</li>
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
                                <div class="pt-3">

                                    <div class="row">
                                        <div class="col-sm-2">
                                        </div>
                                        
                                        <div class="col-sm-8">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('assets/images/logo_elceto.png') }}" style="width: 15%; margin-right 100px" alt="">
                                                <span class="btn btn-rounded waves-effect waves-light" style="background-color:#0055a4;
                                                    color:white; width: 400px; height: 55px; font-size: 24px; border-color: black;">
                                                    Elceto Holding SAS
                                                </span>                                                
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <a wire:click="Open('{{ $semaine->slug }}')"
                                                class="text-info font-size-22">Edit<i
                                                    class="mdi mdi-pencil font-size-22"></i></a>
                                        </div>
                                    </div>
                                    
                                    <div class="row justify-content-center">
                                        <div class="col-xl-8">
                                            <div>
                                                <div class="text-center">
                                                    <h4>Rapport De La Semaine</h4>
                                                    <p class="text-muted mb-4"><i class="mdi mdi-calendar me-1"></i> {{($dateActuelle)->format("d M, Y")}}</p>
                                                </div>
                                                <hr>
                                                <div class="text-center">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div>
                                                                <p class="text-muted mb-2">Entreprise</p>
                                                                <h5 class="font-size-15">{{$semaine->user->filiale->nom}}</h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mt-4 mt-sm-0">
                                                                <p class="text-muted mb-2">Date du Rapport</p>
                                                                <h5 class="font-size-15">{{($dateActuelle)->format("d M, Y")}}</h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="mt-4 mt-sm-0">
                                                                <p class="text-muted mb-2">Departement</p>
                                                                <h5 class="font-size-15">{{$semaine->user->departement->nom}}</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>

                                                <div class="mt-4">
                                                    <div class="text-muted font-size-14">
                                                        
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <h5 class="mb-3">Objet du Rapport:</h5>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <p>{{$semaine->objet}}</p>
                                                            </div>
                                                        </div>
                                                        
                                                        <h5 class="mb-3">Réalisations </h5>
                                                        <p>{{$semaine->realisation}}</p>
                                                    
                                                        <h5 class="mb-3">Difficultés Rencontrées</h5>
                                                        <p>{{$semaine->difficulte}}</p>

                                                        <h5 class="mb-3">Budget Utilisé</h5>
                                                        <p>{{$semaine->budget}}</p>
                                                        <h5 class="mb-3">Recommandations</h5>
                                                        <p>{{$semaine->recommandation}}</p>
                                                        <br>
                                                        <strong>Date de Début:</strong> {{($semaine->debutdate->format('Y/m/d'))}} <br>
                                                        <strong>Date de Fin:</strong> {{($semaine->findate)->format('Y/m/d')}}<br>

                                                            <br><br>

                                                            <strong>Responsable du Rapport:</strong> [Nom du Responsable] <br>
                                                            <strong>Employé Concerné:</strong> {{$semaine->user->name}}
                                                            <div class="d-flex flex-wrap gap-2 m-4">
                                                               
                                                                <a wire:click="Envoie" class="btn btn-primary waves-effect waves-light">Envoie au responsable</a>
                                                                
                                                                {{-- <button type="button" wire:click="add" class="btn btn-primary waves-effect waves-light">Enregistrer</button> --}}
                                                                <button type="reset" class="btn btn-secondary waves-effect waves-light">Retour</button>
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

        <div class="modal fade orderdetailsModal " id="addModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="orderdetailsModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderdetailsModalLabel">Ajout d'un utilisateur</h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>

                <form wire:submit.prevent='Edit'>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Objet: <span
                                            class="text-danger">*</span></label>
                                    <input id="name" type="text" wire:model='objet' autofocus
                                        autocomplete="name" class="form-control @error('objet') is-invalid @enderror">
                                    @error('objet')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="adresse" class="form-label">Realisations : <span
                                            class="text-danger">*</span></label>
                                    <textarea name="realisation" class="form-control" wire:model='realisation' id="realisation" cols="50" rows="5"></textarea>
                                    @error('realisation')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="dificulter" class="form-label">Difficulter : <span
                                            class="text-danger">*</span></label>
                                    <textarea name="dificulter" class="form-control" id="dificulter" wire:model='difficulter' cols="50" rows="5"></textarea>
                                    @error('dificulter')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="budget" class="form-label">Budget : <span
                                            class="text-danger">*</span></label>
                                    <input id="budget" type="text" wire:model='budget' autofocus
                                        autocomplete="budget"
                                        class="form-control @error('budget') is-invalid @enderror">
                                    @error('budget')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="recommandation" class="form-label">Recommandations : <span
                                            class="text-danger">*</span></label>
                                    <textarea name="recommandation" class="form-control" wire:model='recommandation' id="recommandation" cols="50" rows="5"></textarea>
                                    @error('recommandation')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="d-flex justify-content-between p-3 border-top border-opacity-10">

                        <button type="button" class="btn btn-danger" wire:click='close'>Annuler</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light">
                            <i class="bx bx-save font-size-16 align-middle me-2"></i> Ajouter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- end main content-->
</div>
<script>
    window.addEventListener("closeModalAdd", event => {
        // alert('okay')
        $('#addModal').modal('show');
    })
    
    window.addEventListener("closeModal", event => {
        // alert('okay')
        $('#addModal').modal('hide');
    })
</script>