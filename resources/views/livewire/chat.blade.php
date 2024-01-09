<div>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Chat</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Skote</a></li>
                                    <li class="breadcrumb-item active">Chat</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="d-lg-flex">
                    <div class="chat-leftsidebar me-lg-4">
                        <div class="">
                            <div class="py-4 border-bottom">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 align-self-center me-3">
                                        <img src="assets/images/users/avatar-1.jpg" class="avatar-xs rounded-circle" alt="">
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15 mb-1">Henry Wells</h5>
                                        <p class="text-muted mb-0"><i class="mdi mdi-circle text-success align-middle me-1"></i> Active</p>
                                    </div>

                                </div>
                            </div>

                            <div class="search-box chat-search-box py-4">
                                <div class="position-relative">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <i class="bx bx-search-alt search-icon"></i>
                                </div>
                            </div>

                            <div class="chat-leftsidebar-nav">
                                <ul class="nav nav-pills nav-justified">
                                    <li class="nav-item">
                                        <a href="#chat" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                            <i class="bx bx-chat font-size-20 d-sm-none"></i>
                                            <span class="d-none d-sm-block">Chat</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#groups" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                            <i class="bx bx-group font-size-20 d-sm-none"></i>
                                            <span class="d-none d-sm-block">Groups</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#contacts" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                            <i class="bx bx-book-content font-size-20 d-sm-none"></i>
                                            <span class="d-none d-sm-block">Contacts</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content py-4">
                                    <div class="tab-pane show active" id="chat">
                                        <div>
                                            <h5 class="font-size-14 mb-3">Recent</h5>
                                            <ul class="list-unstyled chat-list" data-simplebar style="max-height: 410px;">
                                                @foreach ($recentContacts as $contact)
                                                    <li class="active">
                                                        <a href="javascript:void(0);">
                                                            <div class="d-flex">
                                                                <div class="flex-shrink-0 align-self-center me-3">
                                                                    <i class="mdi mdi-circle font-size-10"></i>
                                                                </div>
                                                                <div class="flex-shrink-0 align-self-center me-3">
                                                                    <img src="{{ asset('path/to/avatar/' . $contact->avatar) }}" class="rounded-circle avatar-xs" alt="{{ $contact->name }}">
                                                                </div>
                                                                <div class="flex-grow-1 overflow-hidden">
                                                                    <h5 class="text-truncate font-size-14 mb-1">{{ $contact->name }}</h5>
                                                                    <!-- Ajoutez ici la logique pour afficher le dernier message si nécessaire -->
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    

                                    <div class="tab-pane" id="groups">
                                        <h5 class="font-size-14 mb-3">Groups</h5>
                                        <ul class="list-unstyled chat-list" data-simplebar style="max-height: 410px;">
                                            <li>
                                                <a href="javascript: void(0);">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-xs">
                                                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                                    G
                                                                </span>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="flex-grow-1">
                                                            <h5 class="font-size-14 mb-0">General</h5>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="javascript: void(0);">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-xs">
                                                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                                    R
                                                                </span>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="flex-grow-1">
                                                            <h5 class="font-size-14 mb-0">Reporting</h5>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="javascript: void(0);">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-xs">
                                                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                                    M
                                                                </span>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="flex-grow-1">
                                                            <h5 class="font-size-14 mb-0">Meeting</h5>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="javascript: void(0);">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-xs">
                                                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                                    A
                                                                </span>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="flex-grow-1">
                                                            <h5 class="font-size-14 mb-0">Project A</h5>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="javascript: void(0);">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-xs">
                                                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                                    B
                                                                </span>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="flex-grow-1">
                                                            <h5 class="font-size-14 mb-0">Project B</h5>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="tab-pane" id="contacts">
                                        <h5 class="font-size-14 mb-3">Contacts</h5>
                                    
                                        <div data-simplebar style="max-height: 410px;">
                                            @foreach ($usersByAlphabet as $letter => $users)
                                                <div class="mt-4">
                                                    <div class="avatar-xs mb-3">
                                                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                            {{ $letter }}
                                                        </span>
                                                    </div>
                                    
                                                    <ul class="list-unstyled chat-list">
                                                        @foreach ($users as $user)
                                                            <li>
                                                                <a href="{{ route('chat-user',['recipientId' => $user->id]) }}">
                                                                    <h5 class="font-size-14 mb-0">{{ $user->name }}</h5>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="w-100 user-chat">
                        <div class="card">
                            <div class="p-4 border-bottom ">
                                <div class="row">
                                    <div class="col-md-4 col-9">
                                        <h5 class="font-size-15 mb-1">Steven Franklin</h5>
                                        <p class="text-muted mb-0"><i class="mdi mdi-circle text-success align-middle me-1"></i> Active now</p>
                                    </div>
                                    <div class="col-md-8 col-3">
                                        <ul class="list-inline user-chat-nav text-end mb-0">
                                            <li class="list-inline-item d-none d-sm-inline-block">
                                                <div class="dropdown">
                                                    <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bx bx-search-alt-2"></i>
                                                    </button>
                                                    <div id="messages-container" class="dropdown-menu dropdown-menu-end dropdown-menu-md">
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
                                                    <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                                    <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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


                            <div>
                                <div class="chat-conversation p-3">
                                    <ul class="list-unstyled mb-0" data-simplebar style="max-height: 486px;">
                                        <li> 
                                            <div class="chat-day-title">
                                                <span class="title">Today</span>
                                            </div>
                                        </li>

                                        <div >
                                            <div  class=" chat-conversation p-3">
                                                <ul id="chat-messages" class="list-unstyled mb-0" data-simplebar style="max-height: 486px;">
                                                    @foreach ($messages as $message)
                                                        <li  class="{{ $message->user_id === Auth::id() ? 'right' : '' }}">
                                                            <div class="conversation-list">
                                                                <!-- Contenu du message ici -->
                                                                <div class="ctext-wrap">
                                                                    <div class="conversation-name">{{ $message->user->name }}</div>
                                                                    <p>{{ $message->content }}</p>
                                                                    <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i>{{ $message->created_at->format('H:i') }}</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        
                                        </div>
                                    </ul>
                                </div>
                                <div class="p-3 chat-input-section">
                                    <div class="row">
                                        <div class="col">
                                            <div class="position-relative">
                                                <input type="text" wire:model="newMessage" class="form-control chat-input" placeholder="Enter Message...">
                                                <div class="chat-input-links" id="tooltip-container">
                                                    <ul class="list-inline mb-0">
                                                        <li class="list-inline-item"><a href="javascript: void(0);" title="Emoji"><i class="mdi mdi-emoticon-happy-outline"></i></a></li>
                                                        <li class="list-inline-item"><a href="javascript: void(0);" title="Images"><i class="mdi mdi-file-image-outline"></i></a></li>
                                                        <li class="list-inline-item"><a href="javascript: void(0);" title="Add Files"><i class="mdi mdi-file-document-outline"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button wire:click="sendMessage" class="btn btn-primary btn-rounded chat-send w-md waves-effect waves-light"><span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send"></i></button>
                                        </div>
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
</div>
<script>
    Livewire.on('newMessage', () => {
        // Mettre à jour les messages sans recharger la page
        Livewire.emit('getMessages');
    });
</script>
<script>
    Livewire.on('newMessage', () => {
        // Mettre à jour les messages sans recharger la page
        Livewire.emit('getMessages');

        // Faire défiler automatiquement vers le bas du conteneur des messages
        let chatMessages = document.getElementById('chat-messages');
        chatMessages.scrollTop = chatMessages.scrollHeight;
    });
</script>

