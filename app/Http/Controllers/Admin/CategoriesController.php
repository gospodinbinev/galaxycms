<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\Admin\CategoryService;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoriesController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('IsAdmin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.index');
    }

    public function getData()
    {
        return Datatables::of(Category::query())
            ->addColumn('parent', function (Category $category) {
                return $category->parent->name ?? 'None';
            })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Giving an array of IDs and names to LaravelCollective select
        $categories = [];
        foreach (Category::with('children')->whereNull('parent_id')->get() as $category) {
            $categories += [$category->id => $category->name];
        }

        return view('admin.categories.create', compact('categories'));
    }

    public function checkSlug(Request $request)
    {
        $slug = Str::slug($request->name, '-');

        return response()->json(['slug' => $slug]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request, CategoryService $categoryService)
    {
        $category = $categoryService->createCategory($request);

        return redirect()->route('admin.categories.index')->withSuccess('New category added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        // Giving an array of IDs and names to LaravelCollective select
        $categories = [];
        foreach (Category::with('children')->whereNull('parent_id')->get() as $cat) {
            $categories += [$cat->id => $cat->name];
        }

        return view('admin.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, CategoryService $categoryService, $id)
    {
        $category = $categoryService->updateCategory($request, $id);

        return redirect()->route('admin.categories.index')->withSuccess('Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryService $categoryService, $id)
    {
        $category = $categoryService->deleteCategory($id);

        return redirect()->route('admin.categories.index')->withSuccess('Category deleted successfully!');
    }
}
