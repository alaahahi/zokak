<?php

namespace App\Repositories;
use Illuminate\Support\Facades\App;

use Illuminate\Support\Str;
use App\Helpers\UploadHelper;
use App\Interfaces\CrudInterface;
use App\Models\Realty;
use App\Models\City;
use App\Models\Governorate;
use App\Models\PropertyType;
use App\Models\Compound;
use App\Models\Property;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Illuminate\Support\Facades\DB;
class RealtyRepository implements CrudInterface
{
    /**
     * Authenticated User Instance.
     *
     * @var User
     */
    public User | null $user;

    /**
     * Constructor.
     */
    public function __construct()
    {
        try {
            $token = JWTAuth::getToken();
            $this->user =   JWTAuth::toUser($token ) ;
        } catch (\Throwable $th) {
            return "valid token required";
        }
    }

    /**
     * Get All Realtys.
     *
     * @return collections Array of Realty Collection
     */
    public function getAll(): Paginator
    {
        $perPage = isset($perPage) ? intval($perPage) : 12;
        return Realty::orderBy('id', 'desc')
            ->with('user')
    
            ->paginate($perPage);
    }

    public function listHomeRealty($perPage,$page,$lng,$lat,$radius)
    {
        $properties = Realty::select(
            'Realty.*',
            DB::raw("(6371 * acos(cos(radians($lat)) 
            * cos(radians(Realty.lat)) 
            * cos(radians(Realty.lng) - radians($lng)) 
            + sin(radians($lat)) 
            * sin(radians(Realty.lat)))) AS distance")
        )
        ->havingRaw('distance < ?', [$radius])
        ->orderBy('distance')
        ->with(['property', 'city', 'governorate', 'compound', 'propertyType'])
        ->accepted()
        ->paginate($perPage, ['*'], 'page', $page);

