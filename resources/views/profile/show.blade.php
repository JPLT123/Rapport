<div>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Profile</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                    <li class="breadcrumb-item active">Profile</li>
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
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="assets/images/users/avatar-1.jpg" alt="" class="avatar-md rounded-circle img-thumbnail">
                                            </div>
                                            <div class="flex-grow-1 align-self-center">
                                                <div class="text-muted">
                                                    <p class="mb-2">Welcome to Dashboard</p>
                                                    <h5 class="mb-1">{{Auth::user()->name}}</h5>
                                                    <p class="mb-0">{{Auth::user()->filiale->nom}} / {{Auth::user()->departement->nom}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="col-lg-4 align-self-center">
                                        <div class="text-lg-center mt-4 mt-lg-0">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div>
                                                        @php
                                                            $userProjectsCount = Auth::user()->projets->count();
                                                            $userOngoingProjectsCount = Auth::user()->ongoingProjects->count();
                                                            $userPendingProjectsCount = Auth::user()->PendingProjects->count();
                                                        @endphp
                                                        <p class="text-muted text-truncate mb-2">Total Projects</p>
                                                        <h5 class="mb-0">{{ $userProjectsCount }}</h5>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div>
                                                        <p class="text-muted text-truncate mb-2">Current Projects</p>
                                                        <h5 class="mb-0">{{ $userOngoingProjectsCount }}</h5>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div>
                                                        <p class="text-muted text-truncate mb-2">Pending Projects</p>
                                                        <h5 class="mb-0">{{ $userPendingProjectsCount }}</h5>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="col-lg-4 d-none d-lg-block">
                                        <div class="clearfix mt-4 mt-lg-0">
                                            <div class="dropdown float-end">
                                                <a href="{{route('reglage')}}" class="btn btn-primary"><i class="bx bxs-cog align-middle me-1"></i> Setting</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-4">
                        <div class="card bg-primary bg-soft">
                            <div>
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-3">
                                            <h5 class="text-primary">Welcome Back !</h5>
                                            <p>Skote Saas Dashboard</p>

                                            <ul class="ps-3 mb-0">
                                                <li class="py-1">7 + Layouts</li>
                                                <li class="py-1">Multiple apps</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                    <i class="bx bx-copy-alt"></i>
                                                </span>
                                            </div>
                                            <h5 class="font-size-14 mb-0">Orders</h5>
                                        </div>
                                        <div class="text-muted mt-4">
                                            <h4>1,452 <i class="mdi mdi-chevron-up ms-1 text-success"></i></h4>
                                            <div class="d-flex">
                                                <span class="badge badge-soft-success font-size-12"> + 0.2% </span> <span class="ms-2 text-truncate">From previous period</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                    <i class="bx bx-archive-in"></i>
                                                </span>
                                            </div>
                                            <h5 class="font-size-14 mb-0">Revenue</h5>
                                        </div>
                                        <div class="text-muted mt-4">
                                            <h4>$ 28,452 <i class="mdi mdi-chevron-up ms-1 text-success"></i></h4>
                                            <div class="d-flex">
                                                <span class="badge badge-soft-success font-size-12"> + 0.2% </span> <span class="ms-2 text-truncate">From previous period</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                    <i class="bx bx-purchase-tag-alt"></i>
                                                </span>
                                            </div>
                                            <h5 class="font-size-14 mb-0">Average Price</h5>
                                        </div>
                                        <div class="text-muted mt-4">
                                            <h4>$ 16.2 <i class="mdi mdi-chevron-up ms-1 text-success"></i></h4>
                                            
                                            <div class="d-flex">
                                                <span class="badge badge-soft-warning font-size-12"> 0% </span> <span class="ms-2 text-truncate">From previous period</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-7">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Evolutions des Projects</h4>
                                <div id="chart_" class="apex-charts" dir="ltr"></div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Radial Chart</h4>
                                
                                <div id="chart" data-colors='["--bs-primary","--bs-success", "--bs-danger", "--bs-warning"]' class="apex-charts" dir="ltr"></div>  
                            </div>
                        </div><!--end card-->
                        
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Attached Files</h4>
                                <div class="table-responsive">
                                    <table class="table table-nowrap align-middle table-hover mb-0">
                                        <tbody>
                                            <tr>
                                                <td style="width: 45px;">
                                                    <div class="avatar-sm">
                                                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-24">
                                                            <i class="bx bxs-file-doc"></i>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">Skote Landing.Zip</a>
                                                    <small>Size : 3.25 MB</small>
                                                </td>
                                                <td>
                                                    <div class="text-center">
                                                        <a href="javascript: void(0);" class="text-dark"><i class="bx bx-download h3 m-0"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="avatar-sm">
                                                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-24">
                                                            <i class="bx bxs-file-doc"></i>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">Skote Admin.Zip</a></h5>
                                                    <small>Size : 3.15 MB</small>
                                                </td>
                                                <td>
                                                    <div class="text-center">
                                                        <a href="javascript: void(0);" class="text-dark"><i class="bx bx-download h3 m-0"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="avatar-sm">
                                                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-24">
                                                            <i class="bx bxs-file-doc"></i>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">Skote Logo.Zip</a></h5>
                                                    <small>Size : 2.02 MB</small>
                                                </td>
                                                <td>
                                                    <div class="text-center">
                                                        <a href="javascript: void(0);" class="text-dark"><i class="bx bx-download h3 m-0"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="avatar-sm">
                                                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-24">
                                                            <i class="bx bxs-file-doc"></i>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="font-size-14"><a href="javascript: void(0);" class="text-dark">Veltrix admin.Zip</a></h5>
                                                    <small>Size : 2.25 MB</small>
                                                </td>
                                                <td>
                                                    <div class="text-center">
                                                        <a href="javascript: void(0);" class="text-dark"><i class="bx bx-download h3 m-0"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Tasks</h4>

                                <ul class="nav nav-pills bg-light rounded">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#">In Process</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Upcoming</a>
                                    </li>
                                </ul>

                                <div class="mt-4">
                                    <div data-simplebar style="max-height: 250px;">
                                    
                                        <div class="table-responsive">
                                            <table class="table table-nowrap align-middle table-hover mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 50px;">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="tasklistCheck01">
                                                                <label class="form-check-label" for="tasklistCheck01"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <h5 class="text-truncate font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">Skote Saas Dashboard</a></h5>
                                                            <p class="text-muted mb-0">Assigned to Mark</p>
                                                        </td>
                                                        <td style="width: 90px;">
                                                            <div>
                                                                <ul class="list-inline mb-0 font-size-16">
                                                                    <li class="list-inline-item">
                                                                        <a href="javascript: void(0);" class="text-success p-1"><i class="bx bxs-edit-alt"></i></a>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <a href="javascript: void(0);" class="text-danger p-1"><i class="bx bxs-trash"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="tasklistCheck02">
                                                                <label class="form-check-label" for="tasklistCheck02"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <h5 class="text-truncate font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">New Landing UI</a></h5>
                                                            <p class="text-muted mb-0">Assigned to Team A</p>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <ul class="list-inline mb-0 font-size-16">
                                                                    <li class="list-inline-item">
                                                                        <a href="javascript: void(0);" class="text-success p-1"><i class="bx bxs-edit-alt"></i></a>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <a href="javascript: void(0);" class="text-danger p-1"><i class="bx bxs-trash"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="tasklistCheck02">
                                                                <label class="form-check-label" for="tasklistCheck02"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <h5 class="text-truncate font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">Brand logo design</a></h5>
                                                            <p class="text-muted mb-0">Assigned to Janis</p>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <ul class="list-inline mb-0 font-size-16">
                                                                    <li class="list-inline-item">
                                                                        <a href="javascript: void(0);" class="text-success p-1"><i class="bx bxs-edit-alt"></i></a>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <a href="javascript: void(0);" class="text-danger p-1"><i class="bx bxs-trash"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="tasklistCheck04">
                                                                <label class="form-check-label" for="tasklistCheck04"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <h5 class="text-truncate font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">Blog Template UI</a></h5>
                                                            <p class="text-muted mb-0">Assigned to Dianna</p>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <ul class="list-inline mb-0 font-size-16">
                                                                    <li class="list-inline-item">
                                                                        <a href="javascript: void(0);" class="text-success p-1"><i class="bx bxs-edit-alt"></i></a>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <a href="javascript: void(0);" class="text-danger p-1"><i class="bx bxs-trash"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="tasklistCheck05">
                                                                <label class="form-check-label" for="tasklistCheck05"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <h5 class="text-truncate font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">Multipurpose Landing</a></h5>
                                                            <p class="text-muted mb-0">Assigned to Team B</p>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <ul class="list-inline mb-0 font-size-16">
                                                                    <li class="list-inline-item">
                                                                        <a href="javascript: void(0);" class="text-success p-1"><i class="bx bxs-edit-alt"></i></a>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <a href="javascript: void(0);" class="text-danger p-1"><i class="bx bxs-trash"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="tasklistCheck06">
                                                                <label class="form-check-label" for="tasklistCheck06"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <h5 class="text-truncate font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">Redesign - Landing page</a></h5>
                                                            <p class="text-muted mb-0">Assigned to Jerry</p>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <ul class="list-inline mb-0 font-size-16">
                                                                    <li class="list-inline-item">
                                                                        <a href="javascript: void(0);" class="text-success p-1"><i class="bx bxs-edit-alt"></i></a>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <a href="javascript: void(0);" class="text-danger p-1"><i class="bx bxs-trash"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="tasklistCheck07">
                                                                <label class="form-check-label" for="tasklistCheck07"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <h5 class="text-truncate font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">Skote Crypto Dashboard</a></h5>
                                                            <p class="text-muted mb-0">Assigned to Eric</p>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <ul class="list-inline mb-0 font-size-16">
                                                                    <li class="list-inline-item">
                                                                        <a href="javascript: void(0);" class="text-success p-1"><i class="bx bxs-edit-alt"></i></a>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <a href="javascript: void(0);" class="text-danger p-1"><i class="bx bxs-trash"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-transparent border-top">
                                <div class="text-center">
                                    <a href="javascript: void(0);" class="btn btn-primary waves-effect waves-light"> Add new Task</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body border-bottom">
                                <div class="row">
                                    <div class="col-md-4 col-9">
                                        <h5 class="font-size-15 mb-1">Steven Franklin</h5>
                                        <p class="text-muted mb-0"><i class="mdi mdi-circle text-success align-middle me-1"></i> Active now</p>
                                    </div>
                                    <div class="col-md-8 col-3">
                                        <ul class="list-inline user-chat-nav text-end mb-0">
                                            <li class="list-inline-item d-none d-sm-inline-block">
                                                <div class="dropdown">
                                                    <button class="btn nav-btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bx bx-search-alt-2"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end py-0 dropdown-menu-md">
                                                        <form class="p-3">
                                                            <div class="form-group m-0">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                                                    
                                                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-inline-item  d-none d-sm-inline-block">
                                                <div class="dropdown">
                                                    <button class="btn nav-btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bx bx-cog"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">View Profile</a>
                                                        <a class="dropdown-item" href="#">Clear chat</a>
                                                        <a class="dropdown-item" href="#">Muted</a>
                                                        <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="list-inline-item">
                                                <div class="dropdown">
                                                    <button class="btn nav-btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bx bx-dots-horizontal-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else</a>
                                                    </div>
                                                </div>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pb-0">
                                <div>
                                    <div class="chat-conversation">
                                        <ul class="list-unstyled" data-simplebar style="max-height: 260px;">
                                            <li> 
                                                <div class="chat-day-title">
                                                    <span class="title">Today</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="conversation-list">
                                                    <div class="dropdown">

                                                        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                          </a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Copy</a>
                                                            <a class="dropdown-item" href="#">Save</a>
                                                            <a class="dropdown-item" href="#">Forward</a>
                                                            <a class="dropdown-item" href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                    <div class="ctext-wrap">
                                                        <div class="conversation-name">Steven Franklin</div>
                                                        <p>
                                                            Hello!
                                                        </p>
                                                        <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> 10:00</p>
                                                    </div>
                                                    
                                                </div>
                                            </li>

                                            <li class="right">
                                                <div class="conversation-list">
                                                    <div class="dropdown">

                                                        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                          </a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Copy</a>
                                                            <a class="dropdown-item" href="#">Save</a>
                                                            <a class="dropdown-item" href="#">Forward</a>
                                                            <a class="dropdown-item" href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                    <div class="ctext-wrap">
                                                        <div class="conversation-name">Henry Wells</div>
                                                        <p>
                                                            Hi, How are you? What about our next meeting?
                                                        </p>

                                                        <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> 10:02</p>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="conversation-list">
                                                    <div class="dropdown">

                                                        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                          </a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Copy</a>
                                                            <a class="dropdown-item" href="#">Save</a>
                                                            <a class="dropdown-item" href="#">Forward</a>
                                                            <a class="dropdown-item" href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                    <div class="ctext-wrap">
                                                        <div class="conversation-name">Steven Franklin</div>
                                                        <p>
                                                            Yeah everything is fine
                                                        </p>
                                                        
                                                        <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> 10:06</p>
                                                    </div>
                                                    
                                                </div>
                                            </li>

                                            <li class="last-chat">
                                                <div class="conversation-list">
                                                    <div class="dropdown">

                                                        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                          </a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Copy</a>
                                                            <a class="dropdown-item" href="#">Save</a>
                                                            <a class="dropdown-item" href="#">Forward</a>
                                                            <a class="dropdown-item" href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                    <div class="ctext-wrap">
                                                        <div class="conversation-name">Steven Franklin</div>
                                                        <p>& Next meeting tomorrow 10.00AM</p>
                                                        <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> 10:06</p>
                                                    </div>
                                                    
                                                </div>
                                            </li>

                                            <li class="right">
                                                <div class="conversation-list">
                                                    <div class="dropdown">

                                                        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                          </a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Copy</a>
                                                            <a class="dropdown-item" href="#">Save</a>
                                                            <a class="dropdown-item" href="#">Forward</a>
                                                            <a class="dropdown-item" href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                    <div class="ctext-wrap">
                                                        <div class="conversation-name">Henry Wells</div>
                                                        <p>
                                                            Wow that's great
                                                        </p>

                                                        <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> 10:07</p>
                                                    </div>
                                                </div>
                                            </li>
                                              
                                        </ul>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="p-3 chat-input-section">
                                <div class="row">
                                    <div class="col">
                                        <div class="position-relative">
                                            <input type="text" class="form-control rounded chat-input" placeholder="Enter Message...">
                                            <div class="chat-input-links">
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item"><a href="javascript: void(0);"><i class="mdi mdi-emoticon-happy-outline"></i></a></li>
                                                    <li class="list-inline-item"><a href="javascript: void(0);"><i class="mdi mdi-file-image-outline"></i></a></li>
                                                    <li class="list-inline-item"><a href="javascript: void(0);"><i class="mdi mdi-file-document-outline"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary chat-send w-md waves-effect waves-light"><span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send"></i></button>
                                    </div>
                                </div>
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
    <script>
        // Récupérez le tableau de séries en PHP
        var seriesData = <?php echo json_encode($TotalTaches); ?>;
        var totale = <?php echo json_encode($totale); ?>; 
    
        var options = {
            series: seriesData.map(function (projet) {
                var totalTaches = projet.taches_count;
                var tachesEnCours = projet.taches_en_cours;
    
                var pourcentageEnCours = (tachesEnCours / totalTaches) * 100;
    
                return parseFloat(pourcentageEnCours).toFixed(2);
            }),
            chart: {
                height: 350,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    dataLabels: {
                        name: {
                            fontSize: '22px',
                        },
                        value: {
                            fontSize: '16px',
                        },
                        total: {
                            show: true,
                            label: 'Total',
                            formatter: function (w) {
                                return totale ; // Exemple de format personnalisé
                            }
                        }
                    }
                }
            },
            labels: <?php echo json_encode($TotalTaches->pluck('nom')->toArray()); ?>,
        };
    
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        var projectData = <?php echo json_encode($projet); ?>;
        var percentageData = <?php echo json_encode($percentage); ?>;

        var projectNames = projectData.map(function (project) {
            return project.nom;
        });

        var percentages = Object.values(percentageData).map(function (percentage) {
            return percentage > 0 ? parseFloat(percentage).toFixed(2) : 0;
        });
        var options = {
          series: [{
          name: 'Pourcentage d\'évolution',
          data: percentages
        }],
          chart: {
          height: 350,
          type: 'bar',
        },
        plotOptions: {
          bar: {
            borderRadius: 10,
            dataLabels: {
              position: 'top', // top, center, bottom
            },
          }
        },
        dataLabels: {
          enabled: true,
          formatter: function (val) {
            return val + "%";
          },
          offsetY: -20,
          style: {
            fontSize: '12px',
            colors: ["#304758"]
          }
        },
        
        xaxis: {
          categories: projectNames,
          position: 'top',
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false
          },
          crosshairs: {
            fill: {
              type: 'gradient',
              gradient: {
                colorFrom: '#D8E3F0',
                colorTo: '#BED1E6',
                stops: [0, 100],
                opacityFrom: 0.4,
                opacityTo: 0.5,
              }
            }
          },
          tooltip: {
            enabled: true,
          }
        },
        yaxis: {
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false,
          },
          labels: {
            show: false,
            formatter: function (val) {
              return val + "%";
            }
          }
        
        },
        title: {
          text: 'Monthly Inflation in Argentina, 2002',
          floating: true,
          offsetY: 330,
          align: 'center',
          style: {
            color: '#444'
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart_"), options);
        chart.render();
    </script>
    // <script>
    //     var projectData = <?php echo json_encode($projects); ?>;
    //     var percentageData = <?php echo json_encode($percentage); ?>;

    //     var projectNames = projectData.map(function (project) {
    //         return project.nom;
    //     });

    //     var percentages = Object.values(percentageData).map(function (percentage) {
    //         return percentage > 0 ? parseFloat(percentage).toFixed(2) : 0;
    //     });

    //     var options = {
    //         series: [{
    //             name: 'Pourcentage d\'évolution',
    //             data: percentages
    //         }],
    //                 chart: {
    //                     height: 350,
    //                     type: 'bar',
    //                 },
    //                 plotOptions: {
    //                     bar: {
    //                         borderRadius: 10,
    //                         dataLabels: {
    //                             position: 'top', // top, center, bottom
    //                         },
    //                     },
    //                 },
    //                 dataLabels: {
    //                     enabled: true,
    //                     formatter: function (val) {
    //                         return val + "%";
    //                     },
    //                     offsetY: -20,
    //                     style: {
    //                         fontSize: '12px',
    //                         colors: ["#304758"]
    //                     }
    //                 },
    //                 xaxis: {
    //                     categories: projectNames,
    //                     position: 'top',
    //                     axisBorder: {
    //                         show: false
    //                     },
    //                     axisTicks: {
    //                         show: false
    //                     },
    //                     crosshairs: {
    //                         fill: {
    //                             type: 'gradient',
    //                             gradient: {
    //                                 colorFrom: '#D8E3F0',
    //                                 colorTo: '#BED1E6',
    //                                 stops: [0, 100],
    //                                 opacityFrom: 0.4,
    //                                 opacityTo: 0.5,
    //                             }
    //                         }
    //                     },
    //                     tooltip: {
    //                         enabled: true,
    //                     }
    //                 },
    //                 yaxis: {
    //                     axisBorder: {
    //                         show: false
    //                     },
    //                     axisTicks: {
    //                         show: false,
    //                     },
    //                     labels: {
    //                         show: false,
    //                         formatter: function (val) {
    //                             return val + "%";
    //                         }
    //                     }

    //                 },
    //                 title: {
    //                     text: 'Évolution mensuelle du pourcentage d\'évolution par projet',
    //                     floating: true,
    //                     offsetY: 330,
    //                     align: 'center',
    //                     style: {
    //                         color: '#444'
    //                     }
    //                 }
    //             };
    //     var chart = new ApexCharts(document.querySelector("#columnchart"), options);
    //     chart.render();
    // </script>
</div>