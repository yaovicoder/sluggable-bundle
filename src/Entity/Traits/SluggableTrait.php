<?php

namespace Vendor\SluggableBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Trait SluggableTrait
 *
 * Adds a slug field and Gedmo Slug annotation to the entity using the 'title' field.
 * Automatically used in conjunction with SluggableInterface.
 *
 * @author Your Name
 */
trait SluggableTrait
{
    #[ORM\Column(length: 255, unique: true)]
    #[Gedmo\Slug(fields: ['title'])]
    protected ?string $slug = null;

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }
}
