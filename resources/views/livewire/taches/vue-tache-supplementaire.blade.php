<div>
    <!-- end main content-->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Projects Grid</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Projects</a></li>
                                    <li class="breadcrumb-item active">Projects Grid</li>
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
                                    <div class="col-xxl-3 col-sm-3">
                                        <input type="search" wire:model.live ="search" class="form-control"
                                            id="searchInput" placeholder="Search for ...">
                                    </div>
                                    <div class="col-xxl-3 col-sm-3">
                                        <select wire:model.live ="projet" class="form-control select2">
                                            <option>Projects</option>
                                            @foreach ($projets as $projet)
                                                <option value="{{ $projet->id }}">{{ $projet->nom }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <div class="row">
                    @foreach ($tache_supls as $item)
                        <div class="col-xl-4 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-4">
                                            <div class="avatar-md">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{asset($item->user->profile_photo_path ? $item->user->profile_photo_path : 'assets\user.png')}}" alt="" class="rounded-circle avatar-md">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class=" font-size-15"><a href="javascript: void(0);" class="text-dark">{{$item->user->name}}</a></h5>
                                            <p class="text-truncate text-muted mb-4">{{$item->description}}</p>
                                            <a href="{{ route('vue-taches-supplementaire', ['slug' => $item->id]) }}" class="btn btn-info">Voir les détails</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-4 py-3 border-top">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item me-3">
                                            <i class="bx bx-calendar me-1"></i> {{ \Carbon\Carbon::parse($item->date)->format('d F, Y') }}
                                        </li>
                                    </ul>
                                </div>
                                
                            </div>
                        </div>
                    @endforeach

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
    <!-- end main content-->
</div>
@include('sweetalert')
