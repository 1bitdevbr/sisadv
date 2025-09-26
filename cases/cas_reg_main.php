<?php
	if( !isset( $_SESSION ) ) session_start();
	$required_level = 1;
	require_once(__DIR__ . '/../access/level.php');
	require_once(__DIR__ . '/../access/conn.php');
	require_once(__DIR__ . '/../config.php');
?>

<a name="topo"></a>
<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<?php require './menuh.php'; ?>
			<div class="invoice p-3 card-primary card-outline">
                <div class="row legend">
                    <legend class="title"><i class="fa fa-folder"></i>&nbsp;<?= $caseTitle; ?></legend>
                </div>
				<hr class="mt-0" style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />
				<div class="container-fluid">
					<div class="row justify-content-md-center">
						<div class="container text-center">
							<strong style="color: rgb( 205, 204, 204 ); font-weight: 500; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;">Convênio Defensoria?</strong><br /><br />
							<a href="?pg=cases/cas_reg_def" class="btn btn-app bg-success" style="color: rgb( 119, 230, 189 ); font-weight: 700; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;"><i class="fas fa-folder"></i>SIM</a>
							<a href="?pg=cases/cas_reg" class="btn btn-app bg-danger" style="color: rgb( 227, 164, 164 ); font-weight: 700; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;"><i class="fas fa-folder"></i>NÃO</a>
						</div>
					</div>
				</div>
				<hr style="width: auto; height: 2px; text-align: center; border: 2px; color: rgb( 108, 117, 125 ); background: rgb( 108, 117, 125, 20% );" />
			</div>
		</div>
	</section>
	<?php require './footerInt.php'; ?>
</div>
<a name="fim"></a>