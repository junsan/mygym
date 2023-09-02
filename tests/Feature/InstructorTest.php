<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\ClassType;
use App\Models\ScheduledClass;
use Database\Seeders\ClassTypeSeeder;

class InstructorTest extends TestCase
{
    //use RefreshDatabase;

    public function test_instructor_is_redirected_to_instructor_dashboard() {

        $user = User::where('role', 'instructor')->first();

        // $user = User::factory()->create([
        //     'role' => 'instructor'
        // ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertRedirectToRoute('instructor.dashboard');

        $this->followRedirects($response)->assertSeeText('Hello Instructor');
    }

    public function test_instructor_can_create_schedule_class() {
        
        $user = User::where('role', 'instructor')->first();

        // $user = User::factory()->create([
        //     'role' => 'instructor'
        // ]);

        //$this->seed(ClassTypeSeeder::class);

        $response = $this->actingAs($user)->post('instructor/schedule', [
            'class_type_id' => ClassType::first()->id,
            'date' => '2023-09-28',
            'time' => '12:00:00'
        ]);

        $this->assertDatabaseHas('scheduled_classes', [
            'class_type_id' => ClassType::first()->id,
            'date_time' => '2023-09-28 12:00:00',
        ]);

        $response->assertRedirectToRoute('schedule.index');
    }

    public function test_instructor_can_delete_class() {
        $user = User::where('role', 'instructor')->first();

        $scheduledClass = ScheduledClass::create([
            'instructor_id' => $user->id,
            'class_type_id' => ClassType::first()->id,
            'date_time' => '2023-09-16 14:00:00'
        ]);

        $response = $this->actingAs($user)->delete('instructor/schedule/'.$scheduledClass->id);

        $this->assertDatabaseMissing('scheduled_classes', [
            'id' => $scheduledClass->id
        ]);

        $response->assertRedirectToRoute('schedule.index');
    }

    public function test_instructor_cannot_cancel_class_less_than_two_hours_before() {
        $user = User::where('role', 'instructor')->first();

        $scheduledClass = ScheduledClass::create([
            'instructor_id' => $user->id,
            'class_type_id' => ClassType::first()->id,
            'date_time' => now()->addHours(1)->minutes(35)->seconds(0)
        ]);

        $response = $this->actingAs($user)->get('instructor/schedule');

        $response->assertDontSeeText('Cancel');

        $response = $this->actingAs($user)->delete('instructor/schedule/'.$scheduledClass->id);

        $this->assertDatabaseHas('scheduled_classes', [
            'id' => $scheduledClass->id
        ]);
    }
}
