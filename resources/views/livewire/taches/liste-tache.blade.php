<div>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Task List</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tasks</a></li>
                                    <li class="breadcrumb-item active">Task List</li>
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
                                        <select wire:model.live ="projet" class="form-control select2">
                                            <option value="">Selectionner...</option>
                                            @foreach ($projets as $projet)
                                                <option value="{{ $projet->id }}">{{ $projet->nom  }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xxl-2 col-sm-3">
                                        <a wire:click="CompletedTasks" class="btn btn-soft-info mx-1 w-100" ><i class=" bx bx-edit-alt"></i> Update</a>
                                    </div>
                                    <div class="col-xxl-2 col-sm-3">
                                        <a href="{{route('create-tache')}}" class="btn btn-soft-success mx-1 w-100" ><i class="mdi mdi-plus-outline align-middle"></i> Add</a>
                                    </div>
                                    <div class="col-xxl-2 col-sm-3">
                                        <a wire:click="confirmationDelete" class="btn btn-soft-danger mx-1 w-100" ><i class="bx bx-trash"></i> Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>

                <div class="row">
                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Upcoming</h4>
                                <div class="table-responsive" style="max-height: 200px; overflow-y: auto;">
                                    <table class="table table-nowrap align-middle mb-0">
                                        <tbody>
                                            @foreach ($taches as $tache)
                                                @if ($tache->status == 'Attente')
                                                    <tr>
                                                        <td style="width: 40px;">
                                                            <div class="form-check font-size-16">
                                                                <input wire:model="tache" class="form-check-input" type="checkbox" id="tache-{{ $tache->id }}" name="tache[]" value="{{ $tache->id }}">
                                                                <label class="form-check-label" for="upcomingtaskCheck01"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">{{$tache->tache_prevues}}</a></h5>
                                                        </td>
                                                        <td>
                                                            <div class="avatar-group">
                                                                @foreach ($tache->projet->membres_projets_relation as $item)
                                                                    <div class="avatar-group-item">
                                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                                            <img src="{{asset($item->profile_photo_path ? '/storage/'.$item->profile_photo_path : 'assets\user.png')}}" alt="" class="rounded-circle avatar-xs">
                                                                        </a>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="text-center">
                                                                <span class="badge rounded-pill badge-soft-warning font-size-11">{{$tache->status}}</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">In Progress</h4>
                                <div class="table-responsive" style="max-height: 200px; overflow-y: auto;">
                                    <table class="table table-nowrap align-middle mb-0">
                                        <tbody>
                                            @foreach ($taches  as $index => $tache)
                                            @if($tache->status == 'En Cour')
                                                <tr>
                                                    <td style="width: 40px;">
                                                        <div class="form-check font-size-16">
                                                            <input wire:model="tache" class="form-check-input" type="checkbox" id="tache-{{ $tache->id }}" name="tache[]" value="{{ $tache->id }}">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">{{$tache->tache_prevues}}</a></h5>
                                                    </td>
                                                    <td>
                                                        <div class="avatar-group">
                                                            @foreach ($tache->projet->membres_projets_relation as $item)
                                                                <div class="avatar-group-item">
                                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                                        <img src="{{asset($item->profile_photo_path ? '/storage/'.$item->profile_photo_path : 'assets\user.png')}}" alt="" class="rounded-circle avatar-xs">
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-center">
                                                            <span class="badge rounded-pill badge-soft-info font-size-11">{{$tache->status}}</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Completed</h4>
                                <div class="table-responsive" style="max-height: 200px; overflow-y: auto;">
                                    <table class="table table-nowrap align-middle mb-0">
                                        <tbody>
                                            @foreach ($taches as $tache)
                                                @if($tache->status == 'Terminer')
                                                    <tr>
                                                        <td style="width: 40px;">
                                                            <div class="form-check font-size-16">
                                                                <input wire:model="tache" class="form-check-input" type="checkbox" id="tache-{{ $tache->id }}" name="tache[]" value="{{ $tache->id }}">
                                                                <label class="form-check-label" for="upcomingtaskCheck01"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">{{$tache->tache_prevues}}</a></h5>
                                                        </td>
                                                        <td>
                                                            <div class="avatar-group">
                                                                @foreach ($tache->projet->membres_projets_relation as $item)
                                                                    <div class="avatar-group-item">
                                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                                            <img src="{{asset($item->profile_photo_path ? '/storage/'.$item->profile_photo_path : 'assets\user.png')}}" alt="" class="rounded-circle avatar-xs">
                                                                        </a>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="text-center">
                                                                <span class="badge rounded-pill badge-soft-success font-size-11">{{$tache->status}}</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <!-- end col -->

                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Tasks</h4>

                                <div id="taskchart" class="apex-charts" dir="ltr"></div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Recent Tasks</h4>

                                <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                                    <table class="table table-nowrap align-middle mb-0">
                                        <tbody>
                                            @foreach ($taches as $tache)
                                                @if($tache->status == 'New')
                                                    <tr>
                                                        <td style="width: 40px;">
                                                            <div class="form-check font-size-16">
                                                                <input wire:model="tache" class="form-check-input" type="checkbox" id="tache-{{ $tache->id }}" name="tache[]" value="{{ $tache->id }}">
                                                                <label class="form-check-label" for="upcomingtaskCheck01"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">{{$tache->tache_prevues}}</a></h5>
                                                        </td>
                                                        <td>
                                                            <div class="avatar-group">
                                                                @foreach ($tache->projet->membres_projets_relation as $item)
                                                                    <div class="avatar-group-item">
                                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                                            <img src="{{asset($item->profile_photo_path ? '/storage/'.$item->profile_photo_path : 'assets\user.png')}}" alt="" class="rounded-circle avatar-xs">
                                                                        </a>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="text-center">
                                                                <span class="badge rounded-pill badge-soft-secondary font-size-11">{{$tache->status}}</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table responsive -->
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
    <div class="modal fade orderdetailsModal " id="hierachie" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="orderdetailsModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Rejeter la Planification</h5>
                    <button type="button" class="btn-close"  aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <textarea class="form-control mb-2" id="tache_prevues"  wire:model="tache_prevues" rows="2"></textarea>
                        @error('tache_prevues')
                            <span class="text-danger"> {{$message}} </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeupdate" class="btn btn-success waves-effect" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" wire:click="UpdateCompletedTasks" class="btn btn-danger waves-effect waves-light">valider</button>
                </div>
                
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>
@include('sweetalert')
<script>
    window.addEventListener("show_modal", event => {
        // alert('okay')
        $('#hierachie').modal('show');
    })

    window.addEventListener("closeupdate", event => {
        $("#hierachie").modal("hide")
    })
</script>
<script>
    // Supposons que vous avez récupéré ces données depuis votre backend (à l'aide d'AJAX, par exemple)
    var totalTasksByDay = {!! json_encode($totalTasksByDay) !!};
    var completedTasksByDay = {!! json_encode($completedTasksByDay) !!};

    var options = {
        series: [{
            name: 'Total Tasks',
            type: 'line',
            data: totalTasksByDay.map(item => item.total_tasks)
        }, {
            name: 'Completed Tasks',
            type: 'column',
            data: completedTasksByDay.map(item => item.completed_tasks)
        }],
        chart: {
            height: 350,
            type: 'line',
        },
        stroke: {
            width: [0, 4]
        },
        title: {
            text: 'Traffic Sources'
        },
        dataLabels: {
            enabled: true,
            enabledOnSeries: [1]
        },
        labels: totalTasksByDay.map(item => item.day), // Utilisez les jours à partir des données
        xaxis: {
            type: 'datetime'
        },
        yaxis: [{
            title: {
                text: 'Total Tasks',
            },
        }, {
            opposite: true,
            title: {
                text: 'Completed Tasks'
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#taskchart"), options);
    chart.render();
</script>