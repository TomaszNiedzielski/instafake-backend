<?php

namespace App\Repositories;

use App\Interfaces\AvatarInterface;
use App\Http\Requests\ImageRequest;
use App\Models\Avatar;
use DB;

class AvatarRepository extends ImageRepository implements AvatarInterface
{
    public function storeAvatar(ImageRequest $imageRequest) : string {
        $fileNameToStore = $this->moveImageToStorage($imageRequest->file('image'), 'images');

        // Save image to database
        if(isset($fileNameToStore)) {
            
            $avatar = DB::table('avatars')
                ->updateOrInsert(
                    ['user_id' => auth()->user()->id],
                    ['name' => $fileNameToStore]
                );

            return $fileNameToStore;
        } else {
            return 'Something went wrong.';
        }
    }
}