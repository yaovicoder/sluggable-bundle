# Sluggable Bundle

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)

A Symfony bundle that provides automatic slug generation and slug-based routing (ParamConverter resolution by ID or slug) for Doctrine entities implementing `SluggableInterface`.
## ✨Features

- Generic `SluggableInterface` for entities
- ParamConverter that works with both IDs and slugs
- Automatic service registration
- Works with Gedmo Sluggable behavior

## 🧩Installation

1. Install the bundle via Composer:

```bash
composer require yic/sluggable-bundle
```

## ⚙️Basic Usage

### Implement `Sluggable` 

```php
use YIC\SluggableBundle\Entity\Interface\SluggableInterface;
use Gedmo\Mapping\Annotation as Gedmo;

class Product implements SluggableInterface
{
    #[Gedmo\Slug(fields: ['title'])]
    private ?string $slug = null;

    public function getSlug(): ?string {
        return $this->slug;
    }

    public function setSlug(?string $slug): self {
        $this->slug = $slug;
        return $this;
    }
}
```

### Use in controllers

```php
#[Route('/products/{id}', name: 'product_show')]
public function show(Product $product): Response
{
    // Works with:
    // /products/1         (ID)
    // /products/some-name (slug)
}
```

## Configuration

Default config (`config/packages/yic_sluggable.yaml`):

```
yic_sluggable:
    # Enable slug fallback when ID not found
    slug_fallback: true      
```  

## Development Setup

```bash
# Clone
git clone https://github.com/yaovicoder/sluggable-bundle.git
cd sluggable-bundle

# Install deps
composer install

# Run tests
composer test
```

## 📦 Dependencies

### Core Requirements

```markdown
| Package                          | Version   | Purpose                   |
|----------------------------------|-----------|---------------------------|
| php                              | ^8.1      | PHP runtime               |
| symfony/framework-bundle         | ^6.4      | Symfony core              |
| doctrine/orm                     | ^2.15     | Database abstraction      |
| gedmo/doctrine-extensions        | ^3.11     | Slug behavior             |
| sensio/framework-extra-bundle    | ^6.0      | ParamConverter            |
```

### Development Dependencies

```
| Package                          | Version   | Purpose                   |
|----------------------------------|-----------|---------------------------|
| phpunit/phpunit                  | ^10.0     | Testing                   |
| symfony/phpunit-bridge           | ^6.4      | Symfony test integration  |
| vimeo/psalm                      | ^5.22     | Static analysis           |
```


