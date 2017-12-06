<?php

namespace TRBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TRBundle\Entity\Eigenfunction;

/**
 * Eigenfunction controller.
 *
 * @Route("eigenfunction")
 */
class EigenfunctionController extends Controller
{
    /**
     * Lists all eigenfunction entities.
     *
     * @Route("/", name="eigenfunction_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $eigenfunctions = $em->getRepository('TRBundle:Eigenfunction')->findAll();

        return $this->render('eigenfunction/index.html.twig', [
            'eigenfunctions' => $eigenfunctions]);
    }

    /**
     * Creates a new eigenfunction entity.
     *
     * @Route("/new", name="eigenfunction_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $eigenfunction = new Eigenfunction();
        $form          = $this->createForm('TRBundle\Form\EigenfunctionType', $eigenfunction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($eigenfunction);
            $eigenfunction->next->map(function ($s) use ($em, $eigenfunction) {$eigenfunction->previous = $s; $em->persist($s);});
            $em->flush();

            return $this->redirectToRoute('board_show');
        }

        return $this->render('eigenfunction/new.html.twig', [
            'eigenfunction_index' => $eigenfunction,
            'form'                => $form->createView()]);
    }

    /**
     * Finds and displays a eigenfunction entity.
     *
     * @Route("/{id}", name="eigenfunction_show")
     * @Method("GET")
     */
    public function showAction(Eigenfunction $eigenfunction)
    {
        $deleteForm = $this->createDeleteForm($eigenfunction);

        return $this->render('eigenfunction/show.html.twig', [
            'eigenfunction_index' => $eigenfunction,
            'delete_form'         => $deleteForm->createView()]);
    }

    /**
     * Displays a form to edit an existing eigenfunction entity.
     *
     * @Route("/{id}/edit", name="eigenfunction_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(
        Request       $request,
        Eigenfunction $eigenfunction
    ) {
        $deleteForm = $this->createDeleteForm($eigenfunction);
        $editForm   = $this->createForm('TRBundle\Form\EigenfunctionType', $eigenfunction);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $eigenfunction->next->map(function ($s) use ($em, $eigenfunction) {$s->addPrev($eigenfunction); $em->persist($s);});
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('board_show');
        }

        return $this->render('eigenfunction/edit.html.twig', [
            'eigenfunction_index' => $eigenfunction,
            'form'                => $editForm->createView(),
            'delete_form'         => $deleteForm->createView()]);
    }

    /**
     * Deletes a eigenfunction entity.
     *
     * @Route("/{id}", name="eigenfunction_delete")
     * @Method("DELETE")
     */
    public function deleteAction(
        Request       $request,
        eigenfunction $eigenfunction
    ) {
        $form = $this->createDeleteForm($eigenfunction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($eigenfunction);
            $em->flush();
        }

        return $this->redirectToRoute('board_show');
    }

    /**
     * Creates a form to delete a eigenfunction entity.
     *
     * @param eigenfunction $eigenfunction The eigenfunction entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(eigenfunction $eigenfunction)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('eigenfunction_delete', ['id' => $eigenfunction->getId()]))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
