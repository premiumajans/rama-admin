<div>
    @if($update == null)
        <div class="mb-3">
            <label>@lang('backend.categories')</label>
            <select wire:model="selectedContinent" wire:change="changeCategory" class="form-control" name="category" required>
                <option value="">-- @lang('backend.categories') --</option>
                @foreach($continents as $continent)
                    <option value="{{$continent->id}}">{{$continent->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>@lang('backend.alt-categories')</label>
            <select wire:model="selectedCountry" wire:change="changeSub" class="form-control" name="altCategory" required>
                <option value="">-- @lang('backend.alt-categories') --</option>
                @foreach($countries as $country)
                    <option value="{{$country->id}}">{{$country->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>@lang('backend.sub-categories')</label>
            <select class="form-control" name="subCategory">
                <option>-- @lang('backend.sub-categories') --</option>
                @foreach($subs as $sub)
                    <option value="{{$sub->id}}">{{$sub->name}}</option>
                @endforeach
            </select>
        </div>
    @else
        <div class="mb-3">
            <label>@lang('backend.categories')</label>
            <select wire:model="selectedContinent" wire:change="changeCategory" class="form-control" name="category" required>
                @foreach($continents as $continent)
                    <option value="{{$continent->id}}"
                            @if($selectedContinent == $continent->id ) selected @endif>{{$continent->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>@lang('backend.alt-categories')</label>
            <select wire:model="selectedCountry" wire:change="changeSub" class="form-control" name="altCategory" required>
                @foreach($newAltCat as $country)
                    <option value="{{$country->id}}"
                            @if($selectedCountry == $country->id) selected @endif>{{$country->name}}</option>
                @endforeach
            </select>
        </div>
        @if($subs != null)
            <div class="mb-3">
                <label>@lang('backend.sub-categories')</label>
                <select wire:model="selectedSub" class="form-control" name="subCategory" wire:model="selectedSub">
                    <option value="-1">-- @lang('backend.sub-categories') --</option>
                    @foreach($subs as $sub)
                        <option value="{{$sub->id}}"  @if($sub->id == $selectedSub) selected @endif>{{$sub->name}}</option>
                    @endforeach
                </select>
            </div>
        @endif
    @endif
</div>


