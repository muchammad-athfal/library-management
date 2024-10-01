<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ServiceHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\AuthorRequest;
use App\Http\Resources\V1\AuthorResource;
use App\Services\AuthorService;

class AuthorController extends Controller
{
    protected $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $limit = request()->get('limit', 10);
        $data = $this->authorService->paginate($limit);

        return response()->json([
            'statusCode' => 200,
            'message' => 'Data retrieved successfully',
            'data' => [
                'data' => AuthorResource::collection($data),
                'pagination' => ServiceHelper::customPagination($data),
            ],
        ]);
    }

    public function booksByAuthor($id)
    {
        try {
            $data = $this->authorService->find($id);

            $result = [
                'statusCode' => 200,
                'message' => 'Data retrieved successfully',
                'data' => new AuthorResource($data->load('books')),
            ];
        } catch (\Throwable $th) {
            $result = [
                'statusCode' => $th->getCode(),
                'message' => $th->getMessage(),
            ];
        }

        return response()->json($result, $result['statusCode']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorRequest $request)
    {
        try {
            $data = $request->validated();

            $createAuthor = $this->authorService->create($data);

            $result = [
                'statusCode' => 201,
                'message' => 'Author created successfully',
                'data' => new AuthorResource($createAuthor),
            ];
        } catch (\Throwable $th) {
            $result = [
                'statusCode' => $th->getCode(),
                'message' => $th->getMessage(),
            ];
        }

        return response()->json($result, $result['statusCode']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = $this->authorService->find($id);

            $result = [
                'statusCode' => 200,
                'message' => 'Data retrieved successfully',
                'data' => new AuthorResource($data),
            ];
        } catch (\Throwable $th) {
            $result = [
                'statusCode' => $th->getCode(),
                'message' => $th->getMessage(),
            ];
        }

        return response()->json($result, $result['statusCode']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AuthorRequest $request, string $id)
    {
        try {
            $data = $request->validated();

            $updateData = $this->authorService->update($id, $data);

            $result = [
                'statusCode' => 200,
                'message' => 'Author updated successfully',
                'data' => new AuthorResource($updateData),
            ];
        } catch (\Throwable $th) {
            $result = [
                'statusCode' => $th->getCode(),
                'message' => $th->getMessage(),
            ];
        }

        return response()->json($result, $result['statusCode']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $deleteAuthor = $this->authorService->delete($id);

            $result = [
                'statusCode' => 204,
                'message' => 'Author deleted successfully',
                'data' => new AuthorResource($deleteAuthor),
            ];
        } catch (\Throwable $th) {
            $result = [
                'statusCode' => $th->getCode(),
                'message' => $th->getMessage(),
            ];
        }

        return response()->json($result, $result['statusCode']);
    }
}
