<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboards</span>
                    </a>
                </li>

                
                <li class="menu-title" key="t-apps">Apps</li>

                @if (Auth::check())
                    @php
                        $userRoles = Auth::user()->permissions->pluck('id_role')->toArray();
                        $ConsultantRoles = Auth::user()->consultants->pluck('id_role')->toArray();
                    @endphp
{{-- {{dd($userRoles)}} --}}
                    @if (in_array(7, $userRoles))
                        @if (in_array(4, $ConsultantRoles))
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-task"></i>
                                    <span key="t-tasks">Tasks</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{route('liste-tache')}}" key="t-task-list">additional tasks</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-archive-in"></i>
                                    <span key="t-dashboards">Report Management</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                                            <i class="mdi mdi-18px dripicons-document"></i>
                                            <span key="t-tasks">Planification</span>
                                        </a>
                                        <ul class="sub-menu" aria-expanded="false">
                                            <li><a href="{{route('planification.apercu')}}" key="t-tui-calendar">Planification Overview</a></li>
                                            <li><a href="{{route('planification.create')}}" key="t-full-calendar">Create New </a></li>
                                            
                                            {{-- @if (!empty(array_intersect(["Responsable", "Admin"], $userRoles)))
                                            
                                                <li>
                                                    <a href="{{route('histoire-planification')}}" class="waves-effect">
                                                        <span key="t-chat">Historique Planification</span>
                                                    </a>
                                                </li>
                                            @endif --}}
                                        </ul>
                                    </li>
            
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                                            <i class="bx bx-note"></i>
                                            <span key="t-tasks">Rapport</span>
                                        </a>
                                        <ul class="sub-menu" aria-expanded="false">
                                            <li><a href="{{route('rapport-journalier')}}" key="t-create-task">rapport journalier</a></li>
                                            @if (!in_array(4, $userRoles))
                                                <li><a href="{{route('rapport-semaine')}}" key="t-create-task">rapport semaine</a></li>
                                            @endif
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        @else

                            {{-- <li>
                                <a href="{{route('chat')}}" class="waves-effect">
                                    <i class="bx bx-chat"></i>
                                    <span key="t-chat">Chat</span>
                                </a>
                            </li> --}}

                            {{-- <li>
                                <a href="{{route('histoire-rapport')}}" class="waves-effect">
                                    <i class="bx bx-chat"></i>
                                    <span key="t-chat">historique</span>
                                </a>
                            </li> --}}

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="mdi mdi-24px mdi-account"></i>
                                    <span key="t-dashboards">User management</span>
                                </a>
                                @if (in_array(5, $ConsultantRoles))
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="{{ route('list-utilisateur') }}" key="t-tui-calendar">List of users</a></li>
                                        
                                    </ul>
                                @else
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="{{ route('list-utilisateur') }}" key="t-tui-calendar">List of users</a></li>
                                        @if (in_array(1, $ConsultantRoles))
                                            <li><a href="{{ route('departement') }}" key="t-full-calendar">Departements</a></li>
                                        @endif
                                        
                                        <li><a href="{{ route('filiale') }}" key="t-full-calendar">Filiales</a></li>
                                        <li><a href="{{ route('service') }}" key="t-full-calendar">Services</a></li>
                                    </ul>
                                @endif
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-briefcase-alt-2"></i>
                                    <span key="t-projects">Projects</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('liste-projet') }}" key="t-p-list">Projects List</a></li>
                                    @if (!in_array(5, $ConsultantRoles))
                                        <li><a href="{{ route('create-projet') }}" key="t-create-new">Create New</a></li>
                                        <li><a href="{{ route('planification.projet') }}" key="t-full-calendar">Planification Projet</a></li>
                                    @endif
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-task"></i>
                                    <span key="t-tasks">Tasks</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{route('liste-tache')}}" key="t-task-list">Task List</a></li>
                                    <li><a href="{{route('create-tache')}}" key="t-create-task">Create Task</a></li>
                                    <li><a href="{{route('taches-supplementaire')}}" key="t-task-list">view additional tasks</a></li>
                                    <li><a href="{{route('form-taches')}}" key="t-task-list">additional tasks</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-archive-in"></i>
                                    <span key="t-dashboards">Report Management</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                                            <i class="mdi mdi-18px dripicons-document"></i>
                                            <span key="t-tasks">Planification</span>
                                        </a>
                                        <ul class="sub-menu" aria-expanded="false">
                                            <li><a href="{{route('planification.apercu')}}" key="t-tui-calendar">Planification Overview</a></li>
                                            <li><a href="{{route('planification.create')}}" key="t-full-calendar">Create New </a></li>
                                            
                                            {{-- @if (!empty(array_intersect(["Responsable", "Admin"], $userRoles)))
                                            
                                                <li>
                                                    <a href="{{route('histoire-planification')}}" class="waves-effect">
                                                        <span key="t-chat">Historique Planification</span>
                                                    </a>
                                                </li>
                                            @endif --}}
                                        </ul>
                                    </li>
            
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                                            <i class="bx bx-note"></i>
                                            <span key="t-tasks">Rapport</span>
                                        </a>
                                        <ul class="sub-menu" aria-expanded="false">
                                            <li><a href="{{route('rapport-journalier')}}" key="t-create-task">rapport journalier</a></li>
                                            @if (!in_array(4, $userRoles))
                                                <li><a href="{{route('rapport-semaine')}}" key="t-create-task">rapport semaine</a></li>
                                            @endif
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    @else
                        @if (in_array(4, $userRoles))
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-task"></i>
                                    <span key="t-tasks">Tasks</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{route('form-taches')}}" key="t-task-list">additional tasks</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-archive-in"></i>
                                    <span key="t-dashboards">Report Management</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                                            <i class="mdi mdi-18px dripicons-document"></i>
                                            <span key="t-tasks">Planification</span>
                                        </a>
                                        <ul class="sub-menu" aria-expanded="false">
                                            <li><a href="{{route('planification.apercu')}}" key="t-tui-calendar">Planification Overview</a></li>
                                            <li><a href="{{route('planification.create')}}" key="t-full-calendar">Create New </a></li>
                                            
                                            {{-- @if (!empty(array_intersect(["Responsable", "Admin"], $userRoles)))
                                            
                                                <li>
                                                    <a href="{{route('histoire-planification')}}" class="waves-effect">
                                                        <span key="t-chat">Historique Planification</span>
                                                    </a>
                                                </li>
                                            @endif --}}
                                        </ul>
                                    </li>
            
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                                            <i class="bx bx-note"></i>
                                            <span key="t-tasks">Rapport</span>
                                        </a>
                                        <ul class="sub-menu" aria-expanded="false">
                                            <li><a href="{{route('rapport-journalier')}}" key="t-create-task">rapport journalier</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        @else

                            {{-- <li>
                                <a href="{{route('chat')}}" class="waves-effect">
                                    <i class="bx bx-chat"></i>
                                    <span key="t-chat">Chat</span>
                                </a>
                            </li> --}}

                            {{-- <li>
                                <a href="{{route('histoire-rapport')}}" class="waves-effect">
                                    <i class="bx bx-chat"></i>
                                    <span key="t-chat">historique</span>
                                </a>
                            </li> --}}

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="mdi mdi-24px mdi-account"></i>
                                    <span key="t-dashboards">User management</span>
                                </a>
                                @if (in_array(5, $userRoles))
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="{{ route('list-utilisateur') }}" key="t-tui-calendar">List of users</a></li>
                                        
                                    </ul>
                                @else
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="{{ route('list-utilisateur') }}" key="t-tui-calendar">List of users</a></li>
                                        @if (in_array(1, $userRoles))
                                            <li><a href="{{ route('departement') }}" key="t-full-calendar">Departements</a></li>
                                        @endif
                                        
                                        <li><a href="{{ route('filiale') }}" key="t-full-calendar">Filiales</a></li>
                                        <li><a href="{{ route('service') }}" key="t-full-calendar">Services</a></li>
                                    </ul>
                                @endif
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-briefcase-alt-2"></i>
                                    <span key="t-projects">Projects</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('liste-projet') }}" key="t-p-list">Projects List</a></li>
                                    @if (!in_array(5, $userRoles))
                                        <li><a href="{{ route('create-projet') }}" key="t-create-new">Create New</a></li>
                                        <li><a href="{{ route('planification.projet') }}" key="t-full-calendar">Planification Projet</a></li>
                                    @endif
                                </ul>
                            </li>
                            
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-task"></i>
                                    <span key="t-tasks">Tasks</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{route('liste-tache')}}" key="t-task-list">Task List</a></li>
                                    <li><a href="{{route('create-tache')}}" key="t-create-task">Create Task</a></li>
                                    <li><a href="{{route('taches-supplementaire')}}" key="t-task-list">view additional tasks</a></li>
                                    <li><a href="{{route('form-taches')}}" key="t-task-list">additional tasks</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-archive-in"></i>
                                    <span key="t-dashboards">Report Management</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                                            <i class="mdi mdi-18px dripicons-document"></i>
                                            <span key="t-tasks">Planification</span>
                                        </a>
                                        <ul class="sub-menu" aria-expanded="false">
                                            <li><a href="{{route('planification.apercu')}}" key="t-tui-calendar">Planification Overview</a></li>
                                            <li><a href="{{route('planification.create')}}" key="t-full-calendar">Create New </a></li>
                                            
                                            {{-- <li>
                                                <a href="{{route('histoire-planification')}}" class="waves-effect">
                                                    <span key="t-chat">Historique Planification</span>
                                                </a>
                                            </li> --}}
                                        </ul>
                                    </li>
            
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                                            <i class="bx bx-note"></i>
                                            <span key="t-tasks">Rapport</span>
                                        </a>
                                        <ul class="sub-menu" aria-expanded="false">
                                            <li><a href="{{route('rapport-journalier')}}" key="t-create-task">rapport journalier</a></li>
                                            @if (!in_array(4, $userRoles))
                                                <li><a href="{{route('rapport-semaine')}}" key="t-create-task">rapport semaine</a></li>
                                            @endif
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    @endif
        
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>