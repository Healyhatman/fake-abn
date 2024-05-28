# Fake-ABN

Faker provider for valid Australian Business Numbers (ABNs) in PHP.

## Installation

To install as a dev dependency using composer:

```bash
composer require healyhatman/fake-abn --dev
```

Remove the `--dev` flag if you want to install as a regular dependency.

## Basic usage

```php
// Plain PHP
$faker = (new \Faker\Factory())::create();
$faker->addProvider(new \Faker\Provider\FakeAbn($faker));
```

## Usage in Laravel factory

```php
<?php
namespace Database\Factories;

use App\Models\Company;
use Faker\Provider\FakeAbn;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition()
    {
        $this->faker->addProvider(new FakeAbn($this->faker));

        return [
            'abn' => $this->faker->abn,
            'name' => $this->faker->company,
        ];
    }
}
```

 
