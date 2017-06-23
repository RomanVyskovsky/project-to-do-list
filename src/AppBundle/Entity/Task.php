<?php
/**
 * Created by PhpStorm.
 * User: vyskovsky
 * Date: 22.06.2017
 * Time: 17:30
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

//use Symfony\Component\Validator\Constraints as Assert;
//use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
//use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Task
 *
 * @ORM\Table(name="task")
 * @ORM\Entity
 */
class Task
{
  /**
   * @var integer
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="SEQUENCE")
   * @ORM\SequenceGenerator(sequenceName="task_id_seq", allocationSize=1, initialValue=1)
   */
  protected $id;

  /**
   * @var string
   *
   * @ORM\Column(name="name", type="string", length=1000, nullable=false)
   */
  protected $task;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="created", type="datetime", nullable=false)
   */
  protected $dueDate = 'now()';

  /**
   * @return int
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param int $id
   */
  public function setId($id)
  {
    $this->id = $id;
  }

  /**
   * @return string
   */
  public function getTask()
  {
    return $this->task;
  }

  /**
   * @param string $task
   */
  public function setTask($task)
  {
    $this->task = $task;
  }

  /**
   * @return \DateTime
   */
  public function getDueDate()
  {
    return $this->dueDate;
  }

  /**
   * @param \DateTime $dueDate
   */
  public function setDueDate($dueDate)
  {
    $this->dueDate = $dueDate;
  }


}