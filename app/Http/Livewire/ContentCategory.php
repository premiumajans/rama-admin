<?php

namespace App\Http\Livewire;

use App\Models\AltCategory;
use App\Models\Category;
use App\Models\Content;
use App\Models\SubCategory;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Component;
use mysql_xdevapi\XSession;

class ContentCategory extends Component
{
    public $continents = [];
    public $countries = [];

    public $subs = [];

    public $update;
    public $updatedCat;
    public $updatedAltCat;
    public $updatedSubCat;
    public $selectedContinent;
    public $selectedSub;
    public $selectedCountry;

    public $newAltCat = [];

    public function mount()
    {
        $this->continents = Category::all();
        if ($this->update != null) {
            $content = Content::where('id', $this->update)->first();
            $this->selectedContinent = $content->category_id;
            $this->selectedCountry = $content->alt_id;
            $this->newAltCat = AltCategory::where('category_id', $content->category_id)->get();
            if ($content->sub_id != (null and -1)) {
                $this->selectedSub = $content->sub_id;
                $this->subs = SubCategory::where('alt_category_id', $content->alt_id)->get();
            }
        }

    }

    public function render()
    {
        return view('livewire.content-category');
    }

    public function changeCategory()
    {
        if ($this->selectedContinent != '-1') {
            $this->countries = AltCategory::where('category_id', $this->selectedContinent)->get();
            $this->newAltCat = AltCategory::where('category_id', $this->selectedContinent)->get();
        }
    }

    public function changeSub()
    {
        if ($this->selectedCountry !== '-1') {
            $this->subs = SubCategory::where('alt_category_id', $this->selectedCountry)->get();
        }
    }
}
