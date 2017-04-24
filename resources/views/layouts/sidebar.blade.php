<div class="col s12 m2 l2 sidebar">
	<div class="menu">
		<ul>
			@foreach($sidebar as $menu)
				<li ><a class="" href="{{$menu->ruta}}">{{$menu->descripcion}}</a></li>
			@endforeach
		</ul>
	</div>
	<div class="calendario">
		
	</div>
	
</div>
