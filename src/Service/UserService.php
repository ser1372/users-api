<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class UserService
{
    private EntityManagerInterface $entityManager;
    private ValidatorInterface $validator;
    private $userRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator,
        UserRepository $userRepository,
    ) {
        $this->entityManager = $entityManager;
        $this->validator = $validator;
        $this->userRepository = $userRepository;
    }

    public function register(Request $request): array
    {
        $data = json_decode($request->getContent(), true);
        if (!$data) {
            throw new \InvalidArgumentException('Invalid JSON.');
        }

        $user = $this->userRepository->create($data);
        $violations = $this->validator->validate($user);

        if (count($violations) > 0) {
            $errors = [];
            foreach ($violations as $violation) {
                $errors[] = $violation->getPropertyPath() . ': ' . $violation->getMessage();
            }

            throw new \InvalidArgumentException(json_encode(['errors' => $errors]));
        }

        if($this->userRepository->findOneBy(['login' => $user->getLogin()])){
            throw new BadRequestException('User already exists.');
        }

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return [
            'user' => [
                'id' => $user->getId(),
                'login' => $user->getLogin(),
                'phone' => $user->getPhone(),
                'pass' => $user->getPassword(),
            ],
            'status' => Response::HTTP_CREATED,
        ];
    }

    public function checkIsTestUser(User $currentUser): bool
    {
        return in_array(User::ROLE_TEST_USER,$currentUser->getRoles());
    }

    public function update(Request $request, int $id,User $currentUser): array
    {
        $data = json_decode($request->getContent(), true);
        if (!$data) {
            throw new \InvalidArgumentException('Invalid JSON.');
        }

        $user = $this->userRepository->find($id);
        if($this->checkIsTestUser($currentUser) && $currentUser->getId() !== $user->getId()){
            throw new BadRequestException('Access denied.', Response::HTTP_FORBIDDEN);
        }

        $user = $this->userRepository->update($user, $data);
        $violations = $this->validator->validate($user);

        if (count($violations) > 0) {
            $errors = [];
            foreach ($violations as $violation) {
                $errors[] = $violation->getPropertyPath() . ': ' . $violation->getMessage();
            }
            throw new \InvalidArgumentException(json_encode(['errors' => $errors]));
        }

        $this->entityManager->flush();

        return [
            'id' => $user->getId(),
            'status' => Response::HTTP_FOUND,
        ];
    }


    public function get(int $id, User $currentUser): array
    {
        $user = $this->userRepository->find($id);
        if($this->checkIsTestUser($currentUser) && $currentUser->getId() !== $user->getId()){
            throw new BadRequestException('Access denied.', Response::HTTP_FORBIDDEN);
        }

        if(empty($user)){
            throw new NotFoundHttpException('User not found.', null,Response::HTTP_NOT_FOUND);
        }

        return [
            'login' => $user->getLogin(),
            'phone' => $user->getPhone(),
            'pass'  => $user->getPassword(),
        ];
    }


    public function destroy(int $id): void
    {
        $user = $this->userRepository->find($id);
        if(empty($user)){
            throw new NotFoundHttpException('User not found.', null,Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }
}