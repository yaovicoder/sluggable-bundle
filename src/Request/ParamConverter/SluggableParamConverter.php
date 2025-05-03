<?php

namespace YIC\SluggableBundle\Request\ParamConverter;

use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use YIC\SluggableBundle\Entity\Interface\SluggableInterface;

class SluggableParamConverter implements ParamConverterInterface
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function apply(Request $request, ParamConverter $configuration): bool
    {
        $class = $configuration->getClass();
        $param = $configuration->getName();
        $value = $request->attributes->get($param);

        if (!$class || !$value) return false;

        $repository = $this->em->getRepository($class);
        $entity = is_numeric($value) 
            ? $repository->find($value) 
            : $repository->findOneBy(['slug' => $value]);

        if (!$entity) {
            throw new NotFoundHttpException(sprintf('%s not found', $class));
        }

        $request->attributes->set($param, $entity);
        return true;
    }

    public function supports(ParamConverter $configuration): bool
    {
        return is_a($configuration->getClass(), SluggableInterface::class, true);
    }
}