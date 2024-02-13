<div>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">users Lists</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="">user management</a></li>
                                    <li class="breadcrumb-item active">users Lists</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-xxl-2 col-lg-4">
                                        <div class="search-box me-2 mb-2 d-inline-block">
                                            <div class="position-relative">
                                                <input type="text" class="form-control" wire:model.live ="search" placeholder="Search...">
                                                <i class="bx bx-search-alt search-icon"></i>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="search-box col-xxl-2 col-lg-2">
                                        <select wire:model.live ="status" class="form-control select2">
                                            <option value="">Status</option>
                                            <option value="activer">Activer</option>
                                            <option value="desactiver">Desactiver</option>
                                            <option value="attente">En attente</option>
                                        </select>
                                    </div>
                                    <div class="search-box col-xxl-2 col-lg-2">
                                        <select wire:model.live ="filiale_id" class="form-control select2">
                                            <option>Filiales</option>
                                            @foreach ($filiales as $filiale)
                                                <option value="{{ $filiale->id }}">{{ $filiale->nom  }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    @if (in_array(1, $userRoles) || in_array(2, $userRoles))
                                        <div class="col-xxl-2 col-lg-4">
                                            <div class="text-sm-end">
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#addModal" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i class="mdi mdi-plus me-1"></i> Add User</button>
                                            </div>
                                        </div><!-- end col-->
                                    @endif
                                </div>
        
                                <div style="width: 100%; font-size: 11px;" class="table-responsive">
                                    <table class="table align-middle table-nowrap table-check">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="align-middle" style="width: 5px;">#</th>
                                                <th scope="align-middle" >Nom Prenom</th>
                                                <th scope="align-middle">Email</th>
                                                <th scope="align-middle">Telephone</th>
                                                <th scope="align-middle">Adresse</th>
                                                <th scope="align-middle">L'entreprises/Filiales</th>                                                    
                                                <th scope="align-middle">Status</th>
                                                <th class="align-middle">View Details</th>
                                                @if (in_array(1, $userRoles) || in_array(2, $userRoles))
                                                    <th class="align-middle">Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                            @php
                                                $Num = 1;
                                            @endphp
                                            @foreach ($users as $user)
                                            <tr>
                                                <td>{{$Num++}} </td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->telephone ? $user->telephone : 'vide'}}</td>
                                                <td>{{$user->adresse ? $user->adresse : 'vide'}}</td>
                                                @if ($user->filiale)
                                                    <td>
                                                        <img src="{{asset($user->filiale->logo ? '/storage/'.$user->filiale->logo : 'assets/images/image_produit.png')}}" alt="" class="rounded-circle avatar-sm"> {{$user->filiale->nom ? $user->filiale->nom : 'vide'}}
                                                    </td>
                                                @else
                                                    <td>
                                                        <img src="{{asset('assets\images\logo_elceto.png')}}" alt="" class="rounded-circle avatar-sm"> Elceto Holding
                                                    </td>
                                                @endif

                                                @if (in_array(1, $userRoles) || in_array(2, $userRoles))
                                                    @if ($user->status == 'activer')
                                                        <td><button wire:click="confirmation('{{ $user->slug }}')" class="btn btn-soft-success btn-sm btn-rounded">Activer</button></td>
                                                    @elseif ($user->status == 'desactiver')
                                                        <td><button wire:click="confirmation('{{ $user->slug }}')" class="btn btn-soft-danger btn-sm btn-rounded">Désactiver</button></td>
                                                    @else
                                                        <td><button wire:click="confirmation('{{ $user->slug }}')" class="btn btn-soft-warning btn-sm btn-rounded">En attente</button></td>
                                                    @endif

                                                    <td>
                                                        <a href="{{ route('detail-user',['slug' => $user->slug]) }}" class="btn btn-primary btn-sm btn-rounded">View Details</a>
                                                    </td>
                                                    <td>
                                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                                <a wire:click="edite('{{ $user->slug }}')" class="text-success"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                            </li>
                                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                                <a wire:click="confirmationDelete('{{ $user->slug }}')" data-bs-toggle="modal" class="text-danger"><i class="mdi mdi-delete font-size-18"></i></a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                @else
                                                <td><a class="badge bg-dark bg-soft text-white font-size-14">{{$user->status}}</a></td>
                                                    <td>
                                                        <a href="{{ route('detail-user',['slug' => $user->slug]) }}" class="btn btn-primary btn-sm btn-rounded">View Details</a>
                                                    </td>
                                                @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <ul class="pagination pagination-rounded justify-content-end mb-2" wire:ignore >
                                    {{$users->links('pagination::bootstrap-5')}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        
    </div>
    <div class="modal fade orderdetailsModal " id="addModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="orderdetailsModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderdetailsModalLabel">Ajout d'un utilisateur</h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form wire:submit.prevent='AddUser'>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nom et Prenom: <span class="text-danger">*</span></label>
                                    <input id="name" type="text" wire:model='name' autofocus autocomplete="name" class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="adresse" class="form-label">Adresse : <span class="text-danger">*</span></label>
                                    <input id="adresse" type="text" wire:model='adresse' autofocus autocomplete="adresse" class="form-control @error('adresse') is-invalid @enderror">
                                    @error('adresse')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="telephone" class="form-label">Telephone : <span class="text-danger">*</span></label>
                                    <input id="telephone" type="text" wire:model='telephone' autofocus autocomplete="telephone" class="form-control @error('telephone') is-invalid @enderror">
                                    @error('telephone')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email : <span class="text-danger">*</span></label>
                                    <input id="email" type="text" wire:model='email' autofocus autocomplete="email" class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>

                            @if (in_array(1, $userRoles))
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:click="showFormForOption1" wire:model.live="showFormOption1" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                            <label class="form-check-label" for="inlineRadio1">L'Entreprise Elceto Holding</label>
                                            
                                        </div>
                                    </div> 
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:click="showFormForOption2" wire:model.live="showFormOption2" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                            <label class="form-check-label" for="inlineRadio2">Choisir une filiale</label>
                                        </div>                                                          
                                    </div>
                                </div>

                                @if ($showFormOption1)
                                    <div class="form-group mb-3">
                                        <label for="service">Departements <span class="text-danger">*</span></label>
                                        <select name="service" id="service" class="form-control" wire:model="service">
                                            <option value="">selectionneur...</option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}">{{ $service->nom  }}</option>
                                            @endforeach
                                        </select>
                                        @error('service')
                                            <span class="text-danger"> {{$message}} </span>
                                        @enderror
                                    </div> 
                                @endif
                                
                                @if ($showFormOption2)
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="filiale">Filiales <span class="text-danger">*</span></label>
                                            <select name="filiale" id="filiale" class="form-control" wire:model.live="filiale">
                                                <option value="">selectionneur...</option>
                                                @foreach ($filiales as $filiale)
                                                    <option value="{{ $filiale->id }}">{{ $filiale->nom  }}</option>
                                                @endforeach
                                            </select>
                                            @error('filiale')
                                                <span class="text-danger"> {{$message}} </span>
                                            @enderror
                                        </div> 
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="filiale">Services <span class="text-danger">*</span></label>
                                            <select name="filiale" id="filiale" class="form-control" wire:model="departement">
                                                <option value="">selectionneur...</option>
                                                @foreach ($departements  as $departement)
                                                    <option value="{{ $departement->id }}">{{ $departement->nom  }}</option>
                                                @endforeach
                                            </select>
                                            @error('departement')
                                                <span class="text-danger"> {{$message}} </span>
                                            @enderror
                                        </div> 
                                    </div>
                                @endif
                            @else
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="filiale">Filiales <span class="text-danger">*</span></label>
                                        <select name="filiale" id="filiale" class="form-control" wire:model.live="filiale">
                                            <option value="">selectionneur...</option>
                                            @foreach ($filiales as $filiale)
                                                <option value="{{ $filiale->id }}">{{ $filiale->nom  }}</option>
                                            @endforeach
                                        </select>
                                        @error('filiale')
                                            <span class="text-danger"> {{$message}} </span>
                                        @enderror
                                    </div> 
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="filiale">Services <span class="text-danger">*</span></label>
                                        <select name="filiale" id="filiale" class="form-control" wire:model="departement">
                                            <option value="">selectionneur...</option>
                                            @foreach ($departements  as $departement)
                                                <option value="{{ $departement->id }}">{{ $departement->nom  }}</option>
                                            @endforeach
                                        </select>
                                        @error('departement')
                                            <span class="text-danger"> {{$message}} </span>
                                        @enderror
                                    </div> 
                                </div>
                            @endif
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
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderdetailsModalLabel">Edit</h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>

                <form wire:submit.prevent='update'>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nom et Prenom: <span class="text-danger">*</span></label>
                                    <input id="name" type="text" wire:model='name' autofocus autocomplete="name" class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="adresse" class="form-label">Adresse : <span class="text-danger">*</span></label>
                                    <input id="adresse" type="text" wire:model='adresse' autofocus autocomplete="adresse" class="form-control @error('adresse') is-invalid @enderror">
                                    @error('adresse')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="telephone" class="form-label">Telephone : <span class="text-danger">*</span></label>
                                    <input id="telephone" type="text" wire:model='telephone' autofocus autocomplete="telephone" class="form-control @error('telephone') is-invalid @enderror">
                                    @error('telephone')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email : <span class="text-danger">*</span></label>
                                    <input id="email" type="text" wire:model='email' autofocus autocomplete="email" class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>

                            @if (in_array(1, $userRoles))
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:click="showFormForOption1" wire:model.live="showFormOption1" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                            <label class="form-check-label" for="inlineRadio1">L'Entreprise Elceto Holding</label>
                                            
                                        </div>
                                    </div> 
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:click="showFormForOption2" wire:model.live="showFormOption2" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                            <label class="form-check-label" for="inlineRadio2">Choisir une filiale</label>
                                        </div>                                                          
                                    </div>
                                </div>

                                @if ($showFormOption1)
                                    <div class="form-group mb-3">
                                        <label for="service">Departements <span class="text-danger">*</span></label>
                                        <select name="service" id="service" class="form-control" wire:model="service">
                                            <option value="">selectionneur...</option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}">{{ $service->nom  }}</option>
                                            @endforeach
                                        </select>
                                        @error('service')
                                            <span class="text-danger"> {{$message}} </span>
                                        @enderror
                                    </div> 
                                @endif
                                
                                @if ($showFormOption2)
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="filiale">Filiales <span class="text-danger">*</span></label>
                                            <select name="filiale" id="filiale" class="form-control" wire:model.live="filiale">
                                                <option value="">selectionneur...</option>
                                                @foreach ($filiales as $filiale)
                                                    <option value="{{ $filiale->id }}">{{ $filiale->nom  }}</option>
                                                @endforeach
                                            </select>
                                            @error('filiale')
                                                <span class="text-danger"> {{$message}} </span>
                                            @enderror
                                        </div> 
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="filiale">Services <span class="text-danger">*</span></label>
                                            <select name="filiale" id="filiale" class="form-control" wire:model="departement">
                                                <option value="">selectionneur...</option>
                                                @foreach ($departements  as $departement)
                                                    <option value="{{ $departement->id }}">{{ $departement->nom  }}</option>
                                                @endforeach
                                            </select>
                                            @error('departement')
                                                <span class="text-danger"> {{$message}} </span>
                                            @enderror
                                        </div> 
                                    </div>
                                @endif
                            @else
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="filiale">Filiales <span class="text-danger">*</span></label>
                                        <select name="filiale" id="filiale" class="form-control" wire:model.live="filiale">
                                            <option value="">selectionneur...</option>
                                            @foreach ($filiales as $filiale)
                                                <option value="{{ $filiale->id }}">{{ $filiale->nom  }}</option>
                                            @endforeach
                                        </select>
                                        @error('filiale')
                                            <span class="text-danger"> {{$message}} </span>
                                        @enderror
                                    </div> 
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="filiale">Services <span class="text-danger">*</span></label>
                                        <select name="filiale" id="filiale" class="form-control" wire:model="departement">
                                            <option value="">selectionneur...</option>
                                            @foreach ($departements  as $departement)
                                                <option value="{{ $departement->id }}">{{ $departement->nom  }}</option>
                                            @endforeach
                                        </select>
                                        @error('departement')
                                            <span class="text-danger"> {{$message}} </span>
                                        @enderror
                                    </div> 
                                </div>
                            @endif
                        </div>
                        
                    </div>

                    <div class="d-flex justify-content-between p-3 border-top border-opacity-10">

                        <button type="button" class="btn btn-danger" wire:click='ModalEdite'>Annuler</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light">
                            <i class="bx bx-save font-size-16 align-middle me-2"></i> Ajouter
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

    window.addEventListener("closeModalAdd", event => {
        $("#addModal").modal("hide")
    })

    window.addEventListener("show_user_modal", event => {
        // alert('okay')
        $('#editModal').modal('show');
    })

    window.addEventListener("closeModal", event => {
        $("#editModal").modal("hide")
    })
</script>