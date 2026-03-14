<?php

namespace App\Services;

use App\Models\Category;

class CategoryTypeService
{
    private $categoryTypeModel;

    public function __construct()
    {
        $this->categoryTypeModel = new Category();
    }

    public function getAllCategoryTypes()
    {
        try {
            return $this->categoryTypeModel->all();
        } catch (\Exception $e) {
            return [];
        }
    }
}

?>