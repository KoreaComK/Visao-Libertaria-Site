<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
	<script src="https://js.hcaptcha.com/1/api.js" async defer></script>

	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?=current_url(true);?>" />
	<meta name="theme-color" content="#F3C921">
	
	<?php if(strpos(current_url(true),'site/artigo/') === false && strpos(current_url(true),'site/pauta/') === false) : ?>

		<meta property="og:title" content="<?=$_SESSION['site_config']['texto_nome'];?>" />
		<meta property="og:image" content="<?= (file_exists('public/assets/favicon.ico'))?(site_url('public/assets/favicon.ico')):('https://yt3.googleusercontent.com/ytc/AIf8zZSU5BzsyFkBIMmIdu0lPTvOEIu6c2h3V_DRrviXcA=s176-c-k-c0x00ffffff-no-rj'); ?>"/>
		<meta property="og:description" content="<?=$_SESSION['site_config']['texto_rodape'];?>" />

	<?php endif; ?>

	<style type="text/css">
		.vl-bg-c,
		.btn-outline-secondary,
		.btn-primary {
			background-color: #f3c921 !important;
			color: #181818;
		}

		.btn-primary {
			border-color: #f3c921 !important;
		}

		a .vl-bg-c:hover {
			background-color: #e6e6e6 !important;
		}

		.bg-light {
			background-color: #e6e6e6;
			color: #181818;
		}

		a {
			color: #4b515c;
		}

		.media img {
			width: auto;
			height: auto;
			max-width: 250px;
			max-height: 120px;
		}
			
		@media screen and (max-width: 600px) {
 			.media {
				display: block;
				text-align: center;
			}

			.media p {
				text-align: left;
			}

			#pautas_form textarea {
				height: 180px;
			}
		}
	</style>
	<?php
		if(file_exists('public/assets/estilos.css')):
	?>
		<link rel="stylesheet" href="public/assets/estilos.css" crossorigin="anonymous">
	<?php
		endif;
	?>
	<title><?=$_SESSION['site_config']['texto_nome'];?></title>
	<link rel="icon" type="image/x-icon" href="<?= (file_exists('public/assets/favicon.ico'))?(site_url('public/assets/favicon.ico')):('https://yt3.googleusercontent.com/ytc/AIf8zZSU5BzsyFkBIMmIdu0lPTvOEIu6c2h3V_DRrviXcA=s176-c-k-c0x00ffffff-no-rj'); ?>">
