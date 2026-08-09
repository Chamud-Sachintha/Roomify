<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryTypeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    private $user;
    private $CategoryModel;
    private $CategoryTypeService;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->CategoryModel = new Category();
        $this->CategoryTypeService = new CategoryTypeService();
    }

    public function showCategorySettingsPage() {
        $categories = $this->CategoryTypeService->getAllCategoryTypes();

        return view('app.admin.manage-category')->with([
            'user' => $this->user,
            'breadcrumb' => 'Category Management',
            'categories' => $categories,
        ]);
    }

    public function createNewCategory(Request $request) {
        
        $validated = $request->validate([
            'categoryName' => 'required|string|max:255',
            'categoryDescription' => 'nullable|string',
            'categoryStatus' => 'required|integer|between:0,1',
        ]);

        $this->CategoryModel->createCategory([
            'name' => $validated['categoryName'],
            'description' => $validated['categoryDescription'] ?? '',
            'status' => $validated['categoryStatus'],
        ]);

        return redirect()
            ->route('category_management')
            ->with('success', 'Category created successfully.');
    }

    public function deleteCategory(Request $request)
    {
        $validated = $request->validate([
            'deleteCategoryId' => 'required|integer|exists:categories,id',
        ]);

        try {
            $category = $this->CategoryModel->findOrFail($validated['deleteCategoryId']);
            $category->delete();

            return redirect()
                ->route('category_management')
                ->with('success', 'Category deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Category could not be deleted.']);
        }
    }

    public function updateCategory(Request $request)
    {
        $validated = $request->validate([
            'categoryId' => 'required|integer|exists:categories,id',
            'editCategoryTypeName' => 'required|string|max:255',
            'editCategoryTypeStatus' => 'required|integer|between:0,1',
        ]);

        try {
            $category = $this->CategoryModel->findOrFail($validated['categoryId']);
            $category->name = $validated['editCategoryTypeName'];
            $category->status = $validated['editCategoryTypeStatus'];
            $category->save();

            return redirect()->route('category_management')->with('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Category could not be updated.']);
        }
    }
}
