<?php

namespace App\Controllers\Colaboradores;

use App\Controllers\BaseController;

use App\Libraries\VerificaPermissao;
use CodeIgniter\I18n\Time;

class Admin extends BaseController
{
	public $verificaPermissao;
	function __construct()
	{
		$this->verificaPermissao = new verificaPermissao();
		helper('url_friendly,data');
	}

	public function dashboard()
	{
		return redirect()->to(base_url() . 'colaboradores/admin/administracao');
	}

	public function configuracoes()
	{
		$this->verificaPermissao->PermiteAcesso('7');
		$configuracaoModel = new \App\Models\ConfiguracaoModel();
		
		$configuracoes = $configuracaoModel->findAll();
		$configuracao = array();
		$data = array();
		foreach ($configuracoes as $conf) {
			$configuracao[$conf['config']] = $conf['config_valor'];
		}
		$data['dados'] = $configuracao;
		return view('colaboradores/administracao_configuracoes', $data);
	}

	public function administracao()
	{
		$this->verificaPermissao->PermiteAcesso('7');
		$configuracaoModel = new \App\Models\ConfiguracaoModel();
		$retorno = new \App\Libraries\RetornoPadrao();

		if ($this->request->isAJAX()) {
			$post = $this->request->getPost();

			if (!empty($this->request->getFiles()) && ($this->request->getFiles()['banner']->getSizeByUnit('kb') > 0 || $this->request->getFiles()['estilos']->getSizeByUnit('kb') > 0 || $this->request->getFiles()['rodape']->getSizeByUnit('kb') > 0 || $this->request->getFiles()['favicon']->getSizeByUnit('kb') > 0)) {
				$validaFormularios = new \App\Libraries\ValidaFormularios();

				$valida = $validaFormularios->validaFormularioAdministracaoGerais();
				if (empty($valida->getErrors())) {
					if ($this->request->getFiles()['banner']->getSizeByUnit('kb') > 0) {
						$file = $this->request->getFiles()['banner'];
						$nome_arquivo = 'banner.png';
						if (!$file->move('public/assets', $nome_arquivo, true)) {
							return $retorno->retorno(false, 'Erro ao subir o arquivo.', true);
						}
					}
					if ($this->request->getFiles()['estilos']->getSizeByUnit('kb') > 0) {
						$file = $this->request->getFiles()['estilos'];
						$nome_arquivo = 'estilos.css';
						if (!$file->move('public/assets', $nome_arquivo, true)) {
							return $retorno->retorno(false, 'Erro ao subir o arquivo.', true);
						}
					}
					if ($this->request->getFiles()['rodape']->getSizeByUnit('kb') > 0) {
						$file = $this->request->getFiles()['rodape'];
						$nome_arquivo = 'rodape.png';
						if (!$file->move('public/assets', $nome_arquivo, true)) {
							return $retorno->retorno(false, 'Erro ao subir o arquivo.', true);
						}
					}
					if ($this->request->getFiles()['favicon']->getSizeByUnit('kb') > 0) {
						$file = $this->request->getFiles()['favicon'];
						$nome_arquivo = 'favicon.ico';
						if (!$file->move('public/assets', $nome_arquivo, true)) {
							return $retorno->retorno(false, 'Erro ao subir o arquivo.', true);
						}
					}

				} else {
					return $retorno->retorno(false, $retorno->montaStringErro($valida->getErrors()), true);
				}
			}

			foreach ($post as $indice => $dado) {
				$gravar = array();
				if ($indice == 'cron_pautas_data_delete_number' || $indice == 'cron_pautas_data_delete_time') {
					$indice = 'cron_pautas_data_delete';
					$gravar[$indice] = $post['cron_pautas_data_delete_number'] . ' ' . $post['cron_pautas_data_delete_time'];
				} elseif ($indice == 'cron_artigos_teoria_desmarcar_data_revisao_number' || $indice == 'cron_artigos_teoria_desmarcar_data_revisao_number') {
					$indice = 'cron_artigos_teoria_desmarcar_data_revisao';
					$gravar[$indice] = $post['cron_artigos_teoria_desmarcar_data_revisao_number'] . ' ' . $post['cron_artigos_teoria_desmarcar_data_revisao_time'];
				} elseif ($indice == 'cron_artigos_teoria_desmarcar_data_narracao_number' || $indice == 'cron_artigos_teoria_desmarcar_data_narracao_time') {
					$indice = 'cron_artigos_teoria_desmarcar_data_narracao';
					$gravar[$indice] = $post['cron_artigos_teoria_desmarcar_data_narracao_number'] . ' ' . $post['cron_artigos_teoria_desmarcar_data_narracao_time'];
				} elseif ($indice == 'cron_artigos_teoria_desmarcar_data_producao_number' || $indice == 'cron_artigos_teoria_desmarcar_data_producao_time') {
					$indice = 'cron_artigos_teoria_desmarcar_data_producao';
					$gravar[$indice] = $post['cron_artigos_teoria_desmarcar_data_producao_number'] . ' ' . $post['cron_artigos_teoria_desmarcar_data_producao_time'];
				} elseif ($indice == 'cron_artigos_noticia_desmarcar_data_revisao_number' || $indice == 'cron_artigos_noticia_desmarcar_data_revisao_number') {
					$indice = 'cron_artigos_noticia_desmarcar_data_revisao';
					$gravar[$indice] = $post['cron_artigos_noticia_desmarcar_data_revisao_number'] . ' ' . $post['cron_artigos_noticia_desmarcar_data_revisao_time'];
				} elseif ($indice == 'cron_artigos_noticia_desmarcar_data_narracao_number' || $indice == 'cron_artigos_noticia_desmarcar_data_narracao_time') {
					$indice = 'cron_artigos_noticia_desmarcar_data_narracao';
					$gravar[$indice] = $post['cron_artigos_noticia_desmarcar_data_narracao_number'] . ' ' . $post['cron_artigos_noticia_desmarcar_data_narracao_time'];
				} elseif ($indice == 'cron_artigos_noticia_desmarcar_data_producao_number' || $indice == 'cron_artigos_noticia_desmarcar_data_producao_time') {
					$indice = 'cron_artigos_noticia_desmarcar_data_producao';
					$gravar[$indice] = $post['cron_artigos_noticia_desmarcar_data_producao_number'] . ' ' . $post['cron_artigos_noticia_desmarcar_data_producao_time'];
				} elseif ($indice == 'cron_notificacoes_data_visualizado_number' || $indice == 'cron_notificacoes_data_visualizado_time') {
					$indice = 'cron_notificacoes_data_visualizado';
					$gravar[$indice] = $post['cron_notificacoes_data_visualizado_number'] . ' ' . $post['cron_notificacoes_data_visualizado_time'];
				} elseif ($indice == 'cron_notificacoes_data_cadastrado_number' || $indice == 'cron_notificacoes_data_cadastrado_time') {
					$indice = 'cron_notificacoes_data_cadastrado';
					$gravar[$indice] = $post['cron_notificacoes_data_cadastrado_number'] . ' ' . $post['cron_notificacoes_data_cadastrado_time'];
				} elseif ($indice == 'cron_email_carteira_data_number' || $indice == 'cron_email_carteira_data_time') {
					$indice = 'cron_email_carteira_data';
					$gravar[$indice] = $post['cron_email_carteira_data_number'] . ' ' . $post['cron_email_carteira_data_time'];
				} elseif ($indice == 'cron_artigos_descartar_data_number' || $indice == 'cron_artigos_descartar_data_time') {
					$indice = 'cron_artigos_descartar_data';
					$gravar[$indice] = $post['cron_artigos_descartar_data_number'] . ' ' . $post['cron_artigos_descartar_data_time'];
				} else {
					$gravar[$indice] = $dado;
				}
				if (!$configuracaoModel->update($indice, array('config_valor' => $gravar[$indice]))) {
					return $retorno->retorno(false, 'Erro ao atualizar as configurações.', true);
				}
			}
			return $retorno->retorno(true, 'Atualização feita com sucesso.', true);
		}





		$configuracoes = $configuracaoModel->findAll();
		$configuracao = array();
		$data = array();
		foreach ($configuracoes as $conf) {
			$configuracao[$conf['config']] = $conf['config_valor'];
		}
		$data['dados'] = $configuracao;
		return view('colaboradores/administracao_detail', $data);
	}

