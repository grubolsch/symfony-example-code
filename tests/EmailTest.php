<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

class User {
    private $isPremium = false;

    /**
     * User constructor.
     * @param bool $isPremium
     */
    public function __construct(bool $isPremium)
    {
        $this->isPremium = $isPremium;
    }

    public function isPremium(): bool
    {
        return $this->isPremium;
    }
}

class Room {
    private $isPremium = false;

    /**
     * User constructor.
     * @param bool $isPremium
     */
    public function __construct(bool $isPremium)
    {
        $this->isPremium = $isPremium;
    }

    public function isPremium(): bool
    {
        return $this->isPremium;
    }

    public function canBook(User $user) : bool
    {
        return (
            !$this->isPremium() ||
            $user->isPremium() === $this->isPremium());
        // return true;
    }
}

// Rooms marked as premium can only be hired for premium members
final class EmailTest extends TestCase
{
    private function dataProviderForPremiumRoom() : array
    {
        return [
            [true, true, true],
            [false, false, true],
            [false, true, true],
            [true, false, false]
        ];
    }

    /**
     * @dataProvider dataProviderForPremiumRoom
     */
    public function testPremiumRoom(): void
    {
        $room = new Room(true);
        $user = new User(true);

        $this->assertTrue($room->canBook($user));

        $room = new Room(true);
        $user = new User(false);

        $this->assertFalse($room->canBook($user));

        $room = new Room(false);
        $user = new User(true);

        $this->assertTrue($room->canBook($user));

        $room = new Room(false);
        $user = new User(false);

        $this->assertTrue($room->canBook($user));
    }
}
