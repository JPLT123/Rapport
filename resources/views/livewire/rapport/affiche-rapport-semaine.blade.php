<div>
    <div style="font-family: Arial, sans-serif; margin: 20px;">
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
                                            color:white; width: 350px; height: 55px; font-size: 24px; border-color: black;">
                                            Elceto Holding SAS
                                        </span>                                                
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="d-print-none">
                                        <div class="float-end">
                                            <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><span class="m-0">Importer le fichier</span> <i class="fa fa-print"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row justify-content-center mt-4">
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
    
                                        <div class="m-4">
                                            <div class="text-muted font-size-14">
                                                
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <h5 class="mb-3">Objet du Rapport:</h5>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <p>{{$semaine->objet}}</p>
                                                    </div>
                                                </div>
                                                
                                                <h5 class="mb-3">Réalisations</h5>
                                                <p>{{$semaine->realisation}}</p>
                                            
                                                <h5 class="mb-3">Difficultés Rencontrées</h5>
                                                <p>{{$semaine->difficulte}}</p>
    
                                                <h5 class="mb-3">Budget Utilisé</h5>
                                                <p>{{$semaine->budget}}</p>
                                                <h5 class="mb-3">Recommandations</h5>
                                                <p>Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. Sed ut perspiciatis unde omnis iste natus error sit</p>
                                                <br>
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        
                                                    <strong>Responsable du Rapport:</strong> [Nom du Responsable] <br>
                                                    <strong>Employé Concerné:</strong> {{$semaine->user->name}}
                                                    </div>
                                                    <div>
                                                        <strong>Date de Début:</strong> {{($semaine->debutdate->format('Y/m/d'))}} <br>
                                                        <strong>Date de Fin:</strong> {{($semaine->findate)->format('Y/m/d')}}
                                                    </div>
                                                </div>
                                                {{-- <div class="row">
                                                    <div>
                                                        
                                                    </div>
                                                    <div class="text-end">
                                                        <strong>Date de Début:</strong> {{($semaine->debutdate->format('Y/m/d'))}} <br>
                                                        <strong>Date de Fin:</strong> {{($semaine->findate)->format('Y/m/d')}}
                                                    </div>
                                                </div> --}}
                                                
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
