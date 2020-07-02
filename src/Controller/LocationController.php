<?php

namespace App\Controller;


use App\Entity\Location;
use App\Repository\LocationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class LocationController extends AbstractController
{
    /**
     * @var LocationRepository
     */
    private $repository;

    /**
     * @param LocationRepository $repository
     */
    public function __construct( LocationRepository $repository )
    {
        $this -> repository = $repository;
    }

    /**
     * @Route("/location", name="location")
     * @param LocationRepository $repository
     * @return Response
     */
    public function location( LocationRepository $repository )
    {
        $locations = $repository -> findLatestLocation();
        return $this -> render( 'location/Location.html.twig', [
            'locations'     => $locations,
            'current_menu' => 'locations'
        ] );
    }

//    /**
//     * @Route("/list", name="product.list")
//     * @param PaginatorInterface $paginator
//     * @param Request $request
//     * @return Response
//     * Tous les produits ( page list ) avec pagination et filtres de recherche
//     */
//    public function list( PaginatorInterface $paginator, Request $request ): Response
//    {
//        $search = new ProductSearch();
//        $form = $this -> createForm( ProductSearchType::class, $search );
//        $form -> handleRequest( $request );
//
//        $post = $paginator -> paginate(
//            $this -> repository -> findAllVisibleQuery( $search ),
//            $request -> query -> getInt( 'page', 1 ),
//            9
//        );
//        return $this -> render( 'product/ProductList.html.twig', [
//            'pagination'   => $paginator,
//            'post'     => $post,
//            'current_menu' => 'post',
//            'form'         => $form -> createView()
//        ] );
//    }
//
//    /**
//     * @Route("/listing", name="product.listing")
//     * @param ProductRepository $repository
//     * @return Response
//     * Tous les produits ( page list ) avec pagination et filtres de recherche
//     */
//    public function listing( ProductRepository $repository): Response
//    {
//        $post = $repository -> findLatestProduct();
//        return $this -> json( [
//           'code'=>200,
//            'message'=> ' ok',
//            'post'=>$post
//        ],200 );
//    }

    /**
     * @Route("/location/{slug}-{id}", name="location.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Location $location
     * @param string $slug
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response;
     * @throws Exception
     */
    public function show( Location $location, string $slug, Request $request, EntityManagerInterface $manager ): Response
    {
        if($location -> getSlug() !== $slug) {
            return $this -> redirectToRoute( 'location.show', [
                'id'   => $location -> getId(),
                'slug' => $location -> getSlug()
            ], 301 );
        }

        return $this -> render( 'location/Show.html.twig', [
            'location'      => $location,
            'current_menu' => 'post',
            'userConnect'  => $this -> getUser()
        ] );
    }

}
