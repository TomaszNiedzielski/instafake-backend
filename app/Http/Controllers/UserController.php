<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\UserInterface;

class UserController extends Controller
{
    protected $userInterface;

    public function __construct(UserInterface $userInterface) {
        $this->userInterface = $userInterface;
    }

    public function getInformation(Request $request) {
        $userInformations = $this->userInterface->getInformation($request->userName);

        return response()->json($userInformations);
    }

    public function searchUsers(Request $request) {
        $results = $this->userInterface->searchUsers($request->searchWord);

        return response()->json($results);
    }

}