<?php declare(strict_types=1);

namespace Swoft\Tcp\Server;

use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Contract\SessionInterface;
use Swoft\Stdlib\Concern\DataPropertyTrait;
use Swoft\Stdlib\Helper\JsonHelper;
use function bean;
use function microtime;

/**
 * Class Connection
 *
 * @since 2.0.3
 * @Bean(scope=Bean::PROTOTYPE)
 */
class Connection implements SessionInterface
{
    use DataPropertyTrait;

    private const METADATA_KEY = '_metadata';

    /**
     * @var int
     */
    private $fd = 0;

    /**
     * @param int   $fd
     * @param array $clientInfo
     *
     * @return Connection
     */
    public static function new(int $fd, array $clientInfo): self
    {
        /** @var self $conn */
        $conn = bean(self::class);

        // Initial properties
        $conn->fd = $fd;
        $conn->initMetadata($fd, $clientInfo);

        // Init meta info
        return $conn;
    }

    /**
     * Create an connection from metadata array
     *
     * @param array $metadata
     *
     * @return Connection
     */
    public static function newFromArray(array $metadata): self
    {
        /** @var self $conn */
        $conn = bean(self::class);

        $conn->fd = $metadata['fd'];
        $conn->set(self::METADATA_KEY, $metadata);

        return $conn;
    }

    /**
     * @param int   $fd
     * @param array $info
     */
    private function initMetadata(int $fd, array $info): void
    {
        // $info = server()->getClientInfo($fd);
        server()->log("Connect: conn#{$fd} send connect request to server, client info: ", $info, 'debug');

        $this->set(self::METADATA_KEY, [
            'fd'           => $fd,
            'ip'           => $info['remote_ip'],
            'port'         => $info['remote_port'],
            // 'path'          => $path,
            'connectTime'  => $info['connect_time'],
            'connectFtime' => microtime(true),
        ]);
    }

    /**
     * @return int
     */
    public function getFd(): int
    {
        return $this->fd;
    }

    /**
     * @return array
     */
    public function getMetadata(): array
    {
        return $this->get(self::METADATA_KEY, []);
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function getMetaValue(string $key)
    {
        $data = $this->get(self::METADATA_KEY, []);

        return $data[$key] ?? null;
    }

    /**
     * Clear resource
     */
    public function clear(): void
    {
        $this->fd   = 0;
        $this->data = [];
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->getMetadata();
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return JsonHelper::encode($this->getMetadata());
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
