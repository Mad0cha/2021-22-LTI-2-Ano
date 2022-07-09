package business;

/**
 * <p>Teste de configurar leilao.</p>
 *
 * @author Grupo12: MadalenaRodrigues_55853, PedroAlmeida_56897, RomuloNogueira_56935
 * @version $Id: $Id
 */

import static org.junit.Assert.*;

import org.junit.Before;
import org.junit.Test;

import business.StatusDoLeilao;
import business.User;

/**
 * Classe que testa a configuracao de um leilao
 */
public class ConfigurarLeilaoTest {
	
	private User user1;
	private User user2;
	private User user3;
	private int idLeilao;
	private int idLeilao2;
	
	/**
	 * Inicializa os utilizadores; cria os artigos 
	 * a leiloar e os leiloes
	 */
	@Before
	public void setUpBefore() {
		
		this.user1 = new User ("User de Teste 1");
		this.user2 = new User ("User de Teste 2");
		this.user3 = new User ("User de Teste 3");
		
		int idArtigo = this.user1.criarArtigo("Artigo para o teste 1");
		this.idLeilao = this.user1.criarLeilao("Normal", idArtigo);
		
		int idArtigo2 = this.user3.criarArtigo("Artigo para o teste 2");
		this.idLeilao2 = this.user3.criarLeilao("Normal", idArtigo2);
	}
	
	
	/**
	 * Testa a configuracao de um leilao e verifica 
	 * que este foi configurado corretamente
	 */
	@Test
	public void test_ConfigurarLeilaoCorreto() {		
		
		this.user1.configurarLeilao(idLeilao, "22/06/2022 21:45:00", 100);
		
		assertEquals(StatusDoLeilao.Configurado, this.user1.obtemLeilao(idLeilao).obtemStatusLeilao()); // Verificar que ficou no estado correto
		assertEquals(100, this.user1.obtemLeilao(idLeilao).obtemPrecoBase()); // Verificar se o preço ficou correto
		assertEquals("Wed Jun 22 21:45:00 WEST 2022", this.user1.obtemLeilao(idLeilao).obtemDataFim().toString());  // Verificar se a data final esta´ bem configurada 
	}
	
	
	/**
	 * Testa a configuracao de um leilao e verifica 
	 * que este nao foi configurado corretamente
	 */
	@Test
	public void test_ConfigurarLeilaoIncorreto() {
		
		this.user2.configurarLeilao(idLeilao2, "22/06/2022 21:45:00", 100);

		assertEquals(StatusDoLeilao.Criado, this.user3.obtemLeilao(idLeilao2).obtemStatusLeilao());
	}

}