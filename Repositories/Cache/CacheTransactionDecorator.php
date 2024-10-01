<?php

namespace Modules\Iwallet\Repositories\Cache;

use Modules\Iwallet\Repositories\TransactionRepository;
use Modules\Core\Icrud\Repositories\Cache\BaseCacheCrudDecorator;

class CacheTransactionDecorator extends BaseCacheCrudDecorator implements TransactionRepository
{
    public function __construct(TransactionRepository $transaction)
    {
        parent::__construct();
        $this->entityName = 'iwallet.transactions';
        $this->repository = $transaction;
    }
}
