<?php

namespace App\Interfaces;

interface UserInterface {
    /**
     * Get information about user to show page
     * @access  public
     * @param   string
     * @return  object
     */
    public function getInformation(string $userName);

    /**
     * @access  public
     * @param   string
     * 
     * @return  array
     */
    public function searchUsers(string $searchWord);

}