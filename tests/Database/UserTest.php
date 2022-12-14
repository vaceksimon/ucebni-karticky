<?php
/***********************************************************/
/*                                                         */
/* File: UserTest.php                                      */
/* Author: Tomas Bartu <xbartu11@stud.fit.vutbr.cz>        */
/* Project: Project for the course ITU                     */
/* Description: Database unit tests for User model         */
/*                                                         */
/***********************************************************/
namespace Tests\Database;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_model_user_exists()
    {
        $user = User::factory()->create();

        $this->assertModelExists($user);
    }

    public function test_model_user_delete()
    {
        $user = User::factory()->create();

        $user->delete();

        $this->assertModelMissing($user);
    }

    public function test_model_user_duplication()
    {
        $user1 = User::make([
            'first_name' => 'John',
            'last_name'  => 'Doe',
            'email'      => 'johndoe@gmail.com'
        ]);

        $user2 = User::make([
            'first_name' => 'Mary',
            'last_name'  => 'Jane',
            'email'      => 'maryjane@gmail.com'
        ]);

        $this->assertNotEquals($user1->getAttributes(), $user2->getAttributes());
    }

    public function test_database_contains_implicit_data()
    {
        $this->assertDatabaseHas('users', [
            'first_name' => 'admin',
            'last_name'  => 'admin',
            'email'      => 'admin@example.com',
        ]);

        $this->assertDatabaseHas('users', [
            'first_name' => 'Marek',
            'last_name'  => 'Dočekal',
            'email'      => 'speedy@example.com',
        ]);

        $this->assertDatabaseHas('users', [
            'degree_front' => 'Dr.',
            'first_name'   => 'Bohumil',
            'last_name'    => 'Brtník',
            'degree_after' => 'Ing.',
            'email'        => 'BBELM@example.com',
        ]);
    }

    public function test_database_update_user()
    {
        $user = User::find(2);

        $user->first_name = 'Josef';
        $user->last_name  = 'Rebenda';

        $user->save();

        $updatedUser = User::find(2);

        $this->assertEquals($user->getAttributes(), $updatedUser->getAttributes());
    }

    public function test_database_delete_user()
    {
        $user = User::find(1);

        $user->delete();

        $this->assertDeleted($user);
    }

    public function test_database_delete_user_teacher_cascade()
    {
        $user = User::find(3);

        $user->delete();

        $this->assertDatabaseMissing('exercises', [
            'id' => 1
        ]);

        $this->assertDatabaseMissing('groups', [
            'id' => 1
        ]);

        $this->assertDatabaseMissing('groups', [
            'id' => 2
        ]);

        $this->assertDatabaseMissing('flashcards', [
            'exercise_id' => 1
        ]);

        $this->assertDatabaseHas('users', [
           'id' => 2
        ]);
    }

    public function test_database_delete_user_student_cascade()
    {
        $user = User::find(2);

        $user->delete();

        $this->assertDatabaseHas('exercises', [
            'id' => 1
        ]);

        $this->assertDatabaseHas('users', [
            'id' => 3
        ]);

        $this->assertDatabaseHas('groups', [
            'id' => 2
        ]);

        $this->assertDatabaseMissing('attempts', [
            'user_id' => 2
        ]);
    }

    public function test_database_data_count()
    {
        $this->assertDatabaseCount('users', 100);

        $user = User::find(1);

        $user->delete();

        $this->assertDatabaseCount('users', 99);
    }
}
