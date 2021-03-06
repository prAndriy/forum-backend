<?php

declare(strict_types = 1);

namespace Tests\TrophyForum\Posts\Domain;

use Doctrine\ORM\PersistentCollection;
use Shared\Domain\ValueObject\Content;
use Shared\Domain\ValueObject\CreatedAt;
use Shared\Domain\ValueObject\InLike;
use Shared\Domain\ValueObject\Slug;
use Shared\Domain\ValueObject\Title;
use Shared\Domain\ValueObject\UnLike;
use Shared\Domain\ValueObject\UpdatedAt;
use Shared\Domain\ValueObject\Uuid;
use Tests\Shared\Domain\ValueObject\ContentStub;
use Tests\Shared\Domain\ValueObject\CreatedAtStub;
use Tests\Shared\Domain\ValueObject\InLikeStub;
use Tests\Shared\Domain\ValueObject\SlugStub;
use Tests\Shared\Domain\ValueObject\TitleStub;
use Tests\Shared\Domain\ValueObject\UnLikeStub;
use Tests\Shared\Domain\ValueObject\UpdatedAtStub;
use Tests\TrophyForum\Authors\Domain\AuthorStub;
use Tests\TrophyForum\SubForums\Domain\SubForumStub;
use TrophyForum\Authors\Domain\Author;
use TrophyForum\Posts\Domain\Post;
use TrophyForum\Posts\Domain\PostIsOpen;
use TrophyForum\Posts\Domain\PostVisualization;
use TrophyForum\SubForums\Domain\SubForum;

final class PostStub
{
    public static function create(
        Uuid $id,
        SubForum $subForum,
        Author $author,
        Title $title,
        Content $content,
        PostIsOpen $isOpen,
        PersistentCollection $responses = null,
        Slug $slug,
        PostVisualization $visualization,
        InLike $inLike,
        UnLike $unLike,
        CreatedAt $createdAt,
        UpdatedAt $updatedAt
    ): Post {
        return new Post(
            $id,
            $subForum,
            $author,
            $title,
            $content,
            $isOpen,
            $responses,
            $slug,
            $visualization,
            $inLike,
            $unLike,
            $createdAt,
            $updatedAt
        );
    }

    public static function withId(Uuid $id): Post
    {
        return self::create(
            $id,
            SubForumStub::random(),
            AuthorStub::random(),
            TitleStub::random(),
            ContentStub::random(),
            PostIsOpenStub::random(),
            null,
            SlugStub::random(),
            PostVisualizationStub::random(),
            InLikeStub::random(),
            UnLikeStub::random(),
            CreatedAtStub::random(),
            UpdatedAtStub::random()
        );
    }

    public static function random(): Post
    {
        return self::create(
            Uuid::random(),
            SubForumStub::random(),
            AuthorStub::random(),
            TitleStub::random(),
            ContentStub::random(),
            PostIsOpenStub::random(),
            null,
            SlugStub::random(),
            PostVisualizationStub::random(),
            InLikeStub::random(),
            UnLikeStub::random(),
            CreatedAtStub::random(),
            UpdatedAtStub::random()
        );
    }
}
