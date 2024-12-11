<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository
{
    private UserPasswordHasherInterface $passwordHasher;
    public function __construct(ManagerRegistry $registry, UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct($registry, User::class);
        $this->passwordHasher = $passwordHasher;
    }


    public function create(array $data): User
    {
        $user = new User();
        $user->setLogin($data['login']);
        $user->setPhone($data['phone']);
        $user->setPass($this->passwordHasher->hashPassword($user, $data['password']));

        return $user;
    }


    public function update(User $user, array $data): User
    {
        if (isset($data['login'])) {
            $user->setLogin($data['login']);
        }

        if (isset($data['phone'])) {
            $user->setPhone($data['phone']);
        }

        if (isset($data['password'])) {
            $hashedPassword = $this->passwordHasher->hashPassword($user, $data['password']);
            $user->setPass($hashedPassword);
        }

        return $user;
    }
}
