<?php

namespace Tests\Database;

use Tests\TestCase;
use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GroupTest extends TestCase
{
    use RefreshDatabase;

    public function test_model_group_exists()
    {
        $group = Group::factory()->create();

        $this->assertModelExists($group);
    }

    public function test_model_group_delete()
    {
        $group = Group::factory()->create();

        $group->delete();

        $this->assertModelMissing($group);
    }

    public function test_model_group_duplication()
    {
        $group1 = Group::make([
            'owner'       => 3,
            'name'        => 'SSPTAJI',
            'description' => 'Střední škola technická, průmyslová a automobilní Jihlava',
            'photo'       => 'https://upload.wikimedia.org/wikipedia/commons/f/f9/Digitaloszilloskop_IMGP1971_WP.jpg',
        ]);

        $group2 = Group::make([
            'owner'       => 3,
            'name'        => 'ELM',
            'description' => 'Elektrotechnícké měření - IT4A',
            'photo'       => 'https://upload.wikimedia.org/wikipedia/commons/f/f9/Digitaloszilloskop_IMGP1971_WP.jpg',
        ]);

        $this->assertNotEquals($group1->getAttributes(), $group2->getAttributes());
    }

    public function test_database_contains_implicit_data()
    {
        $this->assertDatabaseHas('groups', [
            'owner'       => 3,
            'name'        => 'SSPTAJI',
            'description' => 'Střední škola technická, průmyslová a automobilní Jihlava',
            'photo'       => 'https://upload.wikimedia.org/wikipedia/commons/f/f9/Digitaloszilloskop_IMGP1971_WP.jpg',
        ]);

        $this->assertDatabaseHas('groups', [
            'owner'       => 3,
            'name'        => 'ELM',
            'description' => 'Elektrotechnícké měření - IT4A',
            'photo'       => 'https://upload.wikimedia.org/wikipedia/commons/f/f9/Digitaloszilloskop_IMGP1971_WP.jpg',
        ]);
    }

    public function test_database_update_group()
    {
        $group = Group::find(1);

        $group->owner      += 1;
        $group->name        = 'UpdatedName';
        $group->description = 'UpdatedDescription';
        $group->photo       = 'UpdatedPhoto';

        $group->save();

        $updatedGroup = Group::find(1);

        $this->assertEquals($group->getAttributes(), $updatedGroup->getAttributes());
    }

    public function test_database_delete_group()
    {
        $group = Group::find(1);

        $group->delete();

        $this->assertDeleted($group);
    }

    public function test_database_delete_group_teacher_cascade()
    {
        $group = Group::find(1);

        $group->delete();

        $this->assertDatabaseMissing('groups', [
            'id' => 1
        ]);

        $this->assertDatabaseHas('users', [
            'id' => 3
        ]);
    }

    public function test_database_delete_group_student_cascade()
    {
        $group = Group::find(2);

        $group->delete();

        $this->assertDatabaseMissing('groups', [
            'id' => 2
        ]);

        $this->assertDatabaseHas('users', [
            'id' => 2
        ]);

        $this->assertDatabaseHas('users', [
            'id' => 3
        ]);
    }

    public function test_database_data_count()
    {
        $this->assertDatabaseCount('groups', 27);

        $group = Group::find(1);

        $group->delete();

        $this->assertDatabaseCount('groups', 26);
    }
}
