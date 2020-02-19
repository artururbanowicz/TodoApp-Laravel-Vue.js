<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Auth;
use TaskApp\Task;
use Tests\TestCase;
use TaskApp\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
class ExampleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function test_see_tasks(){
        $task = factory('TaskApp\Task')->create();
        $response = $this->get('/getTasks');
        $response->assertSee($task->name);
    }

    public function test_delete_task(){
        $this->actingAs(factory('TaskApp\User')->create());
        $task = factory('TaskApp\Task')->create(['id' => Auth::id()]);
        $this->post('/deleteTask/'.$task->id);
        $this->assertDatabaseMissing('tasks',['id'=> $task->id]);
    }

    public function test_create_task(){
        $this->actingAs(factory('TaskApp\User')->create());
        $task = factory('TaskApp\Task')->make();
        $this->post('/storeTask',$task->toArray());
        $this->assertEquals(1,Task::all()->count());
    }

    public function test_register_user(){
        $attributes = factory('TaskApp\User')->create()->toArray();
        $this->json('POST', '/register', $attributes);
        $this->assertDatabaseHas('users', $attributes);
    }

    public function test_user_can_view_login_form()
    {
        $response = $this->get('/login');
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function test_user_can_login_with_correct_credentials()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'i-love-laravel'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }


}
