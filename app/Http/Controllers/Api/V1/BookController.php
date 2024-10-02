<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ServiceHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\BookRequest;
use App\Http\Resources\V1\BookResource;
use App\Services\BookService;

class BookController extends Controller
{
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $limit = request()->get('limit', 10);
        $page = request()->get('page', 1);

        $data = $this->bookService->paginate($limit, $page);

        return response()->json([
            'statusCode' => 200,
            'message' => 'Data retrieved successfully',
            'data' => [
                'data' => BookResource::collection($data),
                'pagination' => ServiceHelper::customPagination($data),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        try {
            $data = $request->validated();
            $createBook = $this->bookService->create($data);

            $result = [
                'statusCode' => 201,
                'message' => 'Book created successfully',
                'data' => new BookResource($createBook),
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
            $data = $this->bookService->find($id);

            $result = [
                'statusCode' => 200,
                'message' => 'Data retrieved successfully',
                'data' => new BookResource($data->load('author')),
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
    public function update(BookRequest $request, string $id)
    {
        try {
            $data = $request->validated();
            $updateData = $this->bookService->update($id, $data);

            $result = [
                'statusCode' => 200,
                'message' => 'Book updated successfully',
                'data' => new BookResource($updateData->load('author')),
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
            $deleteBook = $this->bookService->delete($id);

            $result = [
                'statusCode' => 204,
                'message' => 'Book deleted successfully',
                'data' => new BookResource($deleteBook->load('author')),
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
