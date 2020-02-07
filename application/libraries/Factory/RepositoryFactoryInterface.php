<?php

namespace Lib\Factory;

use Lib\Repository\RepositoryInterface;

interface RepositoryFactoryInterface
{
    public function createRepository(): RepositoryInterface;
}
