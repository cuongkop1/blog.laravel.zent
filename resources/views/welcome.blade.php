<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    {{-- <link rel="stylesheet" href="{{mix('css/all.css')}}"> --}}
</head>
<body>
    <form enctype="multipart/form-data" method="post" action="upload">
    	@csrf
    	<input multiple="" type="file" name="images[]">
    	<button type="submit">Add</button>
    </form>
    {{-- <img src="{{ asset('storage/ahihi/EfF086fZJjlb0azoJNeCgyWVEwejcFaxamc5djbg.jpeg') }}"> --}}
</body>
</html>