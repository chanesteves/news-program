<?php

namespace App\Classes;

class Comment
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var int
     */
    protected $newsId;

    /**
     * Set the ID of the comment.
     * 
     * @param int $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the ID of the comment.
     * 
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the body of the comment.
     * 
     * @param string $body
     * @return self
     */
    public function setBody(string $body): self
    {
        $this->body = $body;
        return $this;
    }

    /**
     * Get the body of the comment.
     * 
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Set the creation date of the comment.
     * 
     * @param \DateTime $createdAt
     * @return self
     */
    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Get the creation date of the comment.
     * 
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * Set the ID of the related news.
     * 
     * @param int $newsId
     * @return self
     */
    public function setNewsId(int $newsId): self
    {
        $this->newsId = $newsId;
        return $this;
    }

    /**
     * Get the ID of the related news.
     * 
     * @return int
     */
    public function getNewsId(): int
    {
        return $this->newsId;
    }
}
