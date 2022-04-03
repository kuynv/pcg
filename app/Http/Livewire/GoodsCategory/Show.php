<?php

namespace App\Http\Livewire\GoodsCategory;

use App\Models\GoodsCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public $count = 10;
    public $search = '';
    public $itemModal = false;
    public $item;
    protected $rules = [
        'item.name' => 'required|string|min:4',
        'item.status' => 'required|integer|max:2',
    ];
    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->item = new GoodsCategory();
    }

    public function render()
    {
        $data = GoodsCategory::where('name','LIKE', '%'.$this->search.'%')
            ->orderBy('id','desc')
            ->paginate($this->count);
        return view('livewire.goods-category.show',compact('data'));
    }

    public function edit($id = null){
        $this->itemModal = true;
        $this->item = $id ? GoodsCategory::find($id) : new GoodsCategory();
    }

    public function save(){
        $this->validate();
        $this->item->save();
        $this->itemModal = false;
    }

    public function delete($id){
        GoodsCategory::where('id',$id)->delete();
    }
}
