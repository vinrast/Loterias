<div class="col s12 m2 l2 sidebar">
	<div class="menu">
		<ul>
			@foreach($modulos as $menu)
				<li ><a class="" href="{{$menu->ruta}}">{{$menu->descripcion}}</a></li>
				@foreach($submodulos as $link)
					@if($link->dependencia==$menu->id)
						<li ><a class="" href="{{$link->ruta}}">{{$link->descripcion}}</a></li>
					@endif
				@endforeach
			@endforeach
		</ul>
	</div>
	<div class="calendario">
		
	</div>
	
</div>
