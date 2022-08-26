<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use UploadTrait;
    use HasTranslations; 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','parent_id' ,'image'];
    
    public $translatable = ['name'];

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
    public function getImageAttribute($value)
    {
        return asset('/storage/images/categories/'.$value);
    }

    public function setImageAttribute($value)
    {
        if ($value != null)
        {
            $this->attributes['image'] = $this->uploadAllTyps($value, 'categories');
        }
    }

    public function childes(){
        return $this->hasMany(self::class,'parent_id');
    }

    public function parent(){
         return $this->belongsTo(self::class,'parent_id');
    }


    public function subChildes()
    {
         return $this->childes()->with( 'subChildes' );
    }

    public function subParents()
    {
        return $this -> parent()->with('subParents');
    }

    public function getAllChildren ()
    {
        $sections = new Collection();
        foreach ($this->childes as $section) {
            $sections->push($section);
            $sections = $sections->merge($section->getAllChildren());
        }
        return $sections;
    }

    public function getAllParents()
    {
        $parents = collect([]);

        $parent = $this->parent;

        while(!is_null($parent)) {
            $parents->prepend($parent);
            $parent = $parent->parent;
        }
        return $parents;
    }

    public function getFullPath(){
        $parents  = $this->getAllParents () ;
        $current  = Category::where('id',$this->id)->get();
        $parents  = $parents->merge($current);
        $childs   = $this->getAllChildren () ;
        $path     = $childs->merge($parents);
        return $path ;
    }


}
