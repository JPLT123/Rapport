<div>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Report of the week</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Report</a></li>
                                    <li class="breadcrumb-item active">Report of the week</li>
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
                                <h4 class="card-title mb-4">Report of the week</h4>
                                <form class="outer-repeater" wire:submit.prevent="Soumettre">
                                    <div data-repeater-list="outer-group" class="outer">
                                        <div data-repeater-item class="outer">
                                            <div class="form-group row mb-4">
                                                <label for="taskname" class="col-form-label col-lg-2">Object</label>
                                                <div class="col-lg-10">
                                                    <input id="taskname" wire:model="objet" name="taskname" type="text" class="form-control" placeholder="Objet..." required>
                                                    @error('objet') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row mb-4">
                                                <label class="col-form-label col-lg-2">Date</label>
                                                <div class="col-lg-10">
                                                    <div class="input-daterange input-group" >
                                                        <input wire:model="findate" type="date" class="form-control" placeholder="Start Date" name="start" required />                                                                    
                                                        <input wire:model="debutdate" type="date" class="form-control" placeholder="End Date" name="end" required />
                                                        @error('debutdate') <span class="text-danger">{{ $message }}</span> @enderror
                                                        @error('findate') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row mb-4">
                                                <label class="col-form-label col-lg-2">Realisations</label>
                                                <div class="col-lg-10">
                                                    <textarea class="form-control" wire:model="realisation" name="" id="" cols="50" rows="3" required></textarea>
                                                    @error('realisation') <span class="text-danger">{{ $message }}</span> @enderror
                                                    {{-- <div id="editor">
                                                        <textarea wire:model="difficulter" cols="30" rows="5"></textarea>
                                                    </div> --}}
                                                </div>
                                            </div>

                                            <div class="form-group row mb-4">
                                                <label class="col-form-label col-lg-2">Importer un fichier</label>
                                                <div class="col-lg-10">
                                                <input type="file" class="form-control" wire:model="files">
                                                </div>
                                            </div>
                                            <div class="form-group row mb-4">
                                                <label for="taskbudget" class="col-form-label col-lg-2">Budget</label>
                                                <div class="col-lg-10">
                                                    <input id="taskbudget" wire:model="budget" name="taskbudget" type="text" placeholder="Enter Budget..." class="form-control" required>                                                                    
                                                    @error('budget') <span class="text-danger">{{ $message }}</span> @enderror

                                                </div>
                                            </div>
                                            <div class="form-group row mb-4">
                                                <label class="col-form-label col-lg-2">Difficulter</label>
                                                <div class="col-lg-10">
                                                    <textarea class="form-control" wire:model="difficulter" name="" id="" cols="50" rows="2" required></textarea>                                                                    
                                                    @error('difficulter') <span class="text-danger">{{ $message }}</span> @enderror

                                                    {{-- <div id="editor">
                                                        <textarea wire:model="difficulter" cols="30" rows="5"></textarea>
                                                    </div> --}}
                                                </div>
                                            </div>
                                            <div class="form-group row mb-4">
                                                <label class="col-form-label col-lg-2">Recommandations</label>
                                                <div class="col-lg-10">
                                                    <textarea class="form-control" wire:model="recommandation" name="" id="" cols="50" rows="3" required></textarea>
                                                    @error('recommandation') <span class="text-danger">{{ $message }}</span> @enderror

                                                    {{-- <div id="editor">
                                                        <textarea wire:model="recommandation" cols="30" rows="5"></textarea>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="col-lg-10 mt-4">
                                            <button type="submit" class="btn btn-primary">Soumettre</button>
                                        </div>
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
    <!-- end main content-->
</div>
