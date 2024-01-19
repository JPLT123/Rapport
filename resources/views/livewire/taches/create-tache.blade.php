<div>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Create Task</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tasks</a></li>
                                    <li class="breadcrumb-item active">Create Task</li>
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
                                <h4 class="card-title mb-4">Create New Task</h4>
                                <form class="outer-repeater"  wire:submit.prevent="addTache">
                                    <div data-repeater-list="outer-group" class="outer">
                                        <div data-repeater-item class="outer">
                                            <div class="inner-repeater mb-4">
                                                <div data-repeater-list="inner-group" class="inner form-group mb-0 row">
                                                    <div  data-repeater-item class="inner col-lg-10 ms-md-auto">
                                                        @foreach ($taches as $index => $tache)
                                                            <div class="mb-3 row align-items-center">
                                                                <div class="mt-2 col-md-3">
                                                                    <select wire:model="taches.{{ $index }}.projet" class="inner form-control" name="projet" id="projet">
                                                                        <option value="">Selectionner le projet...</option>
                                                                        @foreach ($chef as $item)
                                                                            @if ($item->is_chef == true)
                                                                                <option value="{{$item->projet->id}}">{{$item->projet->nom}}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                    @error('taches.{{ $index }}.projet')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="mt-2 col-md-7">
                                                                    <input wire:model="taches.{{ $index }}.tache_prevues" type="text" name="tache[{{ $index }}][tache_prevues]" class="form-control" required>
                                                                </div>
                                                                @error('taches.{{ $index }}.tache_prevues')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                                <div class=" col-lg-2 col-md-2 ">
                                                                    <div class="mt-2 mt-md-0 d-grid">
                                                                        <input data-repeater-delete wire:click.prevent="removeTaches({{ $index }})" type="button" class="btn btn-danger inner" value="Delete" />
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="row justify-content-end">
                                                    <div class="col-lg-10">
                                                        <input data-repeater-create type="button" wire:click="addTaches" class="btn btn-success inner" value="Add Task"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row text-center">
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-primary">Save Tasks</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <!-- create-tache.blade.php -->
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
@include('sweetalert')