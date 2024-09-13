<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\config;
use Illuminate\Support\Facades\Storage;

use Livewire\WithFileUploads;
class Configurations extends Component
{
    use WithFileUploads;
    public $logo,$icon,$logo2,$icon2,$frais, $logoHeader, $telephone,$addresse, $email,$description; 

    public function mount(){
        $config = config::first();
        $this->logo2 = $config->logo;
        $this->icon2 = $config->icon;
        $this->frais = $config->frais;
        $this->logoHeader= $config->logoHeader;
        $this->email=$config->email;
        $this->telephone=$config->telephone;
        $this->addresse=$config->addresse;
        $this->description=$config->description;

    }
    public function update_form(){
        // valid all form fields as nulable
        $this->validate([
            'logo' =>  'image|nullable|max:2024',   // 1MB Max
          //  'logoHeader' =>  'image|nullable|max:2024',   // 1MB Max
            'icon' =>  'image|nullable|max:2024',//
            'frais' => 'nullable|numeric',
            'telephone' => 'nullable|numeric',
            'email' => 'nullable',
            'addresse' => 'nullable|string',
            'description' => 'nullable|string|max:1000',
        ]);

        // update the user
        $config = config::first();
        if($this->logo){
            //delete old logo
            if ($this->logo2) {
                Storage::disk('public')->delete($this->logo2);
            }
            $config->logo= $this->logo->store('logo', 'public');
        }
        if($this->logoHeader){
            //delete old logo
            if ($this->logoHeader2) {
                Storage::disk('public')->delete($this->logoHeader2);
            }
            $config->logoHeader= $this->logoHeader->store('logoHeader', 'public');
        }

        if($this->icon){
            //delete old icon
            if ($this->icon2) {
                Storage::disk('public')->delete($this->icon2);
            }
            $config->icon= $this->icon->store('icon', 'public');
        }
        $config->frais = $this->frais;
        $config->telephone = $this->telephone;
        $config->email = $this->email;
        $config->addresse = $this->addresse;
        $config->description = $this->description;

        if($config->save()){
            //flash message
            session()->flash('info', 'Vos modifications ont été enregistrées.');
        }else{
            //flash message
            session()->flash('danger', 'Vos modifications n\'ont pas été enregistrées.');
        }
    }
    public function render()
    {
        return view('livewire.configurations');
    }
}
