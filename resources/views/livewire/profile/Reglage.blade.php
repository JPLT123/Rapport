<div class="account-pages my-2 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-8 col-xl-7">
                <div class="card overflow-hidden">
                    <div class="bg-primary bg-soft">
                        <div class="row">
                            <div class="col-8">
                                <div class="text-primary p-4">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                </div>
                            </div>
                            <div class="col-2 align-self-end">
                                <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="p-2">
                            <form class="form-horizontal" action="https://themesbrand.com/skote/layouts/index.html">

                                <div class="mt-3">
                                    <h5 for="username" class="form-label">Profile Information</label>
                                    <p for="username" style="font-size: 14px" class="form-label mt-2">Update your account's profile information and email address.</p>
                                </div>

                                <div class="row">
                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if(session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    
                                    <div class="col-6">
                                        <div class="mt-2">
                                            <label for="nom" class="form-label">Name</label>
                                            <input type="text" wire:model="nom" class="form-control" id="name">
                                            @error('nom')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    
                                        <div class="mt-2">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" wire:model="email" class="form-control" id="email" >
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mt-2">
                                            <label for="telephone" class="form-label">Telephone</label>
                                            <input type="text" wire:model="telephone" class="form-control" id="telephone">
                                            @error('telephone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mt-2">
                                            <label for="adresse" class="form-label">Adresse</label>
                                            <input type="text" wire:model="adresse" class="form-control" id="adresse" value="{{ old('adresse', $user->adresse) }}">
                                            @error('adresse')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="col-6">
                                        <div class="form-group ">
                                            <div class="text-center fw-bold fs-3">
                                                <span>Photo :</span>
                                            </div>
                                            <div class="text-center">
                                                <label for="path_image">
                                                    <div >
                                                        @if ($images !== null)
                                                            <img src="{{ asset($edit_images ? $edit_images->temporaryUrl() : '/storage/'.$images) }}" class="img-fluid" alt="Responsive image" style="width: 200px; height: 150px;"/>
                                                        @else
                                                            <img src="{{ asset($edit_images ? $edit_images->temporaryUrl() : 'assets/images/image_produit.png') }}" class="img-fluid" alt="Responsive image" style="width: 200px; height: 150px;"/>
                                                        @endif
                                                    </div>
                                                </label>
                                                <button class="mt-2" type="button" style="padding: 10px 15px; font-size: 12px; font-weight: bold; color: #fff; background-color: #4CAF50; border: none; border-radius: 5px; cursor: pointer;" onclick="document.getElementById('edit_images').click();">
                                                    change your profile
                                                    <input type="file" wire:model="edit_images" id="edit_images" hidden style="position: absolute; font-size: 100px; right: 0; top: 0; opacity: 0; cursor: pointer;">
                                                </button>
                                            </div>
                                            @error('edit_images')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="mt-3">
                                        <button class="btn btn-primary waves-effect waves-light" wire:click="update" type="button">Save</button>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="mt-4">
                                            <h5 for="username" class="form-label">Update Password</label>
                                            <p for="username" style="font-size: 14px" class="form-label mt-2">Ensure your account is using a long, random password to stay secure.</p>
                                        </div>
                                    </div>

                                    <div class="mt-3 text-center">
                                        <a class="btn btn-primary waves-effect waves-light" wire:click="updatePassword">Update Password</a>
                                    </div>

                                </div>
                            </form>
                        </div>
    
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>