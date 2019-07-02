<?php

use App\Models\Author;
use App\Models\Post;
use App\Models\Role;
use App\Models\SubForum;
use Illuminate\Database\Seeder;
use Tests\Shared\Domain\ValueObject\ContentStub;
use Tests\Shared\Domain\ValueObject\CreatedAtStub;
use Tests\Shared\Domain\ValueObject\SlugStub;
use Tests\Shared\Domain\ValueObject\TitleStub;
use Tests\Shared\Domain\ValueObject\UpdatedAtStub;
use Tests\TrophyForum\Authors\Domain\AuthorAvatarStub;
use Tests\TrophyForum\Authors\Domain\AuthorIdStub;
use Tests\TrophyForum\Authors\Domain\AuthorNameStub;
use Tests\TrophyForum\Posts\Domain\PostIdStub;
use Tests\TrophyForum\Posts\Domain\PostIsOpenStub;
use Tests\TrophyForum\Roles\Domain\RoleIdStub;
use Tests\TrophyForum\Roles\Domain\RoleNameStub;
use Tests\TrophyForum\SubForums\Domain\SubForumDescriptionStub;
use Tests\TrophyForum\SubForums\Domain\SubForumIsAnnounceStub;
use Tests\TrophyForum\SubForums\Domain\SubForumNameStub;
use TrophyForum\SubForums\Domain\SubForumId;

final class SubForumsTableSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $authorId = AuthorIdStub::random()->value();

            Author::create(
                [
                    'id'     => $authorId,
                    'name'   => AuthorNameStub::random()->value(),
                    'avatar' => AuthorAvatarStub::random()->value(),
                ]
            );

            $subForumId = SubForumId::random()->value();

            SubForum::create(
                [
                    'id'          => $subForumId,
                    'author_id'   => $authorId,
                    'name'        => SubForumNameStub::random()->value(),
                    'description' => SubForumDescriptionStub::random()->value(),
                    'is_announce' => SubForumIsAnnounceStub::random()->value(),
                    'slug'        => SlugStub::random()->value(),
                    'created_at'  => CreatedAtStub::random()->value(),
                    'updated_at'  => UpdatedAtStub::random()->value(),
                ]
            );

            for ($j = 0; $j < rand(0, 10); $j++) {
                $authorId = AuthorIdStub::random()->value();

                Author::create(
                    [
                        'id'     => $authorId,
                        'name'   => AuthorNameStub::random()->value(),
                        'avatar' => AuthorAvatarStub::random()->value(),
                    ]
                );

                Post::create(
                    [
                        'id'           => PostIdStub::random()->value(),
                        'sub_forum_id' => $subForumId,
                        'author_id'    => $authorId,
                        'title'        => TitleStub::random()->value(),
                        'content'      => ContentStub::random()->value(),
                        'is_open'      => PostIsOpenStub::random()->value(),
                        'slug'         => SlugStub::random()->value(),
                        'created_at'   => CreatedAtStub::random()->value(),
                        'updated_at'   => UpdatedAtStub::random()->value(),
                    ]
                );
            }

            Role::create(
                [
                    'id'        => RoleIdStub::random()->value(),
                    'author_id' => $authorId,
                    'name'      => RoleNameStub::random()->value(),
                ]
            );
        }

        $roles = Role::all();

        SubForum::all()->each(
            function ($user) use ($roles) {
                $user->roles()->attach(
                    $roles->random(rand(1, 3))->pluck('id')->toArray()
                );
            }
        );
    }
}
