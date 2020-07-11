<option value="">Subcategory</option>
@foreach ($subcategoryData as $subcategory)
<option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
@endforeach