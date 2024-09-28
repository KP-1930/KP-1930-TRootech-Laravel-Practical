<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $category = Category::all();
            return sendResponse($category, 'Category retrieved successfully.');
        } catch (\Exception $e) {
            return sendError('An error occurred while retrieving categories.', [$e->getMessage()]);
        }
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

        try {
            $category = Category::create($input);
            return sendResponse($category, 'Category created successfully.');
        } catch (\Exception $e) {
            return sendError('An error occurred while creating the category.', [$e->getMessage()]);
        }
    }

    public function show(Category $category)
    {
        try {
            return sendResponse($category, 'Category retrieved successfully.');
        } catch (ModelNotFoundException $e) {
            return sendError('Category not found.', [$e->getMessage()]);
        } catch (\Exception $e) {
            return sendError('An error occurred while retrieving the category.', [$e->getMessage()]);
        }
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

        try {
            $category->name = $input['name'];
            $category->description = $input['description'];
            $category->save();
            return sendResponse($category, 'Category updated successfully.');
        } catch (ModelNotFoundException $e) {
            return sendError('Category not found.', [$e->getMessage()]);
        } catch (\Exception $e) {
            return sendError('An error occurred while updating the category.', [$e->getMessage()]);
        }
    }

    public function delete(Category $category)
    {
        try {
            $category->delete();
            return sendResponse([], 'Category deleted successfully.');
        } catch (ModelNotFoundException $e) {
            return sendError('Category not found.', [$e->getMessage()]);
        } catch (\Exception $e) {
            return sendError('An error occurred while deleting the category.', [$e->getMessage()]);
        }
    }
}
