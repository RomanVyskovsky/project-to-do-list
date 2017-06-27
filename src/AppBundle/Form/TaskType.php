<?php

/**
 * Created by PhpStorm.
 * User:
 * Date: 22.06.2017
 * Time: 22:15
 */
namespace AppBundle\Form;

use AppBundle\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TaskType extends AbstractType
{
  /**
   * @param FormBuilderInterface $builder
   * @param array $options
   */
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('task', TextType::class, array(
        'label' => 'Name',
        'attr' => array('class' => 'form-control')))
      ->add('content', TextareaType::class, array(
        'label' => 'Content',
        'attr' => array('class' => 'form-control')))
      ->add('priority', ChoiceType::class, array(
        'choices' => array(
          'Low' => 'Low',
          'Normal' => 'Normal',
          'High' => 'High',
        ), 'attr' => array('class' => 'form-control')
      ))
      ->add('deadline', DateTimeType::class, array(
        'label' => 'Deadline', 'placeholder' => array(
          'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
          'hour' => 'Hour', 'minute' => 'Minute', 'second' => 'Second',
        )))
      ->add('save', SubmitType::class, array(
        'label' => 'Save', 'attr' => array('class' => 'btn-success')));
  }

  /**
   * @param OptionsResolver $resolver
   */
  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => Task::class,
    ));
  }
}