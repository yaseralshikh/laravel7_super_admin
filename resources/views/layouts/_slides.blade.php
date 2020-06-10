<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
    </ol>
    <div class="carousel-inner border border-dark p-2">
        @foreach ($products as $product)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }} bg-white" style="background-image: url({{ asset('uploads/pattern-background.jpg') }});background-repeat: no-repeat;background-size: cover;background-position: center;">
                <img class="d-block" src="uploads/product_images/{{ $product->image }}" alt="slide">
                <div class="carousel-caption d-none d-md-block">
                    <a href="#" class="float-center" target="" style="opacity: 1;display: inline-block;padding: 10px;background-color: rgb(238, 238, 231);border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom: solid black;">
                        <h4><b>{{ ucfirst(trans($product->name)) }}</b> / <b>Price</b> : {{ $product->sale_price }} $</h4>
                        
                    </a>
                    <p class="text-primary"><B>Stock :</B> {{ $product->stock }}</p>
                </div>
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true" style = "opacity:1 !important;color:red;}"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>