</head>

	<?php
		$banner = 'https://yt3.googleusercontent.com/qd_fOR_7fiOlxePKpWniaJSMla9Bv1jRV0wxufCxhVWHJ657Bzmh3yaK1PTi9BydS-2wTnlGCg=w1707-fcrop64=1,00005a57ffffa5a8-k-c0xffffffff-no-nd-rj';
		if(file_exists('public/assets/banner.png')) {
			$banner = base_url('public/assets/banner.png');
		}
	?>
	<div class="container-fluid" style="background-image:url(<?= $banner; ?>); height: 16.5vw; background-size: 100%;"></div>
	<div class="container-fluid mb-3 vl-bg-c">
		<nav class="navbar navbar-expand-lg navbar-light bg-light vl-bg-c">
			<div class="container">
				<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="navbar-collapse collapse" id="navbarsExample07" style="">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link" href="<?= site_url('site'); ?>">Principal</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('site/artigos'); ?>">Artigos Publicados</a>
						</li>
						<?php if (isset($_SESSION) && $_SESSION['colaboradores']['id'] != null) : ?>
							<?php if (in_array('1', $_SESSION['colaboradores']['permissoes'])) : ?>
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">Pautas</a>
									<div class="dropdown-menu vl-bg-c" aria-labelledby="dropdown07">
										<?php if (isset($_SESSION) && in_array('1', $_SESSION['colaboradores']['permissoes'])) : ?>
											<a href="<?= site_url('colaboradores/pautas/cadastrar'); ?>" class="dropdown-item">Sugerir Pauta</a>
										<?php endif; ?>
										<?php if (isset($_SESSION) && in_array('1', $_SESSION['colaboradores']['permissoes'])) : ?>
											<a href="<?= site_url('colaboradores/pautas/'); ?>" class="dropdown-item">Ver Pautas</a>
										<?php endif; ?>
										<?php if (isset($_SESSION) && in_array('11', $_SESSION['colaboradores']['permissoes'])) : ?>
											<a href="<?= site_url('colaboradores/pautas/redatores'); ?>" class="dropdown-item">Ver Pautas dos Redatores</a>
										<?php endif; ?>
									</div>
								</li>
							<?php endif; ?>
							<?php if (in_array('2', $_SESSION['colaboradores']['permissoes']) || in_array('3', $_SESSION['colaboradores']['permissoes']) || in_array('4', $_SESSION['colaboradores']['permissoes']) || in_array('5', $_SESSION['colaboradores']['permissoes']) || in_array('6', $_SESSION['colaboradores']['permissoes'])) : ?>
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">Artigos</a>
									<div class="dropdown-menu vl-bg-c" aria-labelledby="dropdown07">
										<?php if (isset($_SESSION) && in_array('2', $_SESSION['colaboradores']['permissoes'])) : ?>
											<a href="<?= site_url('colaboradores/artigos/cadastrar'); ?>" class="dropdown-item">Escrever Artigo</a>
										<?php endif; ?>
										<?php if (isset($_SESSION) && in_array('2', $_SESSION['colaboradores']['permissoes'])) : ?>
											<a href="<?= site_url('colaboradores/artigos'); ?>" class="dropdown-item">Ver Todos Artigos</a>
										<?php endif; ?>
										<?php if (isset($_SESSION) && in_array('3', $_SESSION['colaboradores']['permissoes'])) : ?>
											<a href="<?= site_url('colaboradores/artigos/revisar'); ?>" class="dropdown-item">Revisar</a>
										<?php endif; ?>
										<?php if (isset($_SESSION) && in_array('4', $_SESSION['colaboradores']['permissoes'])) : ?>
											<a href="<?= site_url('colaboradores/artigos/narrar'); ?>" class="dropdown-item">Narrar</a>
										<?php endif; ?>
										<?php if (isset($_SESSION) && in_array('5', $_SESSION['colaboradores']['permissoes'])) : ?>
											<a href="<?= site_url('colaboradores/artigos/produzir'); ?>" class="dropdown-item">Produzir</a>
										<?php endif; ?>
										<?php if (isset($_SESSION) && in_array('6', $_SESSION['colaboradores']['permissoes'])) : ?>
											<a href="<?= site_url('colaboradores/artigos/publicar'); ?>" class="dropdown-item">Publicar</a>
										<?php endif; ?>
									</div>
								</li>
							<?php endif; ?>
							<?php if (in_array('7', $_SESSION['colaboradores']['permissoes']) || in_array('8', $_SESSION['colaboradores']['permissoes']) || in_array('9', $_SESSION['colaboradores']['permissoes']) || in_array('10', $_SESSION['colaboradores']['permissoes'])) : ?>
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">Administração</a>
									<div class="dropdown-menu vl-bg-c" aria-labelledby="dropdown07">
										<?php if (isset($_SESSION) && in_array('7', $_SESSION['colaboradores']['permissoes'])) : ?>
											<a href="<?= site_url('colaboradores/admin/administracao'); ?>" class="dropdown-item">Configuração do Site</a>
										<?php endif; ?>
										<?php if (isset($_SESSION) && in_array('8', $_SESSION['colaboradores']['permissoes'])) : ?>
											<a href="<?= site_url('colaboradores/admin/financeiro'); ?>" class="dropdown-item">Financeiro</a>
										<?php endif; ?>
										<?php if (isset($_SESSION) && in_array('9', $_SESSION['colaboradores']['permissoes'])) : ?>
											<a href="<?= site_url('colaboradores/admin/permissoes'); ?>" class="dropdown-item">Recursos Humanos</a>
										<?php endif; ?>
										<?php if (isset($_SESSION) && in_array('10', $_SESSION['colaboradores']['permissoes'])) : ?>
											<a href="<?= site_url('colaboradores/pautas/fechar'); ?>" class="dropdown-item">Fechar
												Pauta</a>
										<?php endif; ?>
										<?php if (isset($_SESSION) && in_array('10', $_SESSION['colaboradores']['permissoes'])) : ?>
											<a href="<?= site_url('colaboradores/pautas/fechadas'); ?>" class="dropdown-item">Listar Pautas Fechadas</a>
										<?php endif; ?>
									</div>
								</li>
							<?php endif; ?>
						<?php endif; ?>
					</ul>
					<div class="form-inline my-2 my-md-0">
						<?php if (!isset($_SESSION) || $_SESSION['colaboradores']['id'] === null) : ?>
							<a href="<?= site_url('site/cadastrar'); ?>" class="nav-item nav-link">Cadastrar</a>
							<a href="<?= site_url('site/login'); ?>" class="nav-item nav-link">Login</a>
						<?php endif; ?>
						<?php if (isset($_SESSION) && $_SESSION['colaboradores']['id'] !== null) : ?>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-list-4" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							</button>
							<div class="collapse navbar-collapse" id="navbar-list-4">
								<ul class="navbar-nav">
									<li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<img id="avatar_menu" src="<?= $_SESSION['colaboradores']['avatar']; ?>" width="30" height="30" class="rounded-circle">
											<span class="apelido_colaborador">
												<?= $_SESSION['colaboradores']['nome']; ?>
											</span>
										</a>
										<div class="dropdown-menu vl-bg-c" aria-labelledby="navbarDropdownMenuLink">
											<a class="dropdown-item" href="<?= site_url('colaboradores/perfil'); ?>">Meu
												Perfil</a>
											<a class="dropdown-item" href="<?= site_url('site/logout'); ?>">Sair</a>
										</div>
									</li>
								</ul>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</nav>
	</div>



