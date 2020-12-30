<?php

namespace App\Repositories;

use App\Http\Requests\ImageRequest;
use App\Interfaces\ImageInterface;
use App\Models\Image;
use DB;
use Illuminate\Support\Facades\Log;

class ImageRepository implements ImageInterface
{
    public function storeImage(ImageRequest $imageRequest) {
        if($imageRequest->hasFile('image')) {
            $fileNameToStore = $this->moveImageToStorage($imageRequest->file('image'), 'images');
        }

        // Save image to database
        if(isset($fileNameToStore)) {
            $image = new Image;
            $image->user_id = auth()->user()->id;
            $image->name = $fileNameToStore;
            $image->save();

            return $image;
        } else {
            return 'Something went wrong.';
        }
        
    }

    /**
     * Move image file to destination folder
     * @param   file    $image
     * @param   string  $destinationFolderName
     * 
     * @return  string  $fileNameToStore
    */
    protected function moveImageToStorage($image, string $destinationFolderName) {
        $fileNameWithExt = $image->getClientOriginalName();

        $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

        $extension = $image->guessExtension();

        $fileNameToStore = $filename.'_'.time().mt_rand( 0, 0xffff ).'.'.$extension;

        $path = $image->storeAs("public/$destinationFolderName", $fileNameToStore);

        return $fileNameToStore;
    }

    public function getImagesOfSpecificUser(string $userName) {
        $images = DB::table('users')
            ->where('users.name', $userName)
            ->join('images', 'images.user_id', '=', 'users.id')
            ->select('images.*')
            ->orderBy('images.created_at', 'desc')
            ->get();

        return $images;
    }

    public function getImagesFromFollowedUsers() {
        $images = DB::table('users')
            ->where('users.id', auth()->user()->id)
            ->leftJoin('follows', 'follows.user_id', '=', 'users.id')
            ->leftJoin('images', 'images.user_id', '=', 'follows.followed_id')
            ->join('users as followed_users', 'followed_users.id', '=', 'images.user_id')
            ->select('images.name as image', 'followed_users.name as userName')
            ->groupBy('images.name', 'followed_users.name')
            ->get();
        
        return $images;
    }
}