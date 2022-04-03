<?php

namespace App\Http\Livewire\ThirdPartyAccount;

use App\Models\ThirdPartyAccount;
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
        'item.name' => 'required|string',
        'item.account_name' => 'required|string|min:2',
//        'item.client_id' => 'required|string|min:2',
//        'item.client_secret' => 'required|string|min:2',
        'item.personal_access_token' => 'required|string|min:2',
    ];
    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->item = new ThirdPartyAccount();
    }

    public function render()
    {
        $data = ThirdPartyAccount::where('name','LIKE', '%'.$this->search.'%')
            ->orderBy('id','desc')
            ->paginate($this->count);
        return view('livewire.third-party-account.show',compact('data'));
    }

    public function edit($id = null){
        $this->itemModal = true;
        $this->item = $id ? ThirdPartyAccount::find($id) : new ThirdPartyAccount();
    }

    public function save(){
        $this->item->save();
        $this->itemModal = false;
    }

    public function delete($id){
        ThirdPartyAccount::where('id',$id)->delete();
    }
}
