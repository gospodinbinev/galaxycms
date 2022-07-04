<?php

namespace App\Services\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class UserService {

    public function createUser(Request $request) {
        $user = new User;

        $user->role_id = $request->role;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->display_name = $request->display_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $defaultImagePath = 'users/user.png';

        // Profile pic
        if ($request->file('image')) {
            // Image upload
            $originalImage = $request->file('image');
            $image = Image::make($originalImage);
            $image->orientate()->fit(250, 250, function ($constraint) {
                $constraint->upsize();
            });
  
            // Create a directory for this user with 755 privileges
            mkdir(public_path().'/users/'.$request->display_name, 0755);

            $imagePath = public_path().'/users/'.$request->display_name.'/';
            $imageSaveName = time().$originalImage->getClientOriginalName();
            $image->save($imagePath.$imageSaveName);

            // Save image path in db
            $user->image = 'users/'.$request->display_name.'/'.$imageSaveName;
        } else {
            $user->image = $defaultImagePath;
        }

        $user->save();

        return $user;
    }

    public function updateUser(Request $request, $id) {
        $user = User::findOrFail($id);

        $user->role_id = $request->role;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;

        // If change display name, rename the folder that contains user image
        if ($user->display_name != $request->display_name && File::isDirectory(public_path().'/users/'.$user->display_name)) {
            $oldName = public_path().'/users/'.$user->display_name;
            $newName = public_path().'/users/'.$request->display_name;
            rename($oldName, $newName);

            // Image path correction
            $user->image = str_replace($user->display_name, $request->display_name, $user->image);
        }

        // Profile pic
        if ($request->file('image')) {

            if ($user->image == 'users/user.png') {
                // Create a directory for this user with 755 privileges
                mkdir(public_path().'/users/'.$request->display_name, 0755); 
            } else {
                // Delete the old image
                $oldFile = public_path($user->image);
                File::delete($oldFile);
            }

            // Image upload
            $originalImage = $request->file('image');
            $image = Image::make($originalImage);
            $image->orientate()->fit(250, 250, function ($constraint) {
                $constraint->upsize();
            });

            $imagePath = public_path().'/users/'.$request->display_name.'/';
            $imageSaveName = time().$originalImage->getClientOriginalName();
            $image->save($imagePath.$imageSaveName);

            // Save image path in db
            $user->image = 'users/'.$request->display_name.'/'.$imageSaveName;
        }

        $user->display_name = $request->display_name;

        $user->save();

        return $user;
    }

    public function changePassword(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return $user;
    }

    public function deleteUser($id) {
        $user = User::findOrFail($id);

        File::deleteDirectory(public_path().'/users/'.$user->display_name);

        $user->delete();
    }

}