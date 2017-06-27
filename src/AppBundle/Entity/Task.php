<?php
/**
 * Created by PhpStorm.
 * User:
 * Date: 22.06.2017
 * Time: 17:30
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
   * @var string
   *
   * @ORM\Column(name="content", type="string", length=10000, nullable=false)
   */
  protected $content;

  /**
   * @var string
   *
   * @ORM\Column(name="priority", type="string", length=1000, nullable=false)
   */
  protected $priority;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="deadline", type="datetime", nullable=false)
   */
  protected $deadline;

  /**
   * @var boolean
   *
   * @ORM\Column(name="softDelete", type="boolean", nullable=false)
   */
  protected $softDelete = false;

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
   * @return string
   */
  public function getContent()
  {
    return $this->content;
  }

  /**
   * @param string $content
   */
  public function setContent($content)
  {
    $this->content = $content;
  }

  /**
   * @return string
   */
  public function getPriority()
  {
    return $this->priority;
  }

  /**
   * @param string $priority
   */
  public function setPriority($priority)
  {
    $this->priority = $priority;
  }

  /**
   * @return \DateTime
   */
  public function getDeadline()
  {
    return $this->deadline;
  }

  /**
   * @param \DateTime $deadline
   */
  public function setDeadline(\DateTime $deadline = null)
  {
    $this->deadline = $deadline;
  }

  /**
   * @return bool
   */
  public function isSoftDelete()
  {
    return $this->softDelete;
  }

  /**
   * @param bool $softDelete
   */
  public function setSoftDelete($softDelete)
  {
    $this->softDelete = $softDelete;
  }

}