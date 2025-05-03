<?php

namespace YIC\SluggableBundle\Entity\Interface;

interface SluggableInterface
{
    public function getSlug(): ?string;
    public function setSlug(?string $slug): self;
}