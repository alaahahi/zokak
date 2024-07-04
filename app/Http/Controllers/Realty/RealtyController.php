<?php

namespace App\Http\Controllers\Realty;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RealtyRequest;

use App\Repositories\RealtyRepository;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * @OA\Info(
 *     description="API Documentation - Basic CRUD Laravel",
 *     version="1.0.0",
 *     title="Basic CRUD Laravel API Documentation",
 *     @OA\Contact(
 *         email="manirujjamanakash@gmail.com"
 *     ),
 *     @OA\License(
 *         name="GPL2",
 *         url="https://devsenv.com"
 *     )
 * )
 */

class RealtyController extends Controller
{
    /**
     * Response trait to handle return responses.
     * 
     */
    use ResponseTrait;

    /**
     * Brand Repository class.
     *
     * @var RealtyRepository
     */
    public $RealtyRepository;

    public function __construct(RealtyRepository $RealtyRepository)
    {
        $this->middleware('auth:api', ['except' => ['office','adsPages','adsHome','indexAll','search','listHomeRealty','delRealtyImage','show','index','property','city','governorate','wishlistsRealty','compound','propertyType','compoundRealty','update']]);
        $this->RealtyRepository = $RealtyRepository;
    }


    public function index(Request $request): JsonResponse
    {
        try {
            $data = $this->RealtyRepository->getAll();
            return $this->responseSuccess($data, 'Realty List Fetched Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function property(Request $request): JsonResponse
    {
        try {
            $data = $this->RealtyRepository->property();
            return $this->responseSuccess($data, 'property List Fetched Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function city(Request $request): JsonResponse
    {
        try {
            $id =$request->governorate_id;
            $data = $this->RealtyRepository->city($id);
            return $this->responseSuccess($data, 'city List Fetched Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function governorate(Request $request): JsonResponse
    {
        try {
            $data = $this->RealtyRepository->governorate();
            return $this->responseSuccess($data, 'city List Fetched Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function compound(Request $request): JsonResponse
    {
        try {
            $id =$request->city_id;
            $data = $this->RealtyRepository->compound($id);
            return $this->responseSuccess($data, 'compound List Fetched Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function compoundRealty(Request $request): JsonResponse
    {
        try {
            $id =$request->id;
            $data = $this->RealtyRepository->compoundRealty($id,$request->perPage);
            if($data)
            return $this->responseSuccess($data, 'compound List Fetched Successfully !');
            else
            return $this->responseSuccess(null, 'No Data !');

        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function wishlistsRealty(Request $request): JsonResponse
    {
        try {
            $id =$request->id;
            $data = $this->RealtyRepository->wishlistsRealty($request->perPage);
            if($data)
            return $this->responseSuccess($data, 'Wishlists List Fetched Successfully !');
            else
            return $this->responseSuccess(null, 'No Data !');

        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function myRealty(Request $request): JsonResponse
    {
        try {
            $id =$request->id;
            $data = $this->RealtyRepository->myRealty($request->perPage);
            if($data)
            return $this->responseSuccess($data, 'Wishlists List Fetched Successfully !');
            else
            return $this->responseSuccess(null, 'No Data !');

        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    
    public function propertyType(Request $request): JsonResponse
    {
        try {
            $data = $this->RealtyRepository->propertyType();
            return $this->responseSuccess($data, 'property Type List Fetched Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function listHomeRealty(Request $request): JsonResponse
    {
    
        $perPage = $request->input('perPage', 200); // Default items per page
        $page = $request->input('page', 1); // Default page
        $lng = $request->input('lng',44.27621528506279);
        $lat = $request->input('lat',34.341917794594224);
        $radius = $request->input('zoom', 100); // 100 km

        try {
            $data = $this->RealtyRepository->listHomeRealty($perPage,$page,$lng,$lat,$radius);
             return $this->responseSuccess($data, 'Realty List Fetched Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
 
    public function indexAll(Request $request): JsonResponse
    {
        try {
            $data = $this->RealtyRepository->getPaginatedData($request->perPage);
            return $this->responseSuccess($data, 'Realty List Fetched Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
 

    public function search(Request $request): JsonResponse
    {
        try {
            $data = $this->RealtyRepository->searchRealty($request->all(), $request->perPage);
            return $this->responseSuccess($data, 'Realty List Fetched Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

 
    public function store(RealtyRequest $request): JsonResponse
    {
        try {
            $brand = $this->RealtyRepository->create($request->all());
            return $this->responseSuccess($brand, 'New Realty Created Successfully !');
        } catch (\Exception $exception) {
            return $this->responseError(null, $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function addRealty(RealtyRequest $request): JsonResponse
    {
        try {
            $brand = $this->RealtyRepository->addRealty($request->all());
            return $this->responseSuccess($brand, 'Realty Created Successfully !');
        } catch (\Exception $exception) {
            return $this->responseError(null, $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    
    public function delRealtyImage(Request $request): JsonResponse
    {
        try {
            $brand = $this->RealtyRepository->delRealtyImage($request->all());
            return $this->responseSuccess($brand, 'Realty Image deleted Successfully !');
        } catch (\Exception $exception) {
            return $this->responseError(null, $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    

    public function show($id): JsonResponse
    {
        try {
            $data = $this->RealtyRepository->getByID($id);
            if (is_null($data)) {
                return $this->responseError(null, 'Realty Not Found', Response::HTTP_NOT_FOUND);
            }

            return $this->responseSuccess($data, 'Realty Details Fetch Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\PUT(
     *     path="/api/brands/{id}",
     *     tags={"Realtys"},
     *     summary="Update Realty",
     *     description="Update Realty",
     *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="title", type="string", example="Realty 1"),
     *              @OA\Property(property="description", type="string", example="Description"),
     *              @OA\Property(property="price", type="integer", example=10120),
     *              @OA\Property(property="image", type="string", example=""),
     *          ),
     *      ),
     *     operationId="update",
     *     security={{"bearer":{}}},
     *     @OA\Response(response=200, description="Update Realty"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function update(Request $request, $id): JsonResponse
    { 
        try {
            $data = $this->RealtyRepository->update($id, $request->all());
            if (is_null($data))
                return $this->responseError(null, 'Realty Not Found', Response::HTTP_NOT_FOUND);

            return $this->responseSuccess($data, 'Realty Updated Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function editRealty(Request $request, $id): JsonResponse
    { 
        try {
            $data = $this->RealtyRepository->update($id??$request->id, $request->all());
            if (is_null($data))
                return $this->responseError(null, 'Realty Not Found', Response::HTTP_NOT_FOUND);

            return $this->responseSuccess($data, 'Realty Updated Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function adsHome(Request $request): JsonResponse
    { 

        try {
            $data = $this->RealtyRepository->adsHome('home');
            if (is_null($data)){
                return $this->responseError(null, 'Ads Home Not Found', Response::HTTP_NOT_FOUND);
            }
            return $this->responseSuccess($data, 'Ads Home Get Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function adsPages(Request $request): JsonResponse
    { 

        try {
            $data = $this->RealtyRepository->adsHome('pages');
            if (is_null($data)){
                return $this->responseError(null, 'Ads Home Not Found', Response::HTTP_NOT_FOUND);
            }
            return $this->responseSuccess($data, 'Ads Home Get Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function office(Request $request): JsonResponse
    { 

        $governorate_id= $request->governorate_id ?? '';
        try {
            $data = $this->RealtyRepository->office($governorate_id);
            if (is_null($data)){
                return $this->responseError(null, 'office Not Found', Response::HTTP_NOT_FOUND);
            }
            return $this->responseSuccess($data, 'office Get Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\DELETE(
     *     path="/api/brands/{id}",
     *     tags={"Realtys"},
     *     summary="Delete Realty",
     *     description="Delete Realty",
     *     operationId="destroy",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Delete Realty"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function destroy($id): JsonResponse
    {
        try {
            $brand =  $this->RealtyRepository->getByID($id);
            if (empty($brand)) {
                return $this->responseError(null, 'Realty Not Found', Response::HTTP_NOT_FOUND);
            }

            $deleted = $this->RealtyRepository->delete($id);
            if (!$deleted) {
                return $this->responseError(null, 'Failed to delete the brand.', Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return $this->responseSuccess($brand, 'Realty Deleted Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
