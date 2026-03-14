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
}
