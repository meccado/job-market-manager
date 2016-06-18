<?php
namespace Meccado\JobMarketManager\Facade;
use Illuminate\Support\Facades\Facade;

class JobMarketManagerFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'article_admin';
    }
}
