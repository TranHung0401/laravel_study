<form action="{{request()->segment(2) == 'product' ? 'shop' : ''}}">
    <div class="filter-widget">
        <h4 class="fw-title">Categories</h4>
        <ul class="filter-catagories">
            @foreach($categories as $category)
            <li><a href="shop/category/{{$category->name}}">{{$category->name}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="filter-widget">
        <h4 class="fw-title">Brand</h4>
        <div class="fw-brand-check">
            @foreach($brands as $brand)
                <div class="bc-item">
                    <label for="bc-{{$brand->id}}">
                        {{$brand->name}}
                        <input 
                        {{(request()->brand[$brand->id] ?? '') == 'on' ? 'checked' : ''}}
                        type="checkbox" 
                        id="bc-{{$brand->id}}" 
                        name="brand[{{$brand->id}}]"
                        onchange="this.form.submit()"
                        >
                        <span class="checkmark"></span>
                    </label>
                </div>
            @endforeach
            
        </div>
    </div>
    <div class="filter-widget">
        <h4 class="fw-title">Price</h4>
        <div class="filter-range-wrap">
            <div class="range-slider">
                <div class="price-input">
                    <input type="text" id="minamount" name="price_min">
                    <input type="text" id="maxamount" name="price_max">
                </div>
            </div>
            <div 
                class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                data-min="10" 
                data-max="999"
                data-min-value="{{str_replace('$','',request('price_min'))}}"
                data-max-value="{{str_replace('$','',request('price_max'))}}"
                >
                <div class="ui-sldier-range ui-corner-all ui-widget-header"></div>
                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
            </div>
        </div>
        <button type="submit" class="filter-btn">Filter</button>

    </div>
    <div class="filter-widget">
        <h4 class="fw-title">Color</h4>
        <div class="fw-color-choose">
            <div class="cs-item">
                <input type="radio" name="color" value="black" id="cs-black" onchange="this.form.submit()">
                <label class="cs-black {{request('color') == 'black' ? 'font-weight-bold' : ''}}" for="cs-black">Black</label>
            </div>
            <div class="cs-item">
                <input type="radio" name="color" value="violet" id="cs-violet" onchange="this.form.submit()">
                <label class="cs-violet {{request('color') == 'violet' ? 'font-weight-bold' : ''}}" for="cs-violet">Violet</label>
            </div>
            <div class="cs-item">
                <input type="radio" name="color" value="blue" id="cs-blue" onchange="this.form.submit()">
                <label class="cs-blue {{request('color') == 'blue' ? 'font-weight-bold' : ''}}" for="cs-blue">Blue</label>
            </div>
            <div class="cs-item">
                <input type="radio" name="color" value="yellow" id="cs-yellow" onchange="this.form.submit()">
                <label class="cs-yellow {{request('color') == 'yellow' ? 'font-weight-bold' : ''}}" for="cs-yellow">Yellow</label>
            </div>
            <div class="cs-item">
                <input type="radio" name="color" value="red" id="cs-red" onchange="this.form.submit()">
                <label class="cs-red {{request('color') == 'red' ? 'font-weight-bold' : ''}}" for="cs-red">Red</label>
            </div>
            <div class="cs-item">
                <input type="radio" name="color" value="green" id="cs-green" onchange="this.form.submit()">
                <label class="cs-green {{request('color') == 'green' ? 'font-weight-bold' : ''}}" for="cs-green">Green</label>
            </div>
        </div>
    </div>
    <div class="filter-widget">
        <h4 class="fw-title">Size</h4>
        <div class="fw-size-choose">
            <div class="sc-item">
                <input type="radio" name="size" id="s-size" value="s" onchange="this.form.submit()" {{request('size') == 's' ? 'checked' : ''}}>
                <label for="s-size" class="{{request('size') == 's' ? 'active' : ''}}">s</label>
            </div>
            <div class="sc-item">
                <input type="radio" name="size" id="m-size" value="m" onchange="this.form.submit()" {{request('size') == 'm' ? 'checked' : ''}}>
                <label for="m-size" class="{{request('size') == 'm' ? 'active' : ''}}">m</label>
            </div>
            <div class="sc-item">
                <input type="radio" name="size" id="l-size" value="l" onchange="this.form.submit()" {{request('size') == 'l' ? 'checked' : ''}}> 
                <label for="l-size" class="{{request('size') == 'l' ? 'active' : ''}}">l</label>
            </div>
            <div class="sc-item">
                <input type="radio" name="size" id="xs-size" value="xs" onchange="this.form.submit()" {{request('size') == 'xs' ? 'checked' : ''}}>
                <label for="xs-size" class="{{request('size') == 'xs' ? 'active' : ''}}">xs</label>
            </div>
        </div>
    </div>
    <div class="filter-widget">
        <h4 class="fw-title">Tags</h4>
        <div class="fw-tags">
            <a href="">Towel</a>
            <a href="">Shoes</a>
            <a href="">Coat</a>
            <a href="">Dresses</a>
            <a href="">Trousers</a>
            <a href="">Men-s hats</a>
            <a href="">Backpack</a>
        </div>
    </div>
</form>