	public function permissoes($idColaboradores = NULL)
	{
		$this->verificaPermissao->PermiteAcesso('9');
		$colaboradoresModel = new \App\Models\ColaboradoresModel();
		$atribuicoesModel = new \App\Models\AtribuicoesModel();
		$colaboradoresAtribuicoesModel = new \App\Models\ColaboradoresAtribuicoesModel();
		$retorno = new \App\Libraries\RetornoPadrao();
		$data['atribuicoes'] = $atribuicoesModel->findall();

		if ($idColaboradores != NULL) {
			$colaboradores_atribuicoes = $colaboradoresAtribuicoesModel->getAtribuicoesColaborador($idColaboradores);
			$data['colaboradores_atribuicoes'] = array();
			if ($colaboradores_atribuicoes != NULL && !empty($colaboradores_atribuicoes)) {
				foreach ($colaboradores_atribuicoes as $ca) {
					$data['colaboradores_atribuicoes'][] = $ca['atribuicoes_id'];
				}
			}
			$data['colaboradores'] = $colaboradoresModel->find($idColaboradores);
			$data['titulo'] = 'Cadastro do Colaborador';
			return view('colaboradores/permissoes_form', $data);
		}

		if ($this->request->getMethod() == 'post') {
			$post = service('request')->getPost();
			if (isset($post['atribuicoes']) && isset($post['colaborador_id'])) {
				$colaboradoresAtribuicoesModel->db->transStart();
				$colaboradoresAtribuicoesModel->deletarAtribuicoesColaborador($post['colaborador_id']);
				$colaboradoresAtribuicoesModel->db->transComplete();
				foreach ($post['atribuicoes'] as $atribuicao) {
					$colaboradoresAtribuicoesModel->db->transStart();
					$colaboradoresAtribuicoesModel->insert(array('colaboradores_id' => $post['colaborador_id'], 'atribuicoes_id' => $atribuicao));
					$colaboradoresAtribuicoesModel->db->transComplete();
				}
				return $retorno->retorno(true, 'Permissões do colaborador salvas.', true);
			}
			return $retorno->retorno(false, 'Ocorreu um erro na hora de salvar as permissões do usuário', true);
		}

		$data['titulo'] = 'Permissões - Colaboradores';

		return view('colaboradores/permissoes_list', $data);
	}

