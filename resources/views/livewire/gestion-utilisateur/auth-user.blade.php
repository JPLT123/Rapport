
<div>
    <div class="container-fluid p-0">
        <div class="row g-0">
            
            <div class="col-xl-8">
                <div class="auth-full-bg pt-lg-5 p-4">
                    <div class="w-100">
                        <div class="bg-overlay"></div>
                        <div class="d-flex h-100 flex-column">

                            <div class="p-4 mt-auto">
                                <div class="row justify-content-center">
                                    <div class="col-lg-7">
                                        <div class="text-center">
                                            <div class="text-center mb-4 text-muted">
                                                <a href="#" class="d-block auth-logo">
                                                    <img src="{{asset('assets\images\logo_elceto.png')}}" style="width: 80px" alt="Elceto Holding" height="20" class="auth-logo-dark mx-auto">
                                                    Elceto Holding
                                                </a>
                                            </div>
                                            <h4 class="mb-2"><i class="bx bxs-quote-alt-left text-primary h1 align-middle me-3"></i><span class="text-primary">Objet : </span>Finalisation de la création de votre compte - Action requise</h4>
                                            
                                            <div dir="ltr">
                                                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                                                    <div class="carousel-inner" role="listbox">
                                                        <div class="carousel-item active">
                                                            <div class="py-3">
                                                                <p class="font-size-16 mb-4">" Cher(e) {{ Auth::user()->name }},</p>
                                                                <p class="font-size-16 mb-4">Merci de votre intérêt pour Notre Application. Pour finaliser la création de votre compte, veuillez remplir les champs suivants manquants :"</p>

                                                                <div>
                                                                    <h4 class="font-size-16 text-primary">{{ Auth::user()->slug }}</h4>
                                                                    <p class="font-size-14 mb-0">- Elceto Hoding</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <div class="py-3">
                                                                <p class="font-size-16 mb-4">Veuillez vous connecter à votre compte et accéder à la section "Profil" pour modifier les informations. Si vous avez des questions ou rencontrez des problèmes, n'hésitez pas à contacter l'equipe technique.</p>

                                                                <div>
                                                                    <h4 class="font-size-16 text-primary">{{ Auth::user()->slug }}</h4>
                                                                    <p class="font-size-14 mb-0">-  Elceto Hoding</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->

            <div class="col-xl-4">
                <div class="auth-full-page-content p-md-5 p-4">
                    <div class="w-100">

                        <div class="d-flex flex-column h-100">
                                                     
                            <div class="my-auto">
    
                                <div class="p-2">
                                    <x-validation-errors class="mb-4 text-danger" />
                                    <form wire:submit.prevent='update'>
                                        @csrf
                                        <div class="mb-2 text-center">
                                            <div>
                                                <label for="images">
                                                    <div >
                                                        <img src="{{ $images ? $images->temporaryUrl() : 'assets/images/image_produit.png' }}"
                                                        class="rounded-circle avatar-lg" alt="Responsive image" style="width: 100px; height:100px;"/>
                                                    </div>
                                                </label>
                                                <input type="file" wire:model="images" id="images" hidden>
                                            </div>
                                            @error('images')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label for="telephone" value="{{ __('Phone') }}"  class="form-label">Votre Telephone</label>
                                            <input type="numeric" class="form-control" id="telephone" wire:model="telephone" :value="old('telephone')" placeholder="Enter Phone" required>
                                            <div class="invalid-feedback">
                                                Please Enter phone
                                            </div>  
                                        </div>
                                        
                                        <div class="mb-2">
                                            <label for="adress" value="{{ __('Adress') }}" class="form-label">Votre Adress</label>
                                            <input type="text" class="form-control" wire:model="adresse" :value="old('adresse')" placeholder="Enter Adress" required>  
                                            <div class="invalid-feedback">
                                                Please Enter Adress
                                            </div>      
                                        </div>
                
                                        <div class="mb-2">
                                            <label for="filiale" class="form-label">{{ __('Filiale') }}</label>
                                            <select id="filiale" class="form-control" wire:model.live="filiale" required>
                                                <option value="">Sélectionnez...</option>
                                                @foreach ($filiales as $filiale)
                                                    <option value="{{ $filiale->id }}">{{ $filiale->nom }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Veuillez sélectionner une filiale.
                                            </div>
                                        </div>
                        
                                        <div class="mb-2">
                                            <label for="departement" class="form-label">{{ __('Departement') }}</label>
                                            <select id="departement" class="form-control" wire:model="departement" required>
                                                <option value="">Sélectionnez...</option>
                                                @foreach ($departements as $departement)
                                                    <option value="{{ $departement->id }}">{{ $departement->nom }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Veuillez sélectionner un département.
                                            </div>
                                        </div>
    
                                        <div class="mt-4 d-grid">
                                            <button class="btn btn-primary waves-effect waves-light" type="submit"> Enregistrer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container-fluid -->
    
    {{-- <footer class="footer">
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
    </footer> --}}
</div>
