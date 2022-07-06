<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateSizeRequest;
use App\Http\Requests\Admin\UpdateSizeRequest;
use App\Models\Size;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;


class SizesController extends \App\Http\Controllers\Controller
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
        return view('admin.sizes.index');
    }

    public function getData()
    {
        return Datatables::of(Size::query())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sizes.create');
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
    public function store(CreateSizeRequest $request)
    {
        Size::create(['name' => $request->name, 'slug' => $request->slug]);

        return redirect()->route('admin.sizes.index')->withSuccess('New size added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function show(Size $size)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $size = Size::findOrFail($id);
        return view('admin.sizes.edit', compact('size'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSizeRequest $request, $id)
    {
        Size::findOrFail($id)
            ->update(['name' => $request->name, 'slug' => $request->slug]);

        return redirect()->route('admin.sizes.index')->withSuccess('Size updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Size::findOrFail($id)->delete();

        return redirect()->route('admin.sizes.index')->withSuccess('Size deleted successfully!');
    }
}
