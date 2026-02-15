<?php

namespace App\Repository;

use App\Entity\CommandeProduit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CommandeProduit>
 */
class CommandeProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandeProduit::class);
    }

    public function chiffreAffaireParProduit()
    {
        return $this->createQueryBuilder("cp")
            ->select("p.id AS id", "p.nom AS nom", "SUM(cp.quantite * p.prix_unitaire) AS chiffreAffaires")
            ->join("cp.produit", "p")
            ->groupBy("p.id,p.nom")
            ->getQuery()
            ->getArrayResult()
        ;
    }

    // public function exercice() { OK
    //     return $this->createQueryBuilder("cp")
    //     ->select("p.nom","SUM(cp.quantite * p.prix_unitaire) AS chiffre_affaire")
    //     ->join("cp.produit", "p")
    //     ->groupBy("p.nom")
    //     ->orderBy("chiffre_affaire","DESC")
    //     ->getQuery()
    //     ->getArrayResult()
    //     ;
    // }

    public function topTrois()
    {

        return $this->createQueryBuilder("cp")
            ->select("p.nom AS nom, SUM(cp.quantite) AS total_vendu")
            ->join("cp.produit", 'p')
            ->groupBy("p.id", "p.nom")
            ->orderBy("total_vendu", "DESC")
            ->setMaxResults(3)
            ->getQuery()
            ->getArrayResult()

        ;
    }

    // public function exercice() OK
    // {
    //  return $this->createQueryBuilder("cp")
    // ->select("p.nom", "SUM(cp.quantite) AS total_vendu") 
    // ->join("cp.produit", "p")
    // ->groupBy("p.nom")
    // ->orderBy("total_vendu","DESC")
    // ->setMaxResults(3)
    // ->getQuery()
    // ->getArrayResult()
    // ; 
    // }


    public function chiffreAffaireParClient()
    {
        return $this->createQueryBuilder('cp')
            ->select('cl.id AS id, cl.email AS email, SUM(cp.quantite * p.prix_unitaire) AS chiffre_affaires')
            ->join('cp.commande', 'co')
            ->join('co.client', 'cl')
            ->join('cp.produit', 'p')
            ->groupBy('cl.id, cl.email')
            ->orderBy('chiffre_affaires', 'DESC')
            ->getQuery()
            ->getArrayResult();
    }

    // public function exercice(){ OK
    //     return $this->createQueryBuilder("cp")
    //     ->select("p.nom", "c.email","SUM(cp.quantite * p.prix_unitaire) AS chiffre_affaire")
    //     ->join("cp.produit","p")
    //     ->join("cp.commande", "co")
    //     ->join("co.client", "c")
    //     ->groupBy("c.email", "p.nom")
    //     ->orderBy("chiffre_affaire","DESC")
    //     ->getQuery()
    //     ->getArrayResult()
    //     ;
    // }



    //    /**
    //     * @return CommandeProduit[] Returns an array of CommandeProduit objects
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

    //    public function findOneBySomeField($value): ?CommandeProduit
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
