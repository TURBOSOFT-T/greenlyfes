<?php




namespace App\Http\Controllers\Back;

use App\Http\{
    Controllers\Controller,
};
use App\Http\Requests\Back\UpdateConfigRequest as BackUpdateConfigRequest;
use App\Http\Requests\UpdateConfigRequest;
use App\Models\Config;


class ConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $configs = config::first();
        //  dd($configs);
        return view('back.parametres.contact', compact('configs'));
    }



    public function contact_admin()
    {
        $configs = config::first();
        dd($configs);
        return view('back.parametres.contact', compact('configs'));
    }




    public function edit(Config $config)
    {
        $config = config::first();
        // dd($config);
        //dd($config->description);
        return view('back.config.edit', compact('config'));
    }
    public function update(BackUpdateConfigRequest $request, Config $config)
    {
        $input = $request->all();
        $config = config::first();
        // dd($config->description);
        // Handle image update
//dd($input);
        
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($config->image) {
                $oldImagePath = public_path('Image/parametres/' . $config->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/Image/parametres/', $filename);
            $input['image'] = $filename;
        }

        // Handle logo update
        if ($request->hasFile('logo')) {
            // Delete old logo if it exists
            if ($config->logo) {
                $oldLogoPath = public_path('Image/parametres/' . $config->logo);
                if (file_exists($oldLogoPath)) {
                    unlink($oldLogoPath);
                }
            }

            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/Image/parametres/', $filename);
            $input['logo'] = $filename;
        }

        // Handle icon update
        if ($request->hasFile('icon')) {
            // Delete old icon if it exists
            if ($config->icon) {
                $oldIconPath = public_path('Image/parametres/' . $config->icon);
                if (file_exists($oldIconPath)) {
                    unlink($oldIconPath);
                }
            }

            $file = $request->file('icon');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/Image/parametres/', $filename);
            $input['icon'] = $filename;
        }

        if ($request->hasFile('imagelogin')) {
            // Delete old icon if it exists
            if ($config->imagelogin) {
                $oldIconPath = public_path('Image/parametres/' . $config->imagelogin);
                if (file_exists($oldIconPath)) {
                    unlink($oldIconPath);
                }
            }

            $file = $request->file('imagelogin');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/Image/parametres/', $filename);
            $input['imagelogin'] = $filename;
        }


        if ($request->hasFile('imagergister')) {
            // Delete old icon if it exists
            if ($config->imagergister) {
                $oldIconPath = public_path('Image/parametres/' . $config->imagergister);
                if (file_exists($oldIconPath)) {
                    unlink($oldIconPath);
                }
            }

            $file = $request->file('imagergister');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/Image/parametres/', $filename);
            $input['imagergister'] = $filename;
        }

        if ($request->hasFile('imagefooter')) {
            // Delete old icon if it exists
            if ($config->imagefooter) {
                $oldIconPath = public_path('Image/parametres/' . $config->imagefooter);
                if (file_exists($oldIconPath)) {
                    unlink($oldIconPath);
                }
            }

            $file = $request->file('imagefooter');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/Image/parametres/', $filename);
            $input['imagefooter'] = $filename;
        }

        if ($request->hasFile('imagecontact')) {
            // Delete old icon if it exists
            if ($config->imagecontact) {
                $oldIconPath = public_path('Image/parametres/' . $config->imagecontact);
                if (file_exists($oldIconPath)) {
                    unlink($oldIconPath);
                }
            }

            $file = $request->file('imagecontact');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/Image/parametres/', $filename);
            $input['imagecontact'] = $filename;
        }


        
        if ($request->hasFile('imageblog')) {
            // Delete old icon if it exists
            if ($config->imageblog) {
                $oldIconPath = public_path('Image/parametres/' . $config->imageblog);
                if (file_exists($oldIconPath)) {
                    unlink($oldIconPath);
                }
            }

            $file = $request->file('imageblog');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/Image/parametres/', $filename);
            $input['imageblog'] = $filename;
        }

        if ($request->hasFile('imageeducation')) {
            // Delete old icon if it exists
            if ($config->imageeducation) {
                $oldIconPath = public_path('Image/parametres/' . $config->imageeducation);
                if (file_exists($oldIconPath)) {
                    unlink($oldIconPath);
                }
            }

            $file = $request->file('imageeducation');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/Image/parametres/', $filename);
            $input['imageeducation'] = $filename;
        }


         
        if ($request->hasFile('imagesante')) {
            // Delete old icon if it exists
            if ($config->imagesante) {
                $oldIconPath = public_path('Image/parametres/' . $config->imagesante);
                if (file_exists($oldIconPath)) {
                    unlink($oldIconPath);
                }
            }

            $file = $request->file('imagesante');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/Image/parametres/', $filename);
            $input['imagesante'] = $filename;
        }


         
        if ($request->hasFile('imageindustrielle')) {
            // Delete old icon if it exists
            if ($config->imageindustrielle) {
                $oldIconPath = public_path('Image/parametres/' . $config->imageindustrielle);
                if (file_exists($oldIconPath)) {
                    unlink($oldIconPath);
                }
            }

            $file = $request->file('imageindustrielle');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/Image/parametres/', $filename);
            $input['imageindustrielle'] = $filename;
        }



        if ($request->hasFile('imageabout')) {
            // Delete old icon if it exists
            if ($config->imageabout) {
                $oldIconPath = public_path('Image/parametres/' . $config->imageabout);
                if (file_exists($oldIconPath)) {
                    unlink($oldIconPath);
                }
            }

            $file = $request->file('imageabout');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/Image/parametres/', $filename);
            $input['imageabout'] = $filename;
        }


           
        if ($request->hasFile('logoHeader')) {
            // Delete old icon if it exists
            if ($config->logoHeader) {
                $oldIconPath = public_path('Image/parametres/' . $config->logoHeader);
                if (file_exists($oldIconPath)) {
                    unlink($oldIconPath);
                }
            }

            $file = $request->file('logoHeader');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/Image/parametres/', $filename);
            $input['logoHeader'] = $filename;
        }



       

        $config->update($input);

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Updated successfully!');
    }

    /**
     * Fonction pour gérer l'upload des fichiers.
     */
}