        return $properties->items();
    }

    public function listCity()
    {
        return Realty::all();
    }
    public function property()
    {
        $items = Property::orderBy('order')->get();
        return $items;
    }
    public function city($id)
    {
        if($id){
            $item = City::where('governorate_id',$id)->get();
            return $item;
        }
        $items = City::orderBy('order')->get();
        return $items;
    }
    public function governorate()
    {
        $items = Governorate::orderBy('order')->get();
        return $items;
    }
    public function compound($id)
    {
        if($id){
            $item = Compound::where('city_id',$id)->get();
            return $item;
        }
        $items = Compound::orderBy('order')->get();
        return $items;
    }
    public function compoundRealty($id,$perPage): Paginator
    {
        $perPage = isset($perPage) ? intval($perPage) : 12;
        if($id){
            return Realty::with('property')
            ->with('city')
            ->with('governorate')
            ->with('compound')
            ->with('propertyType')
            ->accepted()->orderBy('id', 'desc')->where('compound_id',$id)->paginate($perPage);

        }
        return Realty::orderBy('id', 'desc')
        ->with('city')
        ->with('governorate')
        ->with('compound')
        ->with('propertyType')
        ->accepted()->paginate($perPage);
    }
    public function wishlistsRealty($perPage): Paginator | Null
    {
        
        $perPage = isset($perPage) ? intval($perPage) : 12;
        $wish =  User::find($this->user->id)->wishlists_realty()->pluck('realty.id');
         $data =Realty::with('property')
            ->with('city')
            ->with('governorate')
            ->with('compound')
            ->with('propertyType')
            ->accepted()->orderBy('id', 'desc')->whereIn('id',$wish)->paginate($perPage);
        if($data->total()){
            return $data;
        }else{
            return null;
        }
    }
    public function propertyType()
    {

        $items = PropertyType::orderBy('order')->get();
        return $items;
    }
    /**
     * Get Paginated Realty Data.
     *
     * @param int $pageNo
     * @return collections Array of Realty Collection
     */
    public function getPaginatedData($perPage): Paginator
    {
        $perPage = isset($perPage) ? intval($perPage) : 12;
        return Realty::orderBy('id', 'desc')
            ->with('user')
            ->accepted()
            ->paginate($perPage);
    }


    public function myRealty($perPage): Paginator |null
    {
        $perPage = isset($perPage) ? intval($perPage) : 12;
        
        $data= Realty::with('property')
        ->with('city')
        ->with('governorate')
        ->with('compound')
        ->with('propertyType')
        ->accepted()->orderBy('id', 'desc')
            ->where('user_id', $this->user->id)
  
            ->paginate($perPage);
            if($data->total()){
                return $data;
            }else{
                return null;
            }

    }

    /**
     * Get Searchable Realty Data with Pagination.
     *
     * @param int $pageNo
     * @return collections Array of Realty Collection
     */
 

    public function searchRealty($all, $perPage): Paginator
    {
        $perPage = isset($perPage) ? intval($perPage) : 10;
        $governorate_id = isset($all['governorate_id']) ? $all['governorate_id'] : null;
        $room = isset($all['room']) ? intval($all['room']) : null;
        $property_id = isset($all['property_id']) ? intval($all['property_id']) : null;
        $property_type_id = isset($all['property_type_id']) ? intval($all['property_type_id']) : null;
        $city_id = isset($all['city_id']) ? intval($all['city_id']) : null;
        $compound_id = isset($all['compound_id']) ? intval($all['compound_id']) : null;
        $startPrice = isset($all['startPrice']) ? intval($all['startPrice']) : null;
        $endPrice = isset($all['endPrice']) ? intval($all['endPrice']) : null;
        $keyword = isset($all['q']) ? $all['q'] : null;

        $query = Realty::query()->accepted();
        
        // Filter by name
        
        // Filter by governorate id
        if ($governorate_id) {
            $query->where('governorate_id', $governorate_id);
        }

        if ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }
        
        // Filter by room number
        if ($room) {
            $query->where('room', $room);
        }
        
        // Filter by property id
        if ($property_id) {
            $query->where('property_id', $property_id);
        }
        
        // Filter by property type id
        if ($property_type_id) {
            $query->where('property_type_id', $property_type_id);
        }
        
        // Filter by city id
        if ($city_id) {
            $query->where('city_id', $city_id);
        }
        
        // Filter by compound id
        if ($compound_id) {
            $query->where('compound_id', $compound_id);
        }
        
        // Filter by price range
        if ($startPrice && $endPrice) {
            $query->whereBetween('price', [$startPrice, $endPrice]);
        } elseif ($startPrice) {
            $query->where('price', '>=', $startPrice);
        } elseif ($endPrice) {
            $query->where('price', '<=', $endPrice);
        }
        
        $realty = $query->with('property')
            ->with('city')
            ->with('governorate')
            ->with('compound')
            ->with('propertyType')
            ->orderBy('id', 'desc')
            ->paginate($perPage);
        try {
            $wish = User::find($this->user->id)->wishlists_realty()->pluck('realty.id');
        
            $realty->getCollection()->transform(function($realty) use ($wish) {
                $realty->inWishlist = $wish->contains($realty->id);
                return $realty;
            });
        } catch (\Throwable $th) {
                $realty->inWishlist =   false;
        }
 
        // Execute the query and paginate the results
        
        return $realty;
    }


    /**
     * Create New Realty.
     *
     * @param array $data
     * @return object Realty Object
     */
    public function create(array $data): Realty
    {
        $titleShort      = Str::slug(substr($data['name'], 0, 20));
        $data['user_id'] = $this->user->id;
        $images = [];
        if($data['image'] ?? ''){
        foreach ($data['image'] as $image) {

                $imageName = $titleShort . '-' . time() . '-' . str_replace(' ', '-', $image->getClientOriginalName());
                $filename = pathinfo($imageName, PATHINFO_FILENAME);
                $imagePath = UploadHelper::upload('image', $image, $filename, 'storage/realty');
                $images[] = $imagePath;
        }

        $data['image'] = json_encode($images);
        }
        $realty = Realty::create($data);
  
        return $realty;
    }

    public function addRealty(array $data): Realty
    {
        $titleShort      = Str::slug(substr($data['name'], 0, 20));
         $data['user_id'] = $this->user->id;
        if (!empty($data['image'])) {
            $data['image'] = UploadHelper::upload('image', $data['image'], $titleShort . '-' . time(), 'storage');
        }
        $realty = Realty::create($data);
        try {
            $realty->tags()->attach(json_decode($data['tags'],true));
        } catch (\Throwable $th) {
            //throw $th;
        }
        return $realty;
    }

    /**
     * Delete Realty.
     *
     * @param int $id
     * @return boolean true if deleted otherwise false
     */
    public function delete(int $id): bool
    {
        $realty = Realty::find($id);
        if (empty($realty)) {
            return false;
        }

        UploadHelper::deleteFile('images/realty/' . $realty->image);
        $realty->delete($realty);
        return true;
    }

    /**
     * Get Realty Detail By ID.
     *
     * @param int $id
     * @return void
     */
    public function getByID(int $id): Realty|null
    {

        $realty = Realty::find($id);

        $inWishlist = false;
        $user =$this->user ;
        if ($user) {
            $inWishlist = $user->wishlists()->where('realty_id', $realty->id)->exists();
        }
         

        $realty->inWishlist = $inWishlist;

        return $realty;

    }

    /**
     * Update Realty By ID.
     *
     * @param int $id
     * @param array $data
     * @return object Updated Realty Object
     */

     
     public function delRealtyImage (array $data)
     {
        $src = $data['src'] ??'';
        if($data['id']??0){
            $realty = Realty::find($data['id']);

            // Decode the JSON string to an array
            $imagesArray = json_decode($realty->image, true);
            
            // Create an array to store the updated image URLs
            $updatedImages = [];
            
            // Iterate through the images array and check if the image URL matches the one to be removed
            foreach ($imagesArray as $image) {
                $imageUrl = asset("storage/realty/$image");
                if ($imageUrl !==  str_replace('\\\\', '\\', $data['src']) ) {
                    $updatedImages[] = $image; // Keep the image URL if it does not match the one to be removed
                }
            }
            
            // Convert the updated images array back to a JSON string
            $updatedImageJson = json_encode($updatedImages);
            // Update the realty with the new image JSON
            $realty->update(['image' => $updatedImageJson]);

            return $realty;
        }
        return 'Image not found';

     }
    public function update(int $id, array $data): Realty|null
    {
        $realty = Realty::find($id);
        if (isset($data['image']) && is_array($data['image'])) {
            $titleShort = Str::slug(substr($data['name'] ?? '', 0, 20));
            $images = json_decode($realty->image, true) ?? [];
            foreach ($data['image'] as $image) {
                $imageName = $titleShort . '-' . time() . '-' . str_replace(' ', '-', $image->getClientOriginalName());
                $filename = pathinfo($imageName, PATHINFO_FILENAME);
                $imagePath = UploadHelper::upload('image', $image, $filename, 'storage/realty');
                $images[] = $imagePath;
            }
            $data['image'] = json_encode($images);
        }

        if (is_null($realty)) {
            return null;
        }

  
        // If everything is OK, then update.
        $realty->update($data);

        // Finally return the updated realty.
        return $realty;
    }
    public function realtySponsors()
    {
        return Realty::where('is_sponsors',1)
            ->with('tags')
            ->accepted()
            ->get();
    }
}
