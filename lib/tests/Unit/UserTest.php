<?php

namespace Tests\Unit;

use Box\Entity\Repository\User\UserRepository;
use Box\Entity\User\UserEntity;
use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\Exception;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function test_find_all_user()
    {
           $user = new UserRepository();
            $results = $user->all();
           $this->assertGreaterThan(0, $results->count());
    }
    /**
     * @test
     */
    public function test_find_find_by_id_user()
    {
        try {
            $user = new UserRepository();
            $results = $user->find(1);
            $this->assertGreaterThan(0, $results->count());
        } catch(Exception $e) {
            Log::error('something error', $e);
        }

    }
}
