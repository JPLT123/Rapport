<div>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">File Manager</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Apps</a></li>
                                    <li class="breadcrumb-item active">File Manager</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="d-xl-flex">
                    <div class="w-100">
                        <div class="d-md-flex">
                            <div class="card filemanager-sidebar me-md-2">
                                <div class="card-body">

                                    <div class="d-flex flex-column h-100">
                                        <div class="mb-4">
                                            <div class="mb-3">
                                                <div class="dropdown">
                                                    <button class="btn btn-light w-100" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-plus me-1"></i> Create New
                                                    </button>
                                                    <div class="dropdown-menu">
                                                      <a class="dropdown-item" href="#"><i class="bx bx-folder me-1"></i> Folder</a>
                                                      <a class="dropdown-item" href="#"><i class="bx bx-file me-1"></i> File</a>
                                                    </div>
                                                </div>
                                                <div>
                                                    @if (session()->has('message'))
                                                        <div>{{ session('message') }}</div>
                                                    @endif
                                                
                                                    @if (session()->has('error'))
                                                        <div>{{ session('error') }}</div>
                                                    @endif
                                                
                                                    <form wire:submit.prevent="createFolder">
                                                        <label for="folderName">Nom du dossier :</label>
                                                        <input wire:model="folderName" type="text" id="folderName" />
                                                        <button type="submit">Créer le dossier</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <ul class="list-unstyled categories-list">
                                                <li>
                                                    <div class="custom-accordion">
                                                        <a class="text-body fw-medium py-1 d-flex align-items-center" data-bs-toggle="collapse" href="#categories-collapse" role="button" aria-expanded="false" aria-controls="categories-collapse">
                                                            <i class="mdi mdi-folder font-size-16 text-warning me-2"></i> Files <i class="mdi mdi-chevron-up accor-down-icon ms-auto"></i>
                                                        </a>
                                                        <div class="collapse show" id="categories-collapse">
                                                            <div class="card border-0 shadow-none ps-2 mb-0">
                                                                <ul class="list-unstyled mb-0">
                                                                    @if(count($folders) > 0)
                                                                            @foreach($folders as $folder)
                                                                                <li><a wire:click="openDirectory('{{ $folder }}')" class="d-flex align-items-center"><span class="me-auto">{{ $folder }}</span></a></li>
                                                                                <form wire:submit.prevent="renameFolder('{{ $folder }}')">
                                                                                    <input type="text" wire:model="newFolderName" placeholder="Nouveau nom du dossier">
                                                                                    <button type="submit">Renommer</button>
                                                                                </form>
                                                                            @endforeach
                                                                    @else
                                                                        <p>Aucun dossier n'existe actuellement.</p>
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <h2>Explorateur de fichiers</h2>
                                                        
                                                            <ul>
                                                                @foreach ($directories as $directory)
                                                                    <li>
                                                                        <a wire:click="openDirectory('{{ $directory }}')" href="#" style="cursor: pointer;">{{ basename($directory) }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        
                                                            <ul>
                                                                @foreach ($files as $file)
                                                                    <li>{{ basename($file) }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                        
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="mt-auto">
                                            <div class="alert alert-success alert-dismissible fade show px-3 mb-0" role="alert">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                <div class="mb-3">
                                                    <i class="bx bxs-folder-open h1 text-success"></i>
                                                </div>

                                                <div>
                                                    <h5 class="text-success">Upgrade Features</h5>
                                                    <p>Cum sociis natoque penatibus et</p>
                                                    <div class="text-center">
                                                        <button type="button" class="btn btn-link text-decoration-none text-success">Upgrade <i class="mdi mdi-arrow-right"></i></button>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- filemanager-leftsidebar -->

                            <div class="w-100">
                                <div class="card">
                                    <div class="card-body">
                                        <div>
                                            <div class="row mb-3">
                                                <div class="col-xl-3 col-sm-6">
                                                    <div class="mt-2">
                                                        <h5>My Files</h5>
                                                    </div>
                                                </div>
                                                <div class="col-xl-9 col-sm-6">
                                                    <form class="mt-4 mt-sm-0 float-sm-end d-flex align-items-center">
                                                        <div class="search-box mb-2 me-2">
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control bg-light border-light rounded" placeholder="Search...">
                                                                <i class="bx bx-search-alt search-icon"></i>
                                                            </div>
                                                        </div>
    
                                                        <div class="dropdown mb-0">
                                                            <a class="btn btn-link text-muted mt-n2" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                <i class="mdi mdi-dots-vertical font-size-20"></i>
                                                            </a>
                                                          
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="#">Share Files</a>
                                                                <a class="dropdown-item" href="#">Share with me</a>
                                                                <a class="dropdown-item" href="#">Other Actions</a>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="row">
                                                @foreach ($folders as $folder)
                                                    <div class="col-xl-4 col-sm-6">
                                                        <div class="card shadow-none border">
                                                            <div class="card-body p-3">
                                                                <div class="">
                                                                    <div class="float-end ms-2">
                                                                        <div class="dropdown mb-2">
                                                                            <a class="font-size-16 text-muted" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                                <i class="mdi mdi-dots-horizontal"></i>
                                                                            </a>
                                                                            
                                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                                <a class="dropdown-item" wire:click="openDirectory('{{ $folder }}')">Open</a>
                                                                                <a class="dropdown-item" href="#">Rename</a>
                                                                                <div class="dropdown-divider"></div>
                                                                                <a class="dropdown-item" wire:click="deleteFolder('{{ $folder }}')">Remove</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-xs me-3 mb-3">
                                                                        <div class="avatar-title bg-transparent rounded">
                                                                            <i class="bx bxs-folder font-size-24 text-warning"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex">
                                                                        <div class="overflow-hidden me-auto">
                                                                            <h5 class="font-size-14 text-truncate mb-1"><a href="javascript: void(0);" class="text-body">{{ $folder }}</a></h5>
                                                                            <p class="text-muted text-truncate mb-0">12 Files</p>
                                                                        </div>
                                                                        <div class="align-self-end ms-2">
                                                                            <p class="text-muted mb-0">6GB</p>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    <!-- end col -->
                                                @endforeach
                                            </div>
                                            
                                            <!-- end row -->
                                        </div>

                                        <div class="mt-4">
                                            <div class="d-flex flex-wrap">
                                                <h5 class="font-size-16 me-3">Recent Files</h5>

                                                <div class="ms-auto">
                                                    <a href="javascript: void(0);" class="fw-medium text-reset">View All</a>
                                                </div>
                                            </div>
                                            <hr class="mt-2">

                                            <div class="table-responsive">
                                                <table class="table align-middle table-nowrap table-hover mb-0">
                                                    <thead>
                                                        <tr>
                                                          <th scope="col">Name</th>
                                                          <th scope="col">Date modified</th>
                                                          <th scope="col" colspan="2">Size</th>
                                                        </tr>
                                                      </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><a href="javascript: void(0);" class="text-dark fw-medium"><i class="mdi mdi-file-document font-size-16 align-middle text-primary me-2"></i> index.html</a></td>
                                                            <td>12-10-2020, 09:45</td>
                                                            <td>09 KB</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a class="font-size-16 text-muted" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                                    </a>
                                                                    
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="#">Open</a>
                                                                        <a class="dropdown-item" href="#">Edit</a>
                                                                        <a class="dropdown-item" href="#">Rename</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Remove</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><a href="javascript: void(0);" class="text-dark fw-medium"><i class="mdi mdi-folder-zip font-size-16 align-middle text-warning me-2"></i> Project-A.zip</a></td>
                                                            <td>11-10-2020, 17:05</td>
                                                            <td>115 KB</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a class="font-size-16 text-muted" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                                    </a>
                                                                    
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="#">Open</a>
                                                                        <a class="dropdown-item" href="#">Edit</a>
                                                                        <a class="dropdown-item" href="#">Rename</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Remove</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><a href="javascript: void(0);" class="text-dark fw-medium"><i class="mdi mdi-image font-size-16 align-middle text-muted me-2"></i> Img-1.jpeg</a></td>
                                                            <td>11-10-2020, 13:26</td>
                                                            <td>86 KB</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a class="font-size-16 text-muted" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                                    </a>
                                                                    
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="#">Open</a>
                                                                        <a class="dropdown-item" href="#">Edit</a>
                                                                        <a class="dropdown-item" href="#">Rename</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Remove</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><a href="javascript: void(0);" class="text-dark fw-medium"><i class="mdi mdi-text-box font-size-16 align-middle text-muted me-2"></i> update list.txt</a></td>
                                                            <td>10-10-2020, 11:32</td>
                                                            <td>08 KB</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a class="font-size-16 text-muted" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                                    </a>
                                                                    
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="#">Open</a>
                                                                        <a class="dropdown-item" href="#">Edit</a>
                                                                        <a class="dropdown-item" href="#">Rename</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Remove</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><a href="javascript: void(0);" class="text-dark fw-medium"><i class="mdi mdi-folder font-size-16 align-middle text-warning me-2"></i> Project B</a></td>
                                                            <td>10-10-2020, 10:51</td>
                                                            <td>72 KB</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a class="font-size-16 text-muted" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                                    </a>
                                                                    
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="#">Open</a>
                                                                        <a class="dropdown-item" href="#">Edit</a>
                                                                        <a class="dropdown-item" href="#">Rename</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Remove</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><a href="javascript: void(0);" class="text-dark fw-medium"><i class="mdi mdi-text-box font-size-16 align-middle text-muted me-2"></i> Changes list.txt</a></td>
                                                            <td>09-10-2020, 17:05</td>
                                                            <td>07 KB</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a class="font-size-16 text-muted" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                                    </a>
                                                                    
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="#">Open</a>
                                                                        <a class="dropdown-item" href="#">Edit</a>
                                                                        <a class="dropdown-item" href="#">Rename</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Remove</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><a href="javascript: void(0);" class="text-dark fw-medium"><i class="mdi mdi-image font-size-16 align-middle text-success me-2"></i> Img-2.png</a></td>
                                                            <td>09-10-2020, 15:12</td>
                                                            <td>31 KB</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a class="font-size-16 text-muted" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                                    </a>
                                                                    
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="#">Open</a>
                                                                        <a class="dropdown-item" href="#">Edit</a>
                                                                        <a class="dropdown-item" href="#">Rename</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Remove</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><a href="javascript: void(0);" class="text-dark fw-medium"><i class="mdi mdi-folder font-size-16 align-middle text-warning me-2"></i> Project C</a></td>
                                                            <td>09-10-2020, 10:11</td>
                                                            <td>20 KB</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a class="font-size-16 text-muted" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                                    </a>
                                                                    
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="#">Open</a>
                                                                        <a class="dropdown-item" href="#">Edit</a>
                                                                        <a class="dropdown-item" href="#">Rename</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Remove</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><a href="javascript: void(0);" class="text-dark fw-medium"><i class="bx bxs-file font-size-16 align-middle text-primary me-2"></i> starter-page.html</a></td>
                                                            <td>08-10-2020, 03:22</td>
                                                            <td>11 KB</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a class="font-size-16 text-muted" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                                    </a>
                                                                    
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="#">Open</a>
                                                                        <a class="dropdown-item" href="#">Edit</a>
                                                                        <a class="dropdown-item" href="#">Rename</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Remove</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end w-100 -->
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
    <!-- end main content-->
</div>
