<div class="col s12 m2 l2 sidebar">
	<div class="cont-menu">
		<ul class="menu">
			@foreach($modulos as $menu)
			<li >
				<a class="" href="{{$menu->ruta}}">{{$menu->descripcion}}</a>
				@foreach($submodulos as $link)
					@if($link->dependencia==$menu->id)
					<ul>
						<li >
							<a href="{{$link->ruta}}">{{$link->descripcion}}</a>
						</li>
					</ul>
					@endif
				@endforeach
			</li>
			@endforeach
		</ul>
	</div>
	<div class="calendario">
		
	</div>
	
</div>
