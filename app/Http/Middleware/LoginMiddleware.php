<?php declare(strict_types=1);
    
namespace App\Http\Middleware;

use Swoft\Bean\Annotation\Mapping\Bean;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Swoft\Http\Server\Contract\MiddlewareInterface;
use Swoft\Log\Helper\CLog;

/**
 * Class LoginMiddleware
 * @package App\Http\Middleware
 * @Bean()
 */
class LoginMiddleware implements MiddlewareInterface
{
    /**
     * Process an incoming server request.
     *
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     *
     * @return ResponseInterface
     * @inheritdoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // TODO: Implement process() method.
        $cookie = $request->getCookieParams();
        if(empty($cookie['id']) && $request->getUriPath() !== '/login'){
            return context()->getResponse()->redirect('/login');
        }
        context()->set("id", date("YmdHis"));
        CLog::info(var_export($cookie, true));
        return $handler->handle($request);
    }
}