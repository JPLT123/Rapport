<div>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Departements</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashborad</a></li>
                                    <li class="breadcrumb-item active">Departements</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body border-bottom">
                                <div class="row g-3">
                                    <div class="col-xxl-2 col-lg-4">
                                        <input type="search" wire:model.live ="search" class="form-control" id="searchInput" placeholder="Search for ...">
                                    </div>
                                    <div class="col-xxl-2 col-lg-4">
                                        <select wire:model.live ="status" class="form-control select2">
                                            <option value="">Status</option>
                                            <option value="activer">Activer</option>
                                            <option value="desactiver">Desactiver</option>
                                        </select>
                                    </div>
                                    <div class="col-xxl-2 col-lg-4">
                                        <button type="button" class="btn btn-soft-info mx-1 w-100" data-bs-toggle="modal" data-bs-target="#addModal"><i class="mdi mdi-plus-outline align-middle"></i> Ajouter</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle nowrap">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nom</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $Num = 1;
                                            @endphp
                                            @foreach ($services as $service)
                                                <tr>
                                                    <td scope="row">
                                                        {{$Num++}}
                                                    </td>
                                                    <td> {{ $service->nom }} </td>
                                                    <td>
                                                        <p class="text-muted text-truncate">{{Str::limit($service->Description, $limit = 50, $end = '...') }}
                                                    </td>
                                                    @if ($service->status == 'activer')
                                                        <td><button wire:click="confirmation('{{ $service->slug }}')" class="btn btn-soft-success btn-sm">Active</button></td>
                                                    @else
                                                        <td><button wire:click="confirmation('{{ $service->slug }}')" class="btn btn-soft-danger btn-sm">desactiver</button></td>
                                                    @endif
                                                    <td>
                                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                                <a wire:click="Viewservice('{{ $service->slug }}')" class="btn btn-sm btn-soft-primary"><i class="mdi mdi-eye-outline"></i></a>
                                                            </li>
                                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                                <a wire:click="edite('{{ $service->slug }}')" class="btn btn-sm btn-soft-info"><i class="mdi mdi-pencil-outline"></i></a>
                                                            </li>
                                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                                <a wire:click="confirmationDelete('{{ $service->slug }}')" data-bs-toggle="modal" class="btn btn-sm btn-soft-danger"><i class="mdi mdi-delete-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-11">
                                    {{$services->links('pagination::bootstrap-5')}}
                                </div>
                                <!--end row-->
                            </div>
                        </div><!--end card-->
                    </div><!--end col-->
            
                </div><!--end row-->

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
    <div class="modal fade orderdetailsModal " id="addModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="orderdetailsModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderdetailsModalLabel">Ajout de Departement</h5>
                </div>

                <form wire:submit.prevent='store'>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="nom">Nom du departement:<span class="text-danger">*</span></label>
                            <div class="input-group auth-pass-inputgroup">
                                <input type="nom" class="form-control @error('nom') is-invalid @enderror" wire:model.defer="nom" aria-label="nom" aria-describedby="nom-addon">
                            </div>
                            @error('nom')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Description :<span class="text-danger">*</span></label>
                            <div class="input-group auth-pass-inputgroup">
                                {{-- <input type="description" class="form-control @error('description') is-invalid @enderror" wire:model.defer="description" required autocomplete="current-description" aria-label="description" aria-describedby="description-addon"> --}}
                                <textarea class="form-control @error('description') is-invalid @enderror" wire:model.defer="description" id="description" cols="30" rows="3"></textarea>
                            </div>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- <div class="form-group mb-3">
                                                                <label for="filiale">Filiale <span class="text-danger">*</span></label>
                                    <select name="filiale" id="filiale" class="form-control" wire:model.defer="filiale">
                                        <option value="">selectionneur...</option>
                                        @foreach ($filiales as $filiale)
                                        <option value="{{ $filiale->id }}">{{ $filiale->nom  }}</option>
                                        @endforeach
                                    </select>
                                    @error('filiale')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                                        </div> --}}
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
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderdetailsModalLabel">Edition Departement</h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>

                <form wire:submit.prevent='update'>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="nom">Nom :<span class="text-danger">*</span></label>
                            <div class="input-group auth-pass-inputgroup">
                                <input type="nom" class="form-control @error('nom') is-invalid @enderror" wire:model.defer="nom" required autocomplete="current-nom" placeholder="Entrer categorie produit" aria-label="nom" aria-describedby="nom-addon">
                            </div>
                            @error('nom')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Description :<span class="text-danger">*</span></label>
                            <div class="input-group auth-pass-inputgroup">
                                {{-- <input type="description" class="form-control @error('description') is-invalid @enderror" wire:model.defer="description" required autocomplete="current-description" placeholder="Entrer categorie produit" aria-label="description" aria-describedby="description-addon"> --}}
                                <textarea class="form-control @error('description') is-invalid @enderror" wire:model.defer="description" id="description" cols="30" rows="3"></textarea>
                            </div>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- <div class="form-group mb-3">
                                                                <label for="filiale">Filiale <span class="text-danger">*</span></label>
                                    <select name="filiale" id="filiale" class="form-control" wire:model.defer="filiale">
                                        <option value="">selectionneur...</option>
                                        @foreach ($filiales as $filiale)
                                        <option value="{{ $filiale->id }}">{{ $filiale->nom  }}</option>
                                        @endforeach
                                    </select>
                                    @error('filiale')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                                        </div> --}}
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

    <div class="modal fade orderdetailsModal " id="viewModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="orderdetailsModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderdetailsModalLabel">Departement Overview</h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>

                @php
                    $user = App\Models\User::find($hierachie);
                @endphp
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <img src="{{asset('assets\images\logo_elceto.png')}}" alt="" class="rounded-circle avatar-lg">
                            {{-- <h6>Elceto Holding</h6> --}}
                        </div>
                        <div class="col-6">
                            <h5>{{$nom}}</h5>
                            @if ($user !== null)
                                <h5>
                                    <img src="{{asset($user->profile_photo_path ? '/storage/'.$user->profile_photo_path : 'assets/user.png')}}" alt="" class="rounded-circle avatar-xs">
                                    {{$user->name ? $user->name : 'pas de responsable'}}
                                </h5>
                            @else
                                <p>pas de responsable</p>
                            @endif
                        </div>
                    </div>
                    <h5 class="mt-3">Description</h5>
                    <p>{{$description}}</p>
                    <h5>Membres</h5>
                    <div class="table-responsive" style="max-height: 100px; overflow-y: auto;">
                        <table class="table align-middle table-nowrap">
                            <tbody>
                                @if ($membres !== null)
                                    @foreach ($membres as $membre)
                                        <tr>
                                            <td style="width: 50px;"><img src="{{asset($membre->profile_photo_path ? '/storage/'.$membre->profile_photo_path : 'assets/user.png')}}" class="rounded-circle avatar-xs" alt=""></td>
                                            <td><h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">{{$membre->name}}</a></h5></td>
                                            <td>
                                                <div>
                                                    @foreach ($membre->permissions as $user)
                                                       @if ($user->role->nom !== 'Employer')
                                                            @if ($user->role->nom == 'Membre')
                                                                <a href="#" wire:click="roles({{ $membre->id }})" class="badge bg-info bg-soft text-info font-size-11">Membre</a>
                                                            @else
                                                                <a href="#" wire:click="roles({{ $membre->id }})" class="badge bg-info bg-soft text-info font-size-11">Responsable</a>
                                                            @endif
                                                            @if ($user->role->nom == 'Membre')
                                                                <a href="#" wire:click="permission({{ $membre->id }})" class="badge bg-success bg-soft text-success font-size-11">Accorder la permission</a>
                                                            @elseif($user->role->nom == 'Chef projet')
                                                                <a href="#" wire:click="permission({{ $membre->id }})" class="badge bg-danger bg-soft text-danger font-size-11">Retirer la permission</a>
                                                            @endif
                                                        @else
                                                            @if ($user->role->nom == 'Membre')
                                                                <a href="#" wire:click="roles({{ $membre->id }})" class="badge bg-info bg-soft text-info font-size-11">Consultant</a>
                                                            @else
                                                                <a href="#" wire:click="roles({{ $membre->id }})" class="badge bg-info bg-soft text-info font-size-11">Consultant</a>
                                                            @endif
                                                            @if ($user->role->nom == 'Membre')
                                                                <a href="#" wire:click="permission({{ $membre->id }})" class="badge bg-success bg-soft text-success font-size-11">Accorder la permission</a>
                                                            @elseif($user->role->nom == 'Chef projet')
                                                                <a href="#" wire:click="permission({{ $membre->id }})" class="badge bg-danger bg-soft text-danger font-size-11">Retirer la permission</a>
                                                            @endif
                                                       @endif
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                        <p class="text-center">aucun membres</p>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" wire:click="ModalEdite">retour</button>
                </div>
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