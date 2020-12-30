<?php declare(strict_types=1);

namespace App\Interfaces;

use App\Http\Requests\ImageRequest;

interface ImageInterface
{
    /**
     * Store uploaded image
     * 
     * @method  POST api/images
     * @access  public
     */
    public function storeImage(ImageRequest $imageRequest);

    /**
     * Get all images for specific user
     * 
     * @param   integer     $userId
     * 
     * @method  GET api/images/for-user/{$userId}
     * @access  public
     * 
     * @return  array   $images
     */
    public function getImagesOfSpecificUser(string $userName);

    /**
     * Load images to show on the main page
     * 
     * @access  public
     * 
     * @return  array
     */
    public function getImagesFromFollowedUsers();
}