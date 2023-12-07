<?php

namespace Feature;

use App\Models\Task;
use Tests\TestCase;

class TasksTest extends TestCase
{
    public function testUsersCreate()
    {
        Task::truncate();
        $response = $this->get('/api/tasks');
        $response->assertStatus(200);
        $this->assertEquals(0, $this->getTasksAmount($response->content()));

        $response = $this->post('/api/tasks', [
            'title' => 'Test 1',
            'description' => 'Test 1',
            'status' => 'new'
        ]);

        $response->assertStatus(201);
        $response = $this->get('/api/tasks');
        $response->assertStatus(200);
        $this->assertEquals(1, $this->getTasksAmount($response->content()));
    }

    public function testUsersDelete()
    {
        Task::truncate();
        $response = $this->post('/api/tasks', [
            'title' => 'Test 1',
            'description' => 'Test 1',
            'status' => 'new'
        ]);
        $response->assertStatus(201);

        $response = $this->post('/api/tasks', [
            'title' => 'Test 2',
            'description' => 'Test 2',
            'status' => 'new'
        ]);
        $response->assertStatus(201);

        $response = $this->get('/api/tasks');
        $response->assertStatus(200);
        $this->assertEquals(2, $this->getTasksAmount($response->content()));

        $task = json_decode($response->content())->data[0];
        $response = $this->delete('/api/tasks/' . $task->id);
        $response->assertStatus(200);

        $response = $this->get('/api/tasks');
        $response->assertStatus(200);
        $this->assertEquals(1, $this->getTasksAmount($response->content()));
    }

    private function getTasksAmount($data)
    {
        $json = json_decode($data);
        if($json->data) {
            return count($json->data);
        }

        return 0;
    }
}
