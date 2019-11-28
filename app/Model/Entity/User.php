<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 用户表
 * Class User
 *
 * @since 2.0
 *
 * @Entity(table="user")
 */
class User extends Model
{
    /**
     * 创建时间
     *
     * @Column(name="_intm", prop="intm")
     *
     * @var int
     */
    private $intm;

    /**
     * 更新时间
     *
     * @Column(name="_uptm", prop="uptm")
     *
     * @var int
     */
    private $uptm;

    /**
     * ID
     * @Id()
     * @Column()
     *
     * @var int
     */
    private $id;

    /**
     * 用户名
     *
     * @Column(name="name", prop="username")
     *
     * @var string
     */
    private $name;

    /**
     * 密码
     *
     * @Column(hidden=true)
     *
     * @var string
     */
    private $pwd;

    /**
     * 状态
     *
     * @Column()
     *
     * @var int
     */
    private $status;

    /**
     * token
     *
     * @Column()
     *
     * @var string
     */
    private $token;


    /**
     * @param int $intm
     *
     * @return void
     */
    public function setIntm(int $intm): void
    {
        $this->intm = $intm;
    }

    /**
     * @param int $uptm
     *
     * @return void
     */
    public function setUptm(int $uptm): void
    {
        $this->uptm = $uptm;
    }

    /**
     * @param int $id
     *
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $name
     *
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $pwd
     *
     * @return void
     */
    public function setPwd(string $pwd): void
    {
        $this->pwd = $pwd;
    }

    /**
     * @param int $status
     *
     * @return void
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @param string $token
     *
     * @return void
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * @return int
     */
    public function getIntm(): ?int
    {
        return $this->intm;
    }

    /**
     * @return int
     */
    public function getUptm(): ?int
    {
        return $this->uptm;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPwd(): ?string
    {
        return $this->pwd;
    }

    /**
     * @return int
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

}
