<?php

namespace App\Livewire;

use App\Models\Chat;
use App\Models\User;
use Livewire\Component;
use App\Events\MyEventName;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChatComposant extends Component
{
    public $messages;
    public $newMessage;
    public $recipientId; 
    public $user;
    public $recentContacts;
    
    protected $listeners = ['messages-updated' => 'getMessages'];

    public function mount($recipientId)
    {
        $this->recipientId = $recipientId;
        $this->getMessages();
        $this->recentContacts = $this->getRecentContacts();
    }
    // public function mount()
    // {
    //     $lastUser = Chat::latest()->value('recipient_id');
    //     $recipientId = $lastUser;

    //     $this->messages = Chat::where(function ($query) use ($recipientId) {
    //         $query->where('user_id', Auth::id())
    //             ->where('recipient_id', $recipientId);
    //     })->orWhere(function ($query) use ($recipientId) {
    //         $query->where('user_id', $recipientId)
    //             ->where('recipient_id', Auth::id());
    //     })->orderBy('created_at')->get();
        
    //     $this->recentContacts = $this->getRecentContacts();
    // }

    public function render()
    {
        $users = User::where('status','activer')->orderBy('name')->get();

        $usersByAlphabet = $users->groupBy(function ($item) {
            return strtoupper(substr($item->name, 0, 1));
        })->sortKeys();

        return view('livewire.chat', [
            'usersByAlphabet' => $usersByAlphabet
            ])->extends('layouts.guest')->section('content');
    }

    public function sendMessage()
    {
        Chat::create([
            'content' => $this->newMessage,
            'user_id' => Auth::id(),
            'recipient_id' => $this->recipientId,
        ]);

        $this->newMessage = '';
        $this->messages = Chat::where(function ($query) {
            $query->where('user_id', Auth::id())
                ->where('recipient_id', $this->recipientId);
        })->orWhere(function ($query) {
            $query->where('user_id', $this->recipientId)
                ->where('recipient_id', Auth::id());
        })->orderBy('created_at')->get();

        $this->dispatch('newMessage');
    }

    public function getRecentContacts()
    {
        // Récupérer la liste des utilisateurs avec qui l'utilisateur actuel a parlé, triée par la date du dernier message
        return User::select('users.*')
            ->join('chats', function ($join) {
                $join->on('users.id', '=', 'chats.user_id')
                    ->orWhere('users.id', '=', 'chats.recipient_id')
                    ->whereNotNull('chats.content'); // Assurez-vous que le message n'est pas vide
            })
            ->where(function ($query) {
                $query->where('chats.user_id', Auth::id())
                    ->orWhere('chats.recipient_id', Auth::id());
            })
            ->groupBy('users.id', 'users.name')
            ->orderByDesc(\DB::raw('MAX(chats.created_at)'))
            ->get();
    }

    public function getMessages()
    {
        $this->messages = Chat::where(function ($query) {
            $query->where('user_id', Auth::id())
                ->where('recipient_id', $this->recipientId);
        })->orWhere(function ($query) {
            $query->where('user_id', $this->recipientId)
                ->where('recipient_id', Auth::id());
        })->orderBy('created_at')->get();

        
        $this->dispatch('messagesUpdated');
    }

}

