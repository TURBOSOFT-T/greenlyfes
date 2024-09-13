<?php

namespace App\Http\Controllers\Back;

use App\DataTables\ProjectsDataTable;
use App\Http\{
    Controllers\Controller,
};
use App\Http\Requests\Back\ProjectRequest;
use Intervention\Image\Facades\Image as InterventionImage;


use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\File;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProjectsDataTable $dataTable)
    {
        return $dataTable->render('back.shared.index');
    }



    public function create()
    {
        return view('back.homes.form');
    }


    public function store(ProjectRequest $request)
    {

        $inputs = $this->getInputs($request);

    Project::create($inputs);

        return back()->with('alert', config('messages.herocreated'));
    }


    protected function saveImages($request)
    {
        $image = $request->file('image');
        $name = time() . '.' . $image->extension();
        $img = InterventionImage::make($image->path());
        $img->widen(800)->encode()->save(public_path('/images/') . $name);
        $img->widen(400)->encode()->save(public_path('/images/thumbs/') . $name);
        return $name;
    }
    protected function getInputs($request)
    {
        $inputs = $request->except(['image']);
        $inputs['active'] = $request->has('active');
        if ($request->image) {
            $inputs['image'] = $this->saveImages($request);
        }
        return $inputs;
    }


    protected function deleteImages($home)
    {
        File::delete([
            public_path('/images/') . $home->image,
            public_path('/images/thumbs/') . $home->image,
        ]);
    }


    public function edit(Project $home)
    {
        return view('back.homes.form', ['home' => $home]);
    }


    public function update(ProjectRequest $request, Project $home)
    {
        $inputs = $this->getInputs($request);
        if ($request->has('image')) {
            $this->deleteImages($home);
        }
        $home->update($inputs);
        return back()->with('alert', config('messages.heroupdated'));
    }


    public function destroy(Project $home)
    {
        $this->deleteImages($home);
        $home->delete();
        return redirect(route('heros.index'));
    }


    public function alert(Project $home)
    {
        return view('back.homes.destroy', ['home' => $home]);
    }
}