<?php declare(strict_types=1);
    
namespace App\Http\Bean;
use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * Class Aa
 * @Bean("aa")
 * @package App\Http\Bean
 */
class Aa
{
    public function hello()
    {
        return __METHOD__;
    }
}