	public function permissoesList()
	{

		$configuracaoModel = new \App\Models\ConfiguracaoModel();
		$config = array();
		$config['site_quantidade_listagem'] = (int) $configuracaoModel->find('site_quantidade_listagem')['config_valor'];

		$this->verificaPermissao->PermiteAcesso('9');
		$colaboradoresModel = new \App\Models\ColaboradoresModel();
		if ($this->request->getMethod() == 'get') {
			$get = service('request')->getGet();
			$colaboradores = $colaboradoresModel->getTodosColaboradores($get['apelido'], $get['email'], $get['atribuicao'], $get['status']);
			$data['colaboradoresList'] = [
				'colaboradores' => $colaboradores->paginate($config['site_quantidade_listagem'], 'colaboradores'),
				'pager' => $colaboradores->pager
			];
		}
		return view('template/templatePermissoesList', $data);
	}

	public function historico()
	{
		$this->verificaPermissao->PermiteAcesso('9');

		$configuracaoModel = new \App\Models\ConfiguracaoModel();
		$config = array();
		$config['site_quantidade_listagem'] = (int) $configuracaoModel->find('site_quantidade_listagem')['config_valor'];

		$colaboradoresHistoricosModel = new \App\Models\ColaboradoresHistoricosModel();
		if ($this->request->getMethod() == 'get') {
			$get = service('request')->getGet();
			$colaboradoresHistoricos = $colaboradoresHistoricosModel->where('colaboradores_id', $get['apelido'])->orderBy('criado', 'DESC');
			$data['colaboradoresHistoricosList'] = [
				'colaboradoresHistoricos' => $colaboradoresHistoricos->paginate($config['site_quantidade_listagem'], 'historico'),
				'pager' => $colaboradoresHistoricos->pager
			];
		}
		return view('template/templateHistoricosList', $data);
	}

