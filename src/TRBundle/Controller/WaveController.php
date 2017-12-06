<?php

namespace TRBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TRBundle\Entity\Wave;

/**
 * Wave controller.
 *
 * @Route("wave")
 */
class WaveController extends Controller
{
    /**
     * Lists all wave entities.
     *
     * @Route("/", name="wave_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $waves = $em->getRepository('TRBundle:Wave')->findAll();

        return $this->render('wave/index.html.twig', [
            'waves' => $waves,
        ]);
    }

    /**
     * Creates a new wave entity.
     *
     * @Route("/new", name="wave_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $wave = new Wave();
        $form = $this->createForm('TRBundle\Form\WaveType', $wave);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($wave);
            $em->flush();

            return $this->redirectToRoute('wave_index');
        }

        return $this->render('wave/new.html.twig', [
            'wave_index' => $wave,
            'form'       => $form->createView(),
        ]);
    }

    /**
     * Finds and displays a wave entity.
     *
     * @Route("/{id}", name="wave_show")
     * @Method("GET")
     */
    public function showAction(Wave $wave)
    {
        $deleteForm = $this->createDeleteForm($wave);

        return $this->render('wave/show.html.twig', [
            'wave_index'  => $wave,
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Displays a form to edit an existing wave entity.
     *
     * @Route("/{id}/edit", name="wave_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(
        Request $request,
        Wave    $wave
    ) {
        $deleteForm = $this->createDeleteForm($wave);
        $editForm   = $this->createForm('TRBundle\Form\WaveType', $wave);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('wave_index');
        }

        return $this->render('wave/edit.html.twig', [
            'wave_index'  => $wave,
            'form'        => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Deletes a wave entity.
     *
     * @Route("/{id}", name="wave_delete")
     * @Method("DELETE")
     */
    public function deleteAction(
        Request $request,
        Wave    $wave
    ) {
        $form = $this->createDeleteForm($wave);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($wave);
            $em->flush();
        }

        return $this->redirectToRoute('wave_index');
    }

    /**
     * Creates a form to delete a wave entity.
     *
     * @param Wave $wave The wave entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Wave $wave)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('wave_delete', ['id' => $wave->getId()]))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
