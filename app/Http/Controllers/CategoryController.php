<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ebook;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('categories.index')
            ->with('categories', Category::orderBy('updated_at', 'desc')->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create')
            ->with('categories', Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:categories|max:20'
        ], [
            'name.max' => 'Please add category name with less than 20 characters.',
            'name.required' => 'Please add the category title.',
        ]);

        $name = str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($request->name))));

        Category::insert([
            'name' => $name,
            'category' => Str::slug($request->name),
            'created_at' => Carbon::now(),
        ]);

        session()->flash('success', 'EBook category created successfully.');

        return redirect(route('categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.create')
            ->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => ['sometimes','required', 'string','max:20', \Illuminate\Validation\Rule::unique('categories')->ignore($category->id)],
        ], [
            'name.max' => 'Please add category name with less than 20 characters.',
            'name.required' => 'Please add the category title.',
            'name.unique' => "The category '$request->name' already exists.",
        ]);

        $category_slug = Str::slug($request->name);
        $name = str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($request->name))));

        $category->update(['name'=>$name,'category'=>$category_slug]);
        session()->flash('success', 'EBook category updated successfully.');
        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $category = Category::where('id', $id)->firstOrFail();

        $category->forceDelete();
        session()->flash('error', 'EBook category deleted permanently');

        return redirect(route('categories.index'));
    }
}