	public function financeiro($acao = null)
	{
		$pagamentosModel = new \App\Models\PagamentosModel();
		$data = array();

		$verifica = new verificaPermissao();
		$verifica->PermiteAcesso('8');

		if ($acao == 'pagar') {
			$data['titulo'] = 'Pagar artigos publicados';
			return view('colaboradores/pagamentos_form', $data);
		}

		if ($acao == 'preview') {
			if ($this->request->getMethod() == 'post') {
				$post = service('request')->getPost();
				$data = array();
				$data = $this->geraPreviewPagamento($post);
				return view('template/templatePagamentosArtigosList', $data);
			}
		}

		if ($acao == 'salvar') {
			if ($this->request->getMethod() == 'post') {
				$post = service('request')->getPost();
				$data = array();
				$validaFormularios = new \App\Libraries\ValidaFormularios();
				$retorno = new \App\Libraries\RetornoPadrao();
				$valida = $validaFormularios->validaFormularioCadastroPagamento($post);
				if (empty($valida->getErrors())) {
					$data = $this->salvaPagamento($post);
					if ($data) {
						return $retorno->retorno(true, 'Pagamento Salvo', true);
					} else {
						return $retorno->retorno(false, 'Ocorreu um erro ao gravar o Pagamento', true);
					}
				} else {
					$erros = $valida->getErrors();
					$string_erros = '';
					foreach ($erros as $erro) {
						$string_erros .= $erro . "<br/>";
					}
					return $retorno->retorno(false, $string_erros, true);
				}
			}
		}

		if ($acao == 'detalhe') {
			if ($this->request->getMethod() == 'post') {
				$post = service('request')->getPost();
				$data = array();
				$data = $this->geraPreviewPagamento($post);
				return view('template/templatePagamentosArtigosList', $data);
			}
		}


		if ($acao !== NULL) {
			$data['titulo'] = 'Pagar artigos publicados';
			$pagamentosModel = new \App\Models\PagamentosModel();
			$data['pagamentos'] = $pagamentosModel->find($acao);
			return view('colaboradores/pagamentos_form', $data);
		} else {
			$data['titulo'] = 'Pagamentos realizados';
			$pagamentosModel = new \App\Models\PagamentosModel();
			$pagamentos = $pagamentosModel->getPagamentos();

			$configuracaoModel = new \App\Models\ConfiguracaoModel();
			$config = array();
			$config['site_quantidade_listagem'] = (int) $configuracaoModel->find('site_quantidade_listagem')['config_valor'];
			$data['pagamentosList'] = [
				'pagamentos' => $pagamentos->paginate($config['site_quantidade_listagem'], 'pagamentos'),
				'pager' => $pagamentos->pager
			];
			return view('colaboradores/pagamentos_list', $data);
		}
	}

