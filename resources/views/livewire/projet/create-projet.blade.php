<div>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Create New</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Project</a></li>
                                    <li class="breadcrumb-item active">Create New</li>
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
                                <h4 class="card-title mb-4">Create New Project</h4>
                                @if(session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <form wire:submit.prevent='store'>
                                    <div class="form-group mb-3">
                                        <label for="nom" class="col-form-label">Project Name<span class="text-danger">*</span></label>
                                        <div class="col-lg-12">
                                            <input id="nom" wire:model='nom' type="text" class="form-control @error('nom') is-invalid @enderror" placeholder="Enter Project Name..." required>
                                            @error('nom')
                                                <span class="text-danger"> {{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="col-form-label">Project Description</label>
                                        <div class="col-lg-12">
                                            <textarea id="description" wire:model='description' class="form-control @error('description') is-invalid @enderror"></textarea>
                                            @error('description')
                                                <span class="text-danger"> {{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="col-form-label">Project Date</label>
                                        <div class="col-lg-12">
                                            <div class="input-daterange input-group" id="project-date-inputgroup" >
                                                <input type="date" wire:model='datedebut' class="form-control @error('datedebut') is-invalid @enderror" placeholder="Start Date" name="debutdate" />
                                                <input type="date" wire:model='datefin' class="form-control @error('datefin') is-invalid @enderror" placeholder="End Date" name="findate" />
                                                @error('datedebut')
                                                    <span class="text-danger"> {{$message}} </span>
                                                @enderror
                                                @error('datefin')
                                                    <span class="text-danger"> {{$message}} </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label">Filiale<span class="text-danger">*</span></label>
                                                <div class="col-lg-12">
                                                    <select name="filiale" id="filiale" class="form-control" wire:model.live="filiale">
                                                        <option value="">Choose...</option>
                                                        @foreach ($filiales as $filiale)
                                                            <option value="{{ $filiale->id }}">{{ $filiale->nom }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('filiale')
                                                        <span class="text-danger"> {{$message}} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label">Département<span class="text-danger">*</span></label>
                                                <div class="col-lg-12">
                                                    <select name="departement" id="departement" class="form-control" wire:model.live="departement">
                                                        <option value="">Choose...</option>
                                                        @foreach ($departements as $depart)
                                                            <option value="{{ $depart->id }}">{{ $depart->nom }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('departement')
                                                        <span class="text-danger"> {{$message}} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label class="col-form-label">Add Team Member<span class="text-danger">*</span></label>
                                        <ul class="list-unstyled user-list validate" id="taskassignee">
                                            @foreach ($users as $user)
                                                <li>
                                                    <div class="form-check form-check-primary mb-2 d-flex align-items-center">
                                                        <input wire:model.live="membre" class="form-check-input" type="checkbox" id="member-{{$user->id}}" name="member[]" value="{{$user->id}}">
                                                        <label class="form-check-label ms-2" for="member-{{$user->id}}">{{$user->name}}</label>
                                                        <img src="{{asset($user->profile_photo_path ? $user->profile_photo_path : 'assets/images/users/avatar-1.jpg')}}" class="rounded-circle avatar-xs m-1" alt="">
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                            @error('membre')
                                                <span class="text-danger"> {{$message}} </span>
                                            @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="col-form-label">Project Manager<span class="text-danger">*</span></label>
                                        <div class="col-lg-12">
                                            <select name="departement" id="departement" class="form-control" wire:model.live="Manager">
                                                <option value="">Choose...</option>
                                                @if (is_array($membre) || is_object($membre))
                                                    @foreach ($membre as $managerId)
                                                        @foreach ($users as $user)
                                                            @if($user->id == $managerId)
                                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('Manager')
                                                <span class="text-danger"> {{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-2">
                                        <div class="col-xxl-10 col-lg-6">
                                            <div class="search-box me-2 mb-2 d-inline-block">
                                                <div class="position-relative">
                                                    <button type="submit" class="btn btn-success  waves-effect waves-light mb-2 me-2">Create Project</button>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-xxl-2 col-lg-6">
                                            <div class="text-sm-end">
                                                <button type="reset" class="btn btn-danger  waves-effect waves-light mb-2 me-2"> Annuler</button>
                                            </div>
                                        </div><!-- end col-->
                                    </div>
                                </form>
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
    
    @include('sweetalert')
</div>
