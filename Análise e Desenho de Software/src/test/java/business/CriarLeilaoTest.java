package business;

/**
 * <p>Teste de criar leilao.</p>
 *
 * @author Grupo12: MadalenaRodrigues_55853, PedroAlmeida_56897, RomuloNogueira_56935
 * @version $Id: $Id
 */

import static org.junit.Assert.*;

import org.junit.Before;
import org.junit.Test;

/**
 * Classe que testa a criacao de um leilao
 */
public class CriarLeilaoTest {
	
	private User userValido;
	private User userNaoValido;
	private User userSemArtigo;
	
	/**
	 * Inicializa os utilizadores; cria os artigos 
	 * e adiciona reputacoes
	 */
	@Before
	public void setUpBefore() {
		
		this.userValido = new User ("Utilizador Válido");
		this.userValido.criarArtigo("Artigo para Utilizador Válido");
		
		this.userNaoValido = new User ("Utilizador Não Válido");
		this.userNaoValido.criarArtigo("Artigo para Utilizador Não Válido");
		this.userNaoValido.adicionaReputacao(Reputacao.MA);
		
		this.userSemArtigo = new User("User sem artigo");
		
	}
	
	
	/**
	 * Testa a criacao de um leilao e verifica 
	 * que este foi criado corretamente sendo 
	 * por isso valido
	 */
	@Test
	public void test_CriarLeilaoValido() {
		
		int idLeilao = this.userValido.criarLeilao("normal", 0);
		assertEquals(StatusDoLeilao.Criado, this.userValido.obtemLeilao(idLeilao).obtemStatusLeilao());
		assertEquals(TipoDeLeilao.Normal, this.userValido.obtemLeilao(idLeilao).obtemSpec());
	}
	
	
	/**
	 * Testa a criacao de um leilao e verifica 
	 * que este nao foi criado corretamente sendo 
	 * por isso invalido
	 */
	@Test
	public void test_CriarLeilaoNaoValido() {

		int idLeilao = this.userNaoValido.criarLeilao("cego", 1);
		assertEquals(-1, idLeilao);
	}
	
	
	/**
	 * Testa a criacao de um leilao e verifica 
	 * que este foi criado sem artigo sendo 
	 * por isso invalido
	 */
	@Test
	public void test_CriarLeilaoSemArtigo() {
		
		int idLeilao = this.userSemArtigo.criarLeilao("invertido",1);
		assertEquals(-1, idLeilao);
	}

}