<body>
	<?= $this->renderSection('content'); ?>

	<div class="container-fluid bg-light pt-5 px-sm-3 px-md-5 vl-bg-c">
		<div class="row">
			<div class="col-lg-4 col-md-6 mb-5">
				<h4 class="font-weight-bold mb-4"><img class="img-thumbnail rounded-circle mr-3" width="100px" src="<?= (file_exists('public/assets/rodape.png'))?(site_url('public/assets/rodape.png')):('https://yt3.googleusercontent.com/ytc/AIf8zZSU5BzsyFkBIMmIdu0lPTvOEIu6c2h3V_DRrviXcA=s176-c-k-c0x00ffffff-no-rj'); ?>" />
					<?=$_SESSION['site_config']['texto_nome'];?>
				</h4>
				<div class="d-flex flex-wrap m-n1 justify-content-start">
					<p><?=$_SESSION['site_config']['texto_rodape'];?></p>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 mb-5 text-center">
				<?php if($_SESSION['site_config']['twitter'] !== NULL || $_SESSION['site_config']['instagram'] !== NULL || $_SESSION['site_config']['youtube'] !== NULL): ?>
					<h4 class="font-weight-bold mb-4">Nossas Redes Sociais</h4>
					<div class="d-flex justify-content-center mt-4">
						<?php if($_SESSION['site_config']['twitter'] !== NULL): ?>
						<a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 60px; height: 60px;" href="<?=$_SESSION['site_config']['twitter'];?>" target="_blank">
							<svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
								<path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
							</svg>
						</a>
						<?php endif; ?>
						<?php if($_SESSION['site_config']['instagram'] !== NULL): ?>
						<a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 60px; height: 60px;" href="<?=$_SESSION['site_config']['instagram'];?>" target="_blank">
							<svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
								<path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
							</svg>
						</a>
						<?php endif; ?>
						<?php if($_SESSION['site_config']['youtube'] !== NULL): ?>
						<a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 60px; height: 60px;" href="<?=$_SESSION['site_config']['youtube'];?>" target="_blank">
							<svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
								<path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z" />
							</svg>
						</a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="col-lg-4 col-md-6 mb-5">
				<h4 class="font-weight-bold mb-4">Quick Links</h4>
				<div class="d-flex flex-column justify-content-start">
					<a class="mb-2" href="<?=site_url('site/contato');?>"><i class="fa fa-angle-right text-dark mr-2"></i>Entre em
						contato</a>
					<a class="mb-2" href="#"><i class="fa fa-angle-right text-dark mr-2"></i>Saiba mais
						sobre o projeto</a>
					<a class="mb-2" href="#"><i class="fa fa-angle-right text-dark mr-2"></i>Seja um
						colaborador</a>
					<a class="mb-2" href="#"><i class="fa fa-angle-right text-dark mr-2"></i>Como
						funciona a colaboração</a>
					<a class="" href="#"><i class="fa fa-angle-right text-dark mr-2"></i>Veja todos os
						nossos canais</a>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid py-2 px-sm-3 px-md-5 vl-bg-c">
		<p class="m-0 text-center">
			<a class="font-light" href="https://visaolibertaria.com">Visão Libertária</a>. Desenvolvido por
			<a class="font-light" href="https://github.com/KoreaComK/">KoreacomK</a> e a comunidade.
		</p>
	</div>


	<div class="modal loading" id="modal-loading" tabindex="-1" aria-hidden="true">
		<div class="position-absolute w-100 h-100 d-flex flex-column align-items-center justify-content-center">
			<div class="spinner-border text-light" style="width: 3rem; height: 3rem;" role="status">
				<span class="sr-only ">Loading...</span>
			</div>
		</div>
	</div>

</body>


<script type="text/javascript">
	$('.carousel').carousel();

	$(document).ready(function() {
		bsCustomFileInput.init()
	})
</script>

</html>
