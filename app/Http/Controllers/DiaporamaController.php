<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{Diaporama};
use App\Http\Requests\StoreDiaporamaRequest;
use App\Http\Requests\UpdateDiaporamaRequest;
use Imagick;

use App\Models\Pdf ;
use App\Models\PdfImage;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DiaporamaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $pdfs = Pdf::with('images')->get();
        return view('back.diaporama.index', compact('pdfs'));
    }

  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('back.diaporama.create');
    }


    public function store(Request $request)
    {
        // Validation du fichier PDF
        $request->validate([
            'pdf' => 'required|mimes:pdf|max:100240', // Limite de 10Mo
        ]);

        // Stockage du fichier PDF
        $filePath = $request->file('pdf')->store('pdfs', 'public');
        $fileName = $request->file('pdf')->getClientOriginalName();

        // Création de l'enregistrement PDF
        $pdf = Pdf::create([
            'file_name' => $fileName,
            'file_path' => $filePath,
        ]);

        // Conversion du PDF en images et stockage dans un tableau
        $imageData = $this->convertPdfToImages($pdf);

        // Insertion des images dans la base de données à partir du tableau
        foreach ($imageData as $image) {
            PdfImage::create([
                'pdf_id' => $pdf->id,
                'image_path' => $image['image_path'],
                'page_number' => $image['page_number'],
            ]);
        }

        return redirect()->route('pdfs.index')->with('success', 'PDF téléchargé et images converties avec succès.');
    }

    /**
     * Convert the uploaded PDF to images and store the image data in an array.
     *
     * @param Pdf $pdf
     * @return array
     */
    private function convertPdfToImages(Pdf $pdf)
    {
        $pdfPath = storage_path('app/public/' . $pdf->file_path);
        $outputPath = storage_path('app/public/pdf_images/' . $pdf->id);

        // Conversion PDF -> Image
        $pdfImage = new Pdf($pdfPath);
        $numPages = $pdfImage->getNumberOfPages();

        $imageData = [];  // Tableau pour stocker les informations des images

        for ($page = 1; $page <= $numPages; $page++) {
            $imagePath = $outputPath . '_page_' . $page . '.jpg';
            
            // Conversion de la page en image
            $pdfImage->setPage($page)->saveImage($imagePath);

            // Stocker les informations de l'image dans le tableau
            $imageData[] = [
                'image_path' => 'pdf_images/' . $pdf->id . '_page_' . $page . '.jpg',
                'page_number' => $page,
            ];
        }

        return $imageData;  // Retourne le tableau contenant les informations des images
    }

    private function convertPdfToImages22(Pdf $pdf)
    {
        // Assuming you are using Imagick or another PDF to image library
        $imagick = new \Imagick(storage_path('app/public/' . $pdf->file_path));
        $numPages = $imagick->getNumberImages();

        for ($page = 0; $page < $numPages; $page++) {
            $imagick->setIteratorIndex($page);
            $imagePath = 'pdf_images/' . $pdf->id . '_page_' . ($page + 1) . '.jpg';
            $imagick->writeImage(storage_path('app/public/' . $imagePath));

            // Store image record in the database
            PdfImage::create([
                'pdf_id' => $pdf->id,
                'image_path' => $imagePath,
                'page_number' => $page + 1,
            ]);
        }

        $imagick->clear();
    }
    public function store1(Request $request)
    {
        // Validation du fichier PDF
        $validator = Validator::make($request->all(), [
            'pdf' => 'required|file|mimes:pdf|max:100240', // Validation du fichier PDF
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Sauvegarde du fichier PDF
        $file = $request->file('pdf');
        $filePath = $file->store('pdfs', 'public'); // Stockage dans le répertoire public

        // Création de l'enregistrement du PDF dans la base de données
        $pdf = Pdf::create([
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $filePath,
        ]);

        // Chemin complet du fichier PDF
        $pdfPath = storage_path('app/public/' . $filePath);

        // Convertir le PDF en images
        $pdfInstance = new Pdf($pdfPath);
        $pageCount = $pdfInstance->getNumberOfPages();

        // Générer une image pour chaque page du PDF
        foreach (range(1, $pageCount) as $pageNumber) {
            // Définir le chemin de l'image pour chaque page
            $imagePath = "pdf_images/page_{$pageNumber}_{$pdf->id}.jpg";

            // Sauvegarder l'image
            $pdfInstance->setPage($pageNumber)
                ->saveImage(storage_path("app/public/{$imagePath}"));

            // Enregistrer l'image générée dans la base de données
            PdfImage::create([
                'pdf_id' => $pdf->id,
                'image_path' => $imagePath,
                'page_number' => $pageNumber,
            ]);
        }

        // Rediriger avec un message de succès
        return redirect()->route('diaporamas.index')->with('success', 'PDF et images téléchargés avec succès!');
    }


    public function store2(Request $request)
    {
        // Validation du fichier PDF
        $request->validate([
            'pdf' => 'required|file|mimes:pdf|max:102400', // 100MB max
        ]);
    
        // Stocker le fichier PDF
        $file = $request->file('pdf');
        $filePath = $file->store('pdfs', 'public');
    
        // Enregistrer le PDF en base de données
        $pdfRecord = PdfModel::create([
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $filePath,
        ]);
    
        // Convertir PDF en images
        $pdfPath = storage_path("app/public/{$filePath}");
        $pdf = new Pdf($pdfPath);
        $totalPages = $pdf->getNumberOfPages();
    
        for ($i = 1; $i <= $totalPages; $i++) {
            $imageName = "pdf_images/page_{$i}_{$pdfRecord->id}.jpg";
            $imagePath = storage_path("app/public/{$imageName}");
    
            // Convertir la page en image
            $pdf->setPage($i)->saveImage($imagePath);
    
            // Sauvegarder dans la base de données
            PdfImage::create([
                'pdf_id' => $pdfRecord->id,
                'image_path' => $imageName,
                'page_number' => $i,
            ]);
        }
    
        return redirect()->route('diaporamas.index')->with('success', 'PDF converti en images avec succès !');
    }
  
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Diaporama  $diaporama
     * @return \Illuminate\Http\Response
     */
    public function show(Diaporama $diaporama)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Diaporama  $diaporama
     * @return \Illuminate\Http\Response
     */
    public function edit(Diaporama $diaporama)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDiaporamaRequest  $request
     * @param  \App\Models\Diaporama  $diaporama
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDiaporamaRequest $request, Diaporama $diaporama)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Diaporama  $diaporama
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diaporama $diaporama)
    {
        //
    }
}
