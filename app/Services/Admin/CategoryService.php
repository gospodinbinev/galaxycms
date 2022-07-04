<?php

namespace App\Services\Admin;

use Illuminate\Http\Request;
use App\Models\Category;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class CategoryService {
    public function createCategory(Request $request)
    {
        $category = new Category();
        $category->parent_id = $request->parent;
        $category->name = $request->name;
        $category->slug = $request->slug;

        $defaultImagePath = 'categories/banner2.jpg';

        // Category image
        if ($request->file('image')) {
            // Image upload
            $originalImage = $request->file('image');
            $image = Image::make($originalImage);
            $image->orientate()->fit(1179, 302, function ($constraint) {
                $constraint->upsize();
            });
  
            // Create a directory for this category with 755 privileges
            mkdir(public_path().'/categories/'.$request->slug, 0755);

            $imagePath = public_path().'/categories/'.$request->slug.'/';
            $imageSaveName = time().$originalImage->getClientOriginalName();
            $image->save($imagePath.$imageSaveName);

            // Save image path in db
            $category->image = 'categories/'.$request->slug.'/'.$imageSaveName;
        } else {
            $category->image = $defaultImagePath;
        }

        $category->save();

        return $category;
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $category->parent_id = $request->parent;
        $category->name = $request->name;

        // If change slug, rename the folder that contains category image
        if ($category->slug != $request->slug && File::isDirectory(public_path().'/categories/'.$category->slug)) {
            $oldName = public_path().'/categories/'.$category->slug;
            $newName = public_path().'/categories/'.$request->slug;
            rename($oldName, $newName);

            // Image path correction
            $category->image = str_replace($category->slug, $request->slug, $category->image);
        }

        // Category image
        if ($request->file('image')) {

            if ($category->image == 'categories/banner2.jpg') {
                // Create a directory for this user with 755 privileges
                mkdir(public_path().'/categories/'.$request->slug, 0755); 
            } else {
                // Delete the old image
                $oldFile = public_path($category->image);
                File::delete($oldFile);
            }

            // Image upload
            $originalImage = $request->file('image');
            $image = Image::make($originalImage);
            $image->orientate()->fit(1179, 302, function ($constraint) {
                $constraint->upsize();
            });

            $imagePath = public_path().'/categories/'.$request->slug.'/';
            $imageSaveName = time().$originalImage->getClientOriginalName();
            $image->save($imagePath.$imageSaveName);

            // Save image path in db
            $category->image = 'categories/'.$request->slug.'/'.$imageSaveName;
        }

        $category->slug = $request->slug;

        $category->save();

        return $category;
    }

    public function deleteCategory($id) {
        $category = Category::findOrFail($id);

        File::deleteDirectory(public_path().'/categories/'.$category->slug);

        $category->delete();
    }
}