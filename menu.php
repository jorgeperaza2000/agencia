<ul id="main-menu" class="main-menu">
	<!-- add class "multiple-expanded" to allow multiple submenus to open -->
	<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
	<div id="statusMenu" style="display:none;" data-controller="<?=isset($_GET["c"])?$_GET["c"]:""?>"></div>
	<li id="dashboard">
		<a href="dashboard.php">
			<i class="entypo-gauge"></i>
			<span class="title">Dashboard</span>
		</a>
	</li>
	<li class="">
		<a href="">
			<i class="fa fa-building-o"></i>
			<span class="title">Taquillas</span>
		</a>
		<ul>
			<li id="ventas_diarias">
				<a href="routes.php?c=ventas_diarias&a=index">
					<span class="title">Ventas Diarias</span>
				</a>
			</li>
			<li id="abonos">
				<a href="../abonos/index">
					<span class="title">Abonos</span>
				</a>
			</li>
			<li id="cuadre_cuentas">
				<a href="routes.php?c=cuadre_cuentas&a=index">
					<span class="title">Cuadre de cuentas</span>
				</a>
			</li>
		</ul>
	</li>
	<li class="">
		<a href="">
			<i class="fa fa-building-o"></i>
			<span class="title">Gestión de clientes</span>
		</a>
		<ul>
			<li id="clientes">
				<a href="../clientes/index">
					<span class="title">Clientes</span>
				</a>
			</li>
			<li id="deudas">
				<a href="routes.php?c=deudas&a=index">
					<span class="title">Detalles CxC</span>
				</a>
			</li>
		</ul>
	</li>
	<li id="programas">
		<a href="routes.php?c=programas&a=index"">
			<i class="entypo-gauge"></i>
			<span class="title">Programas</span>
		</a>
	</li>
</ul>