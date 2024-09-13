<?php


namespace App\Http\Controllers\Back;

use App\Http\{
    Controllers\Controller,

};
use App\Models\Inscription;
use App\Http\Requests\StoreInscriptionRequest;
use App\Http\Requests\UpdateInscriptionRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInscriptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
      /*   $request->validate([
            'hopital_id' => 'nullable|exists:hopitals,id',
            'specialites' => 'nullable|array',
            'specialites.*' => 'exists:specialites,id',
            'nom' => 'nullable|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'age' => 'nullable|integer',
            'taille' => 'nullablenumeric',
            'poids' => 'nullable|numeric',
            'message' => 'nullable|string',
        ]); */
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
          
            
            'message' => 'nullable|string',
            'filieres' => 'required|array',
        ]);
        $user = Auth::user();

        // Create a new consultation
        $consultation = new Inscription();
        $consultation->ecole_id = $request->ecole_id;
        $consultation->user_id = $user->id; // Associate the consultation with the authenticated user
               // $consultation->specialites()->sync($request->input('specialites')); // Sync the specialties with the consultation
        $consultation->nom = $request->input('nom');
        $consultation->prenom = $request->input('prenom');
        $consultation->email = $request->input('email');


 
        $consultation->message = $request->input('message');
        $consultation->save();
        
      //  dd($consultation);

      

        // Attach the selected specialties to the consultation
        $consultation->filieres()->attach($request->input('filieres'));
       

        // Redirect or return a response
        return back()->with('success', 'Consultation enregistrée avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inscription  $inscription
     * @return \Illuminate\Http\Response
     */
    public function show(Inscription $inscription)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inscription  $inscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Inscription $inscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInscriptionRequest  $request
     * @param  \App\Models\Inscription  $inscription
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInscriptionRequest $request, Inscription $inscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inscription  $inscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inscription $inscription)
    {
        //
    }
}
