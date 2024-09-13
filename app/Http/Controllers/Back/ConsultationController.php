<?php

namespace App\Http\Controllers\Back;

use App\Http\{
    Controllers\Controller,

};

use App\Models\Consultation;
use App\Http\Requests\StoreConsultationRequest;
use App\Http\Requests\UpdateConsultationRequest;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Hopital;
use App\Models\Specialites;

class ConsultationController extends Controller
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
     * @param  \App\Http\Requests\StoreConsultationRequest  $request
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
            'age' => 'nullable|integer',    // If 'age' can be null, use 'nullable|integer'
            'taille' => 'nullable|numeric', // If 'taille' can be null, use 'nullable|numeric'
            'poids' => 'nullable|numeric',  // If 'poids' can be null, use 'nullable|numeric'
            'message' => 'nullable|string',
            'specialites' => 'required|array',
        ]);

        // Create a new consultation
        $consultation = new Consultation();
        $consultation->hopital_id = $request->hopital_id;
        
       // $consultation->specialites()->sync($request->input('specialites')); // Sync the specialties with the consultation
        $consultation->nom = $request->input('nom');
        $consultation->prenom = $request->input('prenom');
        $consultation->email = $request->input('email');
        $consultation->age = $request->input('age');
        $consultation->taille = $request->input('taille');
        $consultation->poids = $request->input('poids');
        $consultation->message = $request->input('message');
        $consultation->save();
       // dd($consultation);

      

        // Attach the selected specialties to the consultation
        $consultation->specialites()->attach($request->input('specialites'));
       

        // Redirect or return a response
        return back()->with('success', 'Consultation enregistrée avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $consultation = Consultation::with('hopital')->findOrFail($id);
       // $user = User::find($commande->user_id);
        // dd($commande);
        return view('back.consultations.show', compact('consultation'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function edit(Consultation $consultation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateConsultationRequest  $request
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConsultationRequest $request, Consultation $consultation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consultation $consultation)
    {
        //
    }
}
