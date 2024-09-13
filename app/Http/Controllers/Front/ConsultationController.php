<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;

use App\Models\Consultation;
use App\Http\Requests\StoreConsultationRequest;
use App\Http\Requests\UpdateConsultationRequest;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Mail\ConsultationConfirmed;
use Illuminate\Support\Facades\Mail;
use App\Models\Hopital;
use App\Models\Specialites;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{

    public function store(Request $request)
    {
      
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',

            'age' => 'nullable|integer',    
            'taille' => 'nullable|numeric', 
            'poids' => 'nullable|numeric',  
            'message' => 'nullable|string',
            'specialites' => 'required|array',
        ]);

        
        $consultation = new Consultation();
        $consultation->hopital_id = $request->hopital_id;
        
     
        $consultation->nom = $request->input('nom');
        $consultation->prenom = $request->input('prenom');
        $consultation->email = $request->input('email');
        $consultation->age = $request->input('telephone');
        $consultation->age = $request->input('age');
        $consultation->taille = $request->input('taille');
        $consultation->poids = $request->input('poids');
        $consultation->message = $request->input('message');
        $consultation->save();
      

      

        
        $consultation->specialites()->attach($request->input('specialites'));
       
        Mail::to($consultation->email)->send(new ConsultationConfirmed($consultation));
      
        return back()->with('success', 'Consultation enregistrée avec succès.');
    }

}
