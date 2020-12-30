<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\ImageInterface;
use App\Http\Requests\ImageRequest;

use Illuminate\Support\Facades\Log;


class ImageController extends Controller
{
    protected $imageInterface;

    public function __construct(ImageInterface $imageInterface) {
        $this->imageInterface = $imageInterface;
    }

    public function storeImage(ImageRequest $imageRequest) {
        $image = $this->imageInterface->storeImage($imageRequest);

        return response()->json($image);
    }

    public function getImagesOfSpecificUser(Request $request) {
        Log::info($request->userName);
        if(isset($request->userName)) {
            $images = $this->imageInterface->getImagesOfSpecificUser($request->userName);
        } else {
            return response()->json('There is no user name value.');
        }

        return response()->json($images);
    }

    public function getImagesFromFollowedUsers() {
        $images = $this->imageInterface->getImagesFromFollowedUsers();

        return response()->json($images);
    }
}