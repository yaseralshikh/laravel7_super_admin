<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        @foreach ($products as $product)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }} bg-white">
                <img class="d-block w-80" src="uploads/product_images/{{ $product->image }}" alt="slide">
                <div class="carousel-caption d-none d-md-block">
                    <a href="#" class="float-right" target="" style="opacity: 1;display: inline-block;padding: 10px;background-color: yellow;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom: solid black;"><h1><b>{{ ucfirst(trans($product->name)) }}</b> / <b>Price</b> : {{ $product->sale_price }} $</h1></a>
                </div>
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>