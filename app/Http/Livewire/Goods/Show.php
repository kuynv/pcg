<?php

namespace App\Http\Livewire\Goods;

use App\Models\Goods;
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
        'item.price' => 'required',
    ];
    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->item = new Goods();
    }

    public function render()
    {
        $data = Goods::with('goodsCategory')->where('name','LIKE', '%'.$this->search.'%')
            ->orderBy('id','desc')
            ->paginate($this->count);
        return view('livewire.goods.show',compact('data'));
    }

    public function edit($id = null){
        $this->itemModal = true;
        $this->item = $id ? Goods::find($id) : new Goods();
    }

    public function save(){
        $this->item->save();
        $this->itemModal = false;
    }

    public function delete($id){
        Goods::where('id',$id)->delete();
    }
}
