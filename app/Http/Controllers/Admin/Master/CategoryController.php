<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Master\Category\CreateCategoryRequest;
use App\Http\Requests\Admin\Master\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('posts')->paginate(5);

        return view('Admin.Master.Category.index', compact('categories'));
    }

    public function create()
    {
        return view('Admin.Master.Category.create');
    }

    public function store(CreateCategoryRequest $request)
    {
        Category::create($request->all());

        return redirect()
            ->route('admin.master.category', status: Response::HTTP_MOVED_PERMANENTLY)
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
            ->route('admin.master.category', status: Response::HTTP_MOVED_PERMANENTLY)
            ->with('success', 'Successfully updated category');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('admin.master.category', status: Response::HTTP_MOVED_PERMANENTLY)
            ->with('success', 'Successfully deketed category');
    }
}
