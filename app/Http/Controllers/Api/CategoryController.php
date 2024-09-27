<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return sendResponse($category, 'Category retrieved successfully.');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return sendError('Validation Error.', $validator->errors());
        }
        $category = Category::create($input);
        return sendResponse($category, 'Category created successfully.');
    }

    public function show(Category $category)
    {
        if (is_null($category)) {
            return sendError('Category not found.');
        }
        return sendResponse($category, 'Category retrieved successfully.');
    }

    public function update(Request $request, Category $category)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return sendError('Validation Error.', $validator->errors());
        }

        $category->name = $input['name'];
        $category->description = $input['description'];
        $category->save();

        return sendResponse($category, 'Category updated successfully.');
    }

    public function delete(Category $category)
    {
        $category->delete();
        return sendResponse([], 'Category deleted successfully.');
    }
}
