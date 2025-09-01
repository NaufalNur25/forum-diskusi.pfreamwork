<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Master\Category\StoreCategoryRequest;
use App\Http\Requests\Admin\Master\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereRaw('LOWER(name) LIKE ?', ["%".strtolower($search)."%"]);
        }

        $categories = $query->with('posts')
            ->withCount('posts')
            ->latest('updated_at')
            ->paginate(5);

        return view('Admin.Master.Category.index', compact('categories'));
    }

    public function create()
    {
        return view('Admin.Master.Category.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->all());

        return redirect()
            ->route('admin.master.category')
            ->with('success', 'Successfully create new category');
    }

    public function edit(Category $category)
    {
        return view('Admin.Master.Category.edit', compact('category'));
    }


    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->all());

        return redirect()
            ->route('admin.master.category')
            ->with('success', 'Successfully updated category');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('admin.master.category')
            ->with('success', 'Successfully deleted category');
    }
}
