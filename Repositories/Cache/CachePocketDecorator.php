<?php

namespace Modules\Iwallet\Repositories\Cache;

use Modules\Iwallet\Repositories\PocketRepository;
use Modules\Core\Icrud\Repositories\Cache\BaseCacheCrudDecorator;

class CachePocketDecorator extends BaseCacheCrudDecorator implements PocketRepository
{
    public function __construct(PocketRepository $pocket)
    {
        parent::__construct();
        $this->entityName = 'iwallet.pockets';
        $this->repository = $pocket;
    }
}
