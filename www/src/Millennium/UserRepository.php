<?php
namespace Millennium;

use Millennium\Exception\NoUserInRepositoryException;

class UserRepository {
    private array $users = [];

    public function addUser(User $user): void {
        $this->users[$user->getId()] = $user;
    }

    public function foundUser($userId): User | null {
        if (array_key_exists($userId, $this->users)) {
            return $this->users[$userId];
        }
        return null;
    }

    public function getUsers(): array
    {
        return $this->users;
    }

    public function getUser(int $userId) {
        try {
            return $this->users[$userId];
        } catch (\Exception $exception) {
            return new NoUserInRepositoryException($userId);
        }
    }
}