<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Intervention\Image\Facades\Image as InterventionImage;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\File;

class CategoryController extends BaseController
{
    public function index()
    {
        $data = Category::all();

        return $this->getResponse($data, "All Categories");
    }


    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $categories = Category::where('title', 'like', "%$keyword%")->get();

        return $categories;
    }


    public function show($id)
    {
        $data = Category::whereId($id)->first();

        if (!$data) {
            return $this->getError('Id not found');
        } else {
            return $this->getResponse($data, 'retourne data id category');
        }
    }











}