<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\AvatarInterface;
use App\Http\Requests\ImageRequest;

class AvatarController extends Controller
{
    protected $avatarInterface;

    public function __construct(AvatarInterface $avatarInterface) {
        $this->avatarInterface = $avatarInterface;
    }

    public function storeAvatar(ImageRequest $imageRequest) {
        $avatar = $this->avatarInterface->storeAvatar($imageRequest);

        return response()->json($avatar);
    }
}