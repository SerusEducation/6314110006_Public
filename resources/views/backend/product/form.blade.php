<label for="product_name"><strong>Product Name</strong></label>
<input type="text" name="product_name" id="product_name" class="form-control" value="{{$product->product_name}}" required>
<label for="product_image"><strong>Product Image</strong></label>
<div class="text-center m-3">
    <img src="{{ asset('images/' . $product->product_image) }}" alt="image not found"  id="product_image" height="150" width="150" />
</div>
<input type="file" name="product_image" id="product_image" class="form-control p-1"  onchange="loadFile(event);" required>
<label for="price"><strong>Product Price</strong></label>
<input type="number" step="any" min="0" name="price" id="price" class="form-control" value="{{$product->price}}" required>
<label for="product_description"><strong>Product Description</strong></label>
<textarea name="product_description" id="product_description" class="form-control">{{$product->product_description}}</textarea>
<script>
    var loadFile = function(event) {
        var product_image = document.getElementById('product_image');
        product_image.src = URL.createObjectURL(event.target.files[0]);
        product_image.onload = function() {
            URL.revokeObjectURL(product_image.src)
        }
    }
</script>
