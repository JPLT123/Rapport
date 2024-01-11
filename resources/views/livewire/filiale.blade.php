<div>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Filiales</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashborad</a></li>
                                    <li class="breadcrumb-item active">Filiales</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card job-filter">
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-xxl-2 col-sm-4">
                                        <input type="search" wire:model.live ="search" class="form-control" id="searchInput" placeholder="Search for ...">
                                    </div>
                                    <div class="col-xxl-2 col-sm-4">
                                        <select wire:model.live ="status" class="form-control select2">
                                            <option value="">Status</option>
                                            <option value="activer">Activer</option>
                                            <option value="desactiver">Desactiver</option>
                                        </select>
                                    </div>
                                    <div class="col-xxl-2 col-sm-4">
                                        <button type="button" class="btn btn-soft-info mx-1 w-100" data-bs-toggle="modal" data-bs-target="#addModal"><i class="mdi mdi-plus-outline align-middle"></i> Ajouter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
                
                <div class="row">
                    @foreach ($Filiales as $Filiale)
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="favorite-icon">
                                    <a href="javascript:void(0)"><i class="uil uil-heart-alt fs-18"></i></a>
                                </div>
                                <img src="{{ $Filiale->logo ? '/storage/'. $Filiale->logo : '/assets/images/image_produit.png' }}" alt="" height="50" class="mb-3">
                                <div class="dropdown float-end">
                                    <a href="#" class="dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical m-0 text-muted h5"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" wire:click="edite('{{ $Filiale->slug }}')" >Edit</a>
                                        <a class="dropdown-item" wire:click="confirmationDelete('{{ $Filiale->slug }}')">Delete</a>
                                    </div>
                                </div> <!-- end dropdown -->
                                <div class="float-end ms-2">
                                    @if ($Filiale->status == 'activer')
                                        <button wire:click="confirmation('{{ $Filiale->slug }}')" class="btn btn-soft-success btn-sm">Active</button>
                                    @else
                                        <button wire:click="confirmation('{{ $Filiale->slug }}')" class="btn btn-soft-danger btn-sm">desactiver</button>
                                    @endif 
                                </div>
                                <h5 class="fs-17 mb-2"><a href="job-details.html" class="text-dark">{{$Filiale->nom}}</a></h5>
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <p class="text-muted fs-14 mb-1">{{$Filiale->email}}</p>
                                    </li>
                                    <li class="list-inline-item">
                                        <p class="text-muted fs-14 mb-0"><i class="mdi mdi-map-marker"></i> {{$Filiale->adresse }}</p>
                                    </li>
                                    <li class="list-inline-item">
                                        <p class="text-muted fs-14 mb-0"><i class="uil uil-wallet"></i> Tel: {{$Filiale->telephone}}</p>
                                    </li>
                                </ul>
                                <div class="mt-3 hstack gap-2">
                                    @foreach ($Filiale->departements as $item)
                                        <span class="badge rounded-1 badge-soft-secondary">{{$item->nom}}</span>
                                    @endforeach
                                </div>
                                <div class="mt-4 hstack gap-2">
                                    <a href="{{ route('detail-filiale',['slug' => $Filiale->slug]) }}" class="btn btn-info w-100">View Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                    @endforeach

                </div><!--end row-->
                <div class="col-11">
                    {{$Filiales->links('pagination::bootstrap-5')}}
                </div>
                
            </div> <!-- container-fluid -->
        </div><!-- End Page-content -->

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

    <div class="modal fade orderdetailsModal " id="addModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="orderdetailsModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderdetailsModalLabel">Ajout de Filiale</h5>
                </div>

                <form wire:submit.prevent='store'>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-xxl-2 col-sm-6">
                               <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="nom">Nom :<span class="text-danger">*</span></label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="nom" class="form-control @error('nom') is-invalid @enderror" wire:model="nom" required autocomplete="current-nom" aria-label="nom" aria-describedby="nom-addon">
                                        </div>
                                        @error('nom')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="adresse" class="form-label">Adresse : <span class="text-danger">*</span></label>
                                        <input id="adresse" type="text" wire:model='adresse' autofocus autocomplete="adresse" class="form-control @error('adresse') is-invalid @enderror">
                                        @error('adresse')
                                            <span class="text-danger"> {{$message}} </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="telephone" class="form-label">Telephone : <span class="text-danger">*</span></label>
                                        <input id="telephone" type="text" wire:model='telephone' autofocus autocomplete="telephone" class="form-control @error('telephone') is-invalid @enderror">
                                        @error('telephone')
                                            <span class="text-danger"> {{$message}} </span>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email : <span class="text-danger">*</span></label>
                                        <input id="email" type="text" wire:model='email' autofocus autocomplete="email" class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                            <span class="text-danger"> {{$message}} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="date">Date de creation :<span class="text-danger">*</span></label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="date" class="form-control @error('date') is-invalid @enderror" wire:model="date" required autocomplete="current-date" placeholder="Entrer categorie produit" aria-label="date" aria-describedby="date-addon">
                                        </div>
                                        @error('date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="responsable" class="form-label">Responsable : <span class="text-danger">*</span></label>
                                        <select id="responsable" wire:model='responsable' class="form-control select2">
                                            <option value="">Selectionner l'hierachie... </option>
                                            @foreach ($chef as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}
                                                        <img src="{{asset($item->profile_photo_path ? '/storage/'.$item->profile_photo_path : 'assets\user.png')}}" class="rounded-circle avatar-xs m-1" alt="">
                                                    </option>
                                            @endforeach
                                        </select>
                                        @error('responsable')
                                            <span class="text-danger"> {{$message}} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description">Description :<span class="text-danger">*</span></label>
                                    <div class="input-group auth-pass-inputgroup">
                                        <input type="description" class="form-control @error('description') is-invalid @enderror" wire:model="description" required autocomplete="current-description" aria-label="description" aria-describedby="description-addon">
                                        
                                    </div>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                               </div>
                            </div>
                            <div class="col-xxl-2 col-sm-6">
                                <div class="form-group ">
                                    <div class="text-center fw-bold fs-3">
                                        <span>IMAGE :<span class="text-danger">*</span></span>
                                    </div>
                                    <div>
                                        <label for="images">
                                            <div class="m-4">
                                                <img src="{{ $images ? $images->temporaryUrl() : 'assets/images/image_produit.png' }}"
                                                    class="img-fluid text-center" alt="Responsive image" style="width: 100%; height:200px;"/>
                                            </div>
                                        </label>
                                        <input type="file" wire:model="images" id="images" hidden>
                                    </div>
                                    @error('images')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between p-3 border-top border-opacity-10">

                        <button type="button" class="btn btn-danger" wire:click='ModalAdd'>Annuler</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light">
                            <i class="bx bx-save font-size-16 align-middle me-2"></i> Ajouter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade orderdetailsModal " id="editModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="orderdetailsModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderdetailsModalLabel">Edition filiale</h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>

                <form wire:submit.prevent='update'>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-xxl-2 col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="nom">Nom :<span class="text-danger">*</span></label>
                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="nom" class="form-control @error('nom') is-invalid @enderror" wire:model="nom" required autocomplete="current-nom" aria-label="nom" aria-describedby="nom-addon">
                                            </div>
                                            @error('nom')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="adresse" class="form-label">Adresse : <span class="text-danger">*</span></label>
                                            <input id="adresse" type="text" wire:model='adresse' autofocus autocomplete="adresse" class="form-control @error('adresse') is-invalid @enderror">
                                            @error('adresse')
                                                <span class="text-danger"> {{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="telephone" class="form-label">Telephone : <span class="text-danger">*</span></label>
                                            <input id="telephone" type="text" wire:model='telephone' autofocus autocomplete="telephone" class="form-control @error('telephone') is-invalid @enderror">
                                            @error('telephone')
                                                <span class="text-danger"> {{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email : <span class="text-danger">*</span></label>
                                            <input id="email" type="text" wire:model='email' autofocus autocomplete="email" class="form-control @error('email') is-invalid @enderror">
                                            @error('email')
                                                <span class="text-danger"> {{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="date">Date de creation :<span class="text-danger">*</span></label>
                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="date" class="form-control @error('date') is-invalid @enderror" wire:model="date"  aria-label="date" aria-describedby="date-addon">
                                            </div>
                                            @error('date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="responsable" class="form-label">Responsable : <span class="text-danger">*</span></label>
                                            <select id="responsable" wire:model='responsable' class="form-control select2">
                                                <option value="">Selectionner l'hierachie... </option>
                                                @foreach ($chef as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}
                                                            <img src="{{asset($item->profile_photo_path ? '/storage/'.$item->profile_photo_path : 'assets\user.png')}}" class="rounded-circle avatar-xs m-1" alt="">
                                                        </option>
                                                @endforeach
                                            </select>
                                            @error('responsable')
                                                <span class="text-danger"> {{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="description">Description :<span class="text-danger">*</span></label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="description" class="form-control @error('description') is-invalid @enderror" wire:model="description" required autocomplete="current-description" aria-label="description" aria-describedby="description-addon">
                                        </div>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-sm-6">
                                <div class="form-group ">
                                    <div class="text-center fw-bold fs-3">
                                        <span>IMAGE :<span class="text-danger">*</span></span>
                                    </div>
                                    <div>
                                        <label for="path_image">
                                            <div >
                                                @if ($edit_images)
                                                    <img src="{{ asset($path_image ? $path_image->temporaryUrl() : '/storage/'.$edit_images) }}" class="img-fluid" alt="Responsive image" style="width: 200px; height: 200px;"/>
                                                @else
                                                    <img src="{{ asset($path_image ? $path_image->temporaryUrl() : 'assets/images/image_produit.png') }}" class="img-fluid" alt="Responsive image" style="width: 200px; height: 200px;"/>
                                                @endif
                                            </div>
                                        </label>
                                        <input type="file" wire:model="path_image" id="path_image" hidden>
                                    </div>
                                    @error('path_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between p-3 border-top border-opacity-10">

                        <button type="button" class="btn btn-danger" wire:click='ModalEdite'>Annuler</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light">
                            <i class="bx bx-save font-size-16 align-middle me-2"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('sweetalert')
<script>
    window.addEventListener("showModalAdd", event => {
        // alert('okay')
        $('#addModal').modal('show');
    })

    window.addEventListener("showModalEdite", event => {
        // alert('okay')
        $('#editModal').modal('show');
    })

    window.addEventListener("closeModalAdd", event => {
        $("#addModal").modal("hide");
    })

    window.addEventListener("show_user_modal", event => {
        // alert('okay')
        $('#viewModal').modal('show');
    })

    window.addEventListener("closeModal", event => {
        $("#viewModal").modal("hide");
        $("#editModal").modal("hide")
    })
</script>
