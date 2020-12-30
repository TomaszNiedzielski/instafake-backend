<?php declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\UserInterface;
use DB;

use Illuminate\Support\Facades\Log;

class UserRepository implements UserInterface
{
    public function getInformation(string $userName) {
        $userInformation = DB::table('users')
            ->where('users.name', $userName)
            ->leftJoin('avatars', function($join) {
                $join->on('avatars.user_id', '=', 'users.id');
            })
            ->leftJoin('follows', function($join) {
                $join->on('follows.followed_id', '=', 'users.id')
                ->where('follows.user_id', auth()->user()->id);
            })
            ->select(
                'users.id as userId',
                'users.name as userName',
                'avatars.name as avatarName',
                'follows.followed_id as isFollowed'
            )
            ->groupBy('users.id', 'users.name', 'avatars.name', 'follows.followed_id')
            ->first();

        $userInformation->followersNumber = $this->countFollowers($userInformation->userId);
        $userInformation->imagesNumber = $this->countImages($userInformation->userId);

        return $userInformation;
    }

    private function countFollowers(int $userId) {
        $followersNumber = DB::table('follows')
            ->where('followed_id', $userId) 
            ->select(DB::raw('COUNT(id) as followersNumber'))
            ->value('followersNumber');

        return $followersNumber;
    }

    private function countImages(int $userId) {
        $imagesNumber = DB::table('images')
            ->where('user_id', $userId)
            ->select(DB::raw('COUNT(id) as imagesNumber'))
            ->value('imagesNumber');

        return $imagesNumber;
    }

    public function searchUsers(string $searchWord) {
        $results = DB::table('users')
            ->where('name', 'LIKE', "%{$searchWord}%")
            ->select('name')
            ->get();

        return $results;
    }
}