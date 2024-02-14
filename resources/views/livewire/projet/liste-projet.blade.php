<div>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Projects List</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Projects</a></li>
                                    <li class="breadcrumb-item active">Projects List</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card job-filter">
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-xxl-3 col-sm-3">
                                                    <input type="search" wire:model.live ="search" class="form-control"
                                                        id="searchInput" placeholder="Search for ...">
                                                </div>
                                                <div class="col-xxl-3 col-sm-3">
                                                    <select wire:model.live ="status" class="form-control select2">
                                                        <option value="">Status</option>
                                                        <option value="activer">Activer</option>
                                                        <option value="desactiver">Desactiver</option>
                                                        <option value="attente">En attente</option>
                                                    </select>
                                                </div>
                                                <div class="col-xxl-3 col-sm-3">
                                                    <select wire:model.live ="filiale_id" class="form-control select2">
                                                        <option>Filiales</option>
                                                        @foreach ($filiales as $filiale)
                                                            <option value="{{ $filiale->id }}">{{ $filiale->nom }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-xxl-2 col-sm-3">
                                                    <a href="{{ route('create-projet') }}"
                                                        class="btn btn-soft-success mx-1 w-100"><i
                                                            class="mdi mdi-plus-outline align-middle"></i> Ajouter</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <div class="table-responsive">
                                <table style="width: 100%; font-size: 12px;"
                                    class="table project-list-table table-nowrap align-middle table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 100px">#</th>
                                            <th scope="col">Projects</th>
                                            <th scope="col">Due Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Team</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($projets as $projet)
                                            <tr>
                                                @if ($projet->filiale != null)
                                                    <td><img src="{{asset($projet->filiale->logo ? '/storage/'.$projet->filiale->logo : 'assets/images/image_produit.png')}}" alt="" class="avatar-sm"></td>
                                                @else
                                                    <td><img src="{{asset('assets\images\logo_elceto.png')}}" alt="" class="avatar-sm"></td>
                                                @endif
                                                <td >
                                                    <h5 class=" font-size-14"><a href="javascript: void(0);" class="text-dark">{{$projet->nom}}</a></h5>
                                                    <p class="text-muted text-truncate">{{Str::limit($projet->description, $limit = 50, $end = '...') }}
                                                    </p>
                                                </td>
                                                <td>{{ $projet->findate->format('j F Y') }}</td>
                                                @if ($projet->status == 'attente')
                                                    <td><button class="btn btn-soft-warning btn-sm btn-rounded">En
                                                            attente</button></td>
                                                @elseif ($projet->status == 'Terminer')
                                                    <td><button
                                                            class="btn btn-soft-success btn-sm btn-rounded">Terminer</button>
                                                    </td>
                                                @elseif ($projet->status == 'Retard')
                                                    <td><button class="btn btn-soft-danger btn-sm btn-rounded">En
                                                            Retard</button></td>
                                                @elseif ($projet->status == 'Avance')
                                                    <td><button
                                                            class="btn btn-soft-info btn-sm btn-rounded">Avancer</button>
                                                    </td>
                                                @elseif ($projet->status == 'Suspendu')
                                                    <td><button
                                                            class="btn btn-soft-dark btn-sm btn-rounded">Suspendu</button>
                                                    </td>
                                                @elseif ($projet->status == 'activer')
                                                    <td><button class="btn btn-soft-primary btn-sm btn-rounded">En
                                                            Cours</button></td>
                                                @endif
                                                <td>
                                                    <div class="avatar-group">
                                                        @foreach ($projet->membres_projets as $item)
                                                            @if ($item->status == 'activer')
                                                                <div class="avatar-group-item">
                                                                    <a href="javascript: void(0);"
                                                                        class="d-inline-block">
                                                                        <img src="{{ asset($item->user->profile_photo_path ? '/storage/' . $item->user->profile_photo_path : 'assets/user.png') }}"
                                                                            alt=""
                                                                            class="rounded-circle avatar-xs">
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle card-drop"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="mdi mdi-dots-horizontal font-size-18"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item"
                                                                wire:click="edite('{{ $projet->code }}')">Edit</a>
                                                            @if ($projet->status == 'Suspendu')
                                                                <a class="dropdown-item"
                                                                    wire:click="confirmation('{{ $projet->code }}')">Activer
                                                                    le project</a>
                                                            @else
                                                                <a class="dropdown-item"
                                                                    wire:click="confirmation('{{ $projet->code }}')">Suspendre
                                                                    le project</a>
                                                            @endif
                                                            <a class="dropdown-item"
                                                                wire:click="confirmationDelete('{{ $projet->code }}')">Delete</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('Apercu-projet', ['slug' => $projet->code]) }}">View
                                                                details</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-12">
                        <div class="text-center pagination pagination-rounded justify-content-end mb-2" wire:ignore>
                            {{ $projets->links('pagination::bootstrap-5') }}
                        </div>
                    </div> <!-- end col-->
                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © Skote.
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
    <div class="modal fade orderdetailsModal " id="editModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="orderdetailsModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title update-task-title">Update Projet</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='update'>
                        <div class="form-group mb-3">
                            <label for="Projetname" class="col-form-label">Projet Name<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input wire:model='nom' id="Projetname" name="Projetname" type="text"
                                    class="form-control validate" placeholder="Enter Projet Name..." required>
                                @error('nom')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="col-form-label">Projet Description</label>
                            <div class="col-lg-12">
                                <textarea wire:model.live="description" id="Projetdesc" class="form-control" name="Projetdesc"></textarea>
                                @error('description')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="col-form-label">Add Team Member<span class="text-danger">*</span></label>
                            <ul class="list-unstyled user-list validate" id="taskassignee">
                                @foreach ($membre as $user)
                                    <li>
                                        <div class="form-check form-check-primary mb-2 d-flex align-items-center">
                                            <input wire:model.live="usersnewMembres" class="form-check-input"
                                                type="checkbox" id="usersnewMembres-{{ $user->user->id }}"
                                                name="usersnewMembres[]" value="{{ $user->user->id }}" checked>
                                            <label class="form-check-label ms-2"
                                                for="member-{{ $user->user->id }}">{{ $user->user->name }}</label>
                                            <img src="{{ asset($user->user->profile_photo_path ? $user->user->profile_photo_path : 'assets/images/users/avatar-1.jpg') }}"
                                                class="rounded-circle avatar-xs m-1" alt="">
                                            <span class="badge m-2 rounded-1 badge-soft-secondary">Membre
                                                existant</span>
                                        </div>
                                    </li>
                                @endforeach
                                @foreach ($newmembre as $user)
                                    <li>
                                        <div class="form-check form-check-primary mb-2 d-flex align-items-center">
                                            <input wire:model.live="usersnewMembres" class="form-check-input"
                                                type="checkbox" id="usersnewMembres-{{ $user->id }}"
                                                name="usersnewMembres[]" value="{{ $user->id }}">
                                            <label class="form-check-label ms-2"
                                                for="member-{{ $user->id }}">{{ $user->name }}</label>
                                            <img src="{{ asset($user->profile_photo_path ? $user->profile_photo_path : 'assets/images/users/avatar-1.jpg') }}"
                                                class="rounded-circle avatar-xs m-1" alt="">
                                            <span class="badge m-2 rounded-1 badge-soft-success">Nouveau membre</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            @error('usersnewMembres')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="col-form-label">Project Manager<span class="text-danger">*</span></label>
                            <div class="col-lg-12">
                                <select name="departement" id="departement" class="form-control"
                                    wire:model.live="manager">
                                    <option value="">Choose...</option>
                                    @foreach ($usersnewMembres as $managerId)
                                        @foreach ($users as $user)
                                            @if ($user->id == $managerId)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </select>
                                @error('Manager')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between p-3 border-top border-opacity-10">
                            <button type="button" class="btn btn-danger" wire:click='ModalEdite'>Annuler</button>
                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                <i class="mdi mdi-pencil font-size-18"></i> Update
                            </button>
                        </div>
                    </form>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>
@include('sweetalert')
<script>
    window.addEventListener("show_Projet_modal", event => {
        // alert('okay')
        $('#editModal').modal('show');
    })

    window.addEventListener("closeModal", event => {
        $("#editModal").modal("hide")
    })
</script>
