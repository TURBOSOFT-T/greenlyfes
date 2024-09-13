<?php
namespace App\Http\Controllers\Back;

use App\DataTables\ProductsDataTable;
use App\Http\{
    Controllers\Controller,
};

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Config;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Mail\InvoiceMail;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

use RealRashid\SweetAlert\Facades\Alert;
//use Illuminate\Support\Facade\Mail;

use Illuminate\Support\Facades\Hash;
use PDF;

use Cart;
class OrderController extends Controller
{

  public function index()
    {   
         $commandes = Order::with('products')->latest()->paginate(10);

      //  dd($commandes);
        return view('back.commandes.index', compact('commandes'));
    }



    public function show($id)
    {
        $commande = Order::with('products')->findOrFail($id);
        $user = User::find($commande->user_id);
        // dd($commande);
        return view('back.commandes.show', compact('commande', 'user'));

    }

    public function edit($id)
    {
        $commande = Order::with('products')->findOrFail($id);
        $user = User::find($commande->user_id);
        // dd($commande);
        return view('back.commandes.edit', compact('commande', 'user'));
    }

    public function update(UpdateOrderRequest $request, $id)
    {
        $commande = Order::with('products')->findOrFail($id);
        $commande->update($request->all());
        // dd($commande);
       
        return redirect()->route('admin.commandes.index');
    }

    public function destroy($id)
    {
        $commande = Order::findOrFail($id);
        $commande->delete();
      
return back()->with('success', 'Order has been deleted successfully.');
    }

   

public function generateInvoice($id)
{
    $commande = Order::findOrFail($id);

    // Charger la vue de la facture avec les détails de la commande
    $pdf = FacadePdf::loadView('commandes.facture', compact('commande'));

    // Télécharger la facture en PDF
    return $pdf->download('facture_commande_' . $commande->id . '.pdf');
}



public function sendInvoice($id)
{
    $commande = Order::findOrFail($id);

    // Générer la facture PDF
    $pdf = FacadePdf::loadView('commandes.facture', compact('commande'));

    // Envoyer l'email avec la facture en pièce jointe
    Mail::to($commande->email)->send(new InvoiceMail($commande, $pdf));

    return redirect()->route('commandes.index')->with('success', 'Facture envoyée avec succès.');
}


  


}