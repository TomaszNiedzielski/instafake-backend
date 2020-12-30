<?php declare(strict_types = 1);

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use App\Interfaces\FollowInterface;
use App\Models\Follow;
use DB;

class FollowRepository implements FollowInterface
{
    public function follow($userName) : bool {
        $follow = new Follow;
        $follow->user_id = Auth::user()->id;
        $follow->followed_id = $this->checkUserIdByName($userName);
        $follow->save();

        return true;
    }

    public function unfollow($userName) {
        DB::table('follows')
            ->where([
                'user_id' => Auth::user()->id,
                'followed_id' => $this->checkUserIdByName($userName)
            ])
            ->delete();
        
        return true;
    }

    private function checkUserIdByName(string $userName) : int {
        $userId = DB::table('users')
            ->where('name', $userName)
            ->value('id');
        
        return $userId;
    }
}