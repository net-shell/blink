<!doctype html>
<html>
	<head>
		<title>{{ Site::Title() }}</title>
		{{ Site::Cdn('bootstrap-css') }}
		{{ $assets }}
	</head>
	<body>
		@include('theme::header')
		<div class="container">
			<div class="row fluid">
				<div class="posts col-md-8">
					{{ Site::ContentStart() }}
					<div class="post">
						<h1>{{ Site::ContentTitle() }}</h1>
						<div>{{ Site::ContentTime() }}</div>
						<div>{{ Site::Content() }}</div>
					</div>
					{{ Site::ContentEnd() }}
					
					{{ Site::NoContentStart() }}
					<p>Sorry, no posts here</p>
					{{ Site::NoContentEnd() }}
				</div>
				<div class="col-md-4">
					{{ Site::Sidebar() }}
				</div>
			</div>
			<div class="footer">
				<b>&copy; {{ $Basic->Copyright }}</b>
				<div>Template rendered at {{ date('Y/m/d H:i:s') }}</div>
			</div>
			{{ Site::Cdn('jquery') }}
			{{ Site::Cdn('bootstrap-js') }}
		</div>
	</body>
</html>