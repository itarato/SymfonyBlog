<?php

namespace Itarato\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="blog_post")
 */
class BlogPost
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var Integer
     */
    protected $bid;

    /**
     * @ORM\Column(type="text")
     * @var String
     */
    protected $body;

    /**
     * @ORM\Column(type="integer")
     * @var Integer
     */
    protected $created;

    /**
     * @param $bid
     * @return BlogPost
     */
    public function setBid($bid) {
        $this->bid = $bid;
        return $this;
    }

    /**
     * @return int
     */
    public function getBid() {
        return $this->bid;
    }

    /**
     * @param String $body
     * @return BlogPost
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return String
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param int $created
     * @return BlogPost
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return int
     */
    public function getCreated()
    {
        return $this->created;
    }
}
