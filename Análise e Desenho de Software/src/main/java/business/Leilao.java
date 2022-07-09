package business;

/**
 * <p>Leilao class.</p>
 *
 * @author Grupo12: MadalenaRodrigues_55853, PedroAlmeida_56897, RomuloNogueira_56935
 * @version $Id: $Id
 */

import java.util.Date;
import java.text.ParseException;
import java.text.SimpleDateFormat;

/**
 * Classe que gere um leilao
 *
 */
public class Leilao {
	
	private User user;
	private TipoDeLeilao spec;
	private Date dataFim;
	private int precoBase;
	private StatusDoLeilao statusLeilao; 
	private Licitacao licitacaoAtual;
	private User vencedor;
	private Artigo artigo;
	
	/**
	 * Construtor de um leilao
	 *
	 * @param spec O tipo de leilao que se trata
	 * @param user O vendedor que esta a organizar o leilao
	 * @param art  O artigo a ser leiloado
	 */
	public Leilao(String spec, User user, Artigo art) {
		
		if (spec.toLowerCase().equals("normal")) {
			this.spec = TipoDeLeilao.Normal;
			
		}else if(spec.toLowerCase().equals("invertido")) {
			this.spec = TipoDeLeilao.Invertido;
			
		}else if(spec.toLowerCase().equals("cego")) {
			this.spec = TipoDeLeilao.Cego;
		}
		this.user = user;
		this.statusLeilao = StatusDoLeilao.Criado;
		this.artigo = art;
	}
	
	
	/**
	 * Os seguintes metodos sao getters e servem para obter 
	 * informacao relativa ao leilao
	 */
	
	
	/**
	 * Metodo para obter o utilizador responsavel pelo leilao
	 *
	 * @return utilizador responsavel pelo leilao
	 */
	public User obtemUser() { return this.user; }
	
	
	/**
	 * Metodo para obter o tipo do leilao
	 *
	 * @return o tipo do leilao
	 */
	public TipoDeLeilao obtemSpec() { return this.spec; }
	
	
	/**
	 * Metodo para obter a data de fecho do leilao
	 *
	 * @return a data de fecho do leilao
	 */
	public Date obtemDataFim() { return this.dataFim; }
	
	
	/**
	 * Metodo para obter o preço base do leilao
	 *
	 * @return o preço base do leilao
	 */
	public int obtemPrecoBase() { return this.precoBase; }
	
	
	/**
	 * Metodo para obter o estado do leilao
	 *
	 * @return o estado atual do leilao
	 */
	public StatusDoLeilao obtemStatusLeilao() { return this.statusLeilao; }
	
	
	/**
	 * Metodo para obter a ultima licitacao feita no leilao
	 *
	 * @return a ultima licitacao feita no leilao
	 */
	public Licitacao obtemUltimaLicitacao() { return this.licitacaoAtual; }
	
	
	/**
	 * Metodo para obter o artigo que esta' a ser leiloado
	 *
	 * @return o artigo que esta' a ser leiloado
	 */
	public Artigo obtemArtigo() { return this.artigo; }
	
	
	/**
	 * Configura o leilao atribuindo-lhe uma data para
	 * terminar e um preco base para iniciar as licitacoes
	 *
	 * @param dataFim   Data em que termina o leilão
	 * 					Deve seguir o formato: dia/mes/ano hora:minutos:segundos
	 * @param precoBase Preco onde se iniciao as licitacoes
	 */
	public void configura(String dataFim, int precoBase) { 
		
		SimpleDateFormat dateParser = new SimpleDateFormat("dd/MM/yyyy HH:mm:ss");
		try {
			this.dataFim = dateParser.parse(dataFim);
			
		} catch (ParseException e) {
			e.printStackTrace();
		}
		
		this.precoBase = precoBase;
		this.statusLeilao = StatusDoLeilao.Configurado;
	}
	
	
	/**
	 * Publica o leilao, alterando o seu estado para "A decorrer"
	 */
	public void publica() {
		
		this.statusLeilao = StatusDoLeilao.Decorrer;
	}
	
	
	/**
	 * Verifica se uma licitacao l e' valida
	 *
	 * @param l   licitacao que se pretende validar
	 * @return    True se for valida, False se nao for
	 */
	public boolean validaLicitacao(Licitacao l) {

		if (this.user.validaVendedor()) {
			
			if (l.obtemTimestamp().before(this.dataFim) && l.obtemQuantia() > this.precoBase) {
				
				if (this.licitacaoAtual != null) {
					if (l.obtemQuantia() > this.licitacaoAtual.obtemQuantia()) {
						return true;
					}else {
						System.out.println("A licitação não foi efetuada, pois existe uma maior");
						return false;
					}
				}else {
					return true;
				}
				
			}else {
				if (l.obtemQuantia() <= this.precoBase) {
					System.out.println("A licitação não foi efetuada, pois a sua licitação foi menor ou igual ao preço base do leilão");
					return false;
				}else {
					System.out.println("A licitação não foi efetuada, pois o leilão já terminou");
					this.fechar();
					return false;
				}
			}
		}
		System.out.println("A licitação não foi efetuada, pois o Vendedor está com uma má reputação");
		this.fechar();
		return false;
	}
	
	
	/**
	 * Concretiza a licitacao
	 *
	 * @param l   licitacao a concretizar
	 */
	public void concretizaLicitacao(Licitacao l) {
		
		this.licitacaoAtual = l;
	}
	
	
	/**
	 * Metodo encarregue por fechar corretamente o leilao
	 * verificando a reputacao do vendedor antes de o fazer
	 * para poder encerra-lo ou invalida-lo.
	 */
	public void fechar() {
		
		if (this.user.validaVendedor()) {
			System.out.println("O leilão foi encerrado com sucesso!");
			this.statusLeilao = StatusDoLeilao.Terminado;
			if (this.licitacaoAtual != null) {
				this.vencedor = this.licitacaoAtual.obtemUser();
				System.out.println("O vencedor do leilão foi: \n" + this.vencedor.toString());
				System.out.println("Com a licitação final num valor de: " + this.licitacaoAtual.obtemQuantia());
			}else {
				System.out.println("Não houve vencedor...");
			}
			
		}else {
			this.statusLeilao = StatusDoLeilao.Inválido;
			System.out.println("O leilão encontra-se invalidado devido à má reputação do vendedor. E por isso não é apurado um vencedor");
		}
		
	}
	
	
	/**
	 * Metodo que arquiva o leilao
	 */
	public void arquivar() { this.statusLeilao = StatusDoLeilao.Arquivado; }
	
	
	/**
	 * Metodo que retorna o vencedor do leilao
	 *
	 * @return   User vencedor do leilao
	 */
	public User getVencedor() { return vencedor; }
	
	
	/**
	 * Devolve uma representaçao textual do leilao
	 *
	 * @return Informacao sobre o leilao
	 */
	public String toString() {
		
		StringBuilder s = new StringBuilder();
		s.append("Nome do vendedor: " + this.user.obtemNome() + "\n");
		s.append("Tipo de leilão: " + this.spec.name() + "\n");
		s.append("Status do leilão: " + this.statusLeilao.name() + "\n");
		s.append("Artigo a ser leiloado: " + this.artigo.obtemDescricao()+ "\n");
		if (this.statusLeilao.equals(StatusDoLeilao.Inválido)){
			s.append("Este leilão já não é válido devido à má reputação do vendedor.");
		}else {
			if (dataFim == null) {
				s.append("Fim do leilão: Não definido. \n");	
			}else {
				SimpleDateFormat dateFormatter = new SimpleDateFormat("dd/MM/yyyy HH:mm:ss");
				s.append("Fim do leilão: " + dateFormatter.format(this.dataFim) + "\n");	
			}
			s.append("Preço base: " + this.precoBase + "\n");
			if (this.licitacaoAtual != null && this.vencedor == null) {
				s.append("Licitação atual: \n" + this.licitacaoAtual.toString());
			}else if (this.vencedor != null){
				s.append("O vencedor do leilão foi: \n" + this.vencedor.toString());
				s.append("Licitação final: " + this.licitacaoAtual.obtemQuantia());
			}else {
				s.append("Licitação atual: Ainda não houveram licitações");
			}
		}
		return s.toString();
	}
	
}