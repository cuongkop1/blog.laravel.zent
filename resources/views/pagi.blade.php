<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<ul>
		@foreach($posts as $post)
			<li>{{$post->title}}</li>
		@endforeach
	</ul>
		{{$posts->links()}}
		
</body>
</html>