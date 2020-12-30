<?php

namespace App\Interfaces;

interface FollowInterface
{
    /**
     * Follow user by user name
     * @param   $userName
     * @return  bool
     */
    public function follow($userName);

    /**
     * Unfollow user by user name
     * @param   $userName
     * @return  bool
     */
    public function unfollow($userName);
}