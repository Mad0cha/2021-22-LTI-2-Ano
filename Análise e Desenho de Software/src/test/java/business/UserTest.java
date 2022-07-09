package business;

/**
 * <p>Teste de utilizador.</p>
 *
 * @author Grupo12: MadalenaRodrigues_55853, PedroAlmeida_56897, RomuloNogueira_56935
 * @version $Id: $Id
 */

import static org.junit.Assert.assertEquals;

import org.junit.Before;

import org.junit.Test;


import business.Reputacao;
import business.User;

/**
 * Classe que testa a criacao de um utilizador e de um artigo
 */
public class UserTest {
	
	private User user;
	
	/**
	 * Cria um utilizador
	 */
	@Before
	public void setUpBefore() {
		
		this.user = new User ("User de Teste 1");
	}
	

	/**
	 * Testa a criacao de um utilizador
	 */
	@Test
	public void test_criaUtilizador() {
		
		Reputacao rep = this.user.obtemReputacao();
		assertEquals(Reputacao.NAO_TEM, rep);
	}
	
	
	/**
	 * Testa a criacao de um artigo
	 */
	@Test
	public void test_criarArtigo() {
		
		int idArtigo = this.user.criarArtigo("Artigo de Teste 1");
		assertEquals(0, idArtigo);		
	}

}