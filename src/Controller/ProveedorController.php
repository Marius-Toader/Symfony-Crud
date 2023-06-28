<?php
 
namespace App\Controller;
 
use App\Entity\Proveedor;
use App\Form\ProveedorType;
use App\Repository\ProveedorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProveedorController extends AbstractController
{
    public function index(ProveedorRepository $proveedorRepository): Response
    {
        return $this->render('proveedor/index.html.twig', [
            'proveedores' => $proveedorRepository->findAll(),
        ]);
    }
 
    public function new(Request $request): Response
    {
        $project = new Proveedor();
        $form = $this->createForm(ProveedorType::class, $project);
        $form->handleRequest($request);
 
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($proveedor);
            $entityManager->flush();
 
            return $this->redirectToRoute('proveedor_index', [], Response::HTTP_SEE_OTHER);
        }
 
        return $this->renderForm('proveedor/new.html.twig', [
            'proveedor' => $proveedor,
            'form' => $form,
        ]);
    }
 
    public function show(Proveedor $proveedor): Response
    {
        return $this->render('proveedor/show.html.twig', [
            'proveedor' => $project,
        ]);
    }
 
    public function edit(Request $request, Proveedor $proveedor): Response
    {
        $form = $this->createForm(ProveedorType::class, $proveedor);
        $form->handleRequest($request);
 
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
 
            return $this->redirectToRoute('proveedor_index', [], Response::HTTP_SEE_OTHER);
        }
 
        return $this->renderForm('proveedor/edit.html.twig', [
            'proveedor' => $proveedor,
            'form' => $form,
        ]);
    }
 
    public function delete(Request $request, Proveedor $proveedor): Response
    {
        if ($this->isCsrfTokenValid('delete'.$proveedor->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($proveedor);
            $entityManager->flush();
        }
 
        return $this->redirectToRoute('proveedor_index', [], Response::HTTP_SEE_OTHER);
    }
}