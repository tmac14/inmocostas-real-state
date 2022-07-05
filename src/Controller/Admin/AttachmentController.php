<?php

namespace App\Controller\Admin;

use App\Entity\TemporaryFile;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route(
    '/attachment/tmp/upload',
    name: 'upload_temp_files',
    methods: ['POST'],
)]
class AttachmentController extends AbstractController
{
    public function __construct(
        private string $tempFilesFolder,
        private SluggerInterface $slugger,
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        // Check your profiler
        dump($this->tempFilesFolder, $this->slugger, $this->em);

        $file = $request->files->get('photos');
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        $response = new JsonResponse();

        try {
            $file->move($this->tempFilesFolder, $newFilename);
            $response->setStatusCode(200);
            $response->setData($newFilename);

            // The next code... Where is the right place, inside or outside of try/catch?
            $temporaryFile = new TemporaryFile();
            $temporaryFile->setName($newFilename);
            $temporaryFile->setDateAt(new \DateTimeImmutable());

            $this->em->persist($temporaryFile);
            $this->em->flush();
        } catch (FileException $e) {
            throw new FileException($e->getMessage());
        }

        return $response;
    }
}