	private function geraPreviewPagamento($post)
	{
		$verifica = new verificaPermissao();
		$verifica->PermiteAcesso('8');

		$data = array();
		$pagamentos_id = NULL;

		if (isset($post['pagamento_id'])) {
			$pagamentosModel = new \App\Models\PagamentosModel();
			$pagamentos_id = $post['pagamento_id'];
			$post = $pagamentosModel->find($pagamentos_id);
		}

		$multiplicadores = array();
		$multiplicadores['escrito'] = (float) $post['multiplicador_escrito'] / 100;
		$multiplicadores['revisado'] = (float) $post['multiplicador_revisado'] / 100;
		$multiplicadores['narrado'] = (float) $post['multiplicador_narrado'] / 100;
		$multiplicadores['produzido'] = (float) $post['multiplicador_produzido'] / 100;
		$multiplicadores['escrito_noticia'] = (float) $post['multiplicador_escrito_noticia'] / 100;
		$multiplicadores['revisado_noticia'] = (float) $post['multiplicador_revisado_noticia'] / 100;
		$multiplicadores['narrado_noticia'] = (float) $post['multiplicador_narrado_noticia'] / 100;
		$multiplicadores['produzido_noticia'] = (float) $post['multiplicador_produzido_noticia'] / 100;
		$repasse_bitcoin = (float) str_replace(",", ".", $post['quantidade_bitcoin']);

		$artigosModel = new \App\Models\ArtigosModel();
		$colaboradoresModel = new \App\Models\ColaboradoresModel();

		if ($pagamentos_id !== null) {
			$pagamentosArtigosModel = new \App\Models\PagamentosArtigosModel();
			$pagamentosArtigos = $pagamentosArtigosModel->where('pagamentos_id', $pagamentos_id)->get()->getResultArray();
			$artigos_id = array();
			foreach ($pagamentosArtigos as $pa) {
				$artigos_id[] = $pa['artigos_id'];
			}
			$data['artigos'] = $artigosModel->getArtigos($artigos_id)->get()->getResultArray();
			$data['pagamentos_id'] = $pagamentos_id;

		} else {
			$data['artigos'] = $artigosModel->getArtigos('6')->get()->getResultArray();
		}
		if ($data['artigos'] == NULL || empty($data['artigos'])) {
			$data['artigos'] = NULL;
			$data['usuarios'] = NULL;
			return $data;
		}

		$usuarios = array();
		$usuarios_id = array();
		$pontos_totais = 0;
		$repasse_string = "";
		$dados = [
			'endereco' => null,
			'apelido' => null,
			'pontos_escrita' => 0,
			'pontos_revisao' => 0,
			'pontos_narracao' => 0,
			'pontos_producao' => 0,
			'pontos_total' => 0,
			'repasse' => 0,
		];
		foreach ($data['artigos'] as $i => $artigo) {
			$usuarios_id[] = $artigo['escrito_colaboradores_id'];
			$usuarios_id[] = $artigo['revisado_colaboradores_id'];
			$usuarios_id[] = $artigo['narrado_colaboradores_id'];
			$usuarios_id[] = $artigo['produzido_colaboradores_id'];
			$data['artigos'][$i]['total_pontuacao'] = (float) $artigo['palavras_escritor'] * $multiplicadores['escrito'] + $artigo['palavras_revisor'] * $multiplicadores['revisado'] + $artigo['palavras_narrador'] * $multiplicadores['narrado'] + $artigo['palavras_produtor'] * $multiplicadores['produzido'];
		}
		$usuarios_id = array_unique($usuarios_id);
		$usuarios_dados = $colaboradoresModel->find($usuarios_id);
		foreach ($usuarios_dados as $usuario) {
			$usuarios[$usuario['id']] = $dados;
			$usuarios[$usuario['id']]['endereco'] = $usuario['carteira'];
			$usuarios[$usuario['id']]['apelido'] = $usuario['apelido'];
		}

		foreach ($data['artigos'] as $artigo) {
			if ($artigo['tipo_artigo'] == 'N') {
				$usuarios[$artigo['escrito_colaboradores_id']]['pontos_escrita'] += (float) $artigo['palavras_escritor'] * $multiplicadores['escrito_noticia'];
				$usuarios[$artigo['revisado_colaboradores_id']]['pontos_revisao'] += (float) $artigo['palavras_revisor'] * $multiplicadores['revisado_noticia'];
				$usuarios[$artigo['narrado_colaboradores_id']]['pontos_narracao'] += (float) $artigo['palavras_narrador'] * $multiplicadores['narrado_noticia'];
				$usuarios[$artigo['produzido_colaboradores_id']]['pontos_producao'] += (float) $artigo['palavras_produtor'] * $multiplicadores['produzido_noticia'];
			}
			if ($artigo['tipo_artigo'] == 'T') {
				$usuarios[$artigo['escrito_colaboradores_id']]['pontos_escrita'] += (float) $artigo['palavras_escritor'] * $multiplicadores['escrito'];
				$usuarios[$artigo['revisado_colaboradores_id']]['pontos_revisao'] += (float) $artigo['palavras_revisor'] * $multiplicadores['revisado'];
				$usuarios[$artigo['narrado_colaboradores_id']]['pontos_narracao'] += (float) $artigo['palavras_narrador'] * $multiplicadores['narrado'];
				$usuarios[$artigo['produzido_colaboradores_id']]['pontos_producao'] += (float) $artigo['palavras_produtor'] * $multiplicadores['produzido'];
			}

		}

		foreach ($usuarios as $i => $u) {
			if ($u['endereco'] != NULL) {
				$usuarios[$i]['pontos_total'] = $u['pontos_escrita'] + $u['pontos_revisao'] + $u['pontos_narracao'] + $u['pontos_producao'];
				$pontos_totais += $usuarios[$i]['pontos_total'];
			}
		}

		foreach ($usuarios as $i => $u) {
			if ($u['endereco'] != NULL) {
				$usuarios[$i]['repasse'] = $repasse_bitcoin * ($usuarios[$i]['pontos_total'] / $pontos_totais);
				$repasse_string .= $usuarios[$i]['endereco'] . ' ' . number_format($usuarios[$i]['repasse'], 8, ',', '.') . "\n";
			}
		}
		$data['repasse_string'] = $repasse_string;
		$data['usuarios'] = $usuarios;
		return $data;
	}

