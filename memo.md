SELECT / UPDATE / DELETE / CREATE

JOIN ->join('cp.exemple', 'e')
GROUPBY ->groupBy("p.id,p.nom")
ORDERBY ->orderBy("p.nom", "ASC")

SUM SUM(cp.quantite _ p.prix_unitaire) AS chiffreAffaires
COUNT ->select('COUNT(c.id)')
AVG >select('AVG(p.prix_unitaire)')
MIN/MAX >select('MIN(p.prix_unitaire)')
WHERE ->where('p.categorie = :cat')->setParameter('cat', 'Papeterie')
HAVING ->having('SUM(cp.quantite _ p.prix_unitaire) > 100')
DISTINCT ->select('DISTINCT p.categorie')

getQuery
getArrayResult
getMaxResults

where("cl.id = :clientId")
setParameter("clientId",5) -> requete dynamique $client au lieu de 5

Pagination : Paginator
API REST : API Platfor

exemple API :

   
#[Route('/api/commandes', name: 'api_commandes')]
public function apiCommandes(CommandeRepository $repo): JsonResponse
{
    $commandes = $repo->findAll();
    $data = [];
    foreach ($commandes as $commande) {
        $data[] = [
            'id' => $commande->getId(),
            'date' => $commande->getDateCommande(),
            // Ajoute ici les infos que tu veux, sans inclure les objets liés complets
        ];
    }
    return $this->json($data);
}
