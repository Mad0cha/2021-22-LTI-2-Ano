package business;

/**
 * <p>Teste de licitacoes.</p>
 *
 * @author Grupo12: MadalenaRodrigues_55853, PedroAlmeida_56897, RomuloNogueira_56935
 * @version $Id: $Id
 */

import static org.junit.Assert.*;

import org.junit.Before;
import org.junit.Test;

/**
 * Classe que testa as licitacoes num leilao
 */
public class LicitarLeilaoTest {

	private User user1;
	private User user2;
	private User user3;
	private int idLeilao;
	
	/**
	 * Cria os utilizadores; cria o artigo e o leiao
	 * Adiciona a reputacao ao vendedor
	 * Configura e publica o leilao
	 */
	@Before
	public void setUpBefore() {
		
		this.user1 = new User ("Vendedor");
		this.user2 = new User ("Comprador 1");
		this.user3 = new User ("Comprador 2");
		
		user1.adicionaReputacao(Reputacao.SUFICIENTE);
		
		// Criar o artigo e o respetivo leilao
		int idArtigo = user1.criarArtigo("mala de viagem");
		this.idLeilao = user1.criarLeilao("normal", idArtigo);
		user1.configurarLeilao(idLeilao, "31/07/2022 23:59:59", 10);
		user1.publicaLeilao(idLeilao);
	}

	
	/**
	 * Testa uma licitacao cujo valor e' menor que 
	 * o preco base do leilao
	 */
	@Test
	public void test_LicitacaoMenorBase() {
		
		Leilao leilao = user2.obtemLeilao(idLeilao);
		
		user2.licitarLeilao(idLeilao, 5);
		assertFalse(5 >= leilao.obtemPrecoBase());
	}
	
	
	/**
	 * Testa uma licitacao cujo valor e'
	 * superior ao atual e por isso e' valida
	 */
	@Test
	public void test_LicitcaoCorreta() {
		
		Leilao leilao = user2.obtemLeilao(idLeilao);
		
		user2.licitarLeilao(idLeilao, 15);
		int valorLicitacao = leilao.obtemUltimaLicitacao().obtemQuantia();
		assertEquals(15, valorLicitacao);
	}
	
	
	/**
	 * Testa uma licitacao cujo valor e' menor que 
	 * o valor de licitacao atual
	 */
	@Test
	public void test_LicitcaoBaixa() {
		
		Leilao leilao = user3.obtemLeilao(idLeilao);
		
		user2.licitarLeilao(idLeilao, 15); // Licita este primeiro
		user3.licitarLeilao(idLeilao, 12); // Licita em segundo
		int valorLicitacao = leilao.obtemUltimaLicitacao().obtemQuantia();
		assertFalse(12 >= valorLicitacao); // 12 < 15
	}
	
	
	/**
	 * Testa uma licitacao feita num leilao em que 
	 * o vendedor ficou com ma reputacao no decorrer do mesmo
	 */
	@Test
	public void test_LicitacaoReputacaoMa() {
		
		Leilao leilao = user2.obtemLeilao(idLeilao);
		user3.licitarLeilao(idLeilao, 15);
		
		user1.adicionaReputacao(Reputacao.MA);
		user1.adicionaReputacao(Reputacao.MA);
		user1.adicionaReputacao(Reputacao.MA);
		
		user2.licitarLeilao(idLeilao, 20); // 20 e´ maior que 15, mas a reputacao esta´ ma´
		int valorLicitacao = leilao.obtemUltimaLicitacao().obtemQuantia();

		assertEquals(15, valorLicitacao); // 10 e´ a licitacao mais alta 
	}

}