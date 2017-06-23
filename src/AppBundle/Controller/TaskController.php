<?php
/**
 * Created by PhpStorm.
 * User: vyskovsky
 * Date: 22.06.2017
 * Time: 17:34
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Form;
use AppBundle\Form\TaskType;

class TaskController extends Controller
{
  /**
   * @Route("/form/create")
   */
  public function createFormAction(Request $request)
  {
    // create a task and give it some dummy data for this example
    $task = new Task();
    $task->setTask('Write a blog post');
    $task->setDueDate(new \DateTime('tomorrow'));

    $form = $this->createForm(TaskType::class, $task);
    /*
    $form = $this->createFormBuilder($task)
      ->add('task', TextType::class)
      ->add('dueDate', DateType::class)
      ->add('save', SubmitType::class, array('label' => 'Create Post'))
      ->getForm();
    */

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      // $form->getData() holds the submitted values
      // but, the original `$task` variable has also been updated
      $task = $form->getData();

      // ... perform some action, such as saving the task to the database
      // for example, if Task is a Doctrine entity, save it!
      $em = $this->getDoctrine()->getManager();
      $em->persist($task);
      $em->flush();

      return $this->redirectToRoute('task_success');
    }

    return $this->render('task/taskForm.html.twig', array(
      'form' => $form->createView(),
    ));
  }

  /**
   * @Route("/users/success", name="task_success")
   */
  public function successAction(Request $request)
  {
    return $this->render('task/success.html.twig', array(
      'id' => '1',
    ));
  }

  /**
   * @Route("/form/task", name="task_success")
   */
/*
  public function postTypeAction(Request $request)
  {
    $post = new Post();
    $form = $this->createForm(PostType::class, $post);

  }
*/

}