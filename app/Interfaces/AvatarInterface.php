<?php

namespace App\Interfaces;

use App\Http\Requests\ImageRequest;

interface AvatarInterface
{
    public function storeAvatar(ImageRequest $imageRequest);
}