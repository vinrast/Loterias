<div class="col s12 m2 l2 sidebar">
	<div class="menu">
		<ul>
			@foreach($modulos as $menu)
				<a class="" href="{{$menu->ruta}}"><li >{{$menu->descripcion}}</li></a>
				@foreach($submodulos as $link)
					@if($link->dependencia==$menu->id)
						<a class="" href="{{$link->ruta}}"><li >{{$link->descripcion}}</li></a>
					@endif
				@endforeach
			@endforeach
		</ul>
	</div>
	<div class="calendario">
		
	</div>
	
</div>
