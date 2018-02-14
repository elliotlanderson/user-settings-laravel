<?php

namespace App\User;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * Abstracts from directly using the Eloquent model
 *
 * Class UserRepository
 * @package App\User
 */

class UserRepository
{

    public function hasProfilePicture()
    {
        if (is_null(Auth::user()->profile_picture_path)) return false;

        return true;
    }

    public function uploadAndStoreProfilePicture(Request $request)
    {
        $fileExtension = $request->file('profile_picture')->getClientOriginalExtension();

        $image = $request->file('profile_picture')->storeAs('images', Auth::user()->id.'.'.$fileExtension);

        $user = Auth::user();
        $user->profile_picture_path = Auth::user()->id.'.'.$fileExtension;
        $user->save();

        return $image;
    }

    public function getProfilePictureUrl()
    {
        $user = Auth::user();
        return url('storage/images/'.$user->profile_picture_path);
    }
}