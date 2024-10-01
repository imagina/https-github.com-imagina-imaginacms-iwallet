<?php

namespace Modules\Iwallet\Repositories\Cache;

use Modules\Iwallet\Repositories\CategoryRepository;
use Modules\Core\Icrud\Repositories\Cache\BaseCacheCrudDecorator;

class CacheCategoryDecorator extends BaseCacheCrudDecorator implements CategoryRepository
{
    public function __construct(CategoryRepository $category)
    {
        parent::__construct();
        $this->entityName = 'iwallet.categories';
        $this->repository = $category;
    }
}
