<?php

namespace App\Controller\Api\V1;

use App\Service\UserService;
use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/v1/api/users')]
class UserController extends AbstractController
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    #[Route('/{id}', name: 'app_user', methods: ['GET'])]
    public function show(int $id): Response
    {
        try {
            return new JsonResponse($this->userService->get($id, $this->getUser()));
        } catch (\Exception $e){
            return new JsonResponse([
                'code' => $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('', name: 'app_user_store', methods: ['POST'])]
    public function store(Request $request): JsonResponse
    {
        try {
            $result = $this->userService->register($request);
            return new JsonResponse($result, $result['status']);
        } catch (InvalidArgumentException $e) {
            return new JsonResponse([
                'code' => Response::HTTP_BAD_REQUEST,
                json_decode($e->getMessage(), true) ?? $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            return new JsonResponse([
                'code' => $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/{id}', name: 'app_user_update', methods: ['PUT'])]
    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $result = $this->userService->update($request, $id, $this->getUser());
            return new JsonResponse($result, $result['status']);
        } catch (InvalidArgumentException $e) {
            return new JsonResponse([
                'code' => Response::HTTP_BAD_REQUEST,
                json_decode($e->getMessage(), true) ?? $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            return new JsonResponse([
                'code' => $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['DELETE'])]
    public function destroy(int $id): ?JsonResponse
    {
        try {
            $this->userService->destroy($id);
        } catch (\Exception $e){
            return new JsonResponse([
                'code' => $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
