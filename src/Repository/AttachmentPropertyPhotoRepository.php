<?php

namespace App\Repository;

use App\Entity\AttachmentPropertyPhoto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AttachmentPropertyPhoto|null find($id, $lockMode = null, $lockVersion = null)
 * @method AttachmentPropertyPhoto|null findOneBy(array $criteria, array $orderBy = null)
 * @method AttachmentPropertyPhoto[]    findAll()
 * @method AttachmentPropertyPhoto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttachmentPropertyPhotoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttachmentPropertyPhoto::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(AttachmentPropertyPhoto $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(AttachmentPropertyPhoto $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
}
