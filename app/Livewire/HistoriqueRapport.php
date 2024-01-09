<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class HistoriqueRapport extends Component
{
    public $folderName;
    public $folders;
    public $currentPath = '';
    public $newFolderName = '';

    public function mount($path = '')
    {
        $this->folders = $this->getFolders();
        $this->currentPath = $path;
    }

    public function createFolder()
    {
        $path = storage_path('uploads/' . $this->folderName);

        if (!file_exists($path)) {
            mkdir($path, 0777, true);

            session()->flash('message', 'Dossier créé avec succès.');
        } else {
            session()->flash('error', 'Le dossier existe déjà.');
        }

        $this->folders = $this->getFolders();
        
        $this->reset('folderName');
    }

    private function getFolders()
{
    $path = public_path('uploads');

    return array_diff(scandir($path), ['.', '..']);
}


    public function render()
    {
        $files = Storage::files($this->currentPath);
        $directories = Storage::directories($this->currentPath);

        return view('livewire.historique-rapport', [
            'files' => $files,
            'directories' => $directories,
        ])->extends('layouts.guest')->section('content');
    }

    public function openDirectory($directory)
    {
        $this->currentPath = $directory;
    }

    public function renameFolder($oldPath)
    {
        if ($this->newFolderName !== '') {
            $newPath = dirname($oldPath) . '/' . $this->newFolderName;

            Storage::move($oldPath, $newPath);

            $this->currentPath = $newPath;
        }

        $this->newFolderName = '';
    }

    public function deleteFolder($path)
    {
        Storage::deleteDirectory($path);

        $this->currentPath = dirname($path);
    }
}


