<div>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Data Tables</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                    <li class="breadcrumb-item active">Data Tables</li>
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
                                    <div class="col-sm-4 col-lg-4">
                                        <div class="search-box me-2 mb-2 d-inline-block">
                                            <div class="position-relative">
                                                <input type="text" class="form-control" wire:model.live ="search"
                                                    placeholder="Search...">
                                                <i class="bx bx-search-alt search-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-sm-2 col-lg-2">
                                        <div class="search-box me-2 mb-2 d-inline-block">
                                            <div class="position-relative">
                                                <select wire:model.live ="status" class="form-control select2">
                                                    <option value="">Status</option>
                                                    <option value="activer">Activer</option>
                                                    <option value="desactiver">Desactiver</option>
                                                    <option value="attente">En attente</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="col-sm-2 col-lg-2">
                                        <div class="search-box me-2 mb-2 d-inline-block">
                                            <div class="position-relative">
                                                <select wire:model.live ="filiale_id" class="form-control select2">
                                                    <option>Filiales</option>
                                                    @foreach ($filiales as $filiale)
                                                        <option value="{{ $filiale->id }}">{{ $filiale->nom }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div> --}}
                                    
                                    {{-- @if (in_array(1, $userRoles) || in_array(2, $userRoles))
                                        <div class="col-xxl-2 col-lg-4">
                                            <div class="text-sm-end">
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#addModal" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i class="mdi mdi-plus me-1"></i> Add User</button>
                                            </div>
                                        </div><!-- end col-->
                                    @endif --}}
                                </div>

                                <div style="width: 100%; font-size: 11px;" class="table-responsive">
                                    <table class="table align-middle table-nowrap table-check">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="align-middle" style="width: 5px;">#</th>
                                                <th scope="align-middle">Nom Prenom</th>
                                                <th scope="align-middle">Email</th>
                                                <th scope="align-middle">Telephone</th>
                                                <th scope="align-middle">Adresse</th>
                                                <th scope="align-middle">L'entreprises/Filiales</th>
                                                <th class="align-middle">View planification</th>
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
                                                    <td>
                                                        <a href="{{ route('detail-user',['slug' => $user->slug]) }}" class="btn btn-primary btn-sm btn-rounded">View planification</a>
                                                    </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <ul class="pagination pagination-rounded justify-content-end mb-2"  wire:ignore>
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
</div>
