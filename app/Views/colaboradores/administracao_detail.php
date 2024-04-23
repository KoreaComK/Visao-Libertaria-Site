<?php

use CodeIgniter\I18n\Time;

?>
<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid py-3">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="mensagem p-3 mb-2 rounded text-white text-center collapse col-12"></div>
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item" role="presentation">
						<button class="nav-link active" id="cron-tab" data-toggle="tab" data-target="#cron"
							type="button" role="tab" aria-controls="cron" aria-selected="true">Cron</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="pautas-tab" data-toggle="tab" data-target="#pautas" type="button"
							role="tab" aria-controls="pautas" aria-selected="false">Pautas</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="artigos-tab" data-toggle="tab" data-target="#artigos" type="button"
							role="tab" aria-controls="artigos" aria-selected="false">Artigos</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="home-tab" data-toggle="tab" data-target="#home" type="button"
							role="tab" aria-controls="home" aria-selected="false">Home</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="gerais-tab" data-toggle="tab" data-target="#gerais" type="button"
							role="tab" aria-controls="gerais" aria-selected="false">Geral</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="estilos-tab" data-toggle="tab" data-target="#estilos" type="button"
							role="tab" aria-controls="estilos" aria-selected="false">Estilo</button>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade justify-content-center mt-2 show active" id="cron" role="tabpanel"
						aria-labelledby="cron-tab">
						<form class="col-12 mt-4" novalidate="yes" method="post" id="cron_form">
							<div class="mb-3">
								<label for="username">Hash do Cron <span class="text-muted">Ao alterar o hash, é
										necessário alterar o Cron no servidor</span></label>
								<div class="input-group">
									<input type="text" class="form-control" id="cron_hash" placeholder="Hash do Cron"
										name="cron_hash" required
										value="<?= (isset($dados['cron_hash'])) ? ($dados['cron_hash']) : (''); ?>">
								</div>
							</div>

							<div class="mb-3">
								<h4>Pautas</h4>
							</div>

							<div class="mb-3">
								<label for="titulo">Habilitar exclusão das pautas</label>
								<select class="custom-select" id="cron_pautas_status_delete"
									name="cron_pautas_status_delete">
									<option value="1" <?= (isset($dados['cron_pautas_status_delete']) && $dados['cron_pautas_status_delete'] == '1') ? ('selected') : (''); ?>>Ativar
									</option>
									<option value="0" <?= (isset($dados['cron_pautas_status_delete']) && $dados['cron_pautas_status_delete'] == '0') ? ('selected') : (''); ?>>Inativar
									</option>
								</select>
							</div>

							<div class="mb-3">
								<label for="titulo">Data limite para exclusão</label>
								<div class="form-row">
									<div class="col-md-8 mb-2">
										<input type="number" class="form-control" id="cron_pautas_data_delete_number"
											placeholder="Data para exclusão" name="cron_pautas_data_delete_number"
											required min="1"
											value="<?= (isset($dados['cron_pautas_data_delete'])) ? (explode(' ', $dados['cron_pautas_data_delete'])[0]) : (''); ?>">
									</div>
									<div class="col-md-4 mb-4">
										<select class="custom-select" id="cron_pautas_data_delete_time"
											name="cron_pautas_data_delete_time">
											<option selected value="days" <?= (isset($dados['cron_pautas_data_delete']) && explode(' ', $dados['cron_pautas_data_delete'])[1] == 'days') ? ('selected') : (''); ?>>dia(s)</option>
											<option value="weeks" <?= (isset($dados['cron_pautas_data_delete']) && explode(' ', $dados['cron_pautas_data_delete'])[1] == 'weeks') ? ('selected') : (''); ?>>semana(s)</option>
											<option value="months" <?= (isset($dados['cron_pautas_data_delete']) && explode(' ', $dados['cron_pautas_data_delete'])[1] == 'months') ? ('selected') : (''); ?>>mes(es)</option>
											<option value="years" <?= (isset($dados['cron_pautas_data_delete']) && explode(' ', $dados['cron_pautas_data_delete'])[1] == 'years') ? ('selected') : (''); ?>>ano(s)</option>
										</select>
									</div>
								</div>
							</div>

							<div class="mb-3">
								<h4>Marcação de Artigos</h4>
							</div>

							<div class="mb-3">
								<label for="titulo">Habilitar desmarcação de artigos</label>
								<select class="custom-select" id="cron_artigos_desmarcar_status"
									name="cron_artigos_desmarcar_status">
									<option value="1" <?= (isset($dados['cron_artigos_desmarcar_status']) && $dados['cron_artigos_desmarcar_status'] == '1') ? ('selected') : (''); ?>>Ativar
									</option>
									<option value="0" <?= (isset($dados['cron_artigos_desmarcar_status']) && $dados['cron_artigos_desmarcar_status'] == '0') ? ('selected') : (''); ?>>Inativar
									</option>
								</select>
							</div>

							<div class="mb-3">
								<label for="cron_artigos_teoria_desmarcar_data_revisao_number">Tempo limite para desmarcação da revisão (Teórico)</label>
								<div class="form-row">
									<div class="col-md-8 mb-2">
										<input type="number" class="form-control" id="cron_artigos_teoria_desmarcar_data_revisao_number"
											placeholder="Tempo para desmarcação" name="cron_artigos_teoria_desmarcar_data_revisao_number"
											required min="1"
											value="<?= (isset($dados['cron_artigos_teoria_desmarcar_data_revisao'])) ? (explode(' ', $dados['cron_artigos_teoria_desmarcar_data_revisao'])[0]) : (''); ?>">
									</div>
									<div class="col-md-4">
										<select class="custom-select" id="cron_artigos_teoria_desmarcar_data_revisao_time"
											name="cron_artigos_teoria_desmarcar_data_revisao_time">
											<option value="hours" <?= (isset($dados['cron_artigos_teoria_desmarcar_data_revisao']) && explode(' ', $dados['cron_artigos_teoria_desmarcar_data_revisao'])[1] == 'hours') ? ('selected') : (''); ?>>hora(s)</option>
											<option value="days" <?= (isset($dados['cron_artigos_teoria_desmarcar_data_revisao']) && explode(' ', $dados['cron_artigos_teoria_desmarcar_data_revisao'])[1] == 'days') ? ('selected') : (''); ?>>dia(s)</option>
										</select>
									</div>
								</div>
							</div>

							<div class="mb-3">
								<label for="cron_artigos_teoria_desmarcar_data_narracao_number">Tempo limite para desmarcação da narração (Teórico)</label>
								<div class="form-row">
									<div class="col-md-8 mb-2">
										<input type="number" class="form-control" id="cron_artigos_teoria_desmarcar_data_narracao_number"
											placeholder="Tempo para desmarcação" name="cron_artigos_teoria_desmarcar_data_narracao_number"
											required min="1"
											value="<?= (isset($dados['cron_artigos_teoria_desmarcar_data_narracao'])) ? (explode(' ', $dados['cron_artigos_teoria_desmarcar_data_narracao'])[0]) : (''); ?>">
									</div>
									<div class="col-md-4">
										<select class="custom-select" id="cron_artigos_teoria_desmarcar_data_narracao_time"
											name="cron_artigos_teoria_desmarcar_data_narracao_time">
											<option value="hours" <?= (isset($dados['cron_artigos_teoria_desmarcar_data_narracao']) && explode(' ', $dados['cron_artigos_teoria_desmarcar_data_narracao'])[1] == 'hours') ? ('selected') : (''); ?>>hora(s)</option>
											<option value="days" <?= (isset($dados['cron_artigos_teoria_desmarcar_data_narracao']) && explode(' ', $dados['cron_artigos_teoria_desmarcar_data_narracao'])[1] == 'days') ? ('selected') : (''); ?>>dia(s)</option>
										</select>
									</div>
								</div>
							</div>

							<div class="mb-3">
								<label for="cron_artigos_teoria_desmarcar_data_producao">Tempo limite para desmarcação da produção (Teórico)</label>
								<div class="form-row">
									<div class="col-md-8 mb-2">
										<input type="number" class="form-control" id="cron_artigos_teoria_desmarcar_data_producao_number"
											placeholder="Tempo para desmarcação" name="cron_artigos_teoria_desmarcar_data_producao_number"
											required min="1"
											value="<?= (isset($dados['cron_artigos_teoria_desmarcar_data_producao'])) ? (explode(' ', $dados['cron_artigos_teoria_desmarcar_data_producao'])[0]) : (''); ?>">
									</div>
									<div class="col-md-4">
										<select class="custom-select" id="cron_artigos_teoria_desmarcar_data_producao_time"
											name="cron_artigos_teoria_desmarcar_data_producao_time">
											<option value="hours" <?= (isset($dados['cron_artigos_teoria_desmarcar_data_producao']) && explode(' ', $dados['cron_artigos_teoria_desmarcar_data_producao'])[1] == 'hours') ? ('selected') : (''); ?>>hora(s)</option>
											<option value="days" <?= (isset($dados['cron_artigos_teoria_desmarcar_data_producao']) && explode(' ', $dados['cron_artigos_teoria_desmarcar_data_producao'])[1] == 'days') ? ('selected') : (''); ?>>dia(s)</option>
										</select>
									</div>
								</div>
							</div>

							<div class="mb-3">
								<label for="cron_artigos_noticia_desmarcar_data_revisao">Tempo limite para desmarcação da revisão (Notícia)</label>
								<div class="form-row">
									<div class="col-md-8 mb-2">
										<input type="number" class="form-control" id="cron_artigos_noticia_desmarcar_data_revisao_number"
											placeholder="Tempo para desmarcação" name="cron_artigos_noticia_desmarcar_data_revisao_number"
											required min="1"
											value="<?= (isset($dados['cron_artigos_noticia_desmarcar_data_revisao'])) ? (explode(' ', $dados['cron_artigos_noticia_desmarcar_data_revisao'])[0]) : (''); ?>">
									</div>
									<div class="col-md-4">
										<select class="custom-select" id="cron_artigos_noticia_desmarcar_data_revisao_time"
											name="cron_artigos_noticia_desmarcar_data_revisao_time">
											<option value="hours" <?= (isset($dados['cron_artigos_noticia_desmarcar_data_revisao']) && explode(' ', $dados['cron_artigos_noticia_desmarcar_data_revisao'])[1] == 'hours') ? ('selected') : (''); ?>>hora(s)</option>
											<option value="days" <?= (isset($dados['cron_artigos_noticia_desmarcar_data_revisao']) && explode(' ', $dados['cron_artigos_noticia_desmarcar_data_revisao'])[1] == 'days') ? ('selected') : (''); ?>>dia(s)</option>
										</select>
									</div>
								</div>
							</div>

							<div class="mb-3">
								<label for="cron_artigos_noticia_desmarcar_data_narracao_number">Tempo limite para desmarcação da narração (Notícia)</label>
								<div class="form-row">
									<div class="col-md-8 mb-2">
										<input type="number" class="form-control" id="cron_artigos_noticia_desmarcar_data_narracao_number"
											placeholder="Tempo para desmarcação" name="cron_artigos_noticia_desmarcar_data_narracao_number"
											required min="1"
											value="<?= (isset($dados['cron_artigos_noticia_desmarcar_data_narracao'])) ? (explode(' ', $dados['cron_artigos_noticia_desmarcar_data_narracao'])[0]) : (''); ?>">
									</div>
									<div class="col-md-4">
										<select class="custom-select" id="cron_artigos_noticia_desmarcar_data_narracao_time"
											name="cron_artigos_noticia_desmarcar_data_narracao_time">
											<option value="hours" <?= (isset($dados['cron_artigos_noticia_desmarcar_data_narracao']) && explode(' ', $dados['cron_artigos_noticia_desmarcar_data_narracao'])[1] == 'hours') ? ('selected') : (''); ?>>hora(s)</option>
											<option value="days" <?= (isset($dados['cron_artigos_noticia_desmarcar_data_narracao']) && explode(' ', $dados['cron_artigos_noticia_desmarcar_data_narracao'])[1] == 'days') ? ('selected') : (''); ?>>dia(s)</option>
										</select>
									</div>
								</div>
							</div>

							<div class="mb-3">
								<label for="cron_artigos_noticia_desmarcar_data_producao_number">Tempo limite para desmarcação da produção (Notícia)</label>
								<div class="form-row">
									<div class="col-md-8 mb-2">
										<input type="number" class="form-control" id="cron_artigos_noticia_desmarcar_data_producao_number"
											placeholder="Tempo para desmarcação" name="cron_artigos_noticia_desmarcar_data_producao_number"
											required min="1"
											value="<?= (isset($dados['cron_artigos_noticia_desmarcar_data_producao'])) ? (explode(' ', $dados['cron_artigos_noticia_desmarcar_data_producao'])[0]) : (''); ?>">
									</div>
									<div class="col-md-4">
										<select class="custom-select" id="cron_artigos_noticia_desmarcar_data_producao_time"
											name="cron_artigos_noticia_desmarcar_data_producao_time">
											<option value="hours" <?= (isset($dados['cron_artigos_noticia_desmarcar_data_producao']) && explode(' ', $dados['cron_artigos_noticia_desmarcar_data_producao'])[1] == 'hours') ? ('selected') : (''); ?>>hora(s)</option>
											<option value="days" <?= (isset($dados['cron_artigos_noticia_desmarcar_data_producao']) && explode(' ', $dados['cron_artigos_noticia_desmarcar_data_producao'])[1] == 'days') ? ('selected') : (''); ?>>dia(s)</option>
										</select>
									</div>
								</div>
							</div>

							<div class="mb-3">
								<h4>Descarte Automático de Artigos</h4>
							</div>

							<div class="mb-3">
								<label for="titulo">Habilitar descarte automático de artigos</label>
								<select class="custom-select" id="cron_artigos_descartar_status"
									name="cron_artigos_descartar_status">
									<option value="1" <?= (isset($dados['cron_artigos_descartar_status']) && $dados['cron_artigos_descartar_status'] == '1') ? ('selected') : (''); ?>>Ativar
									</option>
									<option value="0" <?= (isset($dados['cron_artigos_descartar_status']) && $dados['cron_artigos_descartar_status'] == '0') ? ('selected') : (''); ?>>Inativar
									</option>
								</select>
							</div>

							<div class="mb-3">
								<label for="titulo">Data Limite Exclusão de Notificação Lida</label>
								<div class="form-row">
									<div class="col-md-8 mb-2">
										<input type="number" class="form-control" id="cron_artigos_descartar_data_number"
											placeholder="Data para exclusão" name="cron_artigos_descartar_data_number"
											required min="1"
											value="<?= (isset($dados['cron_artigos_descartar_data'])) ? (explode(' ', $dados['cron_artigos_descartar_data'])[0]) : (''); ?>">
									</div>
									<div class="col-md-4 mb-4">
										<select class="custom-select" id="cron_artigos_descartar_data_time"
											name="cron_artigos_descartar_data_time">
											<option selected value="days" <?= (isset($dados['cron_artigos_descartar_data']) && explode(' ', $dados['cron_artigos_descartar_data'])[1] == 'days') ? ('selected') : (''); ?>>dia(s)</option>
											<option value="weeks" <?= (isset($dados['cron_artigos_descartar_data']) && explode(' ', $dados['cron_artigos_descartar_data'])[1] == 'weeks') ? ('selected') : (''); ?>>semana(s)</option>
											<option value="months" <?= (isset($dados['cron_artigos_descartar_data']) && explode(' ', $dados['cron_artigos_descartar_data'])[1] == 'months') ? ('selected') : (''); ?>>mes(es)</option>
											<option value="years" <?= (isset($dados['cron_artigos_descartar_data']) && explode(' ', $dados['cron_artigos_descartar_data'])[1] == 'years') ? ('selected') : (''); ?>>ano(s)</option>
										</select>
									</div>
								</div>
							</div>

							<div class="mb-3">
								<h4>Notificações</h4>
							</div>

							<div class="mb-3">
								<label for="titulo">Habilitar Exclusão das Notificações</label>
								<select class="custom-select" id="cron_notificacoes_status_delete"
									name="cron_notificacoes_status_delete">
									<option value="1" <?= (isset($dados['cron_notificacoes_status_delete']) && $dados['cron_notificacoes_status_delete'] == '1') ? ('selected') : (''); ?>>Ativar
									</option>
									<option value="0" <?= (isset($dados['cron_notificacoes_status_delete']) && $dados['cron_notificacoes_status_delete'] == '0') ? ('selected') : (''); ?>>Inativar
									</option>
								</select>
							</div>

							<div class="mb-3">
								<label for="titulo">Data Limite Exclusão de Notificação Lida</label>
								<div class="form-row">
									<div class="col-md-8 mb-2">
										<input type="number" class="form-control" id="cron_notificacoes_data_visualizado_number"
											placeholder="Data para exclusão" name="cron_notificacoes_data_visualizado_number"
											required min="1"
											value="<?= (isset($dados['cron_notificacoes_data_visualizado'])) ? (explode(' ', $dados['cron_notificacoes_data_visualizado'])[0]) : (''); ?>">
									</div>
									<div class="col-md-4 mb-2">
										<select class="custom-select" id="cron_notificacoes_data_visualizado_time"
											name="cron_notificacoes_data_visualizado_time">
											<option selected value="days" <?= (isset($dados['cron_notificacoes_data_visualizado']) && explode(' ', $dados['cron_notificacoes_data_visualizado'])[1] == 'days') ? ('selected') : (''); ?>>dia(s)</option>
											<option value="weeks" <?= (isset($dados['cron_notificacoes_data_visualizado']) && explode(' ', $dados['cron_notificacoes_data_visualizado'])[1] == 'weeks') ? ('selected') : (''); ?>>semana(s)</option>
											<option value="months" <?= (isset($dados['cron_notificacoes_data_visualizado']) && explode(' ', $dados['cron_notificacoes_data_visualizado'])[1] == 'months') ? ('selected') : (''); ?>>mes(es)</option>
											<option value="years" <?= (isset($dados['cron_notificacoes_data_visualizado']) && explode(' ', $dados['cron_notificacoes_data_visualizado'])[1] == 'years') ? ('selected') : (''); ?>>ano(s)</option>
										</select>
									</div>
								</div>
							</div>

							<div class="mb-3">
								<label for="titulo">Data Limite Exclusão de Notificação Não Lida</label>
								<div class="form-row">
									<div class="col-md-8 mb-2">
										<input type="number" class="form-control" id="cron_notificacoes_data_cadastrado_number"
											placeholder="Data para exclusão" name="cron_notificacoes_data_cadastrado_number"
											required min="1"
											value="<?= (isset($dados['cron_notificacoes_data_cadastrado'])) ? (explode(' ', $dados['cron_notificacoes_data_cadastrado'])[0]) : (''); ?>">
									</div>
									<div class="col-md-4 mb-4">
										<select class="custom-select" id="cron_notificacoes_data_cadastrado_time"
											name="cron_notificacoes_data_cadastrado_time">
											<option selected value="days" <?= (isset($dados['cron_notificacoes_data_cadastrado']) && explode(' ', $dados['cron_notificacoes_data_cadastrado'])[1] == 'days') ? ('selected') : (''); ?>>dia(s)</option>
											<option value="weeks" <?= (isset($dados['cron_notificacoes_data_cadastrado']) && explode(' ', $dados['cron_notificacoes_data_cadastrado'])[1] == 'weeks') ? ('selected') : (''); ?>>semana(s)</option>
											<option value="months" <?= (isset($dados['cron_notificacoes_data_cadastrado']) && explode(' ', $dados['cron_notificacoes_data_cadastrado'])[1] == 'months') ? ('selected') : (''); ?>>mes(es)</option>
											<option value="years" <?= (isset($dados['cron_notificacoes_data_cadastrado']) && explode(' ', $dados['cron_notificacoes_data_cadastrado'])[1] == 'years') ? ('selected') : (''); ?>>ano(s)</option>
										</select>
									</div>
								</div>
							</div>

							<div class="mb-3">
								<h4>Notificações Falta de Carteira para Colaboradores</h4>
							</div>

							<div class="mb-3">
								<label for="titulo">Enviar e-mail quantos dias antes do último dia do mês</label>
								<div class="form-row">
									<div class="col-md-8 mb-2">
										<input type="number" class="form-control" id="cron_email_carteira_data_number"
											placeholder="Data para exclusão" name="cron_email_carteira_data_number"
											required min="1"
											value="<?= (isset($dados['cron_email_carteira_data'])) ? (explode(' ', $dados['cron_email_carteira_data'])[0]) : (''); ?>">
									</div>
									<div class="col-md-4 mb-4">
										<select class="custom-select" id="cron_email_carteira_data_time"
											name="cron_email_carteira_data_time">
											<option selected value="days" <?= (isset($dados['cron_email_carteira_data']) && explode(' ', $dados['cron_email_carteira_data'])[1] == 'days') ? ('selected') : (''); ?>>dia(s)</option>
											<option value="weeks" <?= (isset($dados['cron_email_carteira_data']) && explode(' ', $dados['cron_email_carteira_data'])[1] == 'weeks') ? ('selected') : (''); ?>>semana(s)</option>
										</select>
									</div>
								</div>
							</div>

							<button class="btn btn-primary btn-block mb-3 salvar-config-cron" type="button">Salvar
								alterações
								do
								Cron</button>
						</form>
					</div>
					<div class="tab-pane fade" id="pautas" role="tabpanel" aria-labelledby="pautas-tab">
						<form class="col-12 mt-4" novalidate="yes" method="post" id="pautas_form">
							<div class="mb-3">
								<label for="pauta_bot_hash">Hash de acesso do Ancapsubot</label> <span class="text-muted">Ao alterar o hash, é necessário alterar a hash de acesso do Ancapsubot</span>
								<div class="input-group">
									<input type="text" class="form-control" id="pauta_bot_hash"
										placeholder="Hash do Ancapsubot" name="pauta_bot_hash" required min="1"
										value="<?= (isset($dados['pauta_bot_hash'])) ? ($dados['pauta_bot_hash']) : (''); ?>">
								</div>
							</div>
						
							<div class="mb-3">
								<h4>Limites de Envio</h4>
							</div>

							<div class="mb-3">
								<label for="limite_pautas_diario">Limites DIÁRIOS de Pautas</label>
								<div class="input-group">
									<input type="number" class="form-control" id="limite_pautas_diario"
										placeholder="Data para exclusão" name="limite_pautas_diario" required min="1"
										value="<?= (isset($dados['limite_pautas_diario'])) ? ($dados['limite_pautas_diario']) : (''); ?>">
								</div>
							</div>

							<div class="mb-3">
								<label for="limite_pautas_semanal">Limites SEMANAIS de Pautas</label>
								<div class="input-group">
									<input type="number" class="form-control" id="limite_pautas_semanal"
										placeholder="Data para exclusão" name="limite_pautas_semanal" required min="1"
										value="<?= (isset($dados['limite_pautas_semanal'])) ? ($dados['limite_pautas_semanal']) : (''); ?>">
								</div>
							</div>

							<div class="mb-3">
								<label for="pauta_dias_antigo">Idade Máxima da Pauta</label>
								<div class="input-group">
									<input type="number" class="form-control" id="pauta_dias_antigo"
										placeholder="Idade Máxima da Pauta" name="pauta_dias_antigo" required min="0"
										value="<?= (isset($dados['pauta_dias_antigo'])) ? ($dados['pauta_dias_antigo']) : (''); ?>">
								</div>
							</div>

							<div class="mb-3">
								<h4>Limites de Escrita</h4>
							</div>

							<div class="mb-3">
								<label for="pauta_tamanho_minimo">Tamanho Mínimo da Pauta</label>
								<div class="input-group">
									<input type="number" class="form-control" id="pauta_tamanho_minimo"
										placeholder="Data para exclusão" name="pauta_tamanho_minimo" required min="1"
										value="<?= (isset($dados['pauta_tamanho_minimo'])) ? ($dados['pauta_tamanho_minimo']) : (''); ?>">
								</div>
							</div>

							<div class="mb-3">
								<label for="pauta_tamanho_maximo">Tamanho Máximo da Pauta</label>
								<div class="input-group">
									<input type="number" class="form-control" id="pauta_tamanho_maximo"
										placeholder="Data para exclusão" name="pauta_tamanho_maximo" required min="1"
										value="<?= (isset($dados['pauta_tamanho_maximo'])) ? ($dados['pauta_tamanho_maximo']) : (''); ?>">
								</div>
							</div>

							<button class="btn btn-primary btn-block mb-3 salvar-config-pautas" type="button">Salvar
								alterações
								das Pautas</button>
						</form>
					</div>
					<div class="tab-pane fade" id="artigos" role="tabpanel" aria-labelledby="artigos-tab">
						<form class="col-12 mt-4" novalidate="yes" method="post" id="artigos_form">

							<div class="mb-3">
								<label for="artigo_visualizacao_narracao">Texto para narração</label> <span class="text-muted">Tags disponíveis: {gancho}, {texto}, {colaboradores}</span>
								<textarea id="artigo_visualizacao_narracao" name="artigo_visualizacao_narracao" class="form-control" rows="5" placeholder="Como mostrar o texto da narração"><?= (isset($dados['artigo_visualizacao_narracao'])) ? ($dados['artigo_visualizacao_narracao']) : (''); ?></textarea>
							</div>

							<div class="mb-3">
								<label for="artigo_tamanho_minimo">Tamanho mínimo permitido do artigo</label>
								<div class="input-group">
									<input type="number" class="form-control" id="artigo_tamanho_minimo"
										placeholder="Quantidade de artigos nos últimos vídeos"
										name="artigo_tamanho_minimo" required min="1"
										value="<?= (isset($dados['artigo_tamanho_minimo'])) ? ($dados['artigo_tamanho_minimo']) : (''); ?>">
								</div>
							</div>
							
							<div class="mb-3">
								<label for="artigo_tamanho_maximo">Tamanho máximo permitido do artigo</label>
								<div class="input-group">
									<input type="number" class="form-control" id="artigo_tamanho_maximo"
										placeholder="Quantidade de artigos nos últimos vídeos"
										name="artigo_tamanho_maximo" required min="1"
										value="<?= (isset($dados['artigo_tamanho_maximo'])) ? ($dados['artigo_tamanho_maximo']) : (''); ?>">
								</div>
							</div>

							<div class="mb-3">
								<label for="artigo_regras_escrever">Regras de Escrita</label> <span class="text-muted">Permitido usar HTML</span>
								<textarea id="artigo_regras_escrever" name="artigo_regras_escrever" class="form-control" rows="10" placeholder="Regras de escrita"><?= (isset($dados['artigo_regras_escrever'])) ? ($dados['artigo_regras_escrever']) : (''); ?></textarea>
							</div>

							<div class="mb-3">
								<label for="artigo_regras_revisar">Regras de Revisão</label> <span class="text-muted">Permitido usar HTML</span>
								<textarea id="artigo_regras_revisar" name="artigo_regras_revisar" class="form-control" rows="10" placeholder="Regras de revisão"><?= (isset($dados['artigo_regras_revisar'])) ? ($dados['artigo_regras_revisar']) : (''); ?></textarea>
							</div>

							<div class="mb-3">
								<label for="artigo_regras_narrar">Regras de Narração</label> <span class="text-muted">Permitido usar HTML</span>
								<textarea id="artigo_regras_narrar" name="artigo_regras_narrar" class="form-control" rows="10" placeholder="Regras de narração"><?= (isset($dados['artigo_regras_narrar'])) ? ($dados['artigo_regras_narrar']) : (''); ?></textarea>
							</div>

							<div class="mb-3">
								<label for="artigo_regras_produzir">Regras de Produção</label> <span class="text-muted">Permitido usar HTML</span>
								<textarea id="artigo_regras_produzir" name="artigo_regras_produzir" class="form-control" rows="10" placeholder="Regras de produção"><?= (isset($dados['artigo_regras_produzir'])) ? ($dados['artigo_regras_produzir']) : (''); ?></textarea>
							</div>

							<div class="mb-3">
								<label for="descricao_padrao_youtube">Descrição do padrão do Youtube na publicação</label> <span class="text-muted">Tags disponíveis: {referencias}, {tags}</span>
								<textarea id="descricao_padrao_youtube" name="descricao_padrao_youtube" class="form-control" rows="10" placeholder="Descrição de publicação no YouTube"><?= (isset($dados['descricao_padrao_youtube'])) ? ($dados['descricao_padrao_youtube']) : (''); ?></textarea>
							</div>

							<button class="btn btn-primary btn-block mb-3 salvar-config-artigos" type="button">Salvar
								alterações das pautas</button>
						</form>

					</div>
					<div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
						<form class="col-12 mt-4" novalidate="yes" method="post" id="home_form">

							<div class="mb-3">
								<label for="home_banner_mostrar">Mostrar Banner</label>
								<select class="custom-select" id="home_banner_mostrar" name="home_banner_mostrar">
									<option value="1" <?= (isset($dados['home_banner_mostrar']) && $dados['home_banner_mostrar'] == '1') ? ('selected') : (''); ?>>Mostrar
									</option>
									<option value="0" <?= (isset($dados['home_banner_mostrar']) && $dados['home_banner_mostrar'] == '0') ? ('selected') : (''); ?>>Esconder
									</option>
								</select>
							</div>

							<div class="mb-3">
								<label for="home_newsletter_mostrar">Mostrar Newsletter</label>
								<select class="custom-select" id="home_newsletter_mostrar"
									name="home_newsletter_mostrar">
									<option value="1" <?= (isset($dados['home_newsletter_mostrar']) && $dados['home_newsletter_mostrar'] == '1') ? ('selected') : (''); ?>>Mostrar
									</option>
									<option value="0" <?= (isset($dados['home_newsletter_mostrar']) && $dados['home_newsletter_mostrar'] == '0') ? ('selected') : (''); ?>>Esconder
									</option>
								</select>
							</div>

							<div class="mb-3">
								<label for="home_talvez_goste_mostrar">Mostrar Talvez Goste</label>
								<select class="custom-select" id="home_talvez_goste_mostrar"
									name="home_talvez_goste_mostrar">
									<option value="1" <?= (isset($dados['home_talvez_goste_mostrar']) && $dados['home_talvez_goste_mostrar'] == '1') ? ('selected') : (''); ?>>Mostrar
									</option>
									<option value="0" <?= (isset($dados['home_talvez_goste_mostrar']) && $dados['home_talvez_goste_mostrar'] == '0') ? ('selected') : (''); ?>>Esconder
									</option>
								</select>
							</div>

							<div class="mb-3">
								<label for="home_ultimos_videos_mostrar">Mostrar Últimos Vídeos</label>
								<select class="custom-select" id="home_ultimos_videos_mostrar"
									name="home_ultimos_videos_mostrar">
									<option value="1" <?= (isset($dados['home_ultimos_videos_mostrar']) && $dados['home_ultimos_videos_mostrar'] == '1') ? ('selected') : (''); ?>>Mostrar
									</option>
									<option value="0" <?= (isset($dados['home_ultimos_videos_mostrar']) && $dados['home_ultimos_videos_mostrar'] == '0') ? ('selected') : (''); ?>>Esconder
									</option>
								</select>
							</div>

							<div class="mb-3">
								<label for="home_banner">Quantidade de artigos no banner</label>
								<div class="input-group">
									<input type="number" class="form-control" id="home_banner"
										placeholder="Quantidade de artigos no banner" name="home_banner" required
										min="1"
										value="<?= (isset($dados['home_banner'])) ? ($dados['home_banner']) : (''); ?>">
								</div>
							</div>

							<div class="mb-3">
								<label for="home_talvez_goste">Quantidade de artigos no Talvez Goste</label>
								<div class="input-group">
									<input type="number" class="form-control" id="home_talvez_goste"
										placeholder="Quantidade de artigos no Talvez Goste" name="home_talvez_goste"
										required min="1"
										value="<?= (isset($dados['home_talvez_goste'])) ? ($dados['home_talvez_goste']) : (''); ?>">
								</div>
							</div>

							<div class="mb-3">
								<label for="home_ultimos_videos">Quantidade de artigos nos últimos vídeos</label>
								<div class="input-group">
									<input type="number" class="form-control" id="home_ultimos_videos"
										placeholder="Quantidade de artigos nos últimos vídeos"
										name="home_ultimos_videos" required min="2" step="2"
										value="<?= (isset($dados['home_ultimos_videos'])) ? ($dados['home_ultimos_videos']) : (''); ?>">
								</div>
							</div>

							<button class="btn btn-primary btn-block mb-3 salvar-config-home" type="button">Salvar
								alterações da home</button>
						</form>

					</div>
					<div class="tab-pane fade" id="gerais" role="tabpanel" aria-labelledby="gerais-tab">
						<form class="col-12 mt-4" novalidate="yes" method="post" id="gerais_form" enctype="multipart/form-data">

							<div class="mb-3">
								<h4>Listagens</h4>
							</div>

							<div class="mb-3">
								<label for="site_quantidade_listagem">Quantidade de itens nas listagens do site</label>
								<div class="input-group">
									<input type="number" class="form-control" id="site_quantidade_listagem"
										placeholder="Quantidade de itens nas listagens do site"
										name="site_quantidade_listagem" required min="1"
										value="<?= (isset($dados['site_quantidade_listagem'])) ? ($dados['site_quantidade_listagem']) : (''); ?>">
								</div>
							</div>

							<div class="mb-3">
								<h4>Rodapé</h4>
							</div>

							<div class="mb-3">
								<label for="link_youtube">Link Youtube</label> <span class="text-muted">Usar <a href="https://codebeautify.org/string-to-json-online" target="_blank">este site</a> para deixar o JSON configurado corretamente.</span>
									<textarea id="link_youtube" name="link_youtube" class="form-control" rows="5" placeholder="Links do Youtube"><?= (isset($dados['link_youtube'])) ? ($dados['link_youtube']) : (''); ?></textarea>
							</div>
							
							<div class="mb-3">
								<label for="link_instagram">Link Instagram</label> <span class="text-muted">Usar <a href="https://codebeautify.org/string-to-json-online" target="_blank">este site</a> para deixar o JSON configurado corretamente.</span>
								<textarea id="link_instagram" name="link_instagram" class="form-control" rows="5" placeholder="Links do Instagram"><?= (isset($dados['link_instagram'])) ? ($dados['link_instagram']) : (''); ?></textarea>
							</div>

							<div class="mb-3">
								<label for="link_twitter">Link Twitter</label> <span class="text-muted">Usar <a href="https://codebeautify.org/string-to-json-online" target="_blank">este site</a> para deixar o JSON configurado corretamente.</span>
								<textarea id="link_twitter" name="link_twitter" class="form-control" rows="5" placeholder="Links do Twitter"><?= (isset($dados['link_twitter'])) ? ($dados['link_twitter']) : (''); ?></textarea>
							</div>

							<div class="mb-3">
								<h4>Nome e Descrição dos Sites</h4>
							</div>
							
							<div class="mb-3">
								<label for="site_nome">Nome</label> <span class="text-muted">Usar <a href="https://codebeautify.org/string-to-json-online" target="_blank">este site</a> para deixar o JSON configurado corretamente.</span>
								<textarea id="site_nome" name="site_nome" class="form-control" rows="5" placeholder="Nome do Site"><?= (isset($dados['site_nome'])) ? ($dados['site_nome']) : (''); ?></textarea>
							</div>

							<div class="mb-3">
								<label for="site_descricao">Descrição</label> <span class="text-muted">Usar <a href="https://codebeautify.org/string-to-json-online" target="_blank">este site</a> para deixar o JSON configurado corretamente.</span>
								<textarea id="site_descricao" name="site_descricao" class="form-control" rows="5" placeholder="Descrição do site"><?= (isset($dados['site_descricao'])) ? ($dados['site_descricao']) : (''); ?></textarea>
							</div>

							<div class="mb-3">
								<h4>E-mails de Contato</h4>
							</div>

							<div class="mb-3">
								<label for="contato_email">E-mail destinatário</label>
								<div class="input-group">
									<input type="text" class="form-control" id="contato_email"
										placeholder="Link do Youtube"
										name="contato_email" required min="1"
										value="<?= (isset($dados['contato_email'])) ? ($dados['contato_email']) : (''); ?>">
								</div>
							</div>

							<div class="mb-3">
								<label for="contato_email_copia">E-mail de cópia</label> <span class="text-muted">Usar vírgulas para adicionar mais de um e-mail.</span>
								<div class="input-group">
									<input type="text" class="form-control" id="contato_email_copia"
										placeholder="Link do Youtube"
										name="contato_email_copia" required min="1"
										value="<?= (isset($dados['contato_email_copia'])) ? ($dados['contato_email_copia']) : (''); ?>">
								</div>
							</div>

							<button class="btn btn-primary btn-block mb-3 salvar-config-gerais" type="button">Salvar
								alterações da home</button>
						</form>
					</div>
					<div class="tab-pane fade" id="estilos" role="tabpanel" aria-labelledby="estilos-tab">
						<form class="col-12 mt-4" novalidate="yes" method="post" id="estilos_form" enctype="multipart/form-data">

							<div class="mb-3">
								<h4>Banner</h4>
							</div>


							<div class="mb-3">
								<label for="banner">Imagem do Banner</label>
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="banner" name="banner" required aria-describedby="image" accept="image/png">
									<label class="custom-file-label" for="banner">Escolha o arquivo do banner...</label>
								</div>
							</div>

							<div class="mb-3">
								<label for="banner">Imagem do Favicon</label>
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="favicon" name="favicon" required aria-describedby="image" accept="image/ico">
									<label class="custom-file-label" for="banner">Escolha o arquivo do favicon...</label>
								</div>
							</div>

							<div class="mb-3">
								<label for="banner">Imagem de Rodapé</label>
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="rodape" name="rodape" required aria-describedby="image" accept="image/png">
									<label class="custom-file-label" for="banner">Escolha o arquivo do rodapé...</label>
								</div>
							</div>
								
							<div class="mb-3">
								<label for="estilos">Folha de estilos</label> <?= (file_exists('public/assets/estilos.css'))?('<a href="'.site_url("public/assets/estilos.css").'" target="_blank" class="text-muted">Clique aqui para ver a folha de estilos atual.</a>'):(''); ?>
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="estilos" name="estilos" required aria-describedby="css" accept="text/css">
									<label class="custom-file-label" for="estilos">Escolha o arquivo de estilo css...</label>
								</div>
							</div>

							<button class="btn btn-primary btn-block mb-3 salvar-config-estilos" type="button">Salvar
								alterações do estilo</button>
						</form>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(".salvar-config-cron").on("click", function () {
		form = new FormData(cron_form);
		submit(form);
	});

	$(".salvar-config-pautas").on("click", function () {
		form = new FormData(pautas_form);
		submit(form);
	});

	$(".salvar-config-home").on("click", function () {
		form = new FormData(home_form);
		submit(form);
	});

	$(".salvar-config-gerais").on("click", function () {
		form = new FormData(gerais_form);
		submit(form);
	});

	$(".salvar-config-artigos").on("click", function () {
		form = new FormData(artigos_form);
		submit(form);
	});

	$(".salvar-config-estilos").on("click", function () {
		form = new FormData(estilos_form);
		submit(form);
	});


	function submit(form) {
		$.ajax({
			url: "<?php echo base_url('colaboradores/admin/administracao'); ?>",
			method: "POST",
			data: form,
			processData: false,
			contentType: false,
			cache: false,
			dataType: "json",
			beforeSend: function () { $('#modal-loading').modal('show'); },
			complete: function () { $('#modal-loading').modal('hide'); },
			success: function (retorno) {
				$('.mensagem').show();
				$('.mensagem').html(retorno.mensagem);
				if (retorno.status) {
					$('.mensagem').removeClass('bg-danger');
					$('.mensagem').addClass('bg-success');
				} else {
					$('.mensagem').addClass('bg-danger');
					$('.mensagem').removeClass('bg-success');
				}
			}
		});
	}
</script>


<?= $this->endSection(); ?>
