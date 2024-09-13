<?php



namespace App\Http\Controllers\Back;

use App\Http\{
    Controllers\Controller,

};
use App\Http\Requests\Back\HeroPageRequest;
use App\Http\Requests\Back\HeroRequest;
use App\Http\Requests\Back\HomeRequest;
use App\Models\HeroPage;
use App\Http\Requests\StoreHeroPageRequest;
use App\Http\Requests\UpdateHeroPageRequest;
use App\Models\Category;
use Intervention\Image\Facades\Image as InterventionImage;
use Illuminate\Support\Facades\File;
//use App\Models\File;

class CategoryController extends Controller
{
    protected $dataTable;

    public function index()
    {
        return app()->make($this->dataTable)->render('back.shared.index');
    }

    public function create()
    {
        return view('back.homes.form');
    }


    public function store(HomeRequest $request)
    {

        $fileUpload = new Category();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $request->image->getClientOriginalName();
            $image->move('uploads', $fileName);
            $fileUpload->title = $request->title;
            $fileUpload->slug = $request->slug;
            $fileUpload->body = $request->body;
            $fileUpload->image = $fileName;
            $fileUpload->save();

            return back()
                ->with('success', 'Category has been created.')
                ->with('file', $fileName);
        }


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


    public function edit(Category $home)
    {
        return view('back.homes.form', ['home' => $home]);
    }


    public function update(HomeRequest $request, Category $home)
    {
        $inputs = $this->getInputs($request);
        if ($request->has('image')) {
            $this->deleteImages($home);
        }
        $home->update($inputs);
        return back()->with('alert', config('messages.heroupdated'));
    }


    public function destroy(Category $home)
    {
        $this->deleteImages($home);
        $home->delete();
        return redirect(route('heros.index'));
    }


    public function alert(Category $home)
    {
        return view('back.homes.destroy', ['home' => $home]);
    }

}