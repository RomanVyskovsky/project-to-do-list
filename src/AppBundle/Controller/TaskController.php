<?php
/**
 * Created by PhpStorm.
 * User:
 * Date: 22.06.2017
 * Time: 17:34
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Form\TaskType;

class TaskController extends Controller
{
  /**
   * @Route("/", name="homepage")
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function indexAction()
  {
    return $this->render('task/index.html.twig');
  }

  /**
   * @Route("/task/list/", name="task_list")
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function listTasksAction()
  {
    $taskEntity = $this->getDoctrine()
      ->getRepository('AppBundle:Task')
      ->findBy(array('softDelete' => false), array('deadline' => 'ASC', 'id' => 'ASC'));

    return $this->render('task/list.html.twig', array(
      'taskList' => $taskEntity,
      'id' => null,
      'deleted' => null,
    ));
  }

  /**
   * @Route("/task/create", name="task_create")
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
   */
  public function createTaskAction(Request $request)
  {
    $task = new Task();

    $form = $this->createForm(TaskType::class, $task);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

      $task = $form->getData();

      // save task to database
      $em = $this->getDoctrine()->getManager();
      $em->persist($task);
      $em->flush();

      return $this->redirectToRoute('task_create_success', array('id' => $task->getId()));
    }

    return $this->render('task/form.html.twig', array(
      'form' => $form->createView(),
      'activity' => 'create',
    ));
  }

  /**
   * @Route("/task/create/success/{id}/", name="task_create_success")
   * @param Request $request
   * @param $id
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function successCreateAction(Request $request, $id)
  {
    $taskEntity = $this->getDoctrine()->getRepository('AppBundle:Task')->findOneBy(array('id' => $id));

    return $this->render('task/detail.html.twig', array(
      'taskEntity' => $taskEntity,
      'activity' => 'created',
      'id' => $id,
    ));
  }

  /**
   * @Route("/task/{id}/", name="task_detail")
   * @param Request $request
   * @param $id
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function detailTaskAction(Request $request, $id)
  {
    $taskEntity = $this->getDoctrine()->getRepository('AppBundle:Task')->findOneBy(array('id' => $id));

    return $this->render('task/detail.html.twig', array(
      'taskEntity' => $taskEntity,
      'activity' => null,
      'id' => $id,
    ));
  }

  /**
   * @Route("/task/edit/{id}", name = "task_edit", requirements={"id": "\d+"})
   * @param Request $request
   * @param $id
   * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
   */
  public function editTaskAction(Request $request, $id)
  {
    $taskEntity = $this->getDoctrine()->getRepository('AppBundle:Task')->findOneBy(array('id' => $id));

    $form = $this->createForm(TaskType::class, $taskEntity);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $task = $form->getData();

      $em = $this->getDoctrine()->getManager();
      $em->persist($task);
      $em->flush();

      return $this->redirectToRoute('task_update_success', array('id' => $task->getId()));
    }

    return $this->render('task/form.html.twig', array(
      'form' => $form->createView(),
      'activity' => 'edit',
    ));
  }

  /**
   * @Route("/task/edit/success/{id}/", name="task_update_success")
   * @param Request $request
   * @param $id
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function successUpdateAction(Request $request, $id)
  {
    $taskEntity = $this->getDoctrine()->getRepository('AppBundle:Task')->findOneBy(array('id' => $id));

    return $this->render('task/detail.html.twig', array(
      'taskEntity' => $taskEntity,
      'activity' => 'updated',
      'id' => $id,
    ));
  }

  /**
   * @Route("/task/{id}/delete", name="task_delete_success")
   * @param $id
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function deleteTaskAction($id)
  {
    $em = $this->getDoctrine()->getManager();

    $taskDeletedEntity = $this->getDoctrine()->getRepository('AppBundle:Task')->findOneBy(array('id' => $id));
    $taskDeletedEntity->setSoftDelete(true);

    $em->persist($taskDeletedEntity);
    $em->flush();

    $taskEntity = $this->getDoctrine()
      ->getRepository('AppBundle:Task')
      ->findBy(array('softDelete' => false), array('deadline' => 'ASC', 'id' => 'ASC')); // sorting is redundant

    return $this->render('task/list.html.twig', array(
      'taskList' => $taskEntity,
      'id' => $id,
      'deleted' => $taskDeletedEntity,
    ));
  }
}