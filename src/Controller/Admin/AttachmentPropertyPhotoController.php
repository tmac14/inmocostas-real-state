<?php

namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AttachmentPropertyPhotoController extends AttachmentController
{
    public function __construct(private string $propertyPhotosFolder)
    {
    }

    #[Route('/property/photos/store', name: 'store_property_photos', methods: ['POST'])]
    public function store(Request $request): JsonResponse
    {
        $response = new JsonResponse();

        return $response;
    }
}