	private function salvaPagamento($post)
	{
		$verifica = new verificaPermissao();
		$verifica->PermiteAcesso('8');

		$data = array();
		$artigosModel = new \App\Models\ArtigosModel();
		$pagamentosModel = new \App\Models\PagamentosModel();
		$pagamentosArtigosModel = new \App\Models\PagamentosArtigosModel();
		$colaboradoresModel = new \App\Models\ColaboradoresModel();
		$faseProducaoModel = new \App\Models\FaseProducaoModel();

		$artigos = $artigosModel->getArtigos('6')->get()->getResultArray();
		if ($artigos == null || empty($artigos)) {
			return false;
		}

		$gravar = array();
		$gravar['titulo'] = ($post['titulo'] == '') ? ('Pagamento do mês ' . Time::now()->toLocalizedString('MMMM yyyy')) : ($post['titulo']);
		$gravar['quantidade_bitcoin'] = $post['quantidade_bitcoin'];
		$gravar['multiplicador_escrito'] = $post['multiplicador_escrito'];
		$gravar['multiplicador_revisado'] = $post['multiplicador_revisado'];
		$gravar['multiplicador_narrado'] = $post['multiplicador_narrado'];
		$gravar['multiplicador_produzido'] = $post['multiplicador_produzido'];
		$gravar['multiplicador_escrito_noticia'] = $post['multiplicador_escrito_noticia'];
		$gravar['multiplicador_revisado_noticia'] = $post['multiplicador_revisado_noticia'];
		$gravar['multiplicador_narrado_noticia'] = $post['multiplicador_narrado_noticia'];
		$gravar['multiplicador_produzido_noticia'] = $post['multiplicador_produzido_noticia'];

		$gravar['hash_transacao'] = $post['hash_transacao'];
		//$pagamentosModel->db->transStart();
		$idPagamentos = $pagamentosModel->insert($gravar);
		//$pagamentosModel->db->transComplete();

		$faseProducao = $faseProducaoModel->find(6);
		$faseProducao = $faseProducao['etapa_posterior'];
		$pontuacaoTotalPagamento = 0;
		foreach ($artigos as $artigo) {

			$pagamentosArtigosModel->save(
				array(
					'artigos_id' => $artigo['id'],
					'pagamentos_id' => $idPagamentos
				)
			);

			$colaborador = $colaboradoresModel->find($artigo['escrito_colaboradores_id']);
			$colaborador['pontuacao_total'] = $colaborador['pontuacao_total'] + $artigo['palavras_escritor'];
			if ($colaborador['carteira'] != NULL) {
				if ($artigo['tipo_artigo'] == 'T') {
					$pontos = $gravar['multiplicador_escrito'] * $artigo['palavras_escritor'] / 100;
				}
				if ($artigo['tipo_artigo'] == 'N') {
					$pontos = $gravar['multiplicador_escrito_noticia'] * $artigo['palavras_escritor'] / 100;
				}
				$pontuacaoTotalPagamento += $pontos;
			}
			$colaboradoresModel->save($colaborador);

			$colaborador = $colaboradoresModel->find($artigo['revisado_colaboradores_id']);
			$colaborador['pontuacao_total'] = $colaborador['pontuacao_total'] + $artigo['palavras_revisor'];
			if ($colaborador['carteira'] != NULL) {
				if ($artigo['tipo_artigo'] == 'T') {
					$pontos = $gravar['multiplicador_revisado'] * $artigo['palavras_revisor'] / 100;
				}
				if ($artigo['tipo_artigo'] == 'N') {
					$pontos = $gravar['multiplicador_revisado_noticia'] * $artigo['palavras_escritor'] / 100;
				}
				$pontuacaoTotalPagamento += $pontos;
			}
			$colaboradoresModel->save($colaborador);

			$colaborador = $colaboradoresModel->find($artigo['narrado_colaboradores_id']);
			$colaborador['pontuacao_total'] = $colaborador['pontuacao_total'] + $artigo['palavras_narrador'];
			if ($colaborador['carteira'] != NULL) {
				if ($artigo['tipo_artigo'] == 'T') {
					$pontos = $gravar['multiplicador_narrado'] * $artigo['palavras_narrador'] / 100;
				}
				if ($artigo['tipo_artigo'] == 'N') {
					$pontos = $gravar['multiplicador_narrado_noticia'] * $artigo['palavras_escritor'] / 100;
				}
				$pontuacaoTotalPagamento += $pontos;
			}
			$colaboradoresModel->save($colaborador);

			$colaborador = $colaboradoresModel->find($artigo['produzido_colaboradores_id']);
			$colaborador['pontuacao_total'] = $colaborador['pontuacao_total'] + $artigo['palavras_produtor'];
			if ($colaborador['carteira'] != NULL) {
				if ($artigo['tipo_artigo'] == 'T') {
					$pontos = $gravar['multiplicador_produzido'] * $artigo['palavras_produtor'] / 100;
				}
				if ($artigo['tipo_artigo'] == 'N') {
					$pontos = $gravar['multiplicador_produzido_noticia'] * $artigo['palavras_escritor'] / 100;
				}

				$pontuacaoTotalPagamento += $pontos;
			}
			$colaboradoresModel->save($colaborador);

			$art = array();
			$art['atualizado'] = $artigosModel->getNow();
			$art['fase_producao_id'] = $faseProducao;
			$artigosModel->update($artigo['id'], $art);
		}
		$pagamentosModel->update($idPagamentos, array('pontuacao_total' => $pontuacaoTotalPagamento));
		return true;
	}
}
