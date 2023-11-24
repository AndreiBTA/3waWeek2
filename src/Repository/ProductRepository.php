<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function getProductsBelowPrice(int $price): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.price <  :price')
            ->setParameter('price', $price)
            ->orderBy('p.price', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function getProductsBetweenPrices(int $priceMin = 0, int $priceMax = 0): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.price between :priceMin and :priceMax')
            ->setParameter('priceMin', $priceMin)
            ->setParameter('priceMax', $priceMax)
            ->orderBy('p.price', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function getProductsByCategory(Category $category): array
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.category', 'c')
            ->where('c.name = :name')
            ->setParameter('name', $category->getName())
            ->getQuery()
            ->getResult();
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findPhotos(int $id = 0): Product|null|array
    {
        $qb = $this->createQueryBuilder('product')
            ->leftJoin('product.photos', 'photo')
            ->addSelect('photo');
        return $qb
            ->getQuery()
            ->getResult();
    }
}
