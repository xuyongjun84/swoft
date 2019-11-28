<?php declare(strict_types=1);
namespace App\Http\Bean;
use Swoft\Bean\BeanFactory;

/**
 * Class Peter
 * @package App\Http\Bean
 */
class Peter
{
    public $aa;
    public function __construct(Aa $aa)
    {
        $this->aa = $aa;
    }
    
    public function hello(){
        return __METHOD__.'--'.$this->aa->hello();
    }
}
