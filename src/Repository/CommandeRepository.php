<?php

namespace App\Repository;

use App\Entity\Commande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Commande>
 */
class CommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commande::class);
    }

    // Liste toutes les commandes passées depuis le début du mois en cours, avec le détail des produits achetés.

    public function commandeDuMois()
    {
        $firstDay = new \DateTime(date('Y-m-01 00:00:00'));
        return $this->createQueryBuilder("c")
            ->select("c.id AS id, c.date_commande AS date, p.nom AS produit, cp.quantite")
            ->join("c.commandeProduits", "cp")
            ->join("cp.produit", "p")
            ->where('c.date_commande >= :firstDay')
            ->setParameter('firstDay', $firstDay)
            ->orderBy('c.date_commande', 'DESC')
            ->getQuery()
            ->getArrayResult()
        ;
    }

    // public function exercice() OK
    // {
    //     $firstDay = new \DateTime(date('Y-m-01 00:00:00'));
    //     return $this->createQueryBuilder("co")
    //         ->select("p.nom","cp.quantite","co.date_commande")
    //         ->join("co.commandeProduits","cp")
    //         ->join("cp.produit", "p")
    //         ->where("co.date_commande >= :firstDay")
    //         ->setParameter("firstDay",$firstDay)
    //         ->orderBy("co.date_commande","ASC")
    //         ->getQuery()
    //         ->getArrayResult()

    //     ;
    // }

    //    /**
    //     * @return Commande[] Returns an array of Commande objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Commande
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
