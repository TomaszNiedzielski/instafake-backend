<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\FollowInterface;
use App\Http\Requests\FollowRequest;

class FollowController extends Controller
{
    protected $followInterface;

    public function __construct(FollowInterface $followInterface) {
        $this->followInterface = $followInterface;
    }

    public function follow(FollowRequest $followRequest) {
        $success = $this->followInterface->follow($followRequest->userName);

        return response()->json($success);
    }

    public function unfollow(FollowRequest $followRequest) {
        $success = $this->followInterface->unfollow($followRequest->userName);

        return response()->json($success);
    }
}