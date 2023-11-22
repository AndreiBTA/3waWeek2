<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Form\CategoryType;
use App\Form\ProductType;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/products')]
class ProductsController extends AbstractController
{
    #[Route('/', name: 'app_products')]
    public function showProducts(ProductRepository $productRepository): Response
    {
        return $this->render('products/index.html.twig', [
            //            'products' => $productRepository->findAll(),
            'products' => $productRepository->findBy([], ['createdAt' => 'DESC'], 9),
            //            'products' => $productRepository->getProductsBelowPrice(600),
            //            'products' => $productRepository->getProductsBetweenPrices(400, 1000),
            //                'products' => $productRepository->getProductsByCategory('Info'),
        ]);
    }

    #[Route('/products-category', name: 'app_products_category')]
    public function showProductsByCategory(
        Request $request,
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository
    ): Response {
        $form = $this->createForm(CategoryType::class);
        $form->handleRequest($request);

        /* @var $category Category * */
        $category = $form->get('name')->getData();

        $formPrice = $this->createForm(SearchType::class);
        $formPrice->handleRequest($request);
        dump($formPrice);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->render('products/products_category.html.twig', [
                'products' => $productRepository->getProductsByCategory($category),
                'form' => $form,
                //                'form_price' => $formPrice,
            ]);
        }
        //        if ($formPrice->isSubmitted() && $formPrice->isValid()) {
        //            $data = $formPrice->getData();
        //            $priceMin = $data['priceMin'];
        //            $priceMax = $data['priceMax'];
        //            return $this->render('products/products_category.html.twig', [
        //                'products' => $productRepository->getProductsBetweenPrices($priceMin, $priceMax),
        //                'form_price' => $formPrice,
        //            ]);
        //        }

        return $this->render('products/products_category.html.twig', [
            'products' => $productRepository->findAll(),
            'form' => $form,
        ]);
    }

    #[Route('/filtered', name: 'app_products_books')]
    public function showFilteredProducts(ProductRepository $productRepository): Response
    {
        return $this->render('products/index.html.twig', [
            'products' => $productRepository->findBy(['category' => 92], ['price' => 'DESC']),
        ]);
    }

    #[Route('/show-one', name: 'app_products_show_one')]
    public function showOneByField(ProductRepository $productRepository): Response
    {
        //        dd($productRepository->findOneBy(['id' => 43]));

        return $this->render('products/index.html.twig', [
            'products' => $productRepository->findOneBy(['name' => 'dicta']),
        ]);
    }

    #[Route('/new', name: 'app_products_new')]
    public function addProducts(Request $request, EntityManagerInterface $em): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($product);
            $em->flush();
            $this->addFlash('success', 'Product added');

            return $this->redirectToRoute('app_products');
        }

        return $this->render('products/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{id}/show', name: 'app_product_show')]
    public function showProduct(Product $product): Response
    {
        return $this->render('products/show.html.twig', [
            'product' => $product,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_product_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Product $product, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            $this->addFlash('info', 'Product updated');

            return $this->redirectToRoute('app_products');
        }

        return $this->render('products/edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_product_delete', methods: ['POST'])]
    public function delete(Request $request, Product $product, EntityManagerInterface $em): Response
    {
        $submittedToken = $request->request->get('token');

        if ($this->isCsrfTokenValid('delete-item', $submittedToken)) {
            $em->remove($product);
            $em->flush();

            $this->addFlash('info', 'Product deleted');
        }

        return $this->redirectToRoute('app_products');
    }
}
