<div>Name: {{ $record->name }}</div>
<div>Stock: {{ $record->stock }}</div>
<div>Price: {{ $record->price }}</div>
<div>Image:  <img src="{{ public_path('storage/'.$record->image) }}" alt=""> </div>
