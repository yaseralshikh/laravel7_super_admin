<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
  </ol>
  <div class="carousel-inner border border-dark p-2">
      @foreach ($products as $product)
      <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
            <img class="d-block w-100" src="{{ $product->banner_path }}" alt="slide">
            <div class="carousel-caption d-none d-md-block">
                <a href="{{ route('show_product', $product->id )}}" target="" style="opacity: 0.9;display: inline-block;padding: 10px;background-color: #d5e7ff;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom: solid black;">
                    <h4><b>@lang('site.price')</b> {{ $product->sale_price }}$ - <B>@lang('site.stock')</b> {{ $product->stock }}</h4>
                </a>
            </div>
        </div>
      @endforeach
  </div>
  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true" style = "opacity:1"></span>
      <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
  </a>
</div>