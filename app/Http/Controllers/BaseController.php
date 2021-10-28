<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use League\Fractal\Manager;
use League\Fractal\Serializer\DataArraySerializer;
use League\Fractal;
use League\Fractal\Serializer\JsonApiSerializer;

use Illuminate\Http\Request;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class BaseController extends Controller
{
    protected $Model = null;
    protected $Transformer = null;
    protected $Request = null;

    public function index(Request $request)
    {
        $paginate = false;
        if (isset($request->page))
        {
            $paginate=true;
        }

        if (!$paginate){
            return $this->collection($this->Model::all(),new $this->Transformer());
        }

        $paginator = $this->Model::paginate();
        $items = $paginator->getCollection();

        return $this->collection($items,new $this->Transformer(),$paginator);        
    }

    public function store(Request $request)
    {
        $valid_request = new $this->Request();

        $values =  $request->validate($valid_request->rules());
        $item = new $this->Model($values);
        $item->save();
        return $this->item($item,new $this->Transformer());
    }

    public function update(Request $request,$id)
    {
        $item = $this->Model::findOrFail($id);
        $valid_request = new $this->Request();
        $values =  $request->validate($valid_request->rules());
        $item->update($values);
        $item->save();
        return $this->item($item,new $this->Transformer());
    }

    public function delete($id)
    {
        $item = $this->Model::findOrFail($id);
        $item->delete();
        return $this->item($item,new $this->Transformer());
    }

    protected function collection($collection, $transformer, $paginator=null)
    {
        $manager = new Manager();
        $manager->setSerializer(new DataArraySerializer());

        if (isset($_GET['include'])) {
            $manager->parseIncludes($_GET['include']);
        }
        $resource = new Fractal\Resource\Collection($collection,$transformer);

        if ($paginator !=null){
            $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));
        }

        $data = $manager->createData($resource)->toArray();
        return $data;
    }

    protected function item($item, $transformer)
    {
        $manager = new Manager();
        $manager->setSerializer(new DataArraySerializer());

        if (isset($_GET['include'])) {
            $manager->parseIncludes($_GET['include']);
        }

        $data = $manager->createData(new Fractal\Resource\Item($item,$transformer))->toArray();
        return $data;
    }

}