<?php


namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;

use App\Models\Inscription;
use App\Http\Requests\StoreInscriptionRequest;
use App\Http\Requests\UpdateInscriptionRequest;
use App\Notifications\InscriptionConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\ConfirmationMail;
use Illuminate\Support\Facades\Mail;


class InscriptionController extends Controller
{

    public function store(Request $request)
{
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'telephone' => 'required|string|max:255',
        'message' => 'nullable|string',
        'filieres' => 'required|array',
    ]);

    try {
      
        if (Auth::check()) {
            $user = Auth::user();
            $userId = $user->id;
        } else {
           
            $userId = null;
        }
        
        $consultation = new Inscription();
        $consultation->ecole_id = $request->ecole_id;
        $consultation->user_id = $userId; 
        $consultation->nom = $request->input('nom');
        $consultation->prenom = $request->input('prenom');
        $consultation->email = $request->input('email');
        $consultation->telephone = $request->input('telephone');
        $consultation->message = $request->input('message');
        $consultation->save();

    
        $consultation->filieres()->attach($request->input('filieres'));

        Mail::to($consultation->email)->send(new ConfirmationMail($consultation));
        return back()->with('success', 'Consultation enregistrée avec succès.');

    } catch (\Exception $e) {
        return back()->with('error', 'Une erreur s\'est produite lors de l\'enregistrement. Veuillez réessayer.');
    }
}

  
    public function store1(Request $request)
    {
   
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:255',
          
            
            'message' => 'nullable|string',
            'filieres' => 'required|array',
        ]);
        $user = Auth::user();

      
        $consultation = new Inscription();
        $consultation->ecole_id = $request->ecole_id;
        $consultation->user_id = $user->id; 
               
        $consultation->nom = $request->input('nom');
        $consultation->prenom = $request->input('prenom');
        $consultation->email = $request->input('email');
        $consultation->telephone = $request->input('telephone');


 
        $consultation->message = $request->input('message');
        $consultation->save();
        
      //  dd($consultation);

      

        // Attach the selected specialties to the consultation
        $consultation->filieres()->attach($request->input('filieres'));
       
 // Envoi de l'email de confirmation
 //$consultation->notify(new InscriptionConfirmation($consultation));


      
        return back()->with('success', 'Consultation enregistrée avec succès.');
    }

}
