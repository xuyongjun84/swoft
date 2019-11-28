<?php declare(strict_types=1);
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://swoft.org/docs
 * @contact  group@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Http\Controller;

use App\Model\Entity\User;
use phpDocumentor\Reflection\Types\Context;
use Swoft\Http\Message\Cookie;
use Swoft;
use Swoft\Exception\SwoftException;
use Swoft\Http\Message\ContentType;
use Swoft\Http\Message\Response;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\View\Renderer;
use App\Exception\ApiException;
use Throwable;
use function context;
use Swoole\Table;
/**
 * Class HomeController
 * @Controller()
 */
class HomeController
{
    /**
     * @RequestMapping("/login")
     *
     *
     * @return Response
     * @throws SwoftException
     */
    public function login():Response
    {
        Swoft\Log\Helper\CLog::info(context()->getRequest()->getUriPath());
        return context()->getResponse()->withCookies(['id' => 'good'])->withContent('login succ');
    }
    /**
     * @RequestMapping("/hi")，
     *
     *
     * @return Response
     * @throws SwoftException
     */
    public function hi(): Response
    {

        $table =  new Table(10);
        $table->column('a', Table::TYPE_INT, 1);
        $table->column('b', Table::TYPE_STRING, 20);
        $table->create();

        $table->set('a', ['a' => 'good']);
        var_dump($table->get('a'));
        //throw new ApiException();
    }

    /**
     * @RequestMapping("/")
     * @throws Throwable
     */
    public function index(): Response
    {
        return context()->getResponse()->withContentType(ContentType::HTML)->withContent('hello');
        $value = [
        'goods' => [
            'goods_id'   => 1,
            'goods_name' => 'iPhone xx'
        ]
    ];
        Swoft\Redis\Redis::set('peter', $value);
        /** @var Renderer $renderer */
        $renderer = Swoft::getBean('view');
        $content  = $renderer->render('home/index');
        $name = context()->getRequest()->get("info");
        return context()->getResponse()->withContentType(ContentType::HTML)->withContent($content);
    }

    /**
     * @RequestMapping("hello[/{name}]", method=RequestMethod::GET)
     * @param string $name
     *
     * @return Response
     * @throws SwoftException
     */
    public function hello(string $name): Response
    {
        return context()->getResponse()->withContent('Hello' . ($name === '' ? '' : ", {$name}"));
